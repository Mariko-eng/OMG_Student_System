
<!-- breadcrumb start -->
<div class="breadcrumb-main ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-contain">
                    <div>
                        <h2>login</h2>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><i class="fa fa-angle-double-right"></i></li>
                            <li><a href="#">login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->

<!--section start-->
<section class="login-page section-big-py-space bg-light">

    <?php if(isset($alert_page) || !empty($alert_page = $this->session->flashdata('alert'))){ ?>
        <div class="custom-container">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                    <div class="theme-card">
                        <?= $alert_page ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="custom-container">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                <div class="theme-card">
                    <h3 class="text-center">Login</h3>
                    <form class="theme-form" method="post" action="<?= base_url('login') ?>">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="username" class="form-control" id="email" placeholder="Email" required="">
                        </div>
                        <div class="form-group">
                            <label for="review">Password</label>
                            <input type="password" name="password" class="form-control" id="review" placeholder="Enter your password" required="">
                        </div>
                        <button type="submit" class="btn btn-normal">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>