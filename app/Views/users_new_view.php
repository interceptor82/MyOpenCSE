    <body>
        <div class="d-flex" id="wrapper">
            <?php echo view('sidebar_view'); ?>
            <!-- Page Content  -->
            <div id="content">
                <?php echo form_open_multipart('users/add'); ?>
                <?php echo view('navbar_view'); ?>
                <?php
                if (isset($validation)) {
                    echo $validation->listErrors('error_list');
                }
                echo show_message($messages);
                if(!empty($user_id)) echo form_hidden('user_id', $user_id);
                
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
                    <label class="col-sm-2 col-form-label"><?php echo lang('Users.mail'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                                <span class="input-group-text"><?php echo single_icon('at'); ?></span>
                            <?php echo form_input('mail', set_value('secret', $user_detail->secret?? ''), 'class="form-control"') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"><?php echo lang('Users.available_profile'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                                <span class="input-group-text"><?php echo single_icon('id-card-alt', 'sm'); ?></span>
                                <?php // var_dump($user->getGroups()); ?>
                            <?php echo form_dropdown('profile', $profile_options, set_value('profile', ''), 'class="form-select" multiple') ?>
                        </div>
                    </div>
                    <label class="col-sm-2 col-form-label"><?php echo lang('Users.available_profile'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                                <ul class="list-group">
                                <?php foreach($user->getGroups() as $group){
                                    echo '<li class="list-group-item">'.$group. icon('circle-minus', null, 'user/delete_profile', null, 'danger', 0, null, false, false, 'sm').'</li>';
                                }
                                ?>
                        </div>
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