@extends('layouts.app')
  
@section('contents')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">TECH4ED Centers</h1>
            <div>
                <a href="{{ route('tech4ed.create') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                    <i class="fas fa-plus"></i> Add New Center
                </a>
                <a href="{{ route('tech4ed.visualization') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                    <i class="fas fa-chart-bar"></i> Data Visualization
                </a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #003566; color: white;">
                <h6 class="m-0 font-weight-bold">TECH4ED Centers List</h6>
            </div>
            <div class="card-body">
                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('tech4ed') }}" class="mb-3">
                    <div class="row g-2 align-items-end">
                        <!-- Search Input -->
                        <div class="col-md-6 col-12">
                            <div class="input-group">
                                <input type="text" name="search" id="searchInput" class="form-control"
                                    placeholder="Search by center name, municipality, CM name..." value="{{ request('search') }}">
                                @if (request('search'))
                                    <a href="{{ route('tech4ed') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn text-white" type="submit" style="background-color: #003566;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Congressional District Filter -->
                        <div class="col-md-2 col-6">
                            <select name="congressional_district" class="form-select">
                                <option value="">All Districts</option>
                                @foreach($congressionalDistricts as $district)
                                    <option value="{{ $district }}" {{ request('congressional_district') == $district ? 'selected' : '' }}>
                                        {{ $district }} District
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Municipality Filter -->
                        <div class="col-md-2 col-6">
                            <select name="municipality" class="form-select">
                                <option value="">All Municipalities</option>
                                @foreach($municipalities as $municipality)
                                    <option value="{{ $municipality }}" {{ request('municipality') == $municipality ? 'selected' : '' }}>
                                        {{ $municipality }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover nowrap w-100" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Congressional District</th>
                                <th class="text-center">Municipality</th>
                                <th class="text-center">Specific Center Location</th>
                                <th class="text-center">Center Name</th>
                                <th class="text-center">Center Model</th>
                                <th class="text-center">CM Name</th>
                                <th class="text-center">CM Email</th>
                                <th class="text-center">CM Mobile</th>
                                <th class="text-center">CM Sex</th>
                                <th class="text-center">Date of Launching</th>
                                <th class="text-center">Operational</th>
                                <th class="text-center">With Donation</th>
                                <th class="text-center">Type of Donation</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tech4eds as $tech4ed)
                            <tr>
                                <td class="text-center">{{ $tech4ed->congressional_district }}</td>
                                <td class="text-center">{{ $tech4ed->municipality }}</td>
                                <td class="text-center">{{ $tech4ed->specific_center_location }}</td>
                                <td class="text-center">{{ $tech4ed->center_name }}</td>
                                <td class="text-center">{{ $tech4ed->center_model }}</td>
                                <td class="text-center">{{ $tech4ed->cm_name }}</td>
                                <td class="text-center">{{ $tech4ed->cm_email }}</td>
                                <td class="text-center">{{ $tech4ed->cm_mobile }}</td>
                                <td class="text-center">{{ $tech4ed->cm_sex }}</td>
                                <td class="text-center">{{ date('F d, Y', strtotime($tech4ed->date_of_launching)) }}</td>
                                <td class="text-center">{{ $tech4ed->operational }}</td>
                                <td class="text-center">{{ $tech4ed->with_donation }}</td>
                                <td class="text-center">{{ $tech4ed->type_of_donation ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('tech4ed.show', $tech4ed->id) }}" class="btn btn-sm btn-info mb-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('tech4ed.edit', $tech4ed->id) }}" class="btn btn-sm btn-primary mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tech4ed.destroy', $tech4ed->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger mb-1 delete-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                        <div class="text-muted small">
                            Showing {{ $tech4eds->firstItem() }} to {{ $tech4eds->lastItem() }} of {{ $tech4eds->total() }}
                            results
                        </div>
                        <div>
                            {{ $tech4eds->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styling -->
    <style>
        #searchInput {
            padding-right: 2.5rem;
        }

        #clearSearchBtn {
            font-size: 1rem;
            z-index: 10;
        }

        @media (max-width: 768px) {
            #clearSearchBtn {
                right: 2.5rem;
            }
        }

        .custom-search-btn {
            flex: 0 0 auto;
            padding: 0.375rem 0.9rem;
            background-color: #003566;
            color: white;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-item .page-link {
            color: #003566;
            border-radius: 6px;
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background-color: #003566;
            border-color: #003566;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #aaa;
        }

        /* Ensure proper alignment */
        .table th,
        .table td {
            white-space: nowrap;
            vertical-align: middle;
            text-align: center;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            form.mb-3.d-flex {
                flex-direction: column;
                gap: 0.5rem;
            }

            .input-group {
                width: 100% !important;
            }
        }

        @media (max-width: 768px) {
            .card-header .btn {
                width: 100%;
            }

            .card-header h6 {
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }

        /* Municipality filter note styling */
        .text-muted {
            font-size: 0.75rem;
            line-height: 1.2;
        }
    </style>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // SweetAlert delete confirmation
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Auto-submit form when filters change
            $('select[name="congressional_district"], select[name="municipality"], select[name="center_model"], select[name="operational"], select[name="with_donation"]').on('change', function() {
                $(this).closest('form').submit();
            });

            // Clear search functionality
            $('#searchInput').on('keyup', function(e) {
                if (e.key === 'Enter') {
                    $(this).closest('form').submit();
                }
            });

            // DataTable initialization
            if (typeof $.fn.DataTable !== 'undefined') {
                $('#dataTable').DataTable({
                    responsive: true,
                    scrollX: true,
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    order: [
                        [0, 'asc']
                    ],
                    // Disable DataTable's built-in search since we have our own
                    dom: 'rt<"bottom"lip>',
                    searching: false
                });
            }

            // Show loading state when form is submitted
            $('form').on('submit', function() {
                $('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            });
        });
    </script>
@endsection