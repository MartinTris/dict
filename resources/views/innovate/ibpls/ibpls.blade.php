@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 font-weight-bold" style="color: #003566;">IBPLS Management</h1>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="{{ route('ibpls.create') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                <i class="fas fa-plus"></i> Add New Record
            </a>
            <a href="{{ route('ibpls.visualization') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                <i class="fas fa-chart-bar"></i> Data Visualization
            </a>
            <div class="dropdown">
                <button class="btn btn-sm text-white dropdown-toggle" type="button" style="background-color: #003566;" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-file-export"></i> Export
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('ibpls.export', 'xlsx') }}">Export to Excel (XLSX)</a></li>
                    <li><a class="dropdown-item" href="{{ route('ibpls.export', 'csv') }}">Export to CSV</a></li>
                    <li><a class="dropdown-item" href="{{ route('ibpls.export', 'pdf') }}">Export to PDF</a></li>
                </ul>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h6 class="m-0 font-weight-bold" style="color: #003566;">IBPLS Records</h6>
        </div>
        <div class="card-body">
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('ibpls') }}" class="mb-3">
                <div class="row g-2 align-items-end">
                    <!-- Search Input -->
                    <div class="col-md-8 col-12">
                        <div class="input-group">
                            <input type="text" name="search" id="searchInput" class="form-control"
                                placeholder="Search by location, district, operation..." value="{{ request('search') }}">
                            @if (request('search'))
                                <a href="{{ route('ibpls') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                            <button class="btn text-white" type="submit" style="background-color: #003566;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Location Filter -->
                    <div class="col-md-2 col-6">
                        <select name="location" class="form-select">
                            <option value="">All Locations</option>
                            @foreach($locations as $location)
                                <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                    {{ $location }}
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
                <table class="table table-bordered table-striped table-hover nowrap w-100" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">LOCATIONS</th>
                            <th class="text-center">DISTRICT</th>
                            <th class="text-center">OPERATIONS</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ibplsRecords as $record)
                        <tr>
                            <td class="text-center">{{ $record->location }}</td>
                            <td class="text-center">{{ $record->district }}</td>
                            <td class="text-center">{{ $record->operation }}</td>
                            <td class="text-center">{{ $record->status ?? 'N/A' }}</td>
                            <td class="text-center">
                                <a href="{{ route('ibpls.show', $record->id) }}" class="btn btn-sm btn-info mb-1" style="background-color: #5076a8; border-color: #5076a8;">
                                    <i class="fas fa-eye" style="color: white;"></i>
                                </a>
                                <a href="{{ route('ibpls.edit', $record->id) }}" class="btn btn-sm btn-primary mb-1" style="background-color: #003566; border-color: #003566;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('ibpls.destroy', $record->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger mb-1 delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                    <div class="text-muted small">
                        Showing {{ $ibplsRecords->firstItem() }} to {{ $ibplsRecords->lastItem() }} of {{ $ibplsRecords->total() }}
                        results
                    </div>
                    <div>
                        {{ $ibplsRecords->links('pagination::bootstrap-4') }}
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
        $('select[name="location"], select[name="district"], select[name="operation"], select[name="status"]').on('change', function() {
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