@extends('layout.master')

@section('title', 'Import Contacts')

@section('body')

    <div class="row">
        <div class="col-xl-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="import__with_column" method="post">
                        @csrf
                        @csrf
                        <div class="card-header border-0">
                            <h4 class="card-title">Import contacts</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mb-5">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li> <strong> {{ $error }} </strong> </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <label class="form-label">Import file *</label>
                                    <input type="file" class="dropify" accept=".xml,.csv" name="uploaded_file"
                                        data-height="180" />
                                    <div class="text-red" id="emoji-image-error"></div>
                                    @error('file')
                                        <div class="text-red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group-download with-button cust_download_sample_button">
                                <a href="{{ route('download_file') }}" class="download_import_excel_file d-flex justify-content-between"
                                    id="contact_import_sample_template">
                                    <input readonly="" value="Download sample XML file" type="text"
                                        class="cust_download_sample_input" id="contact_download_template_name">
                                    <div class="btn cust_download_sample_div" style="cursor: pointer;"><i
                                            class="icon-feather-download"></i></div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button class="btn btn-success import-xml-file ">Add</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        
    </div>
   
@endsection
@push('script')
    <script>
        $('#import__with_column').submit(function(e) {
            e.preventDefault();
            $('.import-xml-file').prop('disabled', true);

            var formData = new FormData($("#import__with_column")[0]);
            $.ajax({
                url: "{{ route('save_import_contacts') }}",
                contentType: false,
                processData: false,
                data: formData,
                type: 'post',
                success: function(response) {
                    $('.import-xml-file').prop('disabled', false);
                    var response = $.parseJSON(response);
                    console.log(response)
                    if(response.status == true) {
                        custom_message('success', response.message);
                    } else {
                        custom_message('error', response.message);
                    }
                }
            });
        });

       
    </script>
@endpush
