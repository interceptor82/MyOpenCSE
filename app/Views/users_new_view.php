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
                                <span class="input-group-text"><?php echo icon('journal-text'); ?></span>
                            <?php echo form_input('first_name', set_value('first_name', $user->first_name), 'class="form-control"') ?>
                        </div>
                    </div>
                    <label class="col-sm-2 col-form-label"><?php echo lang('Users.last_name'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                                <span class="input-group-text"><?php echo icon('journal-text'); ?></span>
                            <?php echo form_input('last_name', set_value('last_name', $user->last_name), 'class="form-control"') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"><?php echo lang('Users.mail'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                                <span class="input-group-text"><?php echo icon('envelope'); ?></span>
                            <?php echo form_input('mail', set_value('secret', $user->secret?? ''), 'class="form-control"') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"><?php echo lang('Users.profile'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                                <span class="input-group-text"><?php echo icon('id-card-alt', 'sm', 'fontawesome'); ?></span>
                            <?php echo form_dropdown('profile_id', $profile_options, set_value('profile', $user['profile_id']), 'class="form-select"') ?>
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