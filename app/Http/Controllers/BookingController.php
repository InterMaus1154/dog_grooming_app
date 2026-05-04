<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function calendar(): array
    {
        return Booking::query()
            ->with('dog', 'dog.dogBreed')
            ->get()
            ->map(function (Booking $booking) {
                return [
                    'id' => $booking->id,
                    'title' => sprintf('%s (%s)', $booking->dog->name, $booking->dog->dogBreed->name),
                    'start' => $booking->scheduled_at->format('Y-m-d H:i:s'),
                    'end' => $booking->ends_at?->format('Y-m-d H:i:s'),
                    'color' => $booking->status->getCSSColor(),
                    'textColor' => '#ffffff'
                ];
            })
            ->toArray();
    }
}
