    <body>
        <div class="d-flex" id="wrapper">
            <?php echo view('sidebar_view', ['user'=>$user]); ?>

            <!-- Page Content  -->
            <div id="page-content-wrapper">

                <?php echo view('navbar_view'); ?>
                <?php
                $icons   = [
                    'pie-chart-fill', 
                    'box-seam', 
                    'basket-fill', 
                    'handbag-fill', 
                    'cart4', 
                    'cart3', 
                    'truck', 
                    'easel-fill', 
                    'tools', 
                    'users', 
                    'plug'
                    ];
                $titles  = [
                    lang('Home.dashboard'), 
                    lang('Home.stock_management'), 
                    lang('Home.suppliers'), 
                    lang('Home.bank_reconciliation'), 
                    lang('Home.ged'), 
                    lang('Home.orders'), 
                    lang('Home.dealings'), 
                    lang('Home.reporting'), 
                    lang('Home.settings'), 
                    lang('Home.users'), 
                    lang('Home.plugins')
                    ];
                $text    = [
                    lang('Home.dashboard_description'), 
                    lang('Home.dealings_description'), 
                    lang('Home.suppliers_description'), 
                    lang('Home.bank_reconciliation_description'),  
                    lang('Home.ged_description'), 
                    lang('Home.orders_description'), 
                    lang('Home.shipment_description'), 
                    lang('Home.reporting_description'), 
                    lang('Home.settings_description'), 
                    lang('Home.users_description'), 
                    lang('Home.plugins_description')
                    ];
                $links   = [
                    '#', 
                    'public/receipts/menu', 
                    'public/suppliers', 
                    'public/products', 
                    'public/purchases', 
                    'public/orders', 
                    '#', 
                    '#', 
                    'public/settings', 
                    'public/users', 
                    'public/plugins'
                    ];
                $legends = [
                            lang('Home.dashboard'), 
                            lang('Home.stock_management'), 
                            lang('Home.suppliers'), 
                            lang('Home.bank_reconciliation'),  
                            lang('Home.purchases'), 
                            lang('Home.orders'), 
                            lang('Home.dealings'), 
                            lang('Home.reporting'), 
                            lang('Home.settings'), 
                            lang('Home.users'), 
                            lang('Home.plugins')
                            ];
                $modules = [
                    'home', 
                    'stock', 
                    'suppliers', 
                    'products', 
                    'purchases', 
                    'orders', 
                    'shipment', 
                    'reporting', 
                    'settings', 
                    'users', 
                    'plugins'
                    ]
                ?>
                <div class="row">
                    <?php foreach ($icons as $key => $card): ?>
                    <?php if ($user->inGroup('superadmin', 'admin', 'developer', 'user', 'beta')) : ?>
                        <?php if ($key % 4 == 0) : ?>
                        </div>
                        <div class="row">
                        <?php endif; ?>
                        <div class="col mb-4"> 
                            <div class="card h-100 bg-secondary border-primary">
                                <div class="text-center p-3"><?php echo single_icon(icon: $icons[$key], size: '2xl'); ?></div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $titles[$key]; ?></h5>
                                    <p class="card-text"><?php echo $text[$key]; ?></p>
                                    
                                </div>
                                <div class="card-footer bg-dark text-center"><?php echo icon('arrow-return-right', ' '.lang('Home.btn_go'), $links[$key], $legends[$key], 'primary') ?></div>
                            </div>
                        </div>
                            <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
    </body>
</html>