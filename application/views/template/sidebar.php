<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="pcoded-inner-navbar main-menu">
                <div class="pcoded-navigatio-lavel">Navigation</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= menu(1,["dashboard"])[0]; ?>">
                        <a href="<?= base_url('dashboard') ?>">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= menu(1,["profile"])[0]; ?>">
                        <a href="<?= base_url('profile') ?>">
                            <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                            <span class="pcoded-mtext">Profile</span>
                        </a>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= menu(1,["setting"])[0]; ?>">
                        <a href="<?= base_url('setting') ?>">
                            <span class="pcoded-micon"><i class="fa fa-cog"></i></span>
                            <span class="pcoded-mtext">Setting</span>
                        </a>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="<?= base_url('login/logout') ?>">
                            <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                            <span class="pcoded-mtext">Logout</span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel">Users</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= menu(1,["customers"])[0]; ?>">
                        <a href="<?= base_url('customers') ?>">
                            <span class="pcoded-micon"><i class="fa fa-address-card-o"></i></span>
                            <span class="pcoded-mtext">Customers</span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel">App CMS</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu <?= menu(1,["customercms"])[2]; ?>">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="fa fa-address-card-o"></i></span>
                            <span class="pcoded-mtext">Customer App</span>
                         </a>   0
                        <ul class="pcoded-submenu">
                            <li class="<?= menu(2,["terms"])[0]; ?>">
                                <a href="<?= base_url('customercms/terms') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">Terms and Conditions</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["privacy"])[0]; ?>">
                                <a href="<?= base_url('customercms/privacy') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">Privacy Policy</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["about"])[0]; ?>">
                                <a href="<?= base_url('customercms/about') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">About App</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["how"])[0]; ?>">
                                <a href="<?= base_url('customercms/how') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">How Does it Work</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["faq"])[0]; ?>">
                                <a href="<?= base_url('customercms/faq') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">FAQ's</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu <?= menu(1,["deliverycms"])[2]; ?>">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="fa fa-car"></i></span>
                            <span class="pcoded-mtext">Delivery App</span>
                         </a>   
                        <ul class="pcoded-submenu">
                            <li class="<?= menu(2,["terms"])[0]; ?>">
                                <a href="<?= base_url('deliverycms/terms') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">Terms and Conditions</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["privacy"])[0]; ?>">
                                <a href="<?= base_url('deliverycms/privacy') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">Privacy Policy</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["about"])[0]; ?>">
                                <a href="<?= base_url('deliverycms/about') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">About App</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["faq"])[0]; ?>">
                                <a href="<?= base_url('deliverycms/faq') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">FAQ's</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu <?= menu(1,["servicecms"])[2]; ?>">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="fa fa-wrench"></i></span>
                            <span class="pcoded-mtext">Service App</span>
                         </a>   
                        <ul class="pcoded-submenu">
                            <li class="<?= menu(2,["terms"])[0]; ?>">
                                <a href="<?= base_url('servicecms/terms') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">Terms and Conditions</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["privacy"])[0]; ?>">
                                <a href="<?= base_url('servicecms/privacy') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">Privacy Policy</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["about"])[0]; ?>">
                                <a href="<?= base_url('servicecms/about') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">About App</span>
                                </a>
                            </li>
                            <li class="<?= menu(2,["faq"])[0]; ?>">
                                <a href="<?= base_url('servicecms/faq') ?>">
                                    <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                    <span class="pcoded-mtext">FAQ's</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">