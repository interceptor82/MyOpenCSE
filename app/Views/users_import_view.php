<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title><?php echo lang('Users.users_import'); ?></title>
        <?php echo headers_html(5, true, false); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php echo view('Common/sidebar_view'); ?>
            <!-- Page Content  -->
            <div id="content">
                <?php echo form_open_multipart('public/users/import_file_preview'); ?>
                <?php echo view('Common/navbar_view'); ?>
                <?php echo show_message($messages); ?>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"><?php echo lang('Settings.template'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><?php echo icon('journal-text'); ?></span>
                            <?php echo form_dropdown('template_name', $templates, set_value('template_name'), 'class="form-control"') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"><?php echo lang('Products.file'); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><?php echo icon('upload'); ?></span>
                            <div class="custom-file">
                                <?php
                                if (isset($file_name) && !empty($file_name) && !isset($messages['danger'])) :
                                    echo '<label class="col-sm-2 col-form-label">' . $file_name . '</label>';
                                else :
                                    echo form_upload('users_file', '', 'class="custom-file-input" id="customFileLangHTML"')
                                    ?>
                                    <label class="custom-file-label" for="customFileLangHTML" data-browse="<?php echo lang('Common.browse'); ?>"><?php echo lang('Common.file_select'); ?></label>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $table = new \CodeIgniter\View\Table();
                if (isset($file_preview) && !empty($file_preview)) {
                    echo '<p>' . lang('Products.check_preview_file') . '</p>';
                    $template = [
                        'table_open' => '<table class="table table-striped table-bordered table-hover table-responsive">'
                    ];
                    $table->setTemplate($template);
                    echo $table->generate($file_preview);
                    echo form_hidden('proceed_import', 1);
                }
                echo form_hidden('template_type', $type);
                ?>
            </div>
        </div>
<?php echo form_close(); ?>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });


        });
    </script>
</html>