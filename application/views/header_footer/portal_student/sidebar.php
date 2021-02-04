                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse in">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <div class="portlet light bg-green" style="border: dotted 1px">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-male font-white"></i>
                                    <span class="caption-subject bold uppercase font-white">SELF SERVICE</span>
                                </div>
                            </div>
                        </div>
                        <div class="portlet light" style="margin-top : -40px; background-color: #44515d">
                            <!-- <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-grey-gallery bold uppercase"><i class="fa fa-gears"></i> Self Service</span>
                                </div>
                            </div> -->
                            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                                <!-- <li class="nav-item start ">
                                    <li class="nav-item">
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">My Profile</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">Academic</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Schedule</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grade</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Absence</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">Activity</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Online Class</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Homework Assign</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Task Assigment</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">Finance</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Earnings</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash Advance</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Purchase Request</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">My Earnings</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">Online Cash Advance</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">Teaching Schedule</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" title="Description" class="nav-link font-grey-gallery sidebar-category" data-id="<?=$c['StockClassCode']?>">
                                            <span class="title">Daily Grade</span>
                                            <span class="badge bg-yellow-casablanca">0</span>
                                        </a>
                                    </li>
                                </li> -->
                                <div class="portlet-body">
                                    <?php if($active) : ?>
                                        <ul style="font-size: 17px; margin-left: -20px">
                                            <!-- <li><a href="<?php echo site_url('Student/view_my_profile'); ?>" class="font-dark">My Profile</a></li> -->
                                            <li class="font-white"><a data-toggle="modal" id="profilemodal" class="widget-subscribe-subtitle-link font-white full1" href="#full">My Profile</a></li>
                                            <li class="font-white"><a data-toggle="modal" id="toggle_modal" class="widget-subscribe-subtitle-link font-white full2" href="#full2">Academic</a></li>
                                            <!-- <li>Service</li>
                                            <ul>
                                                <li class="uppercase">
                                                    <a href="#">
                                                    <font size="2" color="black"><i>Online Class</i></font>
                                                    </a>
                                                </li>
                                                <li class="uppercase">
                                                    <a href="#">
                                                    <font size="2" color="black"><i>Assignment Book</i></font>
                                                    </a>
                                                </li>
                                                <li class="uppercase">
                                                    <a href="#">
                                                    <font size="2" color="black"><i>School Activities</i></font>
                                                    </a>
                                                </li>
                                            </ul>-->
                                            <li class="font-white">
                                                <a href="#" class="font-white">
                                                    Student Account       
                                                </a>
                                            </li>
                                            <li class="font-white">
                                                <a href="#" class="font-white">
                                                    Student Absent       
                                                </a>
                                            </li>
                                            <li class="font-white">
                                                <a href="#" class="font-white">
                                                    School Schedule
                                                </a>
                                            </li>
                                            <li class="font-white">
                                                <a href="#" class="font-white">
                                                    Student Calendar
                                                </a>
                                            </li>
                                            <li class="font-white">My Transaction</li>
                                            <ul>
                                                <li class="font-white">
                                                    <a href="#">
                                                    <font size="2" color="white">Cafetaria</font>
                                                    </a>
                                                </li>
                                                <li class="font-white">
                                                    <a href="#">
                                                    <font size="2" color="white">Library </font>
                                                    </a>
                                                </li>
                                                <li class="font-white">
                                                    <a href="#">
                                                    <font size="2" color="white">Store (Toko)</font>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- <ul>
                                                <li class="uppercase">
                                                    <a href="#">
                                                    <font size="2" color="black"><i>Student Finance</i></font>
                                                    </a>
                                                </li>
                                                <li class="uppercase">
                                                    <a href="#">
                                                    <font size="2" color="black"><i>Account Payable Aging</i></font>
                                                    </a>
                                                </li>
                                            </ul>  -->                             
                                        </ul>
                                    <?php else: ?>
                                        <a class="sbold uppercase font-white">Enrollment</a>
                                    <?php endif; ?>
                                </div>
                            </ul>
                        </div>
                        <div class="portlet light" style="margin-bottom: 0px; background-color: #44515d">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-white bold uppercase"><i class="fa fa-refresh"></i> Change Password</span>
                                </div>
                            </div>
                            <div class="form-group" >
                                <a data-toggle="modal" id="changepassmodal" class="btn btn-md btn-block blue-hoki full1" href="#full">Change</a>
                            </div>
                        </div>
                        <div class="portlet light" style="margin-top: 0px; background-color: #44515d">
                            <div class="form-group" >
                                <a data-toggle="modal" id="changepassmodal" class="btn btn-md btn-block blue-hoki full1" href="#full">Payment Transaction</a>
                            </div>
                        </div>
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
