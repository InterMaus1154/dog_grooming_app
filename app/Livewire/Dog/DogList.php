<?php

namespace App\Livewire\Dog;

use App\Models\Dog;
use App\Traits\HasFilter;
use App\Traits\HasSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class DogList extends Component
{
    use WireUiActions, HasSort, HasFilter, WithPagination;

    public function mount(): void
    {
        $this->initSort('name');
    }


    public function customSorts(): array
    {
        return [];
    }

    public function customFilters(): array
    {
        return [];
    }

    public function createQuery(): Builder
    {
        $query = Dog::query()->with('customer', 'dogBreed', 'latestBooking')->withCount('bookings');
        $query = $this->applyFilters($query, $this->customFilters());
        $query = $this->applySort($query, $this->customSorts());
        return $query;

    }

    public function deleteDog(Dog $dog): void
    {
        $dog->loadCount('bookings');
        if ($dog->bookings_count > 0) {
            $this->dispatch('modal-open', 'modal.alert', [
                'title' => 'Cannot proceed',
                'message' => 'This dog has bookings, so cannot be deleted'
            ]);
            return;
        }

        $this->dispatch('modal-open', 'modal.confirm', [
                'message' => sprintf("This will delete dog '%s'", $dog->name),
                'event' => 'dog-delete',
                'eventData' => [$dog]
            ]
        );
    }

    #[On('dog-delete')]
    public function deleteDogEventReceive(Dog $dog): void
    {
        $dog->delete();
        $this->notification()->success('Dog has been successfully deleted');
    }

    #[On('refresh-dogs')]
    public function refreshOnAction(): void
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.dog.dog-list', [
            'dogs' => $this->createQuery()->paginate(15)
        ]);
    }
}
