<body>
    <div class="d-flex" id="wrapper">
        <?php echo view('sidebar_view'); ?>
        <!-- Page Content  -->
        <div id="content">
            <?php echo form_open_multipart('users/add'); ?>
            <?php echo view('navbar_view'); ?>
            <?php
            if (isset($validation)) {
                echo $validation->listErrors('standard_errors');
            }
            echo show_message($messages);
            if (!empty($user_id)) echo form_hidden('user_id', $user_id);
            ?>
            <div class="alert alert-info" role="alert">
                <h5 class="alert-heading"><?php echo lang('Users.user_features'); ?></h5>
                <hr>
                <p class="mb-0"><?php echo lang('Users.user_features_details'); ?></p>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.first_name'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('user'); ?></span>
                        <?php echo form_input('first_name', set_value('first_name', $user->first_name), 'class="form-control"') ?>
                    </div>
                </div>
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.last_name'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('user'); ?></span>
                        <?php echo form_input('last_name', set_value('last_name', $user->last_name), 'class="form-control"') ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.username'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('user'); ?></span>
                        <?php echo form_input('username', set_value('username', $user->username ?? ''), 'class="form-control"') ?>
                    </div>
                </div>
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.mail'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('at'); ?></span>
                        <?php echo form_input('email', set_value('secret', $user_detail->secret ?? ''), 'class="form-control"') ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.address'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('address-book'); ?></span>
                        <?php echo form_textarea('address', set_value('address', $user->address ?? ''), 'class="form-control" rows="3"') ?>
                    </div>
                </div>
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.address2'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('address-book'); ?></span>
                        <?php echo form_textarea('address2', set_value('address2', $user->address2 ?? ''), 'class="form-control" rows="3"') ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3 align-items-center">
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.address3'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('address-book'); ?></span>
                        <?php echo form_textarea('address3', set_value('address3', $user->address3 ?? ''), 'class="form-control" rows="3"') ?>
                    </div>
                </div>
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.zipcode'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('location-dot'); ?></span>
                        <?php echo form_input('zipcode', set_value('zipcode', $user->zipcode ?? ''), 'class="form-control"') ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.city'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('city'); ?></span>
                        <?php echo form_input('city', set_value('city', $user->city ?? ''), 'class="form-control"') ?>
                    </div>
                </div>
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.country'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('globe'); ?></span>
                        <?php echo form_dropdown('country', $countries, set_value('country', $user->country_code ?? 'FR'), 'class="form-select"') ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.site'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('building-user', 'sm'); ?></span>
                        <?php // var_dump($user->getGroups());  ?>
                        <?php echo form_dropdown('site', $site_options, set_value('site', $user->site_id), 'class="form-select"') ?>
                    </div>
                </div>
            </div>    
            <div class="alert alert-info" role="alert">
                <p class="mb-0"><?php echo lang('Users.user_profiles_details'); ?></p>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.available_profile'); ?></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><?php echo single_icon('id-card-alt', 'sm'); ?></span>
                        <?php // var_dump($user->getGroups());  ?>
                        <?php echo form_dropdown('profile[]', $profile_options, set_value('profile', ''), 'class="form-select" multiple') ?>
                    </div>
                </div>
                <label class="col-sm-2 col-form-label"><?php echo lang('Users.assigned_profile'); ?></label>
                <div class="col-md-4">

                    <ul class="list-group">
                        <?php
                        $encrypter = \Config\Services::encrypter();
                        foreach ($user->getGroups() as $group) {
                            echo '<li class="list-group-item d-flex justify-content-between align-items-center">' . $profiles_affected[$group] . icon('circle-minus', null, 'users/delete_profile/' . bin2hex($encrypter->encrypt($group)), null, 'danger', 0, null, false, false, 'sm') . '</li>';
                        }
                        ?>

                </div>
            </div>
            
            <?php echo form_close(); ?>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(function ($) {
            $("button").tooltip()
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html>