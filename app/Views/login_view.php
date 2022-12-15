<body>
    <div class="home">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid d-flex justify-content-center">
                <h1><?php echo lang('Login.title'); ?></h1>
            </div>
        </nav>
        <?php
        if (isset($validation)) {
            echo $validation->listErrors();
        }
        echo show_message($messages);
        ?>
        <div class="text-center d-flex bg-primary justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url(); ?>/images/logo.jpg" class="card-img-top">
                <div class="card-body">
                    
                    <br />
                    <?php echo icon('box-arrow-in-right', ' ' . lang('Login.connect'), 'login', lang('Login.connect'), 'success', 0, null, false); ?>
                    <br />
                    <?php echo anchor('login/forgot_password', lang('Login.forgot_password')); ?>
                    <br />
                    <?php echo anchor('register', lang('Login.register')); ?>
                </div>
            </div>
        </div>
        <input id="hidd_lang" name="hidd_lang" type="hidden" />
    </div>
    <!--<div class="text-center">-->
                <!--<img src="<?php // echo base_url();     ?>/app/views/img/logo.png" class="img-fluid" alt="" class="rounded mx-auto d-block">-->
    <!--</div>-->
    <script language="javascript">
        document.getElementById('mail').focus();
        document.getElementById("hidd_lang").value = document.getElementById("sel_lang").value;
    </script>
    <script type="text/javascript">
        jQuery(function ($) {
            $("button").tooltip()
        });
    </script>
</body>
