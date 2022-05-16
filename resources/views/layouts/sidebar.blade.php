<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="index">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">@lang('translation.Dashboard')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">@lang('translation.Apps')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="apps-calendar">
                                <span data-key="t-calendar">@lang('translation.Calendar')</span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-chat">
                                <span data-key="t-chat">@lang('translation.Chat')</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-email">@lang('translation.Email')</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-email-inbox" data-key="t-inbox">@lang('translation.Inbox')</a></li>
                                <li><a href="apps-email-read"
                                        data-key="t-read-email">@lang('translation.Read_Email')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-invoices">@lang('translation.Invoices')</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-invoices-list"
                                        data-key="t-invoice-list">@lang('translation.Invoice_List')</a></li>
                                <li><a href="apps-invoices-detail"
                                        data-key="t-invoice-detail">@lang('translation.Invoice_Detail')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-contacts">@lang('translation.Contacts')</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-contacts-grid"
                                        data-key="t-user-grid">@lang('translation.User_Grid')</a></li>
                                <li><a href="apps-contacts-list"
                                        data-key="t-user-list">@lang('translation.User_List')</a></li>
                                <li><a href="apps-contacts-profile"
                                        data-key="t-profile">@lang('translation.Profile')</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">@lang('translation.Authentication')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login" data-key="t-login">@lang('translation.Login')</a></li>
                        <li><a href="auth-register" data-key="t-register">@lang('translation.Register')</a></li>
                        <li><a href="auth-recoverpw"
                                data-key="t-recover-password">@lang('translation.Recover_Password')</a></li>
                        <li><a href="auth-lock-screen" data-key="t-lock-screen">@lang('translation.Lock_Screen')</a>
                        </li>
                        <li><a href="auth-logout" data-key="t-logout">@lang('translation.Logout')</a>
                        </li>
                        <li><a href="auth-confirm-mail" data-key="t-confirm-mail">@lang('translation.Confirm_Mail')</a>
                        </li>
                        <li><a href="auth-email-verification"
                                data-key="t-email-verification">@lang('translation.Email_Verification')</a></li>
                        <li><a href="auth-two-step-verification"
                                data-key="t-two-step-verification">@lang('translation.Two_Step_Verification')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">@lang('translation.Pages')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter" data-key="t-starter-page">@lang('translation.Starter_Page')</a></li>
                        <li><a href="pages-maintenance" data-key="t-maintenance">@lang('translation.Maintenance')</a>
                        </li>
                        <li><a href="pages-comingsoon" data-key="t-coming-soon">@lang('translation.Coming_Soon')</a>
                        </li>
                        <li><a href="pages-timeline" data-key="t-timeline">@lang('translation.Timeline')</a></li>
                        <li><a href="pages-faqs" data-key="t-faqs">@lang('translation.FAQs')</a></li>
                        <li><a href="pages-pricing" data-key="t-pricing">@lang('translation.Pricing')</a></li>
                        <li><a href="pages-404" data-key="t-error-404">@lang('translation.Error_404')</a></li>
                        <li><a href="pages-500" data-key="t-error-500">@lang('translation.Error_500')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="layouts-horizontal">
                        <i data-feather="layout"></i>
                        <span data-key="t-horizontal">@lang('translation.Horizontal')</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">@lang('translation.Elements')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-components">@lang('translation.Components')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts" data-key="t-alerts">@lang('translation.Alerts')</a></li>
                        <li><a href="ui-buttons" data-key="t-buttons">@lang('translation.Buttons')</a></li>
                        <li><a href="ui-cards" data-key="t-cards">@lang('translation.Cards')</a></li>
                        <li><a href="ui-carousel" data-key="t-carousel">@lang('translation.Carousel')</a></li>
                        <li><a href="ui-dropdowns" data-key="t-dropdowns">@lang('translation.Dropdowns')</a></li>
                        <li><a href="ui-grid" data-key="t-grid">@lang('translation.Grid')</a></li>
                        <li><a href="ui-images" data-key="t-images">@lang('translation.Images')</a></li>
                        <li><a href="ui-modals" data-key="t-modals">@lang('translation.Modals')</a></li>
                        <li><a href="ui-offcanvas" data-key="t-offcanvas">@lang('translation.Offcanvas')</a></li>
                        <li><a href="ui-progressbars" data-key="t-progress-bars">@lang('translation.Progress_Bars')</a>
                        </li>
                        <li><a href="ui-placeholders" data-key="t-progress-bars">@lang('translation.Placeholders')</a></li>

                        <li><a href="ui-tabs-accordions"
                                data-key="t-tabs-accordions">@lang('translation.Tabs_n_Accordions')</a></li>
                        <li><a href="ui-typography" data-key="t-typography">@lang('translation.Typography')</a></li>
                        <li><a href="ui-toasts" data-key="t-typography">@lang('translation.Toast')</a></li>
                        <li><a href="ui-video" data-key="t-video">@lang('translation.Video')</a></li>
                        <li><a href="ui-general" data-key="t-general">@lang('translation.General')</a></li>
                        <li><a href="ui-colors" data-key="t-colors">@lang('translation.Colors')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="gift"></i>
                        <span data-key="t-ui-elements">@lang('translation.Extended')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="extended-lightbox" data-key="t-lightbox">@lang('translation.Lightbox')</a></li>
                        <li><a href="extended-rangeslider"
                                data-key="t-range-slider">@lang('translation.Range_Slider')</a></li>
                        <li><a href="extended-sweet-alert"
                                data-key="t-sweet-alert">@lang('translation.SweetAlert_2')</a></li>
                        <li><a href="extended-session-timeout"
                                data-key="t-session-timeout">@lang('translation.Session_Timeout')</a></li>
                        <li><a href="extended-rating" data-key="t-rating">@lang('translation.Rating')</a></li>
                        <li><a href="extended-notifications"
                                data-key="t-notifications">@lang('translation.Notifications')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="box"></i>
                        <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span>
                        <span data-key="t-forms">@lang('translation.Forms')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements" data-key="t-form-elements">@lang('translation.Basic_Elements')</a>
                        </li>
                        <li><a href="form-validation" data-key="t-form-validation">@lang('translation.Validation')</a>
                        </li>
                        <li><a href="form-advanced" data-key="t-form-advanced">@lang('translation.Advanced_Plugins')</a>
                        </li>
                        <li><a href="form-editors" data-key="t-form-editors">@lang('translation.Editors')</a></li>
                        <li><a href="form-uploads" data-key="t-form-upload">@lang('translation.File_Upload')</a></li>
                        <li><a href="form-wizard" data-key="t-form-wizard">@lang('translation.Wizard')</a></li>
                        <li><a href="form-mask" data-key="t-form-mask">@lang('translation.Mask')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables">@lang('translation.Tables')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic" data-key="t-basic-tables">@lang('translation.Bootstrap_Basic')</a>
                        </li>
                        <li><a href="tables-datatable" data-key="t-data-tables">@lang('translation.DataTables')</a></li>
                        <li><a href="tables-responsive"
                                data-key="t-responsive-table">@lang('translation.Responsive')</a></li>
                        <li><a href="tables-editable" data-key="t-editable-table">@lang('translation.Editable')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="pie-chart"></i>
                        <span data-key="t-charts">@lang('translation.Charts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex" data-key="t-apex-charts">@lang('translation.Apexcharts')</a></li>
                        <li><a href="charts-echart" data-key="t-e-charts">@lang('translation.Echarts')</a></li>
                        <li><a href="charts-chartjs" data-key="t-chartjs-charts">@lang('translation.Chartjs')</a></li>
                        <li><a href="charts-knob" data-key="t-knob-charts">@lang('translation.Jquery_Knob')</a></li>
                        <li><a href="charts-sparkline" data-key="t-sparkline-charts">@lang('translation.Sparkline')</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">@lang('translation.Icons')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-boxicons" data-key="t-boxicons">@lang('translation.Boxicons')</a></li>
                        <li><a href="icons-materialdesign"
                                data-key="t-material-design">@lang('translation.Material_Design')</a></li>
                        <li><a href="icons-dripicons" data-key="t-dripicons">@lang('translation.Dripicons')</a></li>
                        <li><a href="icons-fontawesome"
                                data-key="t-font-awesome">@lang('translation.Font_Awesome_5')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="map"></i>
                        <span data-key="t-maps">@lang('translation.Maps')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google" data-key="t-g-maps">@lang('translation.Google')</a></li>
                        <li><a href="maps-vector" data-key="t-v-maps">@lang('translation.Vector')</a></li>
                        <li><a href="maps-leaflet" data-key="t-l-maps">@lang('translation.Leaflet')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="share-2"></i>
                        <span data-key="t-multi-level">@lang('translation.Multi_Level')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);" data-key="t-level-1-1">@lang('translation.Level_1_1')</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow"
                                data-key="t-level-1-2">@lang('translation.Level_1_2')</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);"
                                        data-key="t-level-2-1">@lang('translation.Level_2_1')</a></li>
                                <li><a href="javascript: void(0);"
                                        data-key="t-level-2-2">@lang('translation.Level_2_2')</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>

            <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="assets/images/giftbox.png" alt="">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">@lang('translation.Unlimited_Access')</h5>
                        <p class="font-size-13">
                            @lang("translation.Upgrade_your_plan_from_a_Free_trial,_to_select_‘Business_Plan’").</p>
                        <a href="#!" class="btn btn-primary mt-2">@lang('translation.Upgrade_Now')</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
