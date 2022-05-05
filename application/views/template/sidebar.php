<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">REPORTS</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="active">
                        <a href="<?php echo base_url(); ?>masterfile/dashboard">
                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Manage</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="<?php echo base_url(); ?>employees/import_list">
                            <span class="pcoded-micon"><i class="ti-upload"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Import Attendance</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Masterfile</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="<?php echo base_url(); ?>masterfile/hut_list">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Huts</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="<?php echo base_url(); ?>masterfile/menu_selection">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Menu Selection</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="<?php echo base_url(); ?>masterfile/menu_category">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Menu Category</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="<?php echo base_url(); ?>masterfile/food_menu">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Menu</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="<?php echo base_url(); ?>masterfile/table_list">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Tables</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="<?php echo base_url(); ?>masterfile/position_list">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Position</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-user"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Employees</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="<?php echo base_url(); ?>employees/employee_list">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Employee List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?php echo base_url(); ?>employees/overtime_list">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Overtime</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?php echo base_url(); ?>employees/cashad_list">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Cash Advance</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?php echo base_url(); ?>employees/schedule_list">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Schedules</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="<?php echo base_url(); ?>masterfile/delivery_list">
                            <span class="pcoded-micon"><i class="ti-upload"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Delivery List 
                            <?php 
                            $_count = $this->db->get_where("delivery_head",array("delivered"=>0))->num_rows();
                            ?>
                            <span class="label label-danger" id="delivery_count"><?php echo $_count ?></span></span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Printables</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="<?php echo base_url(); ?>masterfile/payroll_list">
                            <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Payroll</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>masterfile/schedule_list">
                            <span class="pcoded-micon"><i class="ti-timer"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Schedule</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>masterfile/reservation_report">
                            <span class="pcoded-micon"><i class="ti-shopping-cart"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Reservation</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
                <input type = "hidden" id="base_url" value="<?php echo base_url(); ?>">
                <script type="text/javascript">
                    // function badgeNotif(){
                    //     var loc= document.getElementById("base_url").value;
                    //     var redirect1=loc+'masterfile/fetch_deliveries/';
                    //     $.ajax({
                    //           url: redirect1,
                    //           type: 'POST',
                    //           dataType: 'json',
                    //         success:function(response){
                    //             var count = response.count;
                    //             if (count > 0) {
                    //                 $("#delivery_count").text(count);
                    //             } else {
                    //                 $("#delivery_count").hide();
                    //             }
                    //         },
                    //     })
                    // }
                    // setInterval(function(){
                    //     badgeNotif();
                    // }, 20000);
                    
                </script>
                <!--<div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Chart &amp; Maps</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="chart.html">
                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Chart</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="map-google.html">
                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Maps</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Pages</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="auth-normal-sign-in.html">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Login</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="auth-sign-up.html">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Register</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="sample-page.html">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Sample Page</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other">Other</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu ">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>M</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Menu Levels</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Menu Level 2.1</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="pcoded-hasmenu ">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Menu Level 2.2</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Menu Level 3.1</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Menu Level 2.3</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul> -->
            </div>
        </nav>