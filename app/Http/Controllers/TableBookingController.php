<?php

namespace App\Http\Controllers;

use Mail;
use Carbon\Carbon;
use App\Models\TableBooking;
use Illuminate\Http\Request;
use App\Mail\BookingNotification;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BookTableRequest;
use App\Mail\CustomerBookingConfirmation;

class TableBookingController extends Controller
{
    public function bookTable(BookTableRequest  $request)
    {
        $validated = $request->validated();

        $validated['date'] = Carbon::createFromFormat('m/d/Y', $validated['date'])->format('Y-m-d');

        $booking = TableBooking::create($validated);

        try {
            Mail::to(config('site.email'))->send(new BookingNotification($booking));
        
            Mail::to($booking->email)->send(new CustomerBookingConfirmation($booking));
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Your table booking has been made. We will contact you if any changes are required.');
    }
}
