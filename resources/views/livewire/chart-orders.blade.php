<div
    wire:ignore
    class="mt-4"
    x-data="{
         selectedYear: @entangle('selectedYear'),
         lastYearCharts: @entangle('lastYearCharts'),
         thisYearCharts: @entangle('thisYearCharts'),
         init() {
             const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
             const data = {
                 labels: labels,
                 datasets: [{
                     label: `${this.selectedYear - 1} Chart`,
                     backgroundColor: 'lightgray',
                     data: this.lastYearCharts,
                 }, {
                     label: `${this.selectedYear} Chart`,
                     backgroundColor: 'lightgreen',
                     data: this.thisYearCharts,
                 }]
             };
             const config = {
                 type: 'bar',
                 data: data,
                 options: {}
             };
             const myChart = new Chart(
                 this.$refs.canvas,
                 config
             );
             Livewire.on('updateTheChart', () => {
                 myChart.data.datasets[0].label = `${this.selectedYear - 1} Charts`;
                 myChart.data.datasets[1].label = `${this.selectedYear} Charts`;
                 myChart.data.datasets[0].data = this.lastYearCharts;
                 myChart.data.datasets[1].data = this.thisYearCharts;
                 myChart.update();
             })
         }
     }">
    <span>Year:</span>
    <select name="selectedYear" id="selectedYear" class="border" wire:model="selectedYear" wire:change="updateChartsCount">

        @foreach($availableYears as $year)
            <option value="{{ $year }}">{{ $year }}</option>
        @endforeach

    </select>
    <div>
        Selected: <span x-text="selectedYear"></span>
    </div>
    <div class="my-6">
        <div>
            <span x-text="selectedYear - 1"></span> chart:
            <span x-text="lastYearCharts.reduce((a, b) => a + b)"></span>
        </div>
        <div><span x-text="selectedYear"></span> chart:
            <span x-text="thisYearCharts.reduce((a, b) => a + b)"></span>
        </div>
    </div>
    <canvas id="myChart" x-ref="canvas"></canvas>
</div>
