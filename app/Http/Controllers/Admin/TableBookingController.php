<?php

namespace App\Http\Controllers\Admin;

use App\Models\TableBooking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;

class TableBookingController extends Controller
{
    use AdminViewSharedDataTrait;

    public function __construct()
    {
        $this->shareAdminViewData();
        
    }
    public function index()
    {
        $tableBookings = TableBooking::all();
        return view('admin.table-bookings', compact('tableBookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required|string',
            'persons' => 'required|integer|min:1',
        ]);

        TableBooking::create($validated);
        return back()->with('success', 'Table booking created successfully.');
        
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required|string',
            'persons' => 'required|integer|min:1',
        ]);

        $booking = TableBooking::findOrFail($id);
        $booking->update($validated);
        return back()->with('success', 'Table booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = TableBooking::findOrFail($id);
        $booking->delete();
        return back()->with('success', 'Table booking deleted successfully.');
    }
}