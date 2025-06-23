@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="font-weight-bold">IBPLS Data Visualization</h2>
        <a href="{{ route('ibpls') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Records
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header" style="background-color: #003566; color: white;">
                    <h6 class="m-0 font-weight-bold">Operations Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:300px;">
                        <canvas id="operationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header" style="background-color: #003566; color: white;">
                    <h6 class="m-0 font-weight-bold">Status Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:300px;">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header" style="background-color: #003566; color: white;">
                    <h6 class="m-0 font-weight-bold">IBPLS Statistics (Bar Chart)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:300px;">
                        <canvas id="statsBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header" style="background-color: #003566; color: white;">
                    <h6 class="m-0 font-weight-bold">IBPLS Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #e9ecef;">
                                <tr>
                                    <th>Category</th>
                                    <th>Count</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalRecords = $operationStats->sum('count') > 0 ? $operationStats->sum('count') : 1;
                                @endphp
                                @foreach($operationStats as $stat)
                                <tr>
                                    <td>{{ $stat->operation }}</td>
                                    <td>{{ $stat->count }}</td>
                                    <td>{{ number_format(($stat->count / $totalRecords) * 100, 2) }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Direct script inclusion -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
window.onload = function() {
    // Define a color palette similar to your other pages
    const colorPalette = [
        'rgba(0, 53, 102, 0.7)',
        'rgba(33, 150, 243, 0.7)',
        'rgba(0, 119, 182, 0.7)',
        'rgba(17, 138, 178, 0.7)',
        'rgba(144, 224, 239, 0.7)',
        'rgba(33, 158, 188, 0.7)'
    ];
    
    const borderColors = [
        'rgb(0, 53, 102)',
        'rgb(33, 150, 243)',
        'rgb(0, 119, 182)',
        'rgb(17, 138, 178)',
        'rgb(144, 224, 239)',
        'rgb(33, 158, 188)'
    ];
    
    // Get data from PHP
    const operationData = {!! json_encode($operationStats) !!};
    const statusData = {!! json_encode($statusStats) !!};
    
    // Format data for charts
    const operationLabels = operationData.map(item => item.operation);
    const operationCounts = operationData.map(item => item.count);
    
    const statusLabels = statusData.map(item => item.status || 'Unspecified');
    const statusCounts = statusData.map(item => item.count);
    
    // Operations Pie Chart
    const operationsCtx = document.getElementById('operationsChart').getContext('2d');
    const operationsChart = new Chart(operationsCtx, {
        type: 'pie',
        data: {
            labels: operationLabels,
            datasets: [{
                data: operationCounts,
                backgroundColor: colorPalette.slice(0, operationLabels.length),
                borderColor: borderColors.slice(0, operationLabels.length),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed + ' records';
                        }
                    }
                }
            }
        }
    });
    
    // Status Bar Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'Number of Records',
                data: statusCounts,
                backgroundColor: colorPalette.slice(0, statusLabels.length),
                borderColor: borderColors.slice(0, statusLabels.length),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Status'
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
    
    // Operations Bar Chart
    const statsBarCtx = document.getElementById('statsBarChart').getContext('2d');
    const statsBarChart = new Chart(statsBarCtx, {
        type: 'bar',
        data: {
            labels: operationLabels,
            datasets: [{
                label: 'Number of Records',
                data: operationCounts,
                backgroundColor: colorPalette.slice(0, operationLabels.length),
                borderColor: borderColors.slice(0, operationLabels.length),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Operation Type'
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
};
</script>
@endsection