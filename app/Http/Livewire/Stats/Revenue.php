<?php

namespace App\Http\Livewire\Stats;

use App\Models\Chart;
use Livewire\Component;
use NumberFormatter;

class Revenue extends Component
{
    public $selectedDays;
    public $revenue;

    public function mount()
    {
        $this->selectedDays = 30;
        $this->updateStat();
    }

    public function updateStat()
    {
        $this->revenue = Chart::where('created_at', '>=', now()->subDays($this->selectedDays))->sum('total');
    }

    public function render()
    {
        return view('livewire.stats.revenue');
    }
}
