<!-- jquery -->
<script src="{{env('APP_URL').'public/assets/js/jquery-3.3.1.min.js'}}"></script>
<!-- plugins-jquery -->
<script src="{{env('APP_URL').'public/assets/js/plugins-jquery.js'}}"></script>
<!-- plugin_path -->
<script type="text/javascript">var plugin_path = "{{env('APP_URL').'public/assets/js'}}/";</script>

<!-- chart -->
<script src="{{env('APP_URL').'public/assets/js/chart-init.js'}}"></script>
<!-- calendar -->
<script src="{{env('APP_URL').'public/assets/js/calendar.init.js'}}"></script>
<!-- charts sparkline -->
<script src="{{env('APP_URL').'public/assets/js/sparkline.init.js'}}"></script>
<!-- charts morris -->
<script src="{{env('APP_URL').'public/assets/js/morris.init.js'}}"></script>
<!-- datepicker -->
<script src="{{env('APP_URL').'public/assets/js/datepicker.js'}}"></script>
<!-- sweetalert2 -->
<script src="{{env('APP_URL').'public/assets/js/sweetalert2.js'}}"></script>
<!-- toastr -->

@yield('js')
<script src="{{env('APP_URL').'public/assets/js/toastr.js'}}"></script>
<!-- validation -->
<script src="{{env('APP_URL').'public/assets/js/validation.js'}}"></script>
<!-- lobilist -->
<script src="{{env('APP_URL').'public/assets/js/lobilist.js'}}"></script>
<!-- custom -->
<script src="{{env('APP_URL').'public/assets/js/custom.js'}}"></script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>

@if (App::getLocale() == 'en')
    <script src="{{env('APP_URL').'public/assets/js/bootstrap-datatables/en/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'public/assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js'}}"></script>
    <script>
        $('#datatable').DataTable({
            "ordering": false,
        });
    </script>
@else
    <script src="{{env('APP_URL').'public/assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'public/assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js'}}"></script>
    <script>
        $('#datatable').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.2/i18n/ar.json',
                // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            },
            "ordering": false,
        });
    </script>
@endif
