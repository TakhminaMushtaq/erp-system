<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mt-4">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-header">Total Sales</div>
                                    <div class="card-body">
                                        <h5 class="card-title">₹ {{ number_format($totalSales, 2) }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-header">Total Orders</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalOrders }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-header">Low Stock Alerts</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $lowStockProducts->count() }} Products</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($lowStockProducts->count())
                        <div class="card">
                            <div class="card-header">Low Stock Products</div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>SKU</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lowStockProducts as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td class="text-danger fw-bold">{{ $product->quantity }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Daily Sales</h5>
                                <canvas id="dailySalesChart"></canvas>
                            </div>
                            <div class="col-md-6">
                                <h5>Weekly Sales</h5>
                                <canvas id="weeklySalesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
    const dailySalesLabels = @json($dailySales->pluck('date'));
    const dailySalesData = @json($dailySales->pluck('total'));

    new Chart(document.getElementById('dailySalesChart'), {
        type: 'bar',
        data: {
            labels: dailySalesLabels,
            datasets: [{
                label: 'Daily Sales (₹)',
                data: dailySalesData,
                backgroundColor: '#4e73df'
            }]
        }
    });

    const weeklySalesLabels = @json(
        $weeklySales->pluck('week')->map(fn($w) => 'Week ' . $w)
    );
    const weeklySalesData = @json($weeklySales->pluck('total'));

    new Chart(document.getElementById('weeklySalesChart'), {
        type: 'line',
        data: {
            labels: weeklySalesLabels,
            datasets: [{
                label: 'Weekly Sales (₹)',
                data: weeklySalesData,
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28, 200, 138, 0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });
</script>

    @endpush
</x-app-layout>
