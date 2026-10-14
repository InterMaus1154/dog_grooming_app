<?php

namespace App\Livewire\Booking;

use App\Enums\LivewireEvent;
use App\Models\Booking;
use App\Traits\HasFilter;
use App\Traits\HasSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class BookingList extends Component
{
    use HasSort, HasFilter, WithPagination, WireUiActions;

    public function mount(): void
    {
        $this->initSort('id', 'asc', 'resetPage');
    }

    public function deleteBooking(Booking $booking): void
    {
        $booking->loadMissing('dog');
        $this->dispatch(LivewireEvent::MODAL_OPEN->value, 'modal.confirm', [
            'message' => sprintf('This will delete booking for %s on %s', $booking->getTitle(), $booking->scheduled_at->format('H:i, l d/m/y')),
            'event' => LivewireEvent::DELETE_BOOKING_ON_LIST->value,
            'eventData' => [$booking->id]
        ]);
    }

    #[On(LivewireEvent::DELETE_BOOKING_ON_LIST->value)]
    public function deleteBookingEventReceiver(int $id): void
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        $this->notification()->success('Booking has been deleted');
        $this->dispatch(LivewireEvent::MODAL_CLOSE->value);
        $this->dispatch(LivewireEvent::REFRESH_BOOKINGS->value);
    }

    public function customSorts(): array
    {
        return [

        ];
    }

    public function customFilters(): array
    {
        return [
            'search' => function (Builder $builder, $value) {
                return $builder->whereHas('customer', fn($q) => $q
                    ->where('customers.name', 'like', sprintf('%%%s%%', $value))
                    ->orWhere('customers.phone_number', 'like', sprintf('%%%s%%', $value)))
                    ->orWhereHas('dog', fn($q) => $q->where('dogs.name', 'like', sprintf('%%%s%%', $value)));
            },
            'dateFrom' => function(Builder $builder, $value){
                return $builder->whereDate('bookings.scheduled_at', '>=', $value);
            },
            'dateTo' => function(Builder $builder, $value){
                return $builder->whereDate('bookings.scheduled_at', '<=', $value);
            }
        ];
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


    #[On(LivewireEvent::REFRESH_DOGS->value)]
    #[On(LivewireEvent::REFRESH_BOOKINGS->value)]
    public function refreshReceiver(): void
    {

    }

    public function render(): View
    {
        return view('livewire.booking.booking-list', [
            'bookings' => $this->customQuery()->paginate(15)
        ]);
    }
}
