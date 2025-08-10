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
                <link rel="stylesheet" type="text/css" href="{{asset('assets/css/service.css')}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                        <a href="{{url('slot-book')}}" class="book-cricket-call-link">
                            <img src="https://ddon.in/public/assets/call.png" alt="Call">
                            <span>For Booking Call Us - 096769 26268</span>
                        </a>
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
        <form action="{{route('slot-book')}}" method="post" id="myForm">
            @method('post')
            @csrf
            <div class="calender-boxes">
                <div class="container">
                    <div class="calendar-container">
                        <h2 class="date-main-title">Select Date and Book Your Slot</h2>
                        <div class="calendar-date-picer">
                            <div class="calendar-header">
                                <span id="month-year"></span>
                                <div class="month-year-slide-btns">
                                     <a href="javascript:void(0);" class="nav-button" id="prev-month"><img src="{{asset('assets/Frame 16.png')}}" alt="Arrow"/></a>
                                     <a href="javascript:void(0);" class="nav-button" id="next-month"><img src="{{asset('assets/Frame 17.png')}}" alt="Arrow"/></a>
                                </div>
                            </div>
                            <div class="calendar">
                                <div class="days-header">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <div class="days"></div>
                            </div>
                            <div class="selected-date">
                                Selected Date: <span id="selected-date">None</span>
                            </div>
                            <div class="next-btns">
                                <span id="next-button">Next</span>
                            </div>
                        </div>
                    </div>
                    <div class="calender-box-second">
                        <!--<h2 class="book-cricket-title">Book Your Cricket Session</h2>-->
                        <!--<div class="book-cricket-call-btn">-->
                        <!--    <a href="#" class="book-cricket-call-link"><img src="{{asset('assets/call.png')}}" alt="Call" /><span>Call us now on +91 98769 26268</span></a>-->
                        <!--</div>-->
                        <div class="slider-container">
                            <button class="nav-button" id="prev-date">&lt;</button>
                            <div id="week-container" class="date-slider">

                            </div>
                            <button class="nav-button" id="next-date">&gt;</button>
                        </div>
                        <div class="time-play-sec">
                            <div class="time-play-table">
                                <div class="time-play-table-box">
                                    <div class="time-play-boxes popular-shorts">
                                        <h2 class="time-slot-title">Most <span>Popular</span> Booking Slots:</h2>
                                        <div class="table">
                                            <div class="header">
                                                <div class="column"><span>Select Time</span></div>
                                                <div class="column"><span>East Turf</span></div>
                                                <div class="column"><span>West Turf</span></div>
                                                <div class="column"><span>Full Turf</span></div>
                                            </div>
                                            @foreach($time_slots as $slot)
                                                <div class="row">
                                                    <div class="cell time"><span>{{$slot->slot_label}}</span></div>
                                                     @foreach($turfs as $turf)
                                                        <input type="checkbox" id="turf{{$turf->ticker}}{{$slot->id}}" name="turf[{{$slot->id}}]" value="{{$turf->ticker}}{{$slot->id}}" class="turf{{$slot->id}}-checkbox turf{{$turf->ticker}}-checkbox">
                                                        <label for="turf{{$turf->ticker}}{{$slot->id}}" class="cell available"><span>Available</span></label>
                                                    @endforeach                                                    
                                                </div>
                                            @endforeach
                                        </div>                                        
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .third-step-box {
                            padding: 50px 0;
                        }
                    </style>
                    <div class="third-step-box" id="third-step">
                        <h2 class="form-title">Fill Slot Booking Detail</h2>
                        <div class="third-step-row">
                            <div class="third-step-img">
                                <img src="{{asset('assets/Hire Image.png')}}" alt="Ground Image">
                            </div>
                            <div class="form-container">
                                <label class="selected-time-form" for="Times" id="mobile-time-slot"></label>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="text" id="date" name="date" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="time">Time</label>
                                        <input type="text" id="time" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ground">Ground</label>
                                        <input type="text" id="ground" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Enter your Name *</label>
                                    <input type="text" id="name" name="name" placeholder="Enter your Name" required>
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <label for="email">Enter your Email</label>-->
                                <!--    <input type="email" id="email" name="email" placeholder="Enter your Email">-->
                                <!--</div>-->
                                <div class="form-group">
                                    <label for="mobile">Enter your Mobile Number *</label>
                                    <input type="tel" id="mobile" name="mobile_number" placeholder="Enter your Mobile Number" required>
                                </div>
                                <div class="submit-btns">
                                    <button class="submit-button">Submit<img src="{{asset('assets/true.png')}}" alt="" /></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="calender-box-bottom">
                <div class="calender-box-bottom-inner">
                    <div class="container">
                        <div class="calender-select-boxes">
                            <div class="date-seletced-bottom">
                                <div class="select-time">Selected Time: <span class="time" id="bottom-bar-time"></span></div>
                                <div class="select-ground">Selected Ground: <span class="ground" id="bottom-bar-ground"></span></div>
                            </div>
                            <div class="next-button-main">
                                <a href="#third-step" class="next-button" id="next2">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script>
      $(document).ready(function() {
            // Cache DOM elements and data
            const $body = $("body");
            const $siteHeaderDrawer = $('.site-header-drawer');
            const $overlayBox = $('.overlay-box');
            const $bottomBarGround = $('#bottom-bar-ground');
            const $bottomBarTime = $('#bottom-bar-time');
            const $calenderBoxBottom = $('.calender-box-bottom');
            const $mobileTimeSlot = $('#mobile-time-slot');
            const $weekContainer = $('#week-container');
            const $selectedDate = $("#selected-date");
            const $dateInput = $('#date');
            const $groundInput = $('#ground');
            const $timeInput = $('#time');
            
            // Get data from server
            const timeSlots = @json($time_slots ?? []);
            const turfs = @json($turfs ?? []);
            
            // Create lookup objects for better performance
            const timeSlotsById = timeSlots.reduce((acc, slot) => {
                acc[slot.id] = slot;
                return acc;
            }, {});
            
            const turfsById = turfs.reduce((acc, turf) => {
                acc[turf.id] = turf;
                return acc;
            }, {});
            
            const turfTypes = {
                'east': 'East Turf',
                'west': 'West Turf', 
                'full': 'Full Turf'
            };

            // Menu handlers
            $(document).on('click', '.site-hum-menu', () => {
                $siteHeaderDrawer.addClass('open');
                $overlayBox.addClass('overlay');
                $body.css("overflow", "hidden");
            });

            $(document).on('click', '.site-header-close', () => {
                $siteHeaderDrawer.removeClass('open');
                $overlayBox.removeClass('overlay');
                $body.css("overflow", "unset");
            });

            // Main time slot selection function
            function updateTimeSlotSelection() {
                const checkedBoxes = $("#myForm input:checkbox:checked");
                
                if (checkedBoxes.length === 0) {
                    $calenderBoxBottom.hide();
                    return;
                }

                // Get turf type from first checked box
                const firstValue = checkedBoxes.first().val();
                const turfType = firstValue.slice(0, 4);
                const turfName = turfTypes[turfType];
                
                // Update ground display
                $bottomBarGround.text(turfName);
                $groundInput.val(turfName);

                // Get sorted slot IDs
                const slotIds = checkedBoxes.map(function() {
                    const match = this.id.match(/\d+/);
                    return match ? parseInt(match[0]) : null;
                }).get().filter(id => id !== null).sort((a, b) => a - b);

                if (slotIds.length > 0) {
                    const firstSlot = timeSlotsById[slotIds[0]];
                    const lastSlot = timeSlotsById[slotIds[slotIds.length - 1]];
                    
                    if (firstSlot && lastSlot) {
                        const firstTime = firstSlot.slot_label.split(' - ')[0];
                        const lastTime = lastSlot.slot_label.split(' - ')[1];
                        const finalTime = `${firstTime} - ${lastTime}`;
                        
                        $bottomBarTime.text(finalTime);
                        $timeInput.val(finalTime);
                        $mobileTimeSlot.text(`${finalTime} And ${turfName}`);
                        $calenderBoxBottom.show();
                    }
                }
            }

            // Checkbox selection handler for continuous selection
            function handleContinuousSelection(changedCheckbox) {
                const $checkbox = $(changedCheckbox);
                const turfType = changedCheckbox.id.replace(/turf|[0-9]/g, '');
                const currentSlot = parseInt(changedCheckbox.id.match(/\d+/)[0]);
                const isChecked = $checkbox.prop('checked');
                
                const $turfCheckboxes = $(`.turf${turfType}-checkbox`);
                const checkedSlots = [];
                
                $turfCheckboxes.each(function() {
                    if ($(this).prop('checked')) {
                        const slotId = parseInt(this.id.match(/\d+/)[0]);
                        checkedSlots.push(slotId);
                    }
                });
                
                checkedSlots.sort((a, b) => a - b);
                
                if (checkedSlots.length > 1) {
                    const minSlot = Math.min(...checkedSlots);
                    const maxSlot = Math.max(...checkedSlots);
                    
                    // Fill in gaps for continuous selection
                    for (let i = minSlot; i <= maxSlot; i++) {
                        $(`#turf${turfType}${i}`).prop('checked', true);
                    }
                }
            }

            // Initialize checkbox handlers
            function initializeCheckboxHandlers() {
                // Handle mutual exclusion between turf types
                const turfSelectors = ['.turfeast-checkbox', '.turfwest-checkbox', '.turffull-checkbox'];
                
                turfSelectors.forEach(selector => {
                    $(document).on('change', selector, function() {
                        if (this.checked) {
                            // Uncheck other turf types
                            turfSelectors.forEach(otherSelector => {
                                if (otherSelector !== selector) {
                                    $(otherSelector).prop('checked', false);
                                }
                            });
                        }
                        handleContinuousSelection(this);
                        updateTimeSlotSelection();
                    });
                });
            }

            // Date handling
            $(document).on('click', '.date-item', function() {
                $('.date-item').removeClass('selected');
                $(this).addClass('selected');
                
                const selectedDate = $(this).find('.date-on-page').val();
                $dateInput.val(selectedDate);
                checkAvailableTimeSlots(selectedDate);
                $calenderBoxBottom.hide();
            });

            // Generate week dates
            function generateWeekDates(startDate) 
            {
                const [day, month, year] = startDate.split('/').map(Number);
                const startOfWeek = new Date(year, month - 1, day);
                
                $weekContainer.empty();
                
                for (let i = 0; i < 9; i++) {
                    const currentDate = new Date(startOfWeek);
                    currentDate.setDate(startOfWeek.getDate() + i);
                    
                    const dateStr = `${currentDate.getMonth() + 1}/${currentDate.getDate()}/${currentDate.getFullYear()}`;
                    const monthStr = currentDate.toLocaleDateString('en-US', { month: 'short' });
                    const dayStr = currentDate.toLocaleDateString('en-US', { day: 'numeric' });
                    const dayOfWeek = currentDate.toLocaleDateString('en-US', { weekday: 'short' });
                    
                    const dateBox = $(`
                        <div class="date-item ${i === 0 ? 'selected' : ''}">
                            <span class="month">${monthStr}</span><br>
                            <span class="date">${dayStr}</span><br>
                            <span class="day">${dayOfWeek}</span>
                            <input type="hidden" value="${dateStr}" class="date-on-page">
                        </div>
                    `);
                    
                    $weekContainer.append(dateBox);
                }
                
                const startDateFormatted = `${startOfWeek.getMonth() + 1}/${startOfWeek.getDate()}/${startOfWeek.getFullYear()}`;
                checkAvailableTimeSlots(startDateFormatted);
                $dateInput.val(startDateFormatted);
            }

            // Check available time slots
            function checkAvailableTimeSlots(date) {
                $.ajax({
                    url: "{{route('available-slot')}}",
                    type: 'POST',
                    data: { 
                        date: date, 
                        "_token": "{{ csrf_token() }}" 
                    },
                    success: function(data) {
                        // Reset all checkboxes and labels
                        $('input[type="checkbox"]').prop('checked', false);
                        
                        // Reset all slots to available
                        timeSlots.forEach(slot => {
                            turfs.forEach(turf => {
                                const $label = $(`label[for='turf${turf.ticker}${slot.id}']`);
                                $label.removeClass('booked')
                                    .addClass('available')
                                    .html('<span>Available</span>');
                            });
                        });

                        // Mark booked slots
                        Object.entries(data).forEach(([key, isBooked]) => {
                            if (isBooked) {
                                const [timeSlotId, turfId] = key.split('_');
                                const turf = turfsById[turfId];
                                
                                if (turf) {
                                    const $label = $(`label[for='turf${turf.ticker}${timeSlotId}']`);
                                    $label.addClass('booked')
                                        .removeClass('available')
                                        .html('<span>Booked</span>');
                                }
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching available slots:', {
                            status: status,
                            error: error,
                            response: xhr.responseText
                        });
                    }
                });
            }

            // Next button handlers
            $("#next-button").on('click', function() {
                const date = $selectedDate.text();
                if (date) {
                    generateWeekDates(date);
                }
            });

            $("#next2").on('click', function() {
                $('.calender-boxes').css("padding", "0");
                updateTimeSlotSelection();
            });

            // Initialize the application
            initializeCheckboxHandlers();
        });

    </script>
    </body>
    </html>
