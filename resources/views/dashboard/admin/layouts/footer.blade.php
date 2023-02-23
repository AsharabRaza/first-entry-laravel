
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>--}}
{{ Html::script('assets/js/jquery.min.js') }}

<!-- BOOTSTRAP JS -->
{{ Html::script('assets/plugin/bootstrap/js/popper.min.js',array('media'=>'all','rel'=>'stylesheet')) }}
{{ Html::script('assets/plugin/bootstrap/js/bootstrap.min.js') }}

<!-- SPARKLINE JS-->
<!--<script src="../assets/js/jquery.sparkline.min.js"></script>-->

<!-- CHART-CIRCLE JS-->
<!--<script src="../assets/js/circle-progress.min.js"></script>-->

<!-- CHARTJS CHART JS-->
<!--<script src="../assets/plugin/chart/Chart.bundle.js"></script>
<script src="../assets/plugin/chart/utils.js"></script>-->

<!-- PIETY CHART JS-->
{{ Html::script('assets/plugin/peitychart/jquery.peity.min.js') }}
{{ Html::script('assets/plugin/peitychart/peitychart.init.js') }}

<!-- INTERNAL SELECT2 JS -->
{{ Html::script('assets/plugin/select2/select2.full.min.js') }}

<!-- INTERNAL Data tables js-->
{{ Html::script('assets/plugin/datatable/js/jquery.dataTables.min.js') }}
{{ Html::script('assets/plugin/datatable/js/dataTables.bootstrap5.js') }}
{{ Html::script('assets/plugin/datatable/dataTables.responsive.min.js') }}

<!-- ECHART JS-->
<!--<script src="../assets/plugin/echarts/echarts.js"></script>-->

<!-- SIDE-MENU JS-->
{{ Html::script('assets/plugin/sidemenu/sidemenu.js') }}

<!-- Sticky js -->
{{ Html::script('assets/js/sticky.js') }}

<!-- SIDEBAR JS -->
{{ Html::script('assets/plugin/sidebar/sidebar.js') }}

<!-- Perfect SCROLLBAR JS-->
{{ Html::script('assets/plugin/p-scroll/perfect-scrollbar.js') }}
{{ Html::script('assets/plugin/p-scroll/pscroll.js') }}
{{ Html::script('assets/plugin/p-scroll/pscroll-1.js') }}

<!-- APEXCHART JS -->
<!--<script src="../assets/js/apexcharts.js"></script>-->

<!-- INTERNAL Notifications js -->
{{ Html::script('assets/plugin/notify/js/rainbow.js') }}
{{ Html::script('assets/plugin/notify/js/jquery.growl.js') }}
{{ Html::script('assets/plugin/notify/js/notifIt.js') }}


<!-- INDEX JS -->
{{ Html::script('assets/js/index1.js') }}

<!-- Color Theme js -->
{{ Html::script('assets/js/themeColors.js') }}

<!-- CUSTOM JS -->
{{ Html::script('assets/js/custom.js') }}

<script>
    $('#open_right_toggle').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $('.dropdown-toggle2').dropdown('toggle');
    });
</script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@stack('js')
