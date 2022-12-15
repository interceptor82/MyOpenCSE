<body>
    <div class="home">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid d-flex justify-content-center">
                <h1><?php echo lang('Login.title'); ?></h1>
            </div>
        </nav>
        <?php
        if (isset($validation)) {
            echo $validation->listErrors('standard_errors');
        }
        echo show_message($messages);

        echo form_open('login/reset_password_link', 'class="form-horizontal" role="form"');
        $mail = array(
            'name'  => 'mail',
            'id'    => 'mail',
            'class' => 'form-control'
        );
        ?>
        <div class="text-center d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="/images/logo.jpg" class="card-img-top">
            <div class="card-body">
                <div class="input-group">
                    <p class="card-text">
                    <span class="input-group-text">
                        <?php echo lang('Login.mail'); ?>@
                    </span>
                </p>
                    <?php echo form_input($mail); ?>
                </div>
               <?php echo img_html('box-arrow-in-right', ' ' . lang('Login.validate'), null, lang('Login.validate'), 'success', 0, null, true); ?>
                    <br />
                    <?php echo anchor('public/login', lang('Login.connect')); ?>
            </div>
        </div>
        </div>
        
        <input id="hidd_lang" name="hidd_lang" type="hidden" />

        <?php
        echo form_close();
        ?>

        <script language="javascript">
            document.getElementById('mail').focus();
            document.getElementById("hidd_lang").value = document.getElementById("sel_lang").value;
        </script>

        <?php
//        include "application/views/console_user/footer_bootstrap_4.php";
        ?>
        <script type="text/javascript">
            jQuery(function ($) {
                $("button").tooltip()
            });
        </script>
</body>
</html>