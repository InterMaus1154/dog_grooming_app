<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function calendar(): array
    {
        return Booking::query()
            ->with('dog')
            ->get()
            ->map(function (Booking $booking) {
                return [
                    'id' => $booking->id,
                    'title' => $booking->dog->name,
                    'start' => $booking->scheduled_at->format('Y-m-d H:i:s'),
                    'end' => $booking->ends_at?->format('Y-m-d H:i:s')
                ];
            })
            ->toArray();
    }
}
