    <body>
        <div class="d-flex" id="wrapper">
            <?php echo view('sidebar_view', ['user'=>$user]); ?>
            <!-- Page Content  -->
            <div id="page-content-wrapper">
                <?php echo view('navbar_view'); ?>
                <?php echo show_message($messages); ?>
                <table id="dt_users" class="table table-striped table-bordered table-hover table-condensed dt-responsive" width="100%">
                    <thead class="table-primary">
                        <tr>
                            <?php
                            foreach ($datatable_headers as $key => $header) {
                                echo '<th >' . $header . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <?php
                            foreach ($datatable_headers as $key => $header) {
                                echo '<th>' . $header . '</th>';
                            }
                            ?>
                        </tr>
                    </tfoot>
                </table>

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
        <script type="text/javascript">
            $(document).ready(function () {
                var cpt;
                cpt = 0;
                $('#dt_users tfoot th').each(function () {
                    var title = $(this).text();

                    if (title != "<?php echo lang('Orders.actions'); ?>") {
                        $(this).html('<div class="text-center"><input type="text" name="users_' + cpt + '" placeholder="' + title + '" class="form-control" style="width:100%;" /></div>');
                    } else {
                        $(this).html('<div class="text-center"></div>');
                    }
                    cpt += 1;
                });


                var dataTable = $('#dt_users').DataTable({
                    "processing": true,
                    "select": true,
                    "serverSide": true,
//                    "scrollX": true,
                    "colReorder": true,
                    "fixedHeader": true,
                    "responsive": true,
                    "stateSave": true,
                    "stateLoadParams": function (settings, data) {
                        data.search.product_1 = "";
                    },

                    "stateDuration": 0,
                    "dom": 'RBlfrtip',
                    "buttons": ['print', 'colvis', 'excelHtml5',
                        {
                            text: '<?php echo lang('Common.delete_filters'); ?>',
                            action: function (e, dt, node, config) {
                                dataTable.state.clear();
                                window.location.reload();
                            }
                        },
                        'copy'],
                    "fnDrawCallback": function (oSettings) {
                        $("a").tooltip(), $("button").tooltip({"html": true, "placement": 'left'})
                    },
                    "ajax": {
                        "url": "<?php echo '/index.php/users/datatable_users'; ?>"
                    },
                    "aoColumns": [
                        {"sName": "first_name", "aTargets": [0]},
                        {"sName": "last_name", "aTargets": [1]},
                        {"sName": "secret", "aTargets": [2]},
                        {"sName": "actions", "aTargets": [3]},
                    ],
                    "sRowSelect": "multi",
                    "lengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, "Tout"]],
                    "oLanguage":
                            {
<?php echo view('datatable_language_view'); ?>

                            }
                });
<?php
$data = [
    'max_column'             => 3,
    'repopulate_column_name' => 'users_',
    'datatable_id'           => 'dt_users'
];

echo view('datatable_functions_view', $data);
?>

            });
        </script>
    </body>
</html>
