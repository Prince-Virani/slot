$(document).ready(function() {
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function daysInMonth(month, year) {
        return new Date(year, month + 1, 0).getDate();
    }

    function renderCalendar(month, year) {
        $(".days").empty();
        $("#month-year").text(`${monthNames[month]} ${year}`);

        let firstDay = new Date(year, month).getDay();
        let totalDays = daysInMonth(month, year);

        // Disable the "Previous Month" button if we're in the current month/year
        if (month === currentDate.getMonth() && year === currentDate.getFullYear()) {
            $("#prev-month").addClass("not-clicks");
        } else {
            $("#prev-month").removeClass("not-clicks");
        }

        for (let i = 0; i < firstDay; i++) {
            $(".days").append('<div class="day empty"></div>');
        }

        for (let day = 1; day <= totalDays; day++) {
            const dayDiv = $(`<div class="day"><span class="day-dates">${day}</span></div>`);
            const date = new Date(year, month, day);

            // Disable dates in the past
            if (date < currentDate && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
                dayDiv.addClass("empty not-show").css("cursor", "not-allowed");
            } else {
                dayDiv.click(function() {
                    $(".day").removeClass("selected");
                    $(this).addClass("selected");
                    $("#selected-date").text(`${day}/${month + 1}/${year}`);
                });
            }

            if (day === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
                dayDiv.addClass("selected");
                $("#selected-date").text(`${day}/${month + 1}/${year}`);
            }

            $(".days").append(dayDiv);
        }
    }

    renderCalendar(currentMonth, currentYear);

    $("#prev-month").click(function() {
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    $("#next-month").click(function() {
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    $("#next-button").click(function() {
        alert(`Selected Date: ${$("#selected-date").text()}`);
    });
});



$(document).ready(function() {
    const $slider = $('.date-slider');
    const $items = $('.date-item');
    let selectedIdx = $items.index($('.selected'));

    function selectDate(index) {
        $items.removeClass('selected');
        $items.eq(index).addClass('selected');
        selectedIdx = index;
    }

    $('#prev-date').click(function() {
        if (selectedIdx > 0) {
            selectDate(selectedIdx - 1);
            $slider.scrollLeft($slider.scrollLeft() - $items.width() - 10);
        }
    });

    $('#next-date').click(function() {
        if (selectedIdx < $items.length - 1) {
            selectDate(selectedIdx + 1);
            $slider.scrollLeft($slider.scrollLeft() + $items.width() + 10);
        }
    });

    $items.click(function() {
        selectDate($items.index(this));
    });

   $('.calender-box-second').hide();
    $('.calender-box-bottom').hide();
    $('.third-step-box').hide();
    $(document).on('click','#next-button',function(){
        $('.calender-box-second').show();
        $('.calendar-container').hide();
    });
    $(document).on('click','.next-button',function(){
        $('.calender-box-second').hide();
        $('.calender-box-bottom').hide();
        $('.calendar-container').hide();
        $('.third-step-box').show();
    });
});
$(document).ready(function() {

    $('.morning-slots.time-play-boxes').hide();

    // Show all rows when the "See All" button is clicked
    $('.see-all').click(function() {
        $('.morning-slots.time-play-boxes').toggle();
    });
});

