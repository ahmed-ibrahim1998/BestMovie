<!-- Title -->
<title>@yield("title")</title>

<base href="/" target="_top">
<!-- Favicon -->
<link rel="shortcut icon" href="{{env('APP_URL').'public/assets/images/favicon.ico'}}" type="image/x-icon"/>

<!--- Style css -->
@if (App::getLocale() == 'en')
    <!-- Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400&display=swap" rel="stylesheet">
@else

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400&family=Cairo:wght@400;500;600&display=swap"
        rel="stylesheet">
@endif

<link href="{{env('APP_URL').'public/css/wizard.css'}}" rel="stylesheet" id="bootstrap-css">

<!--   fontawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>


@yield('css')
<!--- Style css -->
<link href="{{env('APP_URL').'public/assets/css/style.css'}}" rel="stylesheet">
<!--- Style css -->
@if (App::getLocale() == 'en')
    <link href="{{env('APP_URL').'public/assets/css/ltr.css'}}" rel="stylesheet">
@else
    <link href="{{env('APP_URL').'public/assets/css/rtl.css'}}" rel="stylesheet">
@endif
