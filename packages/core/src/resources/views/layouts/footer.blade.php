
<!-- <script src="/vendors/chart.js/dist/Chart.bundle.min.js"></script> -->
<!-- <script src="/assets/js/widgets.js"></script> -->
<script src="/vendors/jquery/dist/jquery.min.js"></script>
<script src="/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/js/main.js"></script>
<script src="/assets/js/helper.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    jQuery(function($) {
        $('body').on('click', '.btn-logout', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('#form-logout').submit();
        });
    });
</script>
@yield('script')