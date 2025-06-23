@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Cybersecurity Data Visualization</h1>
        
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Activities</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cybersecurityRecords->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                                    Total Male Participants</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cybersecurityRecords->sum('male_participants') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-male fa-2x text-gray-300"></i>
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
                                    Total Female Participants</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cybersecurityRecords->sum('female_participants') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-female fa-2x text-gray-300"></i>
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
                                    Total Participants</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cybersecurityRecords->sum('male_participants') + $cybersecurityRecords->sum('female_participants') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
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
                        <h6 class="m-0 font-weight-bold" style="color: #003566;">Activities by Type</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area" style="height: 300px; position: relative;">
                            <canvas id="activitiesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: #003566;">Gender Distribution</h6>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Activities Summary</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #003566; color: white;">
                            <tr>
                                <th style="min-width: 200px;">Type of Activity</th>
                                <th style="min-width: 100px;">Count</th>
                                <th style="min-width: 100px;">% of Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $typeActivities = $cybersecurityRecords->groupBy('type_of_activity')
                                    ->map(function($items, $key) {
                                        return [
                                            'type_of_activity' => $key,
                                            'count' => $items->count()
                                        ];
                                    })->values();
                            @endphp
                            
                            @foreach($typeActivities as $activity)
                                <tr>
                                    <td>{{ $activity['type_of_activity'] }}</td>
                                    <td class="text-center">{{ $activity['count'] }}</td>
                                    <td class="text-center">{{ round(($activity['count'] / $cybersecurityRecords->count()) * 100, 2) }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4 mb-5">
            <a href="{{ route('cybersecurity') }}" class="btn" style="background-color: #003566; color: white;">
                <i class="fas fa-arrow-left"></i> Back to Cybersecurity Records
            </a>
        </div>
    </div>
    
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Process data for charts
            const cybersecurityData = @json($cybersecurityRecords);
            
            // Group by type of activity
            const activityTypes = {};
            cybersecurityData.forEach(item => {
                if (!activityTypes[item.type_of_activity]) {
                    activityTypes[item.type_of_activity] = 0;
                }
                activityTypes[item.type_of_activity]++;
            });
            
            const activityLabels = Object.keys(activityTypes);
            const activityCounts = Object.values(activityTypes);
            
            // Calculate gender totals
            let totalMale = 0;
            let totalFemale = 0;
            cybersecurityData.forEach(item => {
                totalMale += parseInt(item.male_participants);
                totalFemale += parseInt(item.female_participants);
            });
            
            // Chart for Activities by Type
            var ctx = document.getElementById('activitiesChart').getContext('2d');
            var activitiesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: activityLabels,
                    datasets: [{
                        label: 'Number of Activities',
                        data: activityCounts,
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
            
            // Chart for Gender Distribution
            var genderData = [totalMale, totalFemale];
            var ctxPie = document.getElementById('genderChart').getContext('2d');
            var genderChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        data: genderData,
                        backgroundColor: [
                            'rgba(0, 53, 102, 0.8)',
                            'rgba(0, 119, 230, 0.8)'
                        ],
                        borderColor: [
                            'rgba(0, 53, 102, 1)',
                            'rgba(0, 119, 230, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== undefined) {
                                        label += context.parsed + ' (' + 
                                            Math.round(context.parsed * 100 / (totalMale + totalFemale) * 10) / 10 + '%)';
                                    }
                                    return label;
                                }
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