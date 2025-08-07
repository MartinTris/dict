@extends('layouts.app')
@include('innovate.egov.assistances.create')
@include('innovate.egov.assistances.edit')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">eGov Assistance Management</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">eGov Assistances</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-sm text-white" data-bs-toggle="modal"
                        data-bs-target="#addAssistanceModal" style="background-color: #003566;">
                        <i class="fas fa-plus"></i> Add New Assistance
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" style="color:white; background-color: #003566;">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('egov-assistance.export', 'xlsx') }}">Export as Excel
                                    (.xlsx)</a></li>
                            <li><a class="dropdown-item" href="{{ route('egov-assistance.export', 'csv') }}">Export as CSV (.csv)</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('egov-assistance.export', 'pdf') }}">Export as PDF (.pdf)</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="GET" action="{{ route('egov-assistance.index') }}" class="mb-3">
                    <div class="row g-2 align-items-end">
                        <!-- Search Input -->
                        <div class="col-md-8 col-12">
                            <div class="input-group">
                                <input type="text" name="search" id="searchInput" class="form-control"
                                    placeholder="Name, email, system, concern..." value="{{ request('search') }}">
                                @if (request('search'))
                                    <a href="{{ route('egov-assistance.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn text-white" type="submit" style="background-color: #003566;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Province Filter -->
                        <div class="col-md-2 col-6">
                            <select name="province" id="filterProvince" class="form-select">
                                <option value="">All Provinces</option>
                                @foreach($provinces ?? [] as $province)
                                    <option value="{{ $province }}" {{ request('province') == $province ? 'selected' : '' }}>
                                        {{ $province }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- LGU Filter -->
                        <div class="col-md-2 col-6">
                            <select name="lgu" id="filterLgu" class="form-select">
                                <option value="">All LGUs</option>
                                @foreach($lgus ?? [] as $lgu)
                                    <option value="{{ $lgu }}" {{ request('lgu') == $lgu ? 'selected' : '' }}>
                                        {{ $lgu }}
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
                                <th class="text-center">Date</th>
                                <th class="text-center">Province</th>
                                <th class="text-center">LGU</th>
                                <th class="text-center">Name of Requestee</th>
                                <th class="text-center">Email Address</th>
                                <th class="text-center">Contact No.</th>
                                <th class="text-center">System</th>
                                <th class="text-center">Concern</th>
                                <th class="text-center">Received by</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($egovAssistances as $assistance)
                                <tr>
                                    <td class="text-center">{{ $assistance->date->format('M d, Y') }}</td>
                                    <td class="text-center">{{ $assistance->province }}</td>
                                    <td class="text-center">{{ $assistance->lgu }}</td>
                                    <td class="text-center">{{ $assistance->name_of_requestee }}</td>
                                    <td class="text-center">{{ $assistance->email_address }}</td>
                                    <td class="text-center">{{ $assistance->contact_no ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $assistance->system }}</td>
                                    <td class="text-center">
                                        <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $assistance->concern }}">
                                            {{ Str::limit($assistance->concern, 50) }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $assistance->received_by }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $assistance->status == 'Resolved' ? 'success' : ($assistance->status == 'Pending' ? 'warning' : 'secondary') }}">
                                            {{ $assistance->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('egov-assistance.show', $assistance->id) }}" class="btn btn-sm btn-info mb-1"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-primary mb-1 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editAssistanceModal" data-assistance='@json($assistance)'>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('egov-assistance.destroy', $assistance->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger mb-1 delete-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                        <div class="text-muted small">
                            Showing {{ $egovAssistances->firstItem() }} to {{ $egovAssistances->lastItem() }} of {{ $egovAssistances->total() }}
                            results
                        </div>
                        <div>
                            {{ $egovAssistances->links('pagination::bootstrap-4') }}
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
@endsection

<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // SweetAlert delete confirmation
        $(document).on('click', '.delete-btn', function (e) {
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
    });

    // Wait for jQuery 
    function initScripts() {
        if (typeof jQuery !== 'undefined') {
            // edit modal functionality
            $(document).on('click', '.edit-btn', function () {
                const raw = $(this).attr('data-assistance');
                let assistance;

                try {
                    assistance = JSON.parse(raw);
                } catch (e) {
                    return;
                }

                // Set form action
                $('#editAssistanceForm').attr('action', `/egov-assistance/${assistance.id}`);
                // Set hidden field
                $('#edit_assistance_id').val(assistance.id);

                // Set fields
                // Format date for HTML date input (YYYY-MM-DD)
                const date = new Date(assistance.date);
                const formattedDate = date.toISOString().split('T')[0];
                $('#edit_date').val(formattedDate);
                $('#edit_province').val(assistance.province);
                $('#edit_lgu').val(assistance.lgu);
                $('#edit_name_of_requestee').val(assistance.name_of_requestee);
                $('#edit_email_address').val(assistance.email_address);
                $('#edit_contact_no').val(assistance.contact_no);
                $('#edit_system').val(assistance.system);
                $('#edit_concern').val(assistance.concern);
                $('#edit_received_by').val(assistance.received_by);
                $('#edit_status').val(assistance.status);
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
                });
            }
        } else {
            setTimeout(initScripts, 100);
        }
    }

    initScripts();
</script> 