<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  

    public function index()
    {
        $customers = DB::table('customers')
            ->join('bookings', 'bookings.user_id', '=', 'customers.id')
            ->join('turfs', 'turfs.id', '=', 'bookings.turf_id')
            ->orderByDesc('bookings.user_id')
            ->select(
                'bookings.user_id',
                DB::raw('MAX(customers.name) as name'),
                DB::raw('MAX(customers.mobile_number) as mobile_number'),
                DB::raw('MAX(bookings.booking_date) as booking_date'),
                DB::raw('MAX(bookings.booking_id) as booking_id'),
                DB::raw('MAX(bookings.booking_reference) as booking_reference'),
                DB::raw('GROUP_CONCAT(DISTINCT turfs.turf_name ORDER BY turfs.id SEPARATOR ", ") as turf_names'),
                DB::raw('MIN(bookings.start_time) as start_time'),
                DB::raw('MAX(bookings.end_time) as end_time')
            )
            ->groupBy('bookings.user_id', 'bookings.booking_date')
            ->get();

        // Format the booking time for display
        foreach ($customers as $customer) {
            if ($customer->start_time && $customer->end_time) {
                $start_time = date('h:i A', strtotime($customer->start_time));
                $end_time = date('h:i A', strtotime($customer->end_time));
                $customer->booking_time = $start_time . ' To ' . $end_time;
            } else {
                $customer->booking_time = "Not Available";
            }
            
            // Format date for display
            if ($customer->booking_date) {
                $customer->date = date('d-m-Y', strtotime($customer->booking_date));
            } else {
                $customer->date = "Not Available";
            }
            
            // Set turf names (already formatted from GROUP_CONCAT)
            $customer->booking_ground = $customer->turf_names ?: "Not Available";
        }

        return view('admin.user.list', compact('customers'));
    }

    public function getData(Request $request)
    {
        $date = $request->input('date');

        $customers = DB::table('customers')
            ->join('bookings', 'bookings.user_id', '=', 'customers.id')
            ->join('turfs', 'turfs.id', '=', 'bookings.turf_id')
            ->where('bookings.booking_date', $date)
            ->orderByDesc('bookings.user_id')
            ->select(
                'bookings.user_id',
                DB::raw('MAX(customers.name) as name'),
                DB::raw('MAX(customers.mobile_number) as mobile_number'),
                DB::raw('MAX(bookings.booking_date) as booking_date'),
                DB::raw('MAX(bookings.booking_id) as booking_id'),
                DB::raw('MAX(bookings.booking_reference) as booking_reference'),
                DB::raw('GROUP_CONCAT(DISTINCT turfs.turf_name ORDER BY turfs.id SEPARATOR ", ") as turf_names'),
                DB::raw('MIN(bookings.start_time) as start_time'),
                DB::raw('MAX(bookings.end_time) as end_time')
            )
            ->groupBy('bookings.user_id', 'bookings.booking_date')
            ->get();

        // Format the booking time for display
        foreach ($customers as $customer) {
            if ($customer->start_time && $customer->end_time) {
                $start_time = date('h:i A', strtotime($customer->start_time));
                $end_time = date('h:i A', strtotime($customer->end_time));
                $customer->booking_time = $start_time . ' To ' . $end_time;
            } else {
                $customer->booking_time = "Not Available";
            }
            
            // Format date for display
            if ($customer->booking_date) {
                $customer->date = date('d-m-Y', strtotime($customer->booking_date));
            } else {
                $customer->date = "Not Available";
            }
            
            // Set turf names (already formatted from GROUP_CONCAT)
            $customer->booking_ground = $customer->turf_names ?: "Not Available";
        }

        return view('admin.user.table', compact('customers'));
    }

    public function deleteuserslot(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $customer_id = $request->customer_id;
            
            // First, delete all booking conflicts related to this customer's bookings
            $booking_ids = DB::table('bookings')
                ->where('user_id', $customer_id)
                ->pluck('booking_id');
                
            if ($booking_ids->isNotEmpty()) {
                DB::table('booking_conflicts')
                    ->whereIn('booking_id', $booking_ids)
                    ->delete();
            }
            
            // Delete all bookings for this customer
            DB::table('bookings')->where('user_id', $customer_id)->delete();
            
            // Finally, delete the customer
            $customer = Customer::find($customer_id);
            if ($customer) {
                $customer->delete();
            }
            
            DB::commit();
            
            return response()->json([
                "status" => 1, 
                "message" => "Customer and all bookings deleted successfully"
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                "status" => 0, 
                "message" => "Error deleting customer: " . $e->getMessage()
            ], 500);
        }
    }

    // Alternative method - Delete only specific booking (not entire customer)
    public function deleteSpecificBooking(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $booking_id = $request->booking_id;
            
            // Delete booking conflicts first
            DB::table('booking_conflicts')
                ->where('booking_id', $booking_id)
                ->delete();
                
            // Delete the specific booking
            $deleted = DB::table('bookings')
                ->where('booking_id', $booking_id)
                ->delete();
                
            if (!$deleted) {
                throw new \Exception('Booking not found');
            }
            
            DB::commit();
            
            return response()->json([
                "status" => 1, 
                "message" => "Booking deleted successfully"
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                "status" => 0, 
                "message" => "Error deleting booking: " . $e->getMessage()
            ], 500);
        }
    }

    // Method to delete bookings for specific date
    public function deleteBookingsByDate(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $customer_id = $request->customer_id;
            $date = $request->date;
            
            // Get booking IDs for this customer and date
            $booking_ids = DB::table('bookings')
                ->where('user_id', $customer_id)
                ->where('booking_date', $date)
                ->pluck('booking_id');
                
            if ($booking_ids->isNotEmpty()) {
                // Delete related conflicts first
                DB::table('booking_conflicts')
                    ->whereIn('booking_id', $booking_ids)
                    ->delete();
                    
                // Delete bookings for specific date
                DB::table('bookings')
                    ->where('user_id', $customer_id)
                    ->where('booking_date', $date)
                    ->delete();
            }
            
            // Check if customer has any other bookings
            $remaining_bookings = DB::table('bookings')
                ->where('user_id', $customer_id)
                ->count();
                
            // If no remaining bookings, optionally delete customer
            if ($remaining_bookings == 0 && $request->delete_customer == true) {
                $customer = Customer::find($customer_id);
                if ($customer) {
                    $customer->delete();
                }
            }
            
            DB::commit();
            
            return response()->json([
                "status" => 1, 
                "message" => "Bookings for date $date deleted successfully"
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                "status" => 0, 
                "message" => "Error deleting bookings: " . $e->getMessage()
            ], 500);
        }
    }
    public function getDetailedBookings(Request $request)
    {
        $date = $request->input('date');
        
        $bookings = DB::table('bookings')
            ->join('customers', 'customers.id', '=', 'bookings.user_id')
            ->join('turfs', 'turfs.id', '=', 'bookings.turf_id')
            ->when($date, function($query, $date) {
                return $query->where('bookings.booking_date', $date);
            })
            ->select(
                'bookings.*',
                'customers.name',
                'customers.mobile_number',
                'turfs.turf_name',
                'turfs.ticker as turf_type'
            )
            ->orderBy('bookings.booking_date', 'desc')
            ->orderBy('bookings.start_time', 'asc')
            ->get();

        // Group bookings by customer and date for better display
        $grouped_bookings = $bookings->groupBy(function($booking) {
            return $booking->user_id . '_' . $booking->booking_date;
        })->map(function($customer_bookings) {
            $first_booking = $customer_bookings->first();
            
            return (object)[
                'user_id' => $first_booking->user_id,
                'name' => $first_booking->name,
                'mobile_number' => $first_booking->mobile_number,
                'booking_date' => $first_booking->booking_date,
                'date' => date('d-m-Y', strtotime($first_booking->booking_date)),
                'booking_reference' => $first_booking->booking_reference,
                'start_time' => date('h:i A', strtotime($customer_bookings->min('start_time'))),
                'end_time' => date('h:i A', strtotime($customer_bookings->max('end_time'))),
                'booking_time' => date('h:i A', strtotime($customer_bookings->min('start_time'))) . ' To ' . date('h:i A', strtotime($customer_bookings->max('end_time'))),
                'turf_names' => $customer_bookings->pluck('turf_name')->unique()->implode(', '),
                'booking_ground' => $customer_bookings->pluck('turf_name')->unique()->implode(', '),
                'total_slots' => $customer_bookings->sum('total_slots'),
                'bookings_count' => $customer_bookings->count()
            ];
        })->values();

        return view('admin.user.table', compact('grouped_bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function toggleSlots(Request $request)
    {
        try {
            $status = $request->input('status'); // 'active' or 'inactive'
            
            // Validate status
            if (!in_array($status, ['active', 'inactive'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status provided'
                ], 400);
            }
            
            // Update slots 1 to 20
            $affected = DB::table('time_slots')
                ->whereIn('id', range(1, 20))
                ->update(['status' => $status]);
            
            return response()->json([
                'success' => true,
                'message' => "Successfully updated {$affected} time slots to {$status}",
                'status' => $status,
                'affected_count' => $affected
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating time slots: ' . $e->getMessage()
            ], 500);
        }
    }

    // Also add this function to get current status of slots 1-20
    public function getSlotsStatus()
    {
        try {
            $activeCount = DB::table('time_slots')
                ->whereIn('id', range(1, 20))
                ->where('status', 'active')
                ->count();
            
            // If all 20 slots are active, toggle should be ON, otherwise OFF
            $toggleStatus = ($activeCount === 20) ? 'on' : 'off';
            
            return response()->json([
                'success' => true,
                'toggle_status' => $toggleStatus,
                'active_count' => $activeCount,
                'total_slots' => 20
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error getting slots status: ' . $e->getMessage()
            ], 500);
        }
    }

}
