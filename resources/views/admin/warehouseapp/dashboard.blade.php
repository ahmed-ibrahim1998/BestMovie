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
                        <h4 class="mb-0">{{trans('main_trans.Wahhous_home')}}</h4><br>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-4" onclick="location.href='{{route('goodsUploads.create')}}';"
                     style="cursor: pointer;">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix text-center" style="font-size: 20px;">
                                {{trans('main_trans.goodsUploads')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4"
                     onclick="location.href='{{route('returnReceipts.create')}}';"
                     style="cursor: pointer;">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix text-center" style="font-size: 20px;">
                                {{trans('main_trans.returnReceipts')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=================================
            wrapper -->
            <!--=================================
            footer -->
            <br> <br> <br><br> <br> <br><br> <br> <br><br> <br> <br> <br> <br>

            @include('admin.layouts.footer')
        </div><!-- main content wrapper end-->
 
        
</div>
</div>
</div>

<!--================================= footer -->

@include('admin.layouts.footer-scripts')

</body>

</html>
