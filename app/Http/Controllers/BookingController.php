<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{

    public function index(): View
    {
        return view('bookings.index');
    }

    /** Helper route for JS calendar
     * @return array
     */
    public function calendar(): array
    {
        return Booking::query()
            ->with('dog', 'dog.dogBreed')
            ->get()
            ->map(function (Booking $booking) {
                $dog = $booking->getDog();
                $title = $dog
                    ? sprintf('%s (%s)', $dog->getName(), $dog->hasBreed() ? $dog->dogBreed->name : $dog->breedFallback())
                    : $booking->getTitle();

                return [
                    'id' => $booking->id,
                    'title' => $title,
                    'start' => $booking->scheduled_at->format('Y-m-d H:i:s'),
                    'end' => $booking->ends_at?->format('Y-m-d H:i:s'),
                    'color' => $booking->status->getCSSColor(),
                    'textColor' => '#ffffff'
                ];
            })
            ->toArray();
    }
}
