<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <title>@yield('title')</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Font Awesome-->
    @includeIf('layouts.admin.partials.css')

</head>
<body>
<style>
    .notification-container {
        display: flex;
        flex-direction: column;
        position: fixed;
        top: auto;
        right: 20px;
        width: 350px;
        z-index: 99;
        bottom: 20px;
    }


    .notification {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        background-color: #fff;
        margin-bottom: 15px; /* Space between notifications */
        transform: translateX(100%);
        transition: transform 0.5s ease-out, opacity 0.5s ease-out;
        display: flex;
        align-items: center;
        opacity: 0;
    }

    .notification.hidden {
        opacity: 0;
        transform: translateX(100%);
    }

    .notification:not(.hidden) {
        opacity: 1;
        transform: translateX(0);
    }

    .innernoti {
        padding: 10px;
        background-color: #ffffff;
        display: flex;
        align-items: center;
        width: 100%;
        border-radius: 7px;
    }

    .notification-icon {
        width: 40px;
        height: 40px;
        margin-right: 15px;
    }

    .text-content {
        flex-grow: 1;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .notification-title {
        font-weight: bold;
    }
    .notification-body span {
        color: #ec3237;
        font-weight: 700;
    }
    .notification-container .close-btn {
        font-size: 36px;
        line-height: normal;
        height: 24px;
        width: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    @media(max-width: 400px){
        .notification-container {
            width: 291px;
            right: 15px;
        }
    }

</style>
<!-- Loader starts-->
<div class="loader-wrapper">
    <div class="theme-loader"></div>
</div>
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
@includeIf('layouts.admin.partials.header')
<!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
    @includeIf('layouts.admin.partials.sidebar')
    <!-- Page Sidebar Ends-->
        <div class="page-body">
            <!-- Container-fluid starts-->
        @yield('content')
        <!-- Container-fluid Ends-->
        </div>
        <div class="notification-container">

        </div>
        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">Copyright {{date('Y')}}-{{date('y', strtotime('+1 year'))}} © Ddon. All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <p class="pull-right mb-0">Hand crafted & made with <i class="fa fa-heart font-secondary"></i></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- latest jquery-->
@includeIf('layouts.admin.partials.js')

</body>
</html>
