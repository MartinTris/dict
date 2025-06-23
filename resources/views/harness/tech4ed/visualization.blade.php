@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">TECH4ED Data Visualization</h1>
        
        <!-- Summary Cards Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Centers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tech4eds->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Operational Centers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tech4eds->where('operational', 'Yes')->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Centers with Donations</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tech4eds->where('with_donation', 'Yes')->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-gift fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Center Managers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tech4eds->whereNotNull('cm_sex')->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Charts Row -->
        <div class="row">
            <!-- Center Model Distribution (Left) -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: #003566;">Center Model Distribution</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area" style="height: 300px; position: relative;">
                            <canvas id="centerModelChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gender Distribution (Right) -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: #003566;">CM Gender Distribution</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2" style="height: 250px; position: relative;">
                            <canvas id="genderChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Male
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Female
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> N/A
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Secondary Charts Row -->
        <div class="row">
            <!-- Centers by Municipality (Left) -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: #003566;">Centers by Municipality</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area" style="height: 300px; position: relative;">
                            <canvas id="municipalityChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Operational Status (Right) -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: #003566;">Operational Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2" style="height: 250px; position: relative;">
                            <canvas id="operationalChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Operational
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-danger"></i> Non-Operational
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-secondary"></i> Not Specified
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Center Model Summary</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #003566; color: white;">
                            <tr>
                                <th style="min-width: 200px;">Center Model</th>
                                <th style="min-width: 100px;">Count</th>
                                <th style="min-width: 100px;">% of Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $centerModelCounts = [];
                                foreach($centerModels as $model) {
                                    $count = $tech4eds->where('center_model', $model)->count();
                                    $centerModelCounts[] = [
                                        'model' => $model,
                                        'count' => $count
                                    ];
                                }
                                $total = $tech4eds->count();
                            @endphp
                            
                            @foreach($centerModelCounts as $item)
                                <tr>
                                    <td>{{ $item['model'] }}</td>
                                    <td class="text-center">{{ $item['count'] }}</td>
                                    <td class="text-center">{{ round(($item['count'] / $total) * 100, 2) }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Timeline Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Centers Opening Timeline</h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="height: 300px; position: relative;">
                    <canvas id="timelineChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4 mb-5">
            <a href="{{ route('tech4ed') }}" class="btn" style="background-color: #003566; color: white;">
                <i class="fas fa-arrow-left"></i> Back to TECH4ED Records
            </a>
        </div>
    </div>
    
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Process data for charts
            const tech4edData = @json($tech4eds);
            
            // Center Model Chart
            var centerModelData = {};
            @foreach($centerModels as $model)
                centerModelData['{{ $model }}'] = {{ $tech4eds->where('center_model', $model)->count() }};
            @endforeach
            
            // Sort by count (descending) and limit to top 10
            const sortedModels = Object.entries(centerModelData)
                .sort((a, b) => b[1] - a[1])
                .slice(0, 10);
            
            const modelLabels = sortedModels.map(item => item[0]);
            const modelCounts = sortedModels.map(item => item[1]);
            
            var ctx = document.getElementById('centerModelChart').getContext('2d');
            var centerModelChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: modelLabels,
                    datasets: [{
                        label: 'Number of Centers',
                        data: modelCounts,
                        backgroundColor: [
                            'rgba(0, 53, 102, 0.8)',
                            'rgba(0, 87, 168, 0.8)'
                        ],
                        borderColor: [
                            'rgba(0, 53, 102, 1)',
                            'rgba(0, 87, 168, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            }
                        },
                        x: {
                            ticks: {
                                autoSkip: false,
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            
            // Gender Distribution Chart
            var genderData = [
                {{ $tech4eds->where('cm_sex', 'Male')->count() }},
                {{ $tech4eds->where('cm_sex', 'Female')->count() }},
                {{ $tech4eds->where('cm_sex', 'N/A')->count() }}
            ];
            
            var ctxPie = document.getElementById('genderChart').getContext('2d');
            var genderChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Male', 'Female', 'N/A'],
                    datasets: [{
                        data: genderData,
                        backgroundColor: [
                            'rgba(0, 53, 102, 0.8)',
                            'rgba(46, 204, 113, 0.8)',
                            'rgba(149, 165, 166, 0.8)'
                        ],
                        borderColor: [
                            'rgba(0, 53, 102, 1)',
                            'rgba(46, 204, 113, 1)',
                            'rgba(149, 165, 166, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== undefined) {
                                        const total = genderData.reduce((a, b) => a + b, 0);
                                        label += context.parsed + ' (' + 
                                            Math.round(context.parsed * 100 / total * 10) / 10 + '%)';
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
            
            // Municipality Chart
            var municipalityData = {};
            tech4edData.forEach(item => {
                if (!municipalityData[item.municipality]) {
                    municipalityData[item.municipality] = 0;
                }
                municipalityData[item.municipality]++;
            });
            
            const sortedMunicipalities = Object.entries(municipalityData)
                .sort((a, b) => b[1] - a[1])
                .slice(0, 10);
            
            const municipalityLabels = sortedMunicipalities.map(item => item[0]);
            const municipalityCounts = sortedMunicipalities.map(item => item[1]);
            
            var ctxMuni = document.getElementById('municipalityChart').getContext('2d');
            var municipalityChart = new Chart(ctxMuni, {
                type: 'bar',
                data: {
                    labels: municipalityLabels,
                    datasets: [{
                        label: 'Number of Centers',
                        data: municipalityCounts,
                        backgroundColor: 'rgba(0, 53, 102, 0.8)',
                        borderColor: 'rgba(0, 53, 102, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            }
                        },
                        x: {
                            ticks: {
                                autoSkip: false,
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            
            // Operational Status Chart
            var operationalData = [
                {{ $tech4eds->where('operational', 'Yes')->count() }},
                {{ $tech4eds->where('operational', 'No')->count() }},
                {{ $tech4eds->whereNotIn('operational', ['Yes', 'No'])->count() }}
            ];
            
            var ctxOp = document.getElementById('operationalChart').getContext('2d');
            var operationalChart = new Chart(ctxOp, {
                type: 'doughnut',
                data: {
                    labels: ['Operational', 'Non-Operational', 'Not Specified'],
                    datasets: [{
                        data: operationalData,
                        backgroundColor: [
                            'rgba(0, 53, 102, 0.8)',
                            'rgba(231, 76, 60, 0.8)',
                            'rgba(149, 165, 166, 0.8)'
                        ],
                        borderColor: [
                            'rgba(0, 53, 102, 1)',
                            'rgba(231, 76, 60, 1)',
                            'rgba(149, 165, 166, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== undefined) {
                                        const total = operationalData.reduce((a, b) => a + b, 0);
                                        label += context.parsed + ' (' + 
                                            Math.round(context.parsed * 100 / total * 10) / 10 + '%)';
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
            
            // Timeline Chart
            var timelineData = {};
            tech4edData.forEach(item => {
                const year = new Date(item.date_of_launching).getFullYear();
                if (!isNaN(year)) {
                    if (!timelineData[year]) {
                        timelineData[year] = 0;
                    }
                    timelineData[year]++;
                }
            });
            
            const years = Object.keys(timelineData).sort();
            const yearCounts = years.map(year => timelineData[year]);
            
            var ctxTimeline = document.getElementById('timelineChart').getContext('2d');
            var timelineChart = new Chart(ctxTimeline, {
                type: 'line',
                data: {
                    labels: years,
                    datasets: [{
                        label: 'Centers Opened',
                        data: yearCounts,
                        backgroundColor: 'rgba(0, 53, 102, 0.1)',
                        borderColor: 'rgba(0, 53, 102, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        },
                        x: {
                            ticks: {
                                autoSkip: true
                            }
                        }
                    }
                }
            });
        });
    </script>
    
    <style>
        /* Fix for chart containers */
        .chart-area, .chart-pie {
            position: relative;
            height: 100%;
            width: 100%;
        }
        
        /* Add some padding to table cells */
        .table td, .table th {
            padding: 0.75rem;
            vertical-align: middle;
        }
        
        /* Improve summary table */
        #dataTable {
            border-collapse: collapse;
            width: 100%;
        }
        
        #dataTable thead th {
            font-weight: bold;
            text-align: center;
        }
        
        /* Add hover effect to table rows */
        #dataTable tbody tr:hover {
            background-color: rgba(0, 53, 102, 0.05);
        }
        
        /* Ensure charts are responsive */
        @media (max-width: 768px) {
            .chart-area {
                min-height: 250px;
            }
        }
    </style>
@endsection