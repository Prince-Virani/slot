<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Cricket Box</title>
		<meta name="description" content="">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
       <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
                <link rel="stylesheet" type="text/css" href="{{asset('assets/css/about.css')}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<script type="text/javascript" src=""></script>
	</head>
	<body>
         <div class="overlay-box"></div>
        <div class="site-header-drawer">
            <div class="site-header-drawer-mains">
                <div class="site-drawer-row">
                    <div class="site-drawer-logo">
                        <img src="{{asset('assets/logo.svg')}}" alt="Logo" />
                    </div>
                    <div class="site-header-close">
                        <img src="{{asset('assets/Vector_cross.png')}}" alt="Cross" />
                    </div>
                </div>
                <nav class="site-drawer-items">
                    <ul class="site-drawer-menu-wrap">
                        <li class="site-drawer-item">
                            <a href="{{url('/')}}" class="site-drawer-menu-link">Home</a>
                        </li>
                        <li class="site-drawer-item">
                            <a href="{{url('slot-book')}}" class="site-drawer-menu-link">Service</a>
                        </li>
                        <li class="site-drawer-item">
                            <a href="{{url('about-us')}}" class="site-drawer-menu-link">About</a>
                        </li>
                    </ul>
                </nav>
                <div class="header-btns hader-drawer-btn">
                    <a href="{{url('slot-book')}}" class="header-btn-link">Book Your Cricket</a>
                </div>
            </div>
        </div>
        <header class="site-header">
            <div class="container">
                <div class="site-header-row">
                    <div class="site-hum-menu">
                        <img src="{{asset('assets/Frame.svg')}}" alt="Humburger Icon" class="site-hum-icon"/>
                    </div>
                    <div class="site-header-left">
                        <div class="site-header-logo">
                            <a href="{{url('/')}}">
                                <img src="{{asset('assets/logo.svg')}}" alt="Logo" />
                            </a>
                        </div>
                        <a href="{{url('slot-book')}}" class="book-cricket-call-link"><img src="https://ddon.in/public/assets/call.png" alt="Call"><span>For Booking Call Us - 096769 26268</span></a>
                    </div>
                    <div class="site-header-right">
                        <div class="site-header-inner-right">
                            <nav class="heder-menus">
                                <ul class="header-menu-wrap">
                                    <li class="header-menu-item">
                                        <a href="{{url('/')}}" class="header-menu-link">Home</a>
                                    </li>
                                    <li class="header-menu-item">
                                        <a href="{{url('slot-book')}}" class="header-menu-link">Service</a>
                                    </li>
                                    <li class="header-menu-item">
                                        <a href="{{url('about-us')}}" class="header-menu-link">About</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="header-btns">
                                <a href="{{url('slot-book')}}" class="header-btn-link">Book Your Cricket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="coming-soon">
            <div class="container">
                <div class="coming-soon-sec">
                    <h3 class="coming-soon-title">Coming Soon...</h3>
                    <div class="coming-soon-image">
                        <img src="{{asset('assets/Frame (17).png')}}" alt="Coming Soon" />
                    </div>
                </div>
            </div>
        </div>
        <footer class="site-footer">
            <div class="container">
                <div class="site-footer-main">
                    <div class="site-footer-row">
                        <div class="site-footer-col-left">
                            <div class="site-footer-logo">
                                    <a href="{{url('/')}}">
                                <img src="{{asset('assets/D-Don Sports Arena.png')}}" alt="Logo" />
                                </a>
                            </div>
                            <p class="site-box-info">D-Don Sports Arena, Karmel Nagar, Gunadala, Vijayawada 520 004</p>
                        </div>
                        <div class="site-footer-col-center">
                            <h2 class="site-footer-title">D-Don Sports Arena</h2>
                            <ul class="site-footer-menu">
                                <li class="site-footer-item">
                                    <a href="{{url('/')}}" class="site-footer-item-link">Home</a>
                                </li>
                                <li class="site-footer-item">
                                    <a href="{{url('slot-book')}}" class="site-footer-item-link">Service</a>
                                </li>
                                <li class="site-footer-item">
                                    <a href="{{url('about-us')}}" class="site-footer-item-link">About</a>
                                </li>
                            </ul>
                        </div>
                        <div class="site-footer-col-right">
                            <h2 class="site-footer-title">Contact</h2>
                            <div class="site-footer-icon-box">
                                <div class="site-footer-icon-with-row">
                                    <img src="{{asset('assets/Vector.png')}}" alt="Mobile" />
                                    <a href="tel:+91 9876926268" class="site-footer-icons">+91 96769 26268</a>
                                </div>
                                <div class="site-footer-icon-with-row">
                                    <img src="{{asset('assets/Vector (1).png')}}" alt="Mobile" />
                                    <a href="mailto:contact@ddon.in" class="site-footer-icons">contact@ddon.in</a>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-info">© 2024, All rights reserved.</p>
                </div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).on('click','.site-hum-menu',function(){
                    $('.site-header-drawer').addClass('open');
                    $('.overlay-box').addClass('overlay');
                    $("body").css("overflow", "hidden");
                });
                $(document).on('click','.site-header-close',function(){
                    $('.site-header-drawer').removeClass('open');
                    $('.overlay-box').removeClass('overlay');
                    $("body").css("overflow", "unset");
                });
        </script>
    </body>
</html>