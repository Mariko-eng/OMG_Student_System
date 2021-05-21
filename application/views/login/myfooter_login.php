 <!--footer start-->
 <footer class="footer-2">
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sub-footer-contain">
                        <p><span><i class="fa fa-copyright"></i> <?= date('Y') ?> </span><?= $this->site_options->get_site_data('site_owner') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer end-->

<!-- latest jquery-->
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js" ></script>

<!-- menu js-->
<script src="<?= base_url() ?>assets/js/menu.js"></script>

<!-- popper js-->
<script src="<?= base_url() ?>assets/js/popper.min.js" ></script>

<!-- slick js-->
<script  src="<?= base_url() ?>assets/js/slick.js"></script>

<!-- Bootstrap js-->
<script src="<?= base_url() ?>assets/js/bootstrap.js" ></script>

<!-- Theme js-->
<script src="<?= base_url() ?>assets/js/script.js" ></script>

<?php if(isset($on_page) && $on_page == 'home') { ?>
<!-- Home View -->
    <!-- Bootstrap js-->
<script src="<?= base_url() ?>assets/js/bootstrap-notify.min.js"></script>
<script src="<?= base_url() ?>assets/js/modal.js"></script>
<script src="<?= base_url() ?>assets/js/slider-animat-one.js"></script>

<?php } ?>

</body>
</html>