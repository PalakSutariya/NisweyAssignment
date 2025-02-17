<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Jobs\ImportContact;
use League\Csv\Reader;

class UserController extends Controller
{
    /**
    * @name contacts()
    * @uses It will redirect to contact list
    */
    public function contacts() {
        return view('contact_list');
    }

    /**
    * @name contactList()
    * @uses It will load data table data
    */
    public function contactList(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            $response = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $res = '';
                    $res .= '<a class="btn btn-primary btn-icon btn-sm mr-1 edit_contact" data-id="' . $row->id . '">
                    <i class="feather feather-edit" data-toggle="tooltip" data-original-title="Edit"></i>
                    </a>';
                    $res .= '<a class="btn btn-danger btn-icon btn-sm delete_contact" data-id="' . $row->id . '" data-toggle="tooltip" data-original-title="Delete"><i class="feather feather-trash-2"></i></a>';

                    return $res;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $response;
        }
    }

    /**
    * @name saveContact()
    * @uses It will redirect to add contact page
    */
    public function addContact() {
        return view('add_contact');
    }

    /**
    * @name saveContact()
    * @uses It will save contact data
    */
    public function saveContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'contact_no' => 'required|unique:users,contact_no',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->contact_no = $request->contact_no;
        $saved = $user->save();

        if ($saved) {
            flash()->success('Contact added successfully!');
        } else {
            flash()->error('Contact not added successfully!');
        }
        return redirect('/contacts');
    }

    /**
    * @name checkUniqueContact()
    * @uses it will check unique contact
    */
    public function checkUniqueContact(Request $request)
    {
        $userCheck = User::where('id', '!=', $request->id)->where('contact_no', $request->phone)->get()->toArray();
        if (!empty($userCheck)) {
            echo false;
        } else {
            echo true;
        }
    }

    /**
    * @name editContact()
    * @uses It will redirect to edit contact page
    */
    public function editContact($id) {
        $contact = User::find($id);
        return view('contact_edit', compact('contact'));
    }

    /**
    * @name updateContact()
    * @uses It will update contact in database
    */
    public function updateContact(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'contact_no' => 'required|unique:users,contact_no,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contact = User::find($id);
        $contact->name = $request->name;
        $contact->contact_no = $request->contact_no;
        $saved = $contact->save();
        if ($saved) {
            flash()->success('Contact updated successfully!');
        } else {
            flash()->error('Contact not updated successfully!');
        }
        return redirect('/contacts');
    }
    /**
    * @name deleteContact()
    * @uses It will delete contact
    */
    public function deleteContact(Request $request)
    {
        $contact = User::find($request->contact_id);
        $deleted = $contact->delete();
        if ($deleted) {
            $data['status'] = true;
            $data['message'] = "Contact deleted successfully";
        } else {
            $data['status'] = false;
            $data['message'] = "Contact not deleted successfully";
        }
        return response(json_encode($data));
    }

    /**
    * @name importContactFile()
    * @uses It will redirect to import contact view
    */
    public function importContactFile()
    {
        return view('import_contact_xml');
    }

    /**
    * @name downloadExampleFile()
    * @uses It will download sample XML file
    */
    public function downloadExampleFile() {
        $data = [
            ['name' => 'KöktenAdal', 'contact' => '+90 333 8859342'],
            ['name' => 'HammaAbdurrezak', 'contact' => '+90 333 1563682'],
            ['name' => 'GüleycanŞensal', 'contact' => '+90 333 2557114'],
        ];
        $xml = new \SimpleXMLElement('<items/>');

        foreach ($data as $item) {
            $itemXml = $xml->addChild('item');
            $itemXml->addChild('name', $item['name']);
            $itemXml->addChild('contact', $item['contact']);
            
        }

        return response($xml->asXML()) // Convert XML object to string
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'attachment; filename="sample_xml_file.xml"');
    }

    /**
    * @name importContacts()
    * @uses It will Import contact data, if contact already added then that record will not be added adain
    * this will import XML and CSV both file, if file data were wrong then it will show error
    */
    public function importContacts(Request $request)
    {
        $request->validate([
            'uploaded_file' => 'required|file|mimes:csv,xml',
        ]);

        $file = $request->file('uploaded_file');
        $extension = $file->getClientOriginalExtension();

        $count_inserted = $duplicate_count = $error = 0;
        if($extension == 'csv') {
            $contact_data = array_map('str_getcsv', file($file));
            unset($contact_data[0]);
            $database_field_names = ['name', 'contact'];
            
            $all_contact_data = array_map(function ($field_name) use ($database_field_names) {
                $return_arr = [];
                $return_arr = array_combine($database_field_names, $field_name);
                return $return_arr;
            }, $contact_data);

        } else if ($extension == 'xml') {
            $all_contact_data = simplexml_load_file($file);
            $all_contact_data = json_decode(json_encode($all_contact_data), true)['item'];
        }

        foreach ($all_contact_data as $record) {
            if(isset($record['contact'])) {
                $get_already_exist = User::where('contact_no', $record['contact'])->get()->toArray();
                if(empty($get_already_exist)) {
                    User::create([
                        'name' => $record['name'] ?? $record['name'],
                        'contact_no' => $record['contact']
                    ]);
                    $count_inserted++;
                } else {
                    $duplicate_count++;
                }
            } else {
                $error++;
            }
        }

        if($count_inserted > 0) {
            $response['status'] = true;
            $response['message'] = "Total " . $count_inserted . " contact data inserted successfully";
        } else if ($count_inserted == 0 && $duplicate_count > 0) {
            $response['status'] = false;
            $response['message'] = $duplicate_count . " Records are already added in database";
        } else {
            $response['status'] = false;
            $response['message'] = "Something went wrong, please try with correct file!";
        }

        return response(json_encode($response));
    }
}
