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
                    <a href="{{url('slot-book')}}" class="header-btn-link">Book Your Timeslot</a>
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
                                <a href="{{url('slot-book')}}" class="header-btn-link">Book Your Timeslot</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="main-banner-sec">
            <div class="container">

            </div>
        </section>
        <section class="image-with-text">
            <div class="container">
                <!--<div class="imag-text-head">-->
                <!--    <h2 class="img-text-title">Play Box Cricket: Book Your Match Here!</h2>-->
                <!--</div>-->
                <div class="img-text-row">
                    <div class="img-text-left">
                        <div class="img-text-img">
                            <img src="{{asset('assets/d-don.png')}}" alt="Image" />
                        </div>
                    </div>
                    <div class="img-text-right">
                        <div class="img-text-right-wrap">
                            <div class="img-text-up">
                                <!--<h3 class="img-text-box-title">Premier Destination for Box Cricket Enthusiasts</h3>-->
                                <p class="img-text-info">D-Don Sports Arena is a premier venue for box cricket, football, and more. It offers a state-of-the-art, enclosed environment with artificial turf and top-notch lighting, ideal for fast-paced, competitive, and recreational play. It's the perfect spot for sports enthusiasts to enjoy high-energy matches anytime.</p>
                            </div>
                            <div class="img-text-button">
                                <a href="{{url('slot-book')}}" class="img-text-btn-link">Book Your Timeslot</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="book-play-sec">
            <div class="container">
                <div class="book-play-wrap">
                    <div class="book-play-row">
                        <div class="book-play-left">
                            <div class="book-play-img">
                                <img src="{{asset('assets/Frame.png')}}" alt="Book Play" />
                            </div>
                        </div>
                        <div class="book-play-right">
                            <div class="book-play-right-title">
                                <h2 class="book-play-main-title">One Stop Sports Platform for Discover, Book, Play and Listing.</h2>
                            </div>
                            <div class="book-play-box-right">
                                <div class="book-play-boxes">
                                    <div class="book-play-box-row">
                                        <div class="book-play-box-icon">
                                            <img src="{{asset('assets/image 8.png')}}" alt="Book Play Icon" />
                                        </div>
                                        <div class="play-box-infos">
                                            <h3 class="play-box-title">Book a slot and play with your team</h3>
                                            <p class="play-box-content">Check out the best boxes to play at and have a great time playing with your friends.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="book-play-boxes">
                                    <div class="book-play-box-row">
                                        <div class="book-play-box-icon">
                                            <img src="{{asset('assets/image 8 (1).png')}}" alt="Book Play Icon" />
                                        </div>
                                        <div class="play-box-infos">
                                            <h3 class="play-box-title">Ace in your game with frequent sessions</h3>
                                            <p class="play-box-content">Practice your game with regular sessions by conveniently booking venues online as per your availability</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="book-play-boxes">
                                    <div class="book-play-box-row">
                                        <div class="book-play-box-icon">
                                            <img src="{{asset('assets/image 8 (2).png')}}" alt="Book Play Icon" />
                                        </div>
                                        <div class="play-box-infos">
                                            <h3 class="play-box-title">Choose from the sports venues near you</h3>
                                            <p class="play-box-content">Brows Vijayawada across box and venues and pick the location with the best features, reviews and ratings.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="book-play-boxes">
                                    <div class="book-play-box-row">
                                        <div class="book-play-box-icon">
                                            <img src="{{asset('assets/image 8 (3).png')}}" alt="Book Play Icon" />
                                        </div>
                                        <div class="play-box-infos">
                                            <h3 class="play-box-title">Manage your sports activities with ease</h3>
                                            <p class="play-box-content">Easily list your box, turf, or arena so local players and teams can find and book online it for a variety of games.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="gallery-photo">
            <div class="container">
                <div class="gallery-photo-head">
                    <h2 class="gallery-pic-title">Gallery Photo</h2>
                </div>
                <div class="gallery-photo-row">
                    <div class="gallery-photo-col">
                        <img src="{{asset('assets/Image.png')}}" alt="Gallery" />
                    </div>
                    <div class="gallery-photo-col">
                        <img src="{{asset('assets/Image (1).png')}}" alt="Gallery" />
                    </div>
                    <div class="gallery-photo-col">
                        <img src="{{asset('assets/Image (2).png')}}" alt="Gallery" />
                    </div>
                    <div class="gallery-photo-col">
                        <img src="{{asset('assets/Image (3).png')}}" alt="Gallery" />
                    </div>
                    <div class="gallery-photo-col">
                        <img src="{{asset('assets/Image (4).png')}}" alt="Gallery" />
                    </div>
                    <div class="gallery-photo-col">
                        <img src="{{asset('assets/Image (5).png')}}" alt="Gallery" />
                    </div>
                    <div class="gallery-photo-col">
                        <img src="{{asset('assets/Image (6).png')}}" alt="Gallery" />
                    </div>
                    <div class="gallery-photo-col">
                        <img src="{{asset('assets/Image (7).png')}}" alt="Gallery" />
                    </div>
                </div>
            </div>
        </section>
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