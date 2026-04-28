<?php

namespace App\Livewire\Breed;

use App\Models\Dog;
use App\Models\DogBreed;
use App\Traits\HasSort;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class BreedList extends Component
{
    use HasSort, WithPagination;

    public function mount(): void
    {
        $this->initSort('name', 'asc');
    }


    public function customSorts(): array
    {
        return [
            'custom:dog-count' => function (Builder $builder) {
                return $builder->orderBy(Dog::selectRaw('count(*)')->whereColumn('dogs.dog_breed_id', 'dog_breeds.id'), $this->sortDirection);
            }
        ];
    }

    public function render()
    {
        $query = DogBreed::query()->withCount('dogs');

        $breeds = $this->applySort($query, $this->customSorts())->paginate(15);

        return view('livewire.breed.breed-list', compact('breeds'));
    }
}
