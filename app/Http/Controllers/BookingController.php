<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TimeSlot;
use App\Models\Customer;

class BookingController extends Controller
{
    public function index()
    {
        $time_slots = DB::table('time_slots')->where('status', 'active')->orderBy('slot_order')->get();
        $turfs = DB::table('turfs')->get();
        
        return view('slot-booking', [
            'time_slots' => $time_slots,
            'turfs' => $turfs,
            'time_slots_json' => $time_slots->toJson()
        ]);
    }

    public function bookslot(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'date' => 'required|date',
            'turf' => 'required|array', // Changed from 'turfs' to 'turf' to match form
        ]);

        try {
            DB::beginTransaction();

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->mobile_number = $request->mobile_number;
            $customer->save();

            $total_time = 0;
            $selected_slots = [];
            $turf_names = null;
            
            // Create ticker to ID mapping
            $turf_mapping = [
                'east' => 1,
                'west' => 2,
                'full' => 3
            ];

            // Process the form data - convert from turf[slot_id] = ticker+slot_id format
            $processed_turfs = [];
            foreach ($request->turf as $slot_id => $selected_values) {
                if (!is_array($selected_values)) {
                    $selected_values = [$selected_values];
                }
                
                foreach ($selected_values as $value) {
                    // Extract ticker from value (format: ticker+slot_id, e.g., "east1", "full2")
                    $ticker = preg_replace('/\d+$/', '', $value); // Remove numbers from end
                    
                    if (isset($turf_mapping[$ticker])) {
                        $turf_id = $turf_mapping[$ticker];
                        $processed_turfs[$slot_id][] = $turf_id;
                    }
                }
            }

            foreach ($processed_turfs as $time_slot_id => $turf_ids) {
                foreach ($turf_ids as $turf_id) {
                    $date = date("Y-m-d", strtotime($request->date));
                    $time_slot = TimeSlot::find($time_slot_id);

                    if (!$time_slot) {
                        throw new \Exception("Invalid time slot selected");
                    }

                    if ($turf_id == 3) { // Full Turf
                        // Check if any turf is already booked for this slot
                        $conflict = DB::table('bookings')
                            ->where('booking_date', $date)
                            ->where(function($query) use ($time_slot) {
                                $query->where(function($q) use ($time_slot) {
                                    $q->where('start_time', '<', $time_slot->end_time)
                                      ->where('end_time', '>', $time_slot->start_time);
                                });
                            })
                            ->whereIn('turf_id', [1, 2, 3])
                            ->exists();

                        // Also check booking conflicts
                        $conflict_exists = DB::table('booking_conflicts')
                            ->where('conflict_date', $date)
                            ->where(function($query) use ($time_slot) {
                                $query->where('conflict_start_time', '<', $time_slot->end_time)
                                      ->where('conflict_end_time', '>', $time_slot->start_time);
                            })
                            ->where('conflicted_turf_id', 3)
                            ->exists();

                        if ($conflict || $conflict_exists) {
                            throw new \Exception("Full turf not available for the selected time slot");
                        }

                        // Book Full Turf and get the booking ID
                        $booking_id = $this->insertBooking($customer->id, $turf_id, $date, $time_slot);

                        // Create conflicts for East and West turfs using the actual booking ID
                        $this->insertConflict($booking_id, 1, $date, $time_slot, 'full_blocks_half');
                        $this->insertConflict($booking_id, 2, $date, $time_slot, 'full_blocks_half');

                        $turf_names = 'Full Turf';

                    } else { // East or West Turf
                        // Check if this specific turf or full turf is already booked
                        $conflict = DB::table('bookings')
                            ->where('booking_date', $date)
                            ->where(function($query) use ($time_slot) {
                                $query->where('start_time', '<', $time_slot->end_time)
                                      ->where('end_time', '>', $time_slot->start_time);
                            })
                            ->whereIn('turf_id', [$turf_id, 3])
                            ->exists();

                        // Also check booking conflicts
                        $conflict_exists = DB::table('booking_conflicts')
                            ->where('conflict_date', $date)
                            ->where(function($query) use ($time_slot) {
                                $query->where('conflict_start_time', '<', $time_slot->end_time)
                                      ->where('conflict_end_time', '>', $time_slot->start_time);
                            })
                            ->where('conflicted_turf_id', $turf_id)
                            ->exists();

                        if ($conflict || $conflict_exists) {
                            $turf_name = DB::table('turfs')->where('id', $turf_id)->value('turf_name');
                            throw new \Exception("$turf_name not available for the selected time slot");
                        }

                        // Book the selected half turf and get the booking ID
                        $booking_id = $this->insertBooking($customer->id, $turf_id, $date, $time_slot);

                        // Create conflict for Full Turf using the actual booking ID
                        $this->insertConflict($booking_id, 3, $date, $time_slot, 'half_blocks_full');

                        $turf_name = DB::table('turfs')->where('id', $turf_id)->value('turf_name');
                        $turf_names = $turf_name;
                    }

                    $selected_slots[] = $time_slot_id;
                    $total_time += 0.5; // Each slot = 30 mins
                }
            }

            // Calculate time range
            $unique_slots = array_unique($selected_slots);
            sort($unique_slots);
            $start_slot = TimeSlot::find($unique_slots[0]);
            $end_slot = TimeSlot::find(end($unique_slots));
            $time_range = $start_slot->start_time . ' - ' . $end_slot->end_time;

            // Prepare WhatsApp message
            $message = "D-DON SPORTS ARENA\n";
            $message .= "*Booking Req* # : " . $customer->id . "\n";
            $message .= "*Booking date* : " . $request->date . "\n";
            $message .= "*Timeslot* : " . $time_range . "\n";
            $message .= "*Turf* : " . $turf_names. "\n";
            $message .= "*Number of hours* : " . $total_time . " Hours\n";
            $message .= "*Name* : " . $request->name . "\n";
            $message .= "*Phone number* : " . $request->mobile_number;

            DB::commit();

            return view('redirect_to_whatsapp', [
                'whatsapp_url' => urlencode($message),
                'booking_details' => [
                    'customer_id' => $customer->id,
                    'date' => $request->date,
                    'time_range' => $time_range,
                    'turfs' => $turf_names,
                    'total_hours' => $total_time
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function generateBookingReference()
    {
        // Generate a unique booking reference similar to your existing format (TB001, TB002, etc.)
        $latest_booking = DB::table('bookings')
            ->orderBy('booking_id', 'desc')
            ->first();
        
        if ($latest_booking) {
            // Extract number from existing reference (e.g., TB001 -> 001)
            $last_number = (int) substr($latest_booking->booking_reference, 2);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }
        
        // Format with leading zeros (TB001, TB002, etc.)
        return 'TB' . str_pad($new_number, 3, '0', STR_PAD_LEFT);
    }

    private function insertBooking($user_id, $turf_id, $date, $time_slot)
    {
        // Generate a unique booking reference
        $booking_reference = $this->generateBookingReference();
        
        $booking_id = DB::table('bookings')->insertGetId([
            'booking_reference' => $booking_reference,
            'user_id' => $user_id,
            'turf_id' => $turf_id,
            'booking_date' => $date,
            'start_time' => $time_slot->start_time,
            'end_time' => $time_slot->end_time,
            'total_slots' => 1,
            'slot_duration' => 30,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return $booking_id;
    }

    private function insertConflict($booking_id, $conflicted_turf_id, $date, $time_slot, $conflict_type = 'auto-blocked')
    {
        DB::table('booking_conflicts')->insert([
            'booking_id' => $booking_id, // Now using actual booking ID instead of customer ID
            'conflicted_turf_id' => $conflicted_turf_id,
            'conflict_date' => $date,
            'conflict_start_time' => $time_slot->start_time,
            'conflict_end_time' => $time_slot->end_time,
            'conflict_type' => $conflict_type,
            'created_at' => now()
        ]);
    }

    public function checkslot(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d", strtotime($request->date));
        $today_date = date("Y-m-d");
        $current_time = new \DateTime();

        $booked_slots = [];

        // Get all time slots ordered by start time
        $time_slots = DB::table('time_slots')->orderBy('start_time')->get();
        
        // Get all turfs
        $turfs = DB::table('turfs')->get();

        // Process existing bookings
        $bookings = DB::table('bookings')->where('booking_date', $date)->get();
        foreach ($bookings as $booking) {
            $booking_start = \DateTime::createFromFormat('H:i:s', $booking->start_time);
            $booking_end = \DateTime::createFromFormat('H:i:s', $booking->end_time);
            
            foreach ($time_slots as $slot) {
                $slot_start = \DateTime::createFromFormat('H:i:s', $slot->start_time);
                $slot_end = \DateTime::createFromFormat('H:i:s', $slot->end_time);
                
                // Check if booking overlaps with this time slot
                if ($booking_start < $slot_end && $booking_end > $slot_start) {
                    $booked_slots[$slot->id . '_' . $booking->turf_id] = true;
                    
                    // Handle turf conflicts
                    $booked_turf = $turfs->firstWhere('id', $booking->turf_id);
                    if ($booked_turf) {
                        if ($booked_turf->ticker === 'full') {
                            // If Full Turf is booked, block all turfs for this slot
                            foreach ($turfs as $turf) {
                                $booked_slots[$slot->id . '_' . $turf->id] = true;
                            }
                        } else if ($booked_turf->ticker === 'east' || $booked_turf->ticker === 'west') {
                            // If East or West is booked, also block Full Turf
                            $full_turf = $turfs->firstWhere('ticker', 'full');
                            if ($full_turf) {
                                $booked_slots[$slot->id . '_' . $full_turf->id] = true;
                            }
                        }
                    }
                }
            }
        }

        // Process booking conflicts
        $conflicts = DB::table('booking_conflicts')->where('conflict_date', $date)->get();
        foreach ($conflicts as $conflict) {
            $conflict_start = \DateTime::createFromFormat('H:i:s', $conflict->conflict_start_time);
            $conflict_end = \DateTime::createFromFormat('H:i:s', $conflict->conflict_end_time);
            
            foreach ($time_slots as $slot) {
                $slot_start = \DateTime::createFromFormat('H:i:s', $slot->start_time);
                $slot_end = \DateTime::createFromFormat('H:i:s', $slot->end_time);
                
                // Check if conflict overlaps with this time slot
                if ($conflict_start < $slot_end && $conflict_end > $slot_start) {
                    $booked_slots[$slot->id . '_' . $conflict->conflicted_turf_id] = true;
                }
            }
        }

        // Block past time slots for today
        if ($today_date === $date) {
            foreach ($time_slots as $slot) {
                $slot_time = \DateTime::createFromFormat('H:i:s', $slot->start_time);
                if ($current_time > $slot_time) {
                    foreach ($turfs as $turf) {
                        $booked_slots[$slot->id . '_' . $turf->id] = true;
                    }
                }
            }
        }

        return response()->json($booked_slots);
    }
}