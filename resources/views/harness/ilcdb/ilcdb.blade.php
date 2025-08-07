@extends('layouts.app')

@section('title', 'ILCDB - Offered Courses')

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<style>
    /* Custom styles */
    .courses-table {
        font-size: 0.9rem;
        line-height: 1.5;
    }
    
    .courses-table thead th {
        background: linear-gradient(135deg, #4159a2 0%, #0a2474 100%);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    
    .courses-table tbody tr {
        transition: all 0.2s ease-in-out;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .courses-table tbody tr:hover {
        background-color: #f8f9fc;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .courses-table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: top;
        border: none;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .course-title {
        font-weight: 700;
        color: #114474;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }
    
    .course-description {
        color: #5a5c69;
        line-height: 1.6;
        text-align: justify;
    }
    
    .module-list {
        margin: 0;
        padding: 0;
    }
    
    .module-list li {
        margin-bottom: 0.5rem;
        padding-left: 0;
        position: relative;
        line-height: 1.4;
    }
    
    .module-list li strong {
        color: #0b3c6a;
        font-weight: 600;
    }
    
    .duration-info {
        text-align: center;
    }
    
    .duration-days {
        font-weight: 700;
        color: #003566;
        font-size: 1.1rem;
        display: block;
        margin-bottom: 0.25rem;
    }
    
    .duration-session {
        color: #858796;
        font-size: 0.8rem;
    }
    
    .participants-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    
    .participants-list li {
        margin-bottom: 0.25rem;
        padding: 0.25rem 0;
        border-bottom: 1px solid #f8f9fc;
        line-height: 1.4;
    }
    
    .participants-list li:last-child {
        border-bottom: none;
    }
    
    .remarks-cell {
        color: #858796;
        font-style: italic;
        font-size: 0.85rem;
    }
    
    /* Responsive design improvements */
    @media (max-width: 1200px) {
        .courses-table {
            font-size: 0.85rem;
        }
        
        .course-title {
            font-size: 0.95rem;
        }
    }
    
    @media (max-width: 992px) {
        .courses-table thead th,
        .courses-table tbody td {
            padding: 0.75rem 0.5rem;
        }
        
        .course-title {
            font-size: 0.9rem;
        }
        
        .duration-days {
            font-size: 1rem;
        }
    }
    
    @media (max-width: 768px) {
        .courses-table {
            font-size: 0.8rem;
        }
        
        .course-title {
            font-size: 0.85rem;
        }
        
        .module-list li {
            margin-bottom: 0.4rem;
        }
        
        .participants-list li {
            margin-bottom: 0.2rem;
        }
    }
    
    /* DataTables customization */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        color: #5a5c69;
        font-size: 0.9rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 0.35rem;
        border: 1px solid #d1d3e2;
        padding: 0.375rem 0.75rem;
        margin: 0 0.125rem;
        color: #5a5c69 !important;
        background: white;
        transition: all 0.15s ease-in-out;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #eaecf4;
        border-color: #bac8f3;
        color: #003566 !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4e73df;
        border-color: #4e73df;
        color: white !important;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #bac8f3;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        outline: 0;
    }
    
    /* Card improvements */
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border-radius: 0.75rem;
    }
    
    .card-header {
        background: #003566;
        color: white;
        border: none;
        border-radius: 0.75rem 0.75rem 0 0;
        padding: 1.25rem 1.5rem;
    }
    
    .card-header h6 {
        margin: 0;
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    /* Loading state */
    .table-loading {
        text-align: center;
        padding: 2rem;
        color: #858796;
    }
    
    /* Empty state */
    .table-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: #858796;
    }
    
    .table-empty i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
@endsection

@section('contents')
<div class="container-fluid">
    <!-- Course Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-table mr-2"></i>
                Available Training Courses
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table courses-table" id="coursesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Description</th>
                            <th>Contents</th>
                            <th>Duration</th>
                            <th>Target Participants</th>
                            <th>Additional Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $courses = include resource_path('views/harness/ilcdb/courses-data.php');
                        @endphp
                        
                        @foreach($courses as $course)
                        <tr>
                            <td><div class="course-title">{{ $course['title'] }}</div></td>
                            <td>
                                <div class="course-description">
                                    {{ $course['description'] }}
                                </div>
                            </td>
                            <td>
                                <ul class="list-unstyled module-list mb-0">
                                    @foreach($course['contents'] as $content)
                                    <li><strong>{{ $content }}</strong></li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <div class="duration-info">
                                    <span class="duration-days">{{ $course['duration']['days'] }}</span>
                                    <span class="duration-session">{{ $course['duration']['session'] }}</span>
                                </div>
                            </td>
                            <td>
                                @if(is_array($course['participants']))
                                <ul class="list-unstyled participants-list mb-0">
                                        @foreach($course['participants'] as $participant)
                                        <li>{{ $participant }}</li>
                                        @endforeach
                                </ul>
                                @else
                                <div class="course-description">
                                        {{ $course['participants'] }}
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="remarks-cell">
                                    {{ $course['remarks'] }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        console.log('ILCDB Courses page loaded');
        console.log('Table rows found:', $('#coursesTable tbody tr').length);
        
        try {
            // Initialize DataTable
            var table = $('#coursesTable').DataTable({
                "pageLength": 5,
                "order": [[0, "asc"]],
                "responsive": true,
                "ordering": false,
                "colReorder": true,
                "language": {
                    "lengthMenu": "Show _MENU_ courses per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ courses",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                },
                "columnDefs": [
                    {
                        "targets": [1, 4], // Description, Target Participants columns
                        "width": "auto",
                        "className": "text-left"
                    },
                    {
                        "targets": 2, // Contents
                        "width": "180px",
                        "className": "text-left"
                    },
                    {
                        "targets": 3, // Duration column
                        "width": "120px",
                        "className": "text-left"
                    },
                    {
                        "targets": 5, // Additional Remarks column
                        "width": "120px",
                        "className": "text-center"
                    }
                ],
                "drawCallback": function(settings) {
                    // Add hover effects after table is drawn
                    $('.courses-table tbody tr').hover(
                        function() {
                            $(this).addClass('table-hover');
                        },
                        function() {
                            $(this).removeClass('table-hover');
                        }
                    );
                }
            });
            
            console.log('DataTable initialized successfully');
            console.log('Total records:', table.data().count());
            
        } catch (error) {
            console.error('Error initializing DataTable:', error);
        }
    });
</script>
@endsection