<?php

namespace App\Livewire\Log;

use App\Traits\HasSort;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class LogList extends Component
{
    use HasSort, WithPagination;

    public function mount(): void
    {
        $this->initSort('id', 'desc');
    }

    public function render()
    {
        $query = Activity::query();

        $query = $this->applySort($query);

        return view('livewire.log.log-list', [
            'logs' => $query->paginate(15)
        ]);
    }
}
