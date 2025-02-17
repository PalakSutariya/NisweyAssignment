@extends('layout.master')

@section('title', 'Edit contact')

@section('body')

    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update_contact', ['id' => $contact->id]) }}" method="post" id="save-contact">
                        @csrf
                        <div class="card-header border-0">
                            <h4 class="card-title">Update Contact</h4>
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
                            <div class="row col-6">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Name <span class="text-red">*</span></label>
                                        <input class="form-control" name="name" type="text"
                                            placeholder="Enter Name" value="{{ $contact->name  }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Contact No. <span class="text-red">*</span></label>
                                        <input class="form-control" name="contact_no" type="text" placeholder="Enter Contact Number" value="{{ $contact->contact_no  }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-success">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $.validator.addMethod("validMobile", function(value, element) {
                return this.optional(element) || /^\+90\s?\d{3}\s?\d{2,3}\s?\d{5}$/.test(value); // This regex assumes mobile number with country code
            }, "Please enter a valid contact number (e.g., +90 333 2677248, +90 3332677248, +90 33326 77248).");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.validator.addMethod("checkExist", function(val, elem) {
                    $.ajax({
                        url: "{{ route('check_unique_contact') }}",
                        method: "POST",
                        data: {
                            "phone": val,
                            "id": {{ $contact->id }}
                        },
                        async: false,
                        success: function(response) {
                            result = (response == true) ? true : false;
                        }
                    })
                    return result;
                },
                "Contact number is already exist"
            );

            $("#save-contact").validate({
                highlight: function(element) {
                    $(element).closest('.form').removeClass('has-success').addClass('has-error');
                },
                success: function(element) {
                    $(element).closest('.form').removeClass('has-error').addClass('has-success');
                    $(element).closest('.error').remove();
                },

                rules: {
                    name: {
                        required: true,
                        maxlength: 50,
                    },
                    contact_no: {
                        required: true,
                        validMobile: true,
                        checkExist: true
                    },
                },
                messages: {
                    name: {
                        required: "Name field is required",
                        maxlength: "The name must be less than 50 characters.",
                    },
                    contact_no: {
                        required: "Contact number field is required",
                    },
                },
                submitHandler: function(form, e) {
                    e.preventDefault();
                    form.submit();
                }
            });
        })

    </script>

@endpush