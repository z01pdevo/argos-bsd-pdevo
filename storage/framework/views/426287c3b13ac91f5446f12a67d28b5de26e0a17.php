<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"><?php echo app('translator')->get('translation.Menu'); ?></li>

                <li>
                    <a href="index">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?php echo app('translator')->get('translation.Dashboard'); ?></span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps"><?php echo app('translator')->get('translation.Apps'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="apps-calendar">
                                <span data-key="t-calendar"><?php echo app('translator')->get('translation.Calendar'); ?></span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-chat">
                                <span data-key="t-chat"><?php echo app('translator')->get('translation.Chat'); ?></span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-email"><?php echo app('translator')->get('translation.Email'); ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-email-inbox" data-key="t-inbox"><?php echo app('translator')->get('translation.Inbox'); ?></a></li>
                                <li><a href="apps-email-read"
                                        data-key="t-read-email"><?php echo app('translator')->get('translation.Read_Email'); ?></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-invoices"><?php echo app('translator')->get('translation.Invoices'); ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-invoices-list"
                                        data-key="t-invoice-list"><?php echo app('translator')->get('translation.Invoice_List'); ?></a></li>
                                <li><a href="apps-invoices-detail"
                                        data-key="t-invoice-detail"><?php echo app('translator')->get('translation.Invoice_Detail'); ?></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-contacts"><?php echo app('translator')->get('translation.Contacts'); ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-contacts-grid"
                                        data-key="t-user-grid"><?php echo app('translator')->get('translation.User_Grid'); ?></a></li>
                                <li><a href="apps-contacts-list"
                                        data-key="t-user-list"><?php echo app('translator')->get('translation.User_List'); ?></a></li>
                                <li><a href="apps-contacts-profile"
                                        data-key="t-profile"><?php echo app('translator')->get('translation.Profile'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication"><?php echo app('translator')->get('translation.Authentication'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login" data-key="t-login"><?php echo app('translator')->get('translation.Login'); ?></a></li>
                        <li><a href="auth-register" data-key="t-register"><?php echo app('translator')->get('translation.Register'); ?></a></li>
                        <li><a href="auth-recoverpw"
                                data-key="t-recover-password"><?php echo app('translator')->get('translation.Recover_Password'); ?></a></li>
                        <li><a href="auth-lock-screen" data-key="t-lock-screen"><?php echo app('translator')->get('translation.Lock_Screen'); ?></a>
                        </li>
                        <li><a href="auth-logout" data-key="t-logout"><?php echo app('translator')->get('translation.Logout'); ?></a>
                        </li>
                        <li><a href="auth-confirm-mail" data-key="t-confirm-mail"><?php echo app('translator')->get('translation.Confirm_Mail'); ?></a>
                        </li>
                        <li><a href="auth-email-verification"
                                data-key="t-email-verification"><?php echo app('translator')->get('translation.Email_Verification'); ?></a></li>
                        <li><a href="auth-two-step-verification"
                                data-key="t-two-step-verification"><?php echo app('translator')->get('translation.Two_Step_Verification'); ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages"><?php echo app('translator')->get('translation.Pages'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter" data-key="t-starter-page"><?php echo app('translator')->get('translation.Starter_Page'); ?></a></li>
                        <li><a href="pages-maintenance" data-key="t-maintenance"><?php echo app('translator')->get('translation.Maintenance'); ?></a>
                        </li>
                        <li><a href="pages-comingsoon" data-key="t-coming-soon"><?php echo app('translator')->get('translation.Coming_Soon'); ?></a>
                        </li>
                        <li><a href="pages-timeline" data-key="t-timeline"><?php echo app('translator')->get('translation.Timeline'); ?></a></li>
                        <li><a href="pages-faqs" data-key="t-faqs"><?php echo app('translator')->get('translation.FAQs'); ?></a></li>
                        <li><a href="pages-pricing" data-key="t-pricing"><?php echo app('translator')->get('translation.Pricing'); ?></a></li>
                        <li><a href="pages-404" data-key="t-error-404"><?php echo app('translator')->get('translation.Error_404'); ?></a></li>
                        <li><a href="pages-500" data-key="t-error-500"><?php echo app('translator')->get('translation.Error_500'); ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="layouts-horizontal">
                        <i data-feather="layout"></i>
                        <span data-key="t-horizontal"><?php echo app('translator')->get('translation.Horizontal'); ?></span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components"><?php echo app('translator')->get('translation.Elements'); ?></li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-components"><?php echo app('translator')->get('translation.Components'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts" data-key="t-alerts"><?php echo app('translator')->get('translation.Alerts'); ?></a></li>
                        <li><a href="ui-buttons" data-key="t-buttons"><?php echo app('translator')->get('translation.Buttons'); ?></a></li>
                        <li><a href="ui-cards" data-key="t-cards"><?php echo app('translator')->get('translation.Cards'); ?></a></li>
                        <li><a href="ui-carousel" data-key="t-carousel"><?php echo app('translator')->get('translation.Carousel'); ?></a></li>
                        <li><a href="ui-dropdowns" data-key="t-dropdowns"><?php echo app('translator')->get('translation.Dropdowns'); ?></a></li>
                        <li><a href="ui-grid" data-key="t-grid"><?php echo app('translator')->get('translation.Grid'); ?></a></li>
                        <li><a href="ui-images" data-key="t-images"><?php echo app('translator')->get('translation.Images'); ?></a></li>
                        <li><a href="ui-modals" data-key="t-modals"><?php echo app('translator')->get('translation.Modals'); ?></a></li>
                        <li><a href="ui-offcanvas" data-key="t-offcanvas"><?php echo app('translator')->get('translation.Offcanvas'); ?></a></li>
                        <li><a href="ui-progressbars" data-key="t-progress-bars"><?php echo app('translator')->get('translation.Progress_Bars'); ?></a>
                        </li>
                        <li><a href="ui-placeholders" data-key="t-progress-bars"><?php echo app('translator')->get('translation.Placeholders'); ?></a></li>

                        <li><a href="ui-tabs-accordions"
                                data-key="t-tabs-accordions"><?php echo app('translator')->get('translation.Tabs_n_Accordions'); ?></a></li>
                        <li><a href="ui-typography" data-key="t-typography"><?php echo app('translator')->get('translation.Typography'); ?></a></li>
                        <li><a href="ui-toasts" data-key="t-typography"><?php echo app('translator')->get('translation.Toast'); ?></a></li>
                        <li><a href="ui-video" data-key="t-video"><?php echo app('translator')->get('translation.Video'); ?></a></li>
                        <li><a href="ui-general" data-key="t-general"><?php echo app('translator')->get('translation.General'); ?></a></li>
                        <li><a href="ui-colors" data-key="t-colors"><?php echo app('translator')->get('translation.Colors'); ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="gift"></i>
                        <span data-key="t-ui-elements"><?php echo app('translator')->get('translation.Extended'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="extended-lightbox" data-key="t-lightbox"><?php echo app('translator')->get('translation.Lightbox'); ?></a></li>
                        <li><a href="extended-rangeslider"
                                data-key="t-range-slider"><?php echo app('translator')->get('translation.Range_Slider'); ?></a></li>
                        <li><a href="extended-sweet-alert"
                                data-key="t-sweet-alert"><?php echo app('translator')->get('translation.SweetAlert_2'); ?></a></li>
                        <li><a href="extended-session-timeout"
                                data-key="t-session-timeout"><?php echo app('translator')->get('translation.Session_Timeout'); ?></a></li>
                        <li><a href="extended-rating" data-key="t-rating"><?php echo app('translator')->get('translation.Rating'); ?></a></li>
                        <li><a href="extended-notifications"
                                data-key="t-notifications"><?php echo app('translator')->get('translation.Notifications'); ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="box"></i>
                        <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span>
                        <span data-key="t-forms"><?php echo app('translator')->get('translation.Forms'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements" data-key="t-form-elements"><?php echo app('translator')->get('translation.Basic_Elements'); ?></a>
                        </li>
                        <li><a href="form-validation" data-key="t-form-validation"><?php echo app('translator')->get('translation.Validation'); ?></a>
                        </li>
                        <li><a href="form-advanced" data-key="t-form-advanced"><?php echo app('translator')->get('translation.Advanced_Plugins'); ?></a>
                        </li>
                        <li><a href="form-editors" data-key="t-form-editors"><?php echo app('translator')->get('translation.Editors'); ?></a></li>
                        <li><a href="form-uploads" data-key="t-form-upload"><?php echo app('translator')->get('translation.File_Upload'); ?></a></li>
                        <li><a href="form-wizard" data-key="t-form-wizard"><?php echo app('translator')->get('translation.Wizard'); ?></a></li>
                        <li><a href="form-mask" data-key="t-form-mask"><?php echo app('translator')->get('translation.Mask'); ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables"><?php echo app('translator')->get('translation.Tables'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic" data-key="t-basic-tables"><?php echo app('translator')->get('translation.Bootstrap_Basic'); ?></a>
                        </li>
                        <li><a href="tables-datatable" data-key="t-data-tables"><?php echo app('translator')->get('translation.DataTables'); ?></a></li>
                        <li><a href="tables-responsive"
                                data-key="t-responsive-table"><?php echo app('translator')->get('translation.Responsive'); ?></a></li>
                        <li><a href="tables-editable" data-key="t-editable-table"><?php echo app('translator')->get('translation.Editable'); ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="pie-chart"></i>
                        <span data-key="t-charts"><?php echo app('translator')->get('translation.Charts'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex" data-key="t-apex-charts"><?php echo app('translator')->get('translation.Apexcharts'); ?></a></li>
                        <li><a href="charts-echart" data-key="t-e-charts"><?php echo app('translator')->get('translation.Echarts'); ?></a></li>
                        <li><a href="charts-chartjs" data-key="t-chartjs-charts"><?php echo app('translator')->get('translation.Chartjs'); ?></a></li>
                        <li><a href="charts-knob" data-key="t-knob-charts"><?php echo app('translator')->get('translation.Jquery_Knob'); ?></a></li>
                        <li><a href="charts-sparkline" data-key="t-sparkline-charts"><?php echo app('translator')->get('translation.Sparkline'); ?></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons"><?php echo app('translator')->get('translation.Icons'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-boxicons" data-key="t-boxicons"><?php echo app('translator')->get('translation.Boxicons'); ?></a></li>
                        <li><a href="icons-materialdesign"
                                data-key="t-material-design"><?php echo app('translator')->get('translation.Material_Design'); ?></a></li>
                        <li><a href="icons-dripicons" data-key="t-dripicons"><?php echo app('translator')->get('translation.Dripicons'); ?></a></li>
                        <li><a href="icons-fontawesome"
                                data-key="t-font-awesome"><?php echo app('translator')->get('translation.Font_Awesome_5'); ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="map"></i>
                        <span data-key="t-maps"><?php echo app('translator')->get('translation.Maps'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google" data-key="t-g-maps"><?php echo app('translator')->get('translation.Google'); ?></a></li>
                        <li><a href="maps-vector" data-key="t-v-maps"><?php echo app('translator')->get('translation.Vector'); ?></a></li>
                        <li><a href="maps-leaflet" data-key="t-l-maps"><?php echo app('translator')->get('translation.Leaflet'); ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="share-2"></i>
                        <span data-key="t-multi-level"><?php echo app('translator')->get('translation.Multi_Level'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);" data-key="t-level-1-1"><?php echo app('translator')->get('translation.Level_1_1'); ?></a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow"
                                data-key="t-level-1-2"><?php echo app('translator')->get('translation.Level_1_2'); ?></a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);"
                                        data-key="t-level-2-1"><?php echo app('translator')->get('translation.Level_2_1'); ?></a></li>
                                <li><a href="javascript: void(0);"
                                        data-key="t-level-2-2"><?php echo app('translator')->get('translation.Level_2_2'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>

            <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="assets/images/giftbox.png" alt="">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16"><?php echo app('translator')->get('translation.Unlimited_Access'); ?></h5>
                        <p class="font-size-13">
                            <?php echo app('translator')->get("translation.Upgrade_your_plan_from_a_Free_trial,_to_select_‘Business_Plan’"); ?>.</p>
                        <a href="#!" class="btn btn-primary mt-2"><?php echo app('translator')->get('translation.Upgrade_Now'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<?php /**PATH /var/www/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>