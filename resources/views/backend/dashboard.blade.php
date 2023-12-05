@extends('backend.index')
@section('content')
    {{-- kurang ini alertnya --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errors')->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-4">Total Revenues</h5>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-4 text-muted">Today</h6>
                                    <h4 class="mb-0">@rupiah($dailyRevenues)</h4>
                                </div>
                            </div>
                            <canvas id="sales-chart-a" class="mt-auto" height="65"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-4 text-muted">All Time</h6>
                                    <h4 class="mb-0">@rupiah($allTimeRevenues)</h4>
                                </div>
                            </div>
                            <canvas id="sales-chart-a" class="mt-auto" height="65"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-4">Total Books Sold</h5>
            <div class="row h-100">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-4 text-muted">Today</h6>
                                    <h4 class="mb-0">{{ $dailyProducts }} books</h4>
                                </div>
                            </div>
                            <canvas id="sales-chart-a" class="mt-auto" height="65"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-4 text-muted">All Time</h6>
                                    <h4 class="mb-0">{{ $allTimeProducts }} books</h4>
                                </div>
                            </div>
                            <canvas id="sales-chart-a" class="mt-auto" height="65"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="chart" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="chart2" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var data = @json($groupedDaily);
        var data2 = @json($topFiveProducts);
        // console.log(data);
        var label1 = [];
        var value1 = [];

        var label2 = [];
        var value2 = [];

        data.forEach(element => {
            label1.push(element.day);
            value1.push(element.total);
        });

        data2.forEach(element => {
            label2.push(element.judul);
            value2.push(element.jumlah_buku);
        });
        // console.log(value2);
        var options1 = {
            series: [{
                name: "Total Revenues",
                data: value1
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Daily Revenues',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: label1,
            }
        };
        var options2 = {
            series: [{
                name: "Books Sold",
                data: value2
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            title: {
                text: 'Top 5 Total Books Sold',
                align: 'left'
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: label2,
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options1);
        chart.render();

        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();
    </script>
@endsection
