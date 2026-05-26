<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionBooking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SessionBookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'age' => ['required', 'integer', 'min:5', 'max:120'],
            'gender' => ['required', 'string', 'max:50'],
            'service' => ['required', 'string', 'max:255'],
            'session_mode' => ['required', 'string', 'max:100'],
            'preferred_date' => ['required', 'date', 'after_or_equal:today'],
            'preferred_time' => ['required', 'string', 'max:50'],
            'alternate_date' => ['nullable', 'date', 'after_or_equal:today'],
            'alternate_time' => ['nullable', 'string', 'max:50'],
            'previous_therapy' => ['required', Rule::in(['Yes', 'No'])],
            'concerns' => ['required', 'string', 'max:5000'],
            'additional_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $booking = SessionBooking::create($validated + [
            'user_id' => optional($request->user())->id,
        ]);

        return response()->json([
            'message' => 'Your booking request has been submitted.',
            'booking_id' => $booking->id,
        ], 201);
    }
}
