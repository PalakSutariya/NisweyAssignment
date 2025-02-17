@extends('layout.master')

@section('title', 'Contacts')

@section('body')

    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <h4 class="card-title">Contact List</h4>
                    <div class="row align-items-center justify-content-space-between">
                        <a class="btn btn-primary mr-2" href="{{ route('add_contact') }}">
                            Add
                        </a>
                        <a class="btn btn-primary mr-2" href="{{ route('import_contacts') }}">
                            Import
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="contact-table">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0 w-5">No</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Phone</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script type="text/javascript">
        var table;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            table = $('#contact-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('contact_list') }}",
                    type: "POST",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'contact_no',
                        name: 'contact_no'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });

        function reload_datatable() {
            table.ajax.reload(); //just reload table
        }

        $(document).on('click', '.edit_contact', function(event) {
            event.preventDefault();
            var id = $(this).attr('data-id');
            var editRoute = "{{ route('edit_contact', ':id') }}";
            var editUrl = editRoute.replace(':id', id);
            if (id != '') {
                window.location = editUrl
            }
        })

        $(document).on("click", ".delete_contact", function(e) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: !0,
                dangerMode: !0,
            }).then((willDelete) => {
                if (willDelete) {
                    var id = $(this).attr('data-id');
                    $.ajax({
                        url: "{{ route('delete_contact') }}",
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "contact_id": id,
                        },
                        success: function(response) {
                            reload_datatable();
                            var response = $.parseJSON(response);
                            if (response.status == true) {
                                custom_message('success', response.message);
                            } else {
                                custom_message('error', response.message);
                            }
                        }
                    });
                }
            });
        });        

    </script>
@endpush
