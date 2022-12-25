
<div class="border-end" id="sidebar-wrapper">

    <div class="sidebar-heading border-bottom bg-primary">
        <?php
        $this->session = \Config\Services::session();
        $logo          = null; /* glob(WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/logo/thumb/logo.*'); */
//        $logo_path     = explode('\\', $logo[0]);
        ?>
        <h3><div class="d-flex justify-content-center align-items-center"><a href="<?php echo base_url(); ?>home"><img src="<?php echo (empty($logo)) ? '/images/logo.jpg' : base_url() . '/writable/' . end($logo_path) ?>" class="img-thumbnail float-left" width="64"></a>MyOpenCSE</div></h3>
        <?php echo lang('Home.hello') . ', ' . $this->session->get('user_first_name'); ?>

    </div>
    <div class="accordion accordion-flush" id="accordionFlush">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <?php echo lang('Home.dashboard') ?>
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
                <div class="accordion-body sidemenu">
                    <?php if ($user->inGroup('superadmin', 'admin', 'developer', 'user', 'beta')) : ?><a href="<?php echo base_url(); ?>/home/home" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'home') echo ' active' ?>"><?php echo lang('Home.home') ?></a><?php endif; ?>

                </div>
            </div>
        </div>
        <?php if ($user->inGroup('superadmin', 'admin', 'developer', 'user', 'beta')) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <?php echo lang('Home.stock_management') ?>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse //<?php if (in_array($active, ['stock_list', 'stock_new', 'stock_import', 'stock_export'])) echo 'show'; ?>" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlush">
                    <div class="accordion-body sidemenu">
                        <div class="list-group">
                            <a href="<?php echo base_url(); ?>/stock" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'stock_list') echo ' active' ?>"><?php echo lang('Home.list') ?></a>
                            <a href="<?php echo base_url(); ?>/stock/create" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'stock_new') echo ' active' ?>"><?php echo lang('Home.new') ?></a>
                            <a href="<?php echo base_url(); ?>/stock/import/10" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'stock_import') echo ' active' ?>"><?php echo lang('Home.import') ?></a>
                            <a href="<?php echo base_url(); ?>/stock/export" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'stock_export') echo ' active' ?>"><?php echo lang('Home.export') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($user->inGroup('superadmin', 'admin', 'developer', 'user', 'beta')) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        <?php echo lang('Home.suppliers') ?>
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse <?php if (in_array($active, ['suppliers_list', 'suppliers_new', 'suppliers_import', 'suppliers_export'])) echo 'show'; ?>" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlush">
                    <div class="accordion-body sidemenu">
                        <div class="list-group">
                            <a href="<?php echo base_url(); ?>/public/suppliers" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'suppliers_list') echo ' active' ?>"><?php echo lang('Home.list') ?></a>
                            <a href="<?php echo base_url(); ?>/public/suppliers/create" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'suppliers_new') echo ' active' ?>"><?php echo lang('Home.new') ?></a>
                            <a href="<?php echo base_url(); ?>/public/suppliers/import/15" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'suppliers_import') echo ' active' ?>"><?php echo lang('Home.import') ?></a>
                            <a href="<?php echo base_url(); ?>/public/suppliers/export" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'suppliers_export') echo ' active' ?>"><?php echo lang('Home.export') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($user->inGroup('superadmin', 'admin', 'developer', 'user', 'beta')) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        <?php echo lang('Home.bank_reconciliation') ?>
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse <?php if (in_array($active, ['customers_list', 'customers_new', 'customers_import', 'customers_export'])) echo 'show'; ?>" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlush">
                    <div class="accordion-body sidemenu">
                        <div class="list-group">
                            <a href="//<?php echo base_url(); ?>/bank_reconciliation" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'bank_reconciliation_list') echo ' active' ?>"><?php echo lang('Home.list') ?></a>
                            <a href="//<?php echo base_url(); ?>/bank_reconciliation/create" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'bank_reconciliation_new') echo ' active' ?>"><?php echo lang('Home.new') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($user->inGroup('superadmin', 'admin', 'developer', 'user', 'beta')) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        <?php echo lang('Home.ged') ?>
                    </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse <?php if (in_array($active, ['suppliers_list', 'suppliers_new', 'suppliers_import', 'suppliers_export'])) echo 'show'; ?>" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlush">
                    <div class="accordion-body sidemenu">
                        <div class="list-group">
                            <a href="<?php echo base_url(); ?>/ged" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'suppliers_list') echo ' active' ?>"><?php echo lang('Home.your_docs') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($user->inGroup('superadmin')) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                        <?php echo lang('Home.orders') ?>
                    </button>
                </h2>
                <div id="flush-collapseSix" class="accordion-collapse collapse //<?php if (in_array($active, ['orders_list', 'orders_new', 'orders_import', 'orders_export'])) echo 'show'; ?>" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlush">
                    <div class="accordion-body sidemenu">
                        <div class="list-group">
                            <a href="<?php echo base_url(); ?>/public/orders" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'orders_list') echo ' active' ?>"><?php echo lang('Home.list') ?></a>
                            <a href="<?php echo base_url(); ?>/public/orders/create" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'orders_new') echo ' active' ?>"><?php echo lang('Home.new') ?></a>
                            <a href="<?php echo base_url(); ?>/public/orders/import/10" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'orders_import') echo ' active' ?>"><?php echo lang('Home.import') ?></a>
                            <a href="<?php echo base_url(); ?>/public/orders/export" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'orders_export') echo ' active' ?>"><?php echo lang('Home.export') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                    <?php echo lang('Home.dealings') ?>
                </button>
            </h2>
            <div id="flush-collapseSeven" class="accordion-collapse collapse <?php if (in_array($active, ['dealings_list', 'dealings_new', 'dealings_export'])) echo 'show'; ?>" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlush">
                <div class="accordion-body sidemenu">
                    <div class="list-group">
                        <?php if ($user->inGroup('superadmin', 'admin', 'developer', 'user', 'beta')) : ?><a href="<?php echo base_url(); ?>/dealings" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'dealings_list') echo ' active' ?>"><?php echo lang('Home.list') ?></a><?php endif; ?>
                        <?php if ($user->inGroup('superadmin', 'admin', 'developer', 'user', 'beta')) : ?><a href="<?php echo base_url(); ?>/dealings/create" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'dealings_new') echo ' active' ?>"><?php echo lang('Home.new') ?></a><?php endif; ?>
                        <?php if ($user->inGroup('superadmin', 'admin', 'developer', 'user', 'beta')) : ?><a href="<?php echo base_url(); ?>/dealings/export" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'dealings_export') echo ' active' ?>"><?php echo lang('Home.export') ?></a><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($user->inGroup('superadmin')) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                        <?php echo lang('Home.settings') ?>
                    </button>
                </h2>
                <div id="flush-collapseEight" class="accordion-collapse collapse <?php if (in_array($active, ['list', 'general_settings', 'import_export', 'profiles', 'company', 'taxes'])) echo 'show'; ?>" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlush">
                    <div class="accordion-body sidemenu">
                        <div class="list-group">
                            <a href="<?php echo base_url(); ?>/public/settings" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'list') echo ' active' ?>"><?php echo lang('Home.list') ?></a>
                            <a href="<?php echo base_url(); ?>/public/settings/general_settings" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'general_settings') echo ' active' ?>"><?php echo lang('Settings.global') ?></a>
                            <a href="<?php echo base_url(); ?>/public/settings/import_export" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'import_export') echo ' active' ?>"><?php echo lang('Home.imp_exp') ?></a>
                            <a href="<?php echo base_url(); ?>/public/settings/profiles" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'profiles') echo ' active' ?>"><?php echo lang('Home.profiles') ?></a>
                            <a href="<?php echo base_url(); ?>/settings/company" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'company') echo ' active' ?>"><?php echo lang('Settings.company') ?></a>
                            <a href="<?php echo base_url(); ?>/public/settings/taxes" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'taxes') echo ' active' ?>"><?php echo lang('Home.taxes') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($user->inGroup('superadmin', 'admin', 'developer')) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                        <?php echo lang('Home.users') ?>
                    </button>
                </h2>
                <div id="flush-collapseNine" class="accordion-collapse collapse <?php if (in_array($active, ['users_list', 'users_new', 'users_import', 'users_export'])) echo 'show'; ?>" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlush">
                    <div class="accordion-body sidemenu">
                        <div class="list-group">
                            <a href="<?php echo base_url(); ?>/users" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'users_list') echo ' active' ?>"><?php echo lang('Home.list') ?></a>
                            <a href="<?php echo base_url(); ?>/users/create" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'users_new') echo ' active' ?>"><?php echo lang('Home.new') ?></a>
                            <a href="<?php echo base_url(); ?>/users/import/13" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'users_import') echo ' active' ?>"><?php echo lang('Home.import') ?></a>
                            <a href="<?php echo base_url(); ?>/users/export" class="list-group-item list-group-item-action list-group-item-primary <?php if ($active == 'users_export') echo ' active' ?>"><?php echo lang('Home.export') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="d-grid gap-2 mb-3">
            <a class="btn btn-primary" href="mailto:contact@myopencse.com"><?php echo lang('Home.contact') ?></a>
        </div>

    </div>
    <div class="d-grid gap-2 mb-3">
        <a class="btn btn-primary" href="<?php echo base_url(); ?>/logout"><?php echo lang('Home.logout') ?></a>
    </div>
</div>
