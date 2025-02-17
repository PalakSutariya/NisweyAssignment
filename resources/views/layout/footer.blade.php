        </div>
        </div>
        </div>

        </div>

        <!-- Jquery js-->
        <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>

        <!-- Cookie js-->
        <script src="{{ asset('assets') }}/cookie/jquery.cookie.min.js"></script>
        <a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

        <script src="{{ asset('assets') }}/plugins/bootstrap/popper.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap-multiselect.min.js"></script>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

        <!-- INTERNAL Data tables -->
        <script src="{{ asset('assets') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatable/js/dataTables.bootstrap4.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatable/dataTables.responsive.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatable/responsive.bootstrap4.min.js"></script>
        <!-- Custom js-->
        <script src="{{ asset('assets') }}/js/custom.js"></script>

        <!-- Switcher js -->
        <script src="{{ asset('assets') }}/plugins/notify/js/jquery.growl.js"></script>
        <script src="{{ asset('assets') }}/plugins/notify/js/notifIt.js"></script>
        <script src="{{ asset('assets') }}/plugins/sweet-alert/sweetalert.min.js"></script>

        <script src="{{ asset('assets') }}/plugins/fancyuploder/jquery.ui.widget.js"></script>
        <script src="{{ asset('assets') }}/plugins/fancyuploder/jquery.fileupload.js"></script>
        <script src="{{ asset('assets') }}/plugins/fancyuploder/jquery.iframe-transport.js"></script>
        <script src="{{ asset('assets') }}/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
        <script src="{{ asset('assets') }}/plugins/fancyuploder/fancy-uploader.js"></script>

        <script src="{{ asset('assets') }}/plugins/fileupload/js/dropify.js"></script>
        <script src="{{ asset('assets') }}/js/filupload.js"></script>

        <script>
            function custom_message(type, message) {
                if (type == "success") {
                    $.growl.notice({
                        title: "Success!",
                        message: message
                    });
                } else if (type == "error") {
                    $.growl.error({
                        message: message
                    });
                }
            }
        </script>
        @stack('script')

        