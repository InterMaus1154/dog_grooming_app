<?php

namespace App\Livewire\Breed;

use App\Models\Dog;
use App\Models\DogBreed;
use App\Traits\HasFilter;
use App\Traits\HasSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class BreedList extends Component
{
    use HasSort, WithPagination, HasFilter;

    // filters
    public string $breedName = '';


    public function mount(): void
    {
        $this->initSort('name', 'asc');
        $this->initFilters([], 'resetPage');
        $this->setResetPageMethod('resetPage');
    }

    public function customSorts(): array
    {
        return [
            'custom:dog-count' => function (Builder $builder) { // sort by dog count per pbreed
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

        $breeds = $this->applySort($query, $this->customSorts());
        return $this->applyFilters($breeds, $this->customFilters());
    }


    public function render(): View
    {
        return view('livewire.breed.breed-list', ['breeds' => $this->createQuery()->paginate(15)]);
    }
}
