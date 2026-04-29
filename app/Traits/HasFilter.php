<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;

trait HasFilter
{
    #[Url]
    public array $filters = [];
    public ?string $resetPageMethod = null;

    public function initFilters(array $defaultFilters = [], ?string $resetPageMethod = null): void
    {
        $this->filters = $defaultFilters;
        $this->resetPageMethod = $resetPageMethod;
    }

    /**
     * Sets a simple field to filter
     * Example usage: name, Akita, will filter for where(name, Akita)
     * Ignores empty or null values
     * @param string $key
     * @param $value
     * @return void
     */
    public function setFilter(string $key, $value): void
    {

        if (is_null($value) || $value === '') {
            unset($this->filters[$key]);
        } else {
            $this->filters[$key] = $value;
        }

        if (isset($this->resetPageMethod) && method_exists($this, $this->resetPageMethod)) {
            $this->{$this->resetPageMethod}();
        }

    }

    public function applyFilters(Builder $builder, array $customFilters = []): Builder
    {
        foreach ($this->filters as $key => $value) {
            if (isset($customFilters[$key])) { // prioritise custom filter over simple where statements
                $customFilters[$key]($builder, $value);

            } else {
                $builder->where($key, $value);
            }
        }
        return $builder;
    }

    public function clearFilters(): void
    {
        $this->filters = [];

        if (isset($this->resetPageMethod) && method_exists($this, $this->resetPageMethod)) {
            $this->{$this->resetPageMethod}();
        }
    }

    public function setFilterResetPageMethod(string $method): void
    {
        $this->resetPageMethod = $method;
    }

    public function hasActiveFilters(): bool
    {
        return !empty($this->filters);
    }

}
