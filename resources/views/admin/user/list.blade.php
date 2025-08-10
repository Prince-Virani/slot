@extends('layouts.admin.master')

@section('title')User
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/datatables.css') }}">
    <style>
        .date-container {
            display: flex;
            gap: 10px; /* Spacing between date boxes */
            justify-content: center;
        }

        .date-box {
            border: 1px solid red;
            padding: 14px 40px;
            text-align: center;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }

        .date-box.active {
            background-color: red;
            color: white;
            border-color: red;
        }

        .date-box span {
            display: block;
        }

        .date-month {
            font-size: 14px;
            font-weight: bold;
        }

        .date-day {
            font-size: 20px;
            font-weight: bold;
        }

        .date-weekday {
            font-size: 14px;
            font-weight: bold;
        }

        /* Toggle Switch Styles */
        .toggle-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #4CAF50;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #4CAF50;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .toggle-label {
            font-weight: bold;
            font-size: 16px;
        }

        .slots-status {
            margin-left: 15px;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        .status-active {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
@endpush

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

    <div class="container-fluid">
        <div class="row">
            <!-- Base styles-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>User</h5>
                        
                        <!-- Toggle Switch for Morning Slots (1-20) -->
                        <div class="toggle-container">
                            <span class="toggle-label">Morning Slots (6:00 AM - 4:00 PM):</span>
                            <label class="toggle-switch">
                                <input type="checkbox" id="morningSlotToggle">
                                <span class="slider"></span>
                            </label>
                            <span class="slots-status" id="slotsStatus">Loading...</span>
                        </div>

                        <div class="date-container">
                            <!-- Dates will be appended here dynamically by jQuery -->
                        </div>
                    </div>
                    <div class="card-body" id="table_data">
                       @include('admin.user.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Initialize date boxes
                let today = new Date(); // Get today's date              
                let todayFormatted = formatDate(today); // Format today's date

                for (let i = 0; i < 8; i++) {
                    let currentDate = new Date(today);
                    currentDate.setDate(today.getDate() + i); // Add days to the current date

                    let month = currentDate.toLocaleString('default', { month: 'short' });
                    let day = currentDate.getDate();
                    let weekday = currentDate.toLocaleString('default', { weekday: 'short' });

                    let formattedDate = formatDate(currentDate);

                    let dateBox = `
                        <div class="date-box" data-date="${formattedDate}">
                            <span class="date-month">${month}</span>
                            <span class="date-day">${day}</span>
                            <span class="date-weekday">${weekday}</span>
                        </div>
                    `;

                    $('.date-container').append(dateBox);
                }

                // Load initial toggle status
                loadToggleStatus();
            });

            // Helper function to format date as YYYY-MM-DD
            function formatDate(date) {
                return date.getFullYear() + '-' + 
                    String(date.getMonth() + 1).padStart(2, '0') + '-' + 
                    String(date.getDate()).padStart(2, '0');
            }

            // Load current toggle status
            function loadToggleStatus() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('slots.status') }}", // You'll need to add this route
                    success: function (data) {
                        if (data.success) {
                            const isOn = data.toggle_status === 'on';
                            $('#morningSlotToggle').prop('checked', isOn);
                            updateStatusDisplay(isOn, data.active_count);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading toggle status:', error);
                        $('#slotsStatus').text('Error loading status').addClass('status-inactive');
                    }
                });
            }

            // Update status display
            function updateStatusDisplay(isActive, activeCount = null) {
                const statusElement = $('#slotsStatus');
                statusElement.removeClass('status-active status-inactive');
                
                if (isActive) {
                    statusElement.text('Active (20/20)').addClass('status-active');
                } else {
                    const count = activeCount !== null ? activeCount : '?';
                    statusElement.text(`Inactive (${count}/20)`).addClass('status-inactive');
                }
            }

            // Toggle switch event handler
            $(document).on('change', '#morningSlotToggle', function() {
                const isChecked = $(this).is(':checked');
                const status = isChecked ? 'active' : 'inactive';
                
                // Show loading
                $('#slotsStatus').text('Updating...').removeClass('status-active status-inactive');
                
                $.ajax({
                    type: "POST",
                    url: "{{ route('slots.toggle') }}", // You'll need to add this route
                    data: {
                        status: status,
                        "_token": $('#token').val()
                    },
                    success: function (data) {
                        if (data.success) {
                            updateStatusDisplay(isChecked);
                            
                            // Show success message (optional)
                            // alert(data.message);
                            
                            // Reload table data if a date is selected
                            const activeDate = $('.date-box.active').data('date');
                            if (activeDate) {
                                loadDateData(activeDate);
                            }
                        } else {
                            // Revert toggle if failed
                            $('#morningSlotToggle').prop('checked', !isChecked);
                            updateStatusDisplay(!isChecked);
                            alert('Error: ' + data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Toggle Error:', error);
                        // Revert toggle if failed
                        $('#morningSlotToggle').prop('checked', !isChecked);
                        updateStatusDisplay(!isChecked);
                        alert('Error updating slots. Please try again.');
                    }
                });
            });

            $(document).on('click', '.date-box', function() {
                $('.date-box').removeClass('active');
                $(this).addClass('active');
                var date = $(this).data('date');
                loadDateData(date);
            });

            // Separate function for loading date data
            function loadDateData(date) {
                $(".loader-div1").show();
                
                $.ajax({
                    type: "POST",
                    url: "{{route('data.get')}}",
                    data: {
                        date: date,
                        "_token": $('#token').val()
                    },
                    success: function (data) {
                        $('#table_data').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $('#table_data').html('<p>Error loading data. Please try again.</p>');
                    },
                    complete: function() {
                        $(".loader-div1").hide();
                    }
                });
            }

            function confirmdelete(customer_id) {
                $.ajax({
                    type: "POST",
                    url: "{{route('deleteuserslot')}}",
                    data: {
                        customer_id: customer_id,
                        "_token": $('#token').val()
                    },
                    success: function (data) {
                        if(data['status'] == 1){
                            window.location.reload();
                        } else {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Delete Error:', error);
                        window.location.reload();
                    }
                });
            }
        </script>
    @endpush

@endsection