<?php

namespace App\Livewire\Booking;

use App\Models\Booking;
use App\Traits\HasFilter;
use App\Traits\HasSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class BookingList extends Component
{
    use HasSort, HasFilter, WithPagination;

    public function mount(): void
    {
        $this->initSort('id', 'asc', 'resetPage');
    }

    public function customSorts(): array
    {
        return [

        ];
    }

    public function customFilters(): array
    {
        return [];
    }

    /**
     * @return Builder<Booking>
     */
    public function customQuery(): Builder
    {
        $query = Booking::query()->with(['dog', 'customer', 'dog.dogBreed']);
        $query = $this->applyFilters($query, $this->customFilters());
        $query = $this->applySort($query, $this->customSorts());
        return $query;
    }

    public function render(): View
    {
        return view('livewire.booking.booking-list', [
            'bookings' => $this->customQuery()->paginate(15)
        ]);
    }
}
