<body>
    <div class="d-flex" id="wrapper">
        <?php echo view('sidebar_view'); ?>
        <!-- Page Content  -->
        <div id="content">
            <?php echo form_open('users/add'); ?>
            <?php echo view('navbar_view'); ?>
            <?php
            if (isset($validation)) {
                echo $validation->listErrors('standard_errors');
            }
            echo show_message($messages);
            if (!empty($user_id)) echo form_hidden('user_id', $user_id);
            ?>
            <ul class="nav nav-tabs" id="TabUsers" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="new-user-tab" data-bs-toggle="tab" data-bs-target="#new-user-pane" type="button" role="tab" aria-controls="new-user-pane" aria-selected="true">Home</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#family-pane" type="button" role="tab" aria-controls="family-pane" aria-selected="false">Profile</button>
                </li>
            </ul>
            <div class="tab-content" id="TabUsersContent">
                <div class="tab-pane fade show active" id="new-user-pane" role="tabpanel" aria-labelledby="new-user-tab" tabindex="0">


                    <div class="alert alert-info" role="alert">
                        <h5 class="alert-heading"><?php echo lang('Users.user_features'); ?></h5>
                        <hr>
                        <p class="mb-0"><?php echo lang('Users.user_features_details'); ?></p>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"><?php echo lang('Users.civility'); ?></label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><?php echo single_icon('person-half-dress'); ?></span>
                                <?php echo form_input('civility', set_value('civility', $user->civility ?? ''), 'class="form-control"') ?>
                            </div>
                        </div>
                        <label class="col-sm-2 col-form-label"><?php echo lang('Users.birthdate'); ?></label>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <span class="input-group-text"><?php echo single_icon('calendar-days'); ?></span>
                                <?php echo form_input('birthdate', set_value('birthdate', $user->birthdate ?? ''), 'class="form-control" id="datepicker" ') ?>
                                <span class="add-on">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
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
                                <?php echo form_dropdown('country', $countries, set_value('country', $user->country_id ?? 75), 'class="form-select"') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"><?php echo lang('Users.site'); ?></label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#SiteModal">
                                    <?php echo single_icon('circle-plus', 'sm'); ?>
                                </button>
                                <span class="input-group-text"><?php echo single_icon('building-user', 'sm'); ?></span>
                                <?php echo form_dropdown('site', $site_options, set_value('site', $user->site_id), 'class="form-select"') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"><?php echo lang('Users.entry_date'); ?></label>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <span class="input-group-text"><?php echo single_icon('calendar-days'); ?></span>
                                <?php echo form_input('entry_date', set_value('entry_date', $user->entry_date ?? ''), 'class="form-control" id="datepicker2" ') ?>
                                <span class="add-on">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
                        <label class="col-sm-2 col-form-label"><?php echo lang('Users.release_date'); ?></label>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <span class="input-group-text"><?php echo single_icon('calendar-days'); ?></span>
                                <?php echo form_input('release_date', set_value('release_date', $user->release_date ?? ''), 'class="form-control" id="datepicker3" ') ?>
                                <span class="add-on">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                    </i>
                                </span>
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

                <!-- Modal -->
                <div class="modal fade" id="SiteModal" tabindex="-1" aria-labelledby="SiteModalLabel" aria-hidden="true">
                    <?php echo form_open('sites/add', 'class="needs-validation" novalidate'); ?>
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo lang('Sites.add_site'); ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label class="col-md-2"><?php echo lang('Sites.name'); ?></label>
                                    <div class="col-md-10">
                                        <div class="input-group has-validation">
                                            <?php echo form_input('name', '', 'class="form-control" required aria-describedb'); ?>
                                            <div class="invalid-feedback"><?php echo lang('Sites.name_required'); ?></div>


                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-md-2"><?php echo lang('Sites.address'); ?></label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><?php echo single_icon('address-book'); ?></span>
                                            <?php echo form_textarea('address', '', 'class="form-control" rows="3"'); ?>
                                        </div>
                                    </div>
                                    <label class="col-md-2"><?php echo lang('Sites.address2'); ?></label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><?php echo single_icon('address-book'); ?></span>
                                            <?php echo form_textarea('address2', '', 'class="form-control" rows="3"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-md-2"><?php echo lang('Sites.address3'); ?></label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><?php echo single_icon('address-book'); ?></span>
                                            <?php echo form_textarea('address3', '', 'class="form-control" rows="3"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-md-2"><?php echo lang('Sites.zipcode'); ?></label>
                                    <div class="col-md-4">
                                        <?php echo form_input('zipcode', '', 'class="form-control"'); ?>
                                    </div>
                                    <label class="col-md-2"><?php echo lang('Sites.city'); ?></label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><?php echo single_icon('city'); ?></span>
                                            <?php echo form_input('city', '', 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label"><?php echo lang('Sites.country'); ?></label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><?php echo single_icon('globe'); ?></span>
                                            <?php echo form_dropdown('site_country', $countries, set_value('site_country', 75), 'class="form-select"') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang('Common.close'); ?></button>
                                <button type="submit" class="btn btn-success"><?php echo lang('Common.save'); ?></button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="family-pane" role="tabpanel" aria-labelledby="family-tab" tabindex="0">
                <?php echo form_open('users/add_family'); ?>
                <div class="alert alert-info" role="alert">
                    <p class="mb-0"><?php echo lang('Users.family_details'); ?></p>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"><?php echo lang('Users.family_first_name'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><?php echo single_icon('user'); ?></span>
                            <?php echo form_input('family_first_name', set_value('family_first_name', ''), 'class="form-control"') ?>
                        </div>
                    </div>
                    <label class="col-sm-2 col-form-label"><?php echo lang('Users.family_last_name'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><?php echo single_icon('user'); ?></span>
                            <?php echo form_input('family_last_name', set_value('family_last_name', ''), 'class="form-control"') ?>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('#sidebarCollapse').on('click', function () {
                        $('#sidebar').toggleClass('active');
                    });
                });
            </script>
            <!-- Script -->
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#datepicker').datepicker({language: 'fr'});
                    $('#datepicker2').datepicker({language: 'fr'});
                    $('#datepicker3').datepicker({language: 'fr'});
                });
            </script>
            <script type="text/javascript">
            $(document).ready(function () {

                $('a[data-bs-toggle="tab"]').on('show.bs.tab', function (e) {
                    localStorage.setItem('activeTab', $(e.target).attr('href'));
                });

                var activeTab = localStorage.getItem('activeTab');

                if (activeTab) {
                    $('#TabUsers a[href="' + activeTab + '"]').tab('show');
                }

            });
        </script>

            </body>
            </html>