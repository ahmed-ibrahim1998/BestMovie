<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
            <div class="side-menu-fixed">
                <div class="scrollbar side-menu-bg">
                    <ul class="nav navbar-nav side-menu" id="sidebarnav">
                        <!-- menu item Dashboard-->
                        @can('dashboard')
                            <li>
                                <a href="#"><i class="fas fa-home"></i><span
                                        class="right-nav-text">{{trans('main_trans.Dashboard_home')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('users')
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#users">
                                    <div class="pull-left"><i class="fa fa-users"></i><span
                                            class="right-nav-text">{{trans('main_trans.users_management')}}</span></div>
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="users" class="collapse" data-parent="#sidebarnav">
                                    <li><a href="#">{{trans('main_trans.Drivers')}}</a></li>
                                    <li><a href="#">{{trans('main_trans.users')}}</a></li>
                                    <li><a href="#">{{trans('main_trans.roles')}}</a></li>
                                    <li><a href="#">{{trans('main_trans.add_permissions')}}</a></li>
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </div>
            </div>

    <!-- Left Sidebar End-->

        <!--=================================-->
