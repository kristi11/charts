<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Livewire\Component;

class ChartOrders extends Component
{
    public $selectedYear;
    public $thisYearCharts;
    public $lastYearCharts;

    public function mount()
    {
        $this->selectedYear = date('Y');
        $this->updateChartsCount();
    }

    public function updateChartsCount() {
        $this->lastYearCharts = Chart::getYearOrders($this->selectedYear -1)->groupByMonth();
        $this->thisYearCharts = Chart::getYearOrders($this->selectedYear)->groupByMonth();

        $this->emit('updateTheChart');
    }

    public function render()
    {
        $availableYears = [
            date('Y'),date('Y')-1,date('Y')-2,date('Y')-3,
        ];
        return view('livewire.chart-orders', [
            'availableYears' => $availableYears
        ]);
    }
}
