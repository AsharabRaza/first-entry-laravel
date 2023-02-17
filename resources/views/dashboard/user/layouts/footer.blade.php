<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">
                Copyright © <?php echo date('Y');?> <a href="javascript:void(0);">First Entry</a>. All rights reserved.
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
</div>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="bi bi-chevron-up" style="display: block;text-align: center;padding: 0;transform: translate(-50%, -50%);position: absolute;top: 50%;left: 50%;"></i></a>



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

@stack('js')
