@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">PNPKI Management</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">PNPKI Records</h6>
                <div>
                    <a href="{{ route('pnpki.create') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                        <i class="fas fa-plus"></i> Add New Record
                    </a>
                    <a href="{{ route('pnpki.visualization') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                        <i class="fas fa-chart-bar"></i> Data Visualization
                    </a>
                    <div class="dropdown d-inline">
                        <button class="btn btn-sm dropdown-toggle text-white" type="button" style="background-color: #003566;" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-file-export"></i> Export
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pnpki.export', 'xlsx') }}">Export to Excel (XLSX)</a></li>
                            <li><a class="dropdown-item" href="{{ route('pnpki.export', 'csv') }}">Export to CSV</a></li>
                            <li><a class="dropdown-item" href="{{ route('pnpki.export', 'pdf') }}">Export to PDF</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            <div class="card-body">
                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('pnpki') }}" class="mb-3">
                    <div class="row g-2 align-items-end">
                        <!-- Search Input -->
                        <div class="col-md-6 col-12">
                            <div class="input-group">
                                <input type="text" name="search" id="searchInput" class="form-control"
                                    placeholder="Search by activity title, organizer, province..." value="{{ request('search') }}">
                                @if (request('search'))
                                    <a href="{{ route('pnpki') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn text-white" type="submit" style="background-color: #003566;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
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

                        <!-- District Filter -->
                        <div class="col-md-2 col-6">
                            <select name="district" class="form-select">
                                <option value="">All Districts</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>
                                        {{ $district }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" style="min-width: 120px;">Date Conducted</th>
                                <th class="text-center" style="min-width: 150px;">Time Conducted</th>
                                <th class="text-center" style="min-width: 150px;">Organizer</th>
                                <th class="text-center" style="min-width: 120px;">Province</th>
                                <th class="text-center" style="min-width: 150px;">Municipality</th>
                                <th class="text-center" style="min-width: 120px;">District</th>
                                <th class="text-center" style="min-width: 200px;">Activity Title</th>
                                <th class="text-center" style="min-width: 170px;">Type of Activity</th>
                                <th class="text-center" style="min-width: 180px;">Mode of Implementation</th>
                                <th class="text-center" style="min-width: 100px;">Zoom Link</th>
                                <th class="text-center" style="min-width: 90px;">Male Participants</th>
                                <th class="text-center" style="min-width: 90px;">Female Participants</th>
                                <th class="text-center" style="min-width: 80px;">Total</th>
                                <th class="text-center" style="min-width: 150px;">Resource Person</th>
                                <th class="text-center" style="min-width: 100px;">FB Posting</th>
                                <th class="text-center" style="min-width: 110px;">Engagement</th>
                                <th class="text-center" style="min-width: 130px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pnpkis ?? [] as $pnpki)
                                <tr>
                                    <td class="text-center">{{ $pnpki->date_conducted }}</td>
                                    <td class="text-center">{{ $pnpki->time_conducted }}</td>
                                    <td>{{ $pnpki->organizer }}</td>
                                    <td>{{ $pnpki->province }}</td>
                                    <td>{{ $pnpki->municipality ?? 'N/A' }}</td>
                                    <td>{{ $pnpki->district ?? 'N/A' }}</td>
                                    <td>{{ $pnpki->activity_title }}</td>
                                    <td>{{ $pnpki->type_of_activity }}</td>
                                    <td>{{ $pnpki->mode_of_implementation }}</td>
                                    <td class="text-center">
                                        @if($pnpki->zoom_link)
                                            <a href="{{ $pnpki->zoom_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-link"></i> Link
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $pnpki->male_participants }}</td>
                                    <td class="text-center">{{ $pnpki->female_participants }}</td>
                                    <td class="text-center font-weight-bold">{{ $pnpki->total_participants }}</td>
                                    <td>{{ $pnpki->resource_person }}</td>
                                    <td class="text-center">
                                        @if($pnpki->fb_posting)
                                            <a href="{{ $pnpki->fb_posting }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                <i class="fab fa-facebook"></i> View
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $pnpki->number_of_engagement ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pnpki.show', $pnpki->id) }}" class="btn btn-sm btn-info mx-1" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pnpki.edit', $pnpki->id) }}" class="btn btn-sm btn-primary mx-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pnpki.destroy', $pnpki->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mx-1" 
                                                    onclick="return confirm('Are you sure you want to delete this record?')" 
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="17" class="text-center">No PNPKI records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                        <div class="text-muted small">
                            Showing {{ $pnpkis->firstItem() }} to {{ $pnpkis->lastItem() }} of {{ $pnpkis->total() }}
                            results
                        </div>
                        <div>
                            {{ $pnpkis->links('pagination::bootstrap-4') }}
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
    </style>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Auto-submit form when filters change
            $('select[name="province"], select[name="municipality"], select[name="district"], select[name="type_of_activity"]').on('change', function() {
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
                        [0, 'desc']
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

            // SweetAlert delete confirmation
            $(document).on('click', 'button[type="submit"]', function(e) {
                if ($(this).closest('form').find('input[name="_method"]').val() === 'DELETE') {
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
                }
            });
        });
    </script>
@endsection