<body>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="text-center">
                <?php echo lang('Login.register'); ?>
            </h1>
        </div>
    </div>
    <?php
    if (isset($validation)) {
        echo $validation->listErrors();
    }

    echo form_open('login/register_user', 'class="form-horizontal" role="form"');
    $mail = array(
        'name'  => 'email',
        'id'    => 'email',
        'class' => 'form-control'
    );

    $username = array(
        'name'  => 'username',
        'class' => 'form-control'
    );
    $pwd      = array(
        'name'  => 'password',
        'class' => 'form-control'
    );
    ?>
    <div class="text-center d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="/images/logo.jpg" class="card-img-top">
            <div class="card-body">
                <p class="card-text"><?php echo lang('Login.mail'); ?></p>
                    <div class="input-group">
                        <div class="input-group-text">@</div>
                        <?php echo form_input($mail); ?>
                    </div>
            <p class="card-text">
            <p class="card-text"><?php echo lang('Login.password'); ?></p>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-key"></i></div>
                        <?php echo form_password($pwd); ?>
                    </div>
            <p class="card-text"><?php echo lang('Login.username'); ?></p>
            <?php echo form_input($username); ?>
            <br />
            <?php echo img_html('box-arrow-in-right', ' ' . lang('Login.validate'), null, lang('Login.validate'), 'success', 0, null, true); ?>
            <br />
            <?php echo anchor('login', lang('Login.connect')); ?>
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