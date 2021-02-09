
<!-- <script src="/vendors/chart.js/dist/Chart.bundle.min.js"></script> -->
<!-- <script src="/assets/js/widgets.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
{{-- <script src="/assets/js/main.js"></script> --}}
<script src="/assets/js/helper.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    jQuery(function($) {
        $('body').on('click', '.btn-logout', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('#form-logout').submit();
        });
        $('#menuToggle').on('click', function(event) {
            $('body').toggleClass('open');
        });
    });
</script>
@yield('script')
