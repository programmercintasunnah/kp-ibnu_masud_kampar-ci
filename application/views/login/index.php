<div class="container">
    <div class="row">
        <div class="login-container col-lg-4 col-md-6 col-sm-8 col-xs-12">

            <div class="login-content">
                <div class="login-header">
                    <h4 class="tg">YAYASAN NIDA' AS-SUNNAH KAMPAR</h4>
                    <h4 class="tg">PPS. TAHFIZH AL-QUR'AN</h4>
                    <h2 class="tg"><strong>IBNU MAS'UD</strong></h2>
                    <h4 class="tg">KAMPAR</h4>
                    <div class="login-title text-center">
                        <img class="gmbr" src="<?= base_url("assets/") ?>img/icon.png" alt="">
                    </div>

                </div>

                <div class="login-body">
                    <?= $this->session->flashdata('message'); ?>
                    <form role="form" action="<?= base_url("login") ?>" method="post" class="login-form">
                        <div class="form-group ">
                            <div class="pos-r">
                                <input id="username" type="text" name="username" placeholder="Username..." value="<?= set_value(("username")) ?>" autocomplete="off" autofocus class="form-username form-control">
                                <i class="fa fa-user"></i>
                                <span></span>
                            </div>
                            <?= form_error('username', '<small class="pl-3 b">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <div class="pos-r">
                                <input id="password" type="password" name="password" placeholder="Password..." class="form-password form-control">
                                <i class="fa fa-lock"></i>
                                <span></span>
                            </div>
                            <?= form_error('password', '<small class="pl-3 b">', '</small>') ?>
                        </div>
                        <!-- <div class="form-group text-right">
                            <a href="#" class="bold"> Forgot password?</a>
                        </div> -->

                        <div class="form-group">
                            <button type="submit" class="btn btn-default form-control"><strong>LOGIN</strong></button>
                        </div>
                        <a href="" class="">Lupa Password ?</a>
                    </form>
                </div> <!-- end  login-body -->
            </div><!-- end  login-content -->
            <div class="login-footer text-center template">
                <!-- <h5>Don't have an account?<a href="#" class="bold"> Sign up </a> </h5>
                <h5>Bootstrap login template made by <a href="https://github.com/azouaoui-med" class="bold"> Mohamed Azouaoui</a></h5>
          -->
            </div>
        </div> <!-- end  login-container -->

    </div>
</div><!-- end container -->