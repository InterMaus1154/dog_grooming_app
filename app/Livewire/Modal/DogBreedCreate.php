<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\DogBreedForm;
use App\Models\DogBreed;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class DogBreedCreate extends Component
{

    use WireUiActions;

    public DogBreedForm $form;

    public function save(): void
    {
        $this->validate();

        try{
            $breed = DogBreed::create([
                'name' => $this->form->name
            ]);
            $this->notification()->success('New breed successfully created!');
        }catch (\Exception $e){
            $this->notification()->error('There was an error creating the breed!', 'Contact your administrator (your son)');
            Log::error("Error at saving a dog breed record");
            Log::error($e->getMessage());
        }

        $this->dispatch('modal-clear');
        $this->dispatch('refresh-breeds');

    }

    public function render(): View
    {
        return view('livewire.modal.dog-breed-create');
    }
}
