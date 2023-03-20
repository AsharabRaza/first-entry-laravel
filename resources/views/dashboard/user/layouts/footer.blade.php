</div>
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

<a href="#top" id="back-to-top"><i class="bi bi-chevron-up" style="display: block;text-align: center;padding: 0;transform: translate(-50%, -50%);position: absolute;top: 50%;left: 50%;"></i></a>

{{ Html::script('assets/plugin/peitychart/jquery.peity.min.js') }}
{{ Html::script('assets/plugin/peitychart/peitychart.init.js') }}
{{ Html::script('assets/plugin/select2/select2.full.min.js') }}
{{ Html::script('assets/plugin/datatable/js/jquery.dataTables.min.js') }}
{{ Html::script('assets/plugin/datatable/js/dataTables.bootstrap5.js') }}
{{ Html::script('assets/plugin/datatable/dataTables.responsive.min.js') }}
{{ Html::script('assets/plugin/sidemenu/sidemenu.js') }}
{{ Html::script('assets/js/sticky.js') }}
{{ Html::script('assets/plugin/sidebar/sidebar.js') }}
{{ Html::script('assets/plugin/p-scroll/perfect-scrollbar.js') }}
{{ Html::script('assets/plugin/p-scroll/pscroll.js') }}
{{ Html::script('assets/plugin/p-scroll/pscroll-1.js') }}
{{ Html::script('assets/plugin/notify/js/rainbow.js') }}
{{ Html::script('assets/plugin/notify/js/jquery.growl.js') }}
{{ Html::script('assets/plugin/notify/js/notifIt.js') }}
{{ Html::script('assets/js/index1.js') }}
{{ Html::script('assets/js/themeColors.js') }}
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
