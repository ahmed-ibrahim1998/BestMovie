<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template"/>
    <meta name="author" content="potenzaglobalsolutions.com"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>{{trans('main_trans.Dashboard')}} </title>

    @include('admin.layouts.head')
</head>
<body @if (App::getLocale() == 'ar') style="font-family: 'Cairo', sans-serif;"
      @else style="font-family: 'Tinos', serif;" @endif>

<div class="wrapper">

    <!--================================= preloader -->

    {{--    <div id="pre-loader">--}}
    {{--        <img src="{{ env('APP_URL') }}/public/assets/images/pre-loader/loader-01.svg" alt="">--}}
    {{--    </div>--}}

    <!--================================= preloader  =========================  -->

    @include('admin.layouts.main-header')

    @include('admin.layouts.main-sidebar')

    <!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0">{{trans('main_trans.Dashboard_home')}}</h4><br>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
        <!-- widgets -->
        <div class="row">
            <div class="col-md-6  mb-4">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <a href="{{route('cars.index')}}">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-car highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <div class="float-right text-right">
                                    <p class="card-text text-dark font-weight-bold">{{trans('main_trans.cars')}}</p>
                                    <h4>{{\App\Models\Car::count()}}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6  mb-4">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <a href="#">

                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fas fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark font-weight-bold">{{trans('main_trans.Drivers')}}</p>
                                    <h4>{{\App\User::where('roles_name','["Drivers"]')->count()}}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6  mb-4">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <a href="{{route('users.index')}}">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('main_trans.users')}}</p>
                                    <h4>{{\App\User::count()}}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6  mb-4">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <a href="{{route('roles.index')}}">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-user-secret highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('main_trans.roles')}}</p>
                                    <h4>{{\Spatie\Permission\Models\Role::count()}}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br> <br> <br><br> <br> <br> <br> <br>
        <!--=================================
wrapper -->
        <!--=================================
footer -->
        @include('admin.layouts.footer')
    </div>
    <!-- main content wrapper end-->


    <!--================================= wrapper -->

    <!--=================================  footer -->

    @include('admin.layouts.footer')
</div><!-- main content wrapper end-->
</div>
</div>
</div>

<!--================================= footer -->

@include('admin.layouts.footer-scripts')

</body>

</html>
