<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class GlobalSearch extends Component
{
    public string $search = '';
    public array $results = [];

     public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->results = [];
            return;
        }

        $this->results = app(\App\Services\GlobalSearchService::class)
            ->search($this->search);
    }

    public function render()
    {
        return view('livewire.utils.global-search');
    }
}
