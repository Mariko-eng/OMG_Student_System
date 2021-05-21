</div>
        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0"><?= date('Y') ?>. <a href="<?= base_url() ?>">
                        <?php echo $this->site_options->get_site_data('site_name') ?>
                    </a> by Silus<!--<a href="http://www.deronltd.com/" target="_blank">Kujahapa</a>--></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer end--> 
    </div>

</div>

<!-- Slim select -->
    <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/slimselect/slimselect.min.js"></script>

    <!-- feather icon js-->
    <script src="<?= base_url() ?>assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?= base_url() ?>assets/js/icons/feather-icon/feather-icon.js"></script>
    
    <!-- Dropzone js-->
    <script src="<?= base_url() ?>assets/js/dropzone/dropzone.js"></script>
    <script src="<?= base_url() ?>assets/js/dropzone/dropzone-script.js"></script>

    <!-- touchspin js-->
    <script src="<?= base_url() ?>assets/js/touchspin/vendors.min.js"></script>
    <script src="<?= base_url() ?>assets/js/touchspin/touchspin.js"></script>
    <script src="<?= base_url() ?>assets/js/touchspin/input-groups.min.js"></script>

    <!-- form validation js-->
    <script src="<?= base_url() ?>assets/js/dashboard/form-validation-custom.js"></script>

    <!-- Jquery javascript -->
    <script src="<?= base_url() ?>assets/js/jquery/jquery-3.6.0.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery/jquery-ui.js"></script>      

    <!-- Sidebar jquery-->
    <script src="<?= base_url() ?>assets/js/sidebar-menu.js"></script>

    <!-- Jsgrid js-->
    <script src="<?= base_url() ?>assets/js/jsgrid/jsgrid.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jsgrid/griddata-media.js"></script>
    <script src="<?= base_url() ?>assets/js/jsgrid/jsgrid-media.js"></script>
    
    <!-- Bootstrap js-->
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.js"></script>

    

    <!-- ckeditor js-->
<!-- <script src="<?= base_url() ?>assets/js/editor/ckeditor/ckeditor.js"></script> -->
<!-- <script src="<?= base_url() ?>assets/js/editor/ckeditor/styles.js"></script> -->
<!-- <script src="<?= base_url() ?>assets/js/editor/ckeditor/adapters/jquery.js"></script> --> -->
<!-- <script src="<?= base_url() ?>assets/js/editor/ckeditor/ckeditor.custom.js"></script> -->

<!-- Zoom js-->
<!-- <script src="<?= base_url() ?>assets/js/jquery.elevatezoom.js"></script> -->
<!-- <script src="<?= base_url() ?>assets/js/zoom-scripts.js"></script> -->

<!--Customizer admin-->
<!-- <script src="assets/js/admin-customizer.js"></script> -->
<script src="<?= base_url() ?>assets/js/admin-customizer.js"></script>

<!--lazyload js-->
<script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="<?= base_url() ?>assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="<?= base_url() ?>assets/js/admin-script.js"></script>

<!--height equal js-->
<script src="<?= base_url() ?>assets/js/equal-height.js"></script>

<!-- Custom JS -->
<script src="<?= base_url() ?>assets/js/custom-js.js"></script>

<!--counter js-->
<script src="<?= base_url() ?>assets/js/counter/jquery.waypoints.min.js"></script> -->
<script src="<?= base_url() ?>assets/js/counter/jquery.counterup.min.js"></script> -->
<script src="<?= base_url() ?>assets/js/counter/counter-custom.js"></script>

<!--map js-->
<script src="<?= base_url() ?>assets/js/vector-map/jquery-jvectormap-2.0.2.min.js"></script> -->
<script src="<?= base_url() ?>assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js"></script> -->

<!--apex chart js-->
<script src="<?= base_url() ?>assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="<?= base_url() ?>assets/js/chart/apex-chart/stock-prices.js"></script>
    
<!-- Javascript -->
<script>
    $(function() {
        $( "#birth_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2021",
            showAnim: "fold"
        });
    });
</script>

<script>
    $(function() {
        $( "#certificate_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2010:2021",
            showAnim: "fold"
        });
    });
</script>certificate_nationality_date

<script>
    $(function() {
        $( "#certificate_nationality_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2010:2021",
            showAnim: "fold"
        });
    });
</script>

<?= !empty($scripts) ? $scripts : ''; ?>

</body>
</html>
