<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\DogBreedForm;
use App\Models\DogBreed;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class DogBreedEdit extends Component
{

    use WireUiActions;

    public DogBreed $breed;
    public DogBreedForm $form;

    public function mount(int $id): void
    {
        $this->breed = DogBreed::findOrFail($id);
        $this->form->name = $this->breed->name;
    }

    public function save(): void
    {
        $this->validate();

        $this->breed->update([
            'name' => $this->form->name
        ]);
        $this->dispatch('modal-close');
        $this->dispatch('refresh-on-action');
        $this->notification()->success('Breed updated successfully!');
    }

    public function render(): View
    {
        return view('livewire.modal.dog-breed-edit');
    }
}
