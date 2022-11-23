<x-app-layout>
    <div class="bg-white rounded-md border my-8 px-6 py-6 mx-40">
        <div>
            <h2 class="text-2xl font-semibold">Charts</h2>
            <div class="my-6">
                <div>Last year chart: {{ array_sum($lastYearChart)  }} sales</div>
                <div>This year chart: {{ array_sum($thisYearChart)  }} sales</div>
            </div>
            <div  class="mt-4">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Last year chart',
                        data: {{ \Illuminate\Support\Js::from($lastYearChart) }},
                        borderWidth: 1
                    },
                        {
                            label: 'This year chart',
                            data: {{ \Illuminate\Support\Js::from($thisYearChart) }},
                            borderWidth: 1
                        }]
                }
                // options: {
                //     scales: {
                //         y: {
                //             beginAtZero: true
                //         }
                //     }
                // }
            });
        </script>
    @endpush
</x-app-layout>
