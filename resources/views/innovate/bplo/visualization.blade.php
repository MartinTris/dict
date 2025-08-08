@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">BPLO Data Visualization</h1>
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('bplo') }}" class="btn btn-sm btn-secondary" style="background-color:#6a84a0; border:none">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Records</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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
                                    Operational</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statusCounts->where('bpco_status', 'OPERATIONAL')->first()->count ?? 0 }}</div>
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
                                    Under Development</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statusCounts->where('bpco_status', 'ON GOING DATA BUILD UP')->first()->count ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tools fa-2x text-gray-300"></i>
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
                                    Pending Status</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statusCounts->where('bpco_status', 'PENDING')->first()->count ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: #003566;">BPCO Status Distribution</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area" style="height: 300px; position: relative;">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: #003566;">Income Class Distribution</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2" style="height: 250px; position: relative;">
                            <canvas id="incomeClassChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> City
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> 1st Class
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Other Classes
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: #003566;">Congressional District Distribution</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar" style="height: 300px; position: relative;">
                            <canvas id="districtChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">BPCO Status Summary</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #003566; color: white;">
                            <tr>
                                <th style="min-width: 200px;">BPCO Status</th>
                                <th style="min-width: 100px;">Count</th>
                                <th style="min-width: 100px;">% of Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statusCounts as $status)
                                <tr>
                                    <td>{{ $status->bpco_status }}</td>
                                    <td class="text-center">{{ $status->count }}</td>
                                    <td class="text-center">{{ round(($status->count / $total) * 100, 2) }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
    </div>
    
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Process data for charts
            const statusData = @json($statusCounts);
            const districtData = @json($districtCounts);
            const incomeClassData = @json($incomeCounts);
            
            // Extract labels and values for status chart
            const statusLabels = statusData.map(item => item.bpco_status);
            const statusValues = statusData.map(item => item.count);
            
            // Extract labels and values for district chart
            const districtLabels = districtData.map(item => item.congressional_district);
            const districtValues = districtData.map(item => item.count);
            
            // Extract labels and values for income class chart
            const incomeLabels = incomeClassData.map(item => item.income_class);
            const incomeValues = incomeClassData.map(item => item.count);
            
            // Chart for BPCO Status
            var ctxStatus = document.getElementById('statusChart').getContext('2d');
            var statusChart = new Chart(ctxStatus, {
                type: 'bar',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        label: 'Number of Records',
                        data: statusValues,
                        backgroundColor: [
                            'rgba(0, 53, 102, 0.8)',
                            'rgba(0, 87, 168, 0.8)',
                            'rgba(0, 119, 230, 0.8)',
                            'rgba(51, 153, 255, 0.8)',
                            'rgba(102, 178, 255, 0.8)'
                        ],
                        borderColor: [
                            'rgba(0, 53, 102, 1)',
                            'rgba(0, 87, 168, 1)',
                            'rgba(0, 119, 230, 1)',
                            'rgba(51, 153, 255, 1)',
                            'rgba(102, 178, 255, 1)'
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
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 0,
                            bottom: 20
                        }
                    }
                }
            });
            
            // Chart for Income Class distribution
            var ctxIncome = document.getElementById('incomeClassChart').getContext('2d');
            var incomeChart = new Chart(ctxIncome, {
                type: 'pie',
                data: {
                    labels: incomeLabels,
                    datasets: [{
                        data: incomeValues,
                        backgroundColor: [
                            'rgba(0, 53, 102, 0.8)',
                            'rgba(0, 119, 230, 0.8)',
                            'rgba(51, 153, 255, 0.8)',
                            'rgba(102, 178, 255, 0.8)',
                            'rgba(153, 204, 255, 0.8)'
                        ],
                        borderColor: [
                            'rgba(0, 53, 102, 1)',
                            'rgba(0, 119, 230, 1)',
                            'rgba(51, 153, 255, 1)',
                            'rgba(102, 178, 255, 1)',
                            'rgba(153, 204, 255, 1)'
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
                                        const total = incomeValues.reduce((a, b) => a + b, 0);
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
            
            // Chart for Congressional District
            var ctxDistrict = document.getElementById('districtChart').getContext('2d');
            var districtChart = new Chart(ctxDistrict, {
                type: 'bar',
                data: {
                    labels: districtLabels,
                    datasets: [{
                        label: 'Number of Records',
                        data: districtValues,
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
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 0,
                            bottom: 20
                        }
                    }
                }
            });
        });
    </script>
    
    <style>
        /* Fix for chart containers */
        .chart-area, .chart-pie, .chart-bar {
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
            .chart-area, .chart-bar {
                min-height: 250px;
            }
        }
    </style>
@endsection