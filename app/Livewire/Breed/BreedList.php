<?php

namespace App\Livewire\Breed;

use App\Livewire\Modal\ModalContainer;
use App\Models\Dog;
use App\Models\DogBreed;
use App\Traits\HasFilter;
use App\Traits\HasSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class BreedList extends Component
{
    use HasSort, WithPagination, HasFilter, WireUiActions;


    public function mount(): void
    {
        if (empty($this->sortField)) {
            $this->initSort('name', 'asc');
        }
        $this->setSortResetPageMethod('resetPage');
        $this->setFilterResetPageMethod('resetPage');
    }

    public function deleteBreed(DogBreed $breed): void
    {
        $this->dispatch('modal-open', 'modal.confirm', [
                'message' => sprintf("This will delete breed '%s'", $breed->name),
                'event' => 'breed-delete',
                'eventData' => [$breed]
            ]
        )->to(ModalContainer::class);
    }

    #[On('breed-delete')]
    public function deleteBreedEventReceiver(DogBreed $breed): void
    {
        // restrict deletion if breed has dogs
        if ($breed->dogs()->count() > 0) {
            $this->dispatch('modal-open', 'modal.alert', [
                'title' => 'Cannot process',
                'message' => 'This breed has dogs, so cannot be deleted!'
            ])->to(ModalContainer::class);
        } else {
            $this->notification()->success('Success!', sprintf('%s breed has been deleted', $breed->name));
            $breed->delete();
            $this->dispatch('$refresh');
        }
    }

    public function customSorts(): array
    {
        return [
            'custom:dog-count' => function (Builder $builder) { // sort by dog count per breed
                return $builder->orderBy(Dog::selectRaw('count(*)')->whereColumn('dogs.dog_breed_id', 'dog_breeds.id'), $this->sortDirection);
            }
        ];
    }

    public function customFilters(): array
    {
        return [
            'name' => fn(Builder $builder, $value) => $builder->where('name', 'like', sprintf('%%%s%%', $value))
        ];
    }

    /**
     * @return Builder<DogBreed>
     */
    public function createQuery(): Builder
    {
        $query = DogBreed::query()
            ->withCount('dogs');

        $query = $this->applyFilters($query, $this->customFilters());
        return $this->applySort($query, $this->customSorts());
    }

    #[On('refresh-breeds')]
    public function refreshOnAction(): void
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.breed.breed-list', ['breeds' => $this->createQuery()->paginate(15)]);
    }
}
