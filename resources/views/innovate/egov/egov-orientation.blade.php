@extends('layouts.app')
@include('innovate.egov.orientations.create')
@include('innovate.egov.orientations.edit')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">eGov Orientation Management</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">eGov Orientations</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-sm text-white" data-bs-toggle="modal"
                        data-bs-target="#addOrientationModal" style="background-color: #003566;">
                        <i class="fas fa-plus"></i> Add New Orientation
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" style="color:white; background-color: #003566;">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('egov-orientation.export', 'xlsx') }}">Export as Excel
                                    (.xlsx)</a></li>
                            <li><a class="dropdown-item" href="{{ route('egov-orientation.export', 'csv') }}">Export as CSV (.csv)</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('egov-orientation.export', 'pdf') }}">Export as PDF (.pdf)</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="GET" action="{{ route('egov-orientation.index') }}" class="mb-3">
                    <div class="row g-2 align-items-end">
                        <!-- Search Input -->
                        <div class="col-md-8 col-12">
                            <div class="input-group">
                                <input type="text" name="search" id="searchInput" class="form-control"
                                    placeholder="Training control no, event name, venue, participants..." value="{{ request('search') }}">
                                @if (request('search'))
                                    <a href="{{ route('egov-orientation.index') }}" class="btn btn-outline-secondary">
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

                        <!-- Municipality Filter -->
                        <div class="col-md-2 col-6">
                            <select name="municipality" id="filterMunicipality" class="form-select">
                                <option value="">All Municipalities</option>
                                @foreach($municipalities ?? [] as $municipality)
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
                                <th class="text-center">Date</th>
                                <th class="text-center">Training Control No.</th>
                                <th class="text-center">Event Name</th>
                                <th class="text-center">Venue</th>
                                <th class="text-center">Participants</th>
                                <th class="text-center">Province</th>
                                <th class="text-center">Municipality</th>
                                <th class="text-center">Mode</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">No. of Attendees</th>
                                <th class="text-center">No. of Downloaded & Verified</th>
                                <th class="text-center">Male</th>
                                <th class="text-center">Female</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($egovOrientations as $orientation)
                                <tr>
                                    <td class="text-center">{{ $orientation->date->format('M d, Y') }}</td>
                                    <td class="text-center">{{ $orientation->training_control_no }}</td>
                                    <td class="text-center">{{ $orientation->event_name }}</td>
                                    <td class="text-center">{{ $orientation->venue }}</td>
                                    <td class="text-center">{{ $orientation->participants }}</td>
                                    <td class="text-center">{{ $orientation->province }}</td>
                                    <td class="text-center">{{ $orientation->municipality }}</td>
                                    <td class="text-center">{{ $orientation->mode }}</td>
                                    <td class="text-center">{{ $orientation->status }}</td>
                                    <td class="text-center">{{ $orientation->no_of_attendees }}</td>
                                    <td class="text-center">{{ $orientation->no_of_downloaded_and_verified }}</td>
                                    <td class="text-center">{{ $orientation->male }}</td>
                                    <td class="text-center">{{ $orientation->female }}</td>
                                    <td class="text-center">
                                        @if($orientation->link)
                                            <a href="{{ $orientation->link }}" target="_blank" class="btn btn-sm btn-link">
                                                <i class="fas fa-external-link-alt"></i> View
                                            </a>
                                        @else
                                            <span class="text-muted">No link</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('egov-orientation.show', $orientation->id) }}" class="btn btn-sm btn-info mb-1"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-primary mb-1 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editOrientationModal" data-orientation='@json($orientation)'>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('egov-orientation.destroy', $orientation->id) }}" method="POST"
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
                            Showing {{ $egovOrientations->firstItem() }} to {{ $egovOrientations->lastItem() }} of {{ $egovOrientations->total() }}
                            results
                        </div>
                        <div>
                            {{ $egovOrientations->links('pagination::bootstrap-4') }}
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
                const raw = $(this).attr('data-orientation');
                let orientation;

                try {
                    orientation = JSON.parse(raw);
                } catch (e) {
                    return;
                }

                // Set form action
                $('#editOrientationForm').attr('action', `/egov-orientation/${orientation.id}`);
                // Set hidden field
                $('#edit_orientation_id').val(orientation.id);

                // Set fields
                // Format date for HTML date input (YYYY-MM-DD)
                const date = new Date(orientation.date);
                const formattedDate = date.toISOString().split('T')[0];
                $('#edit_date').val(formattedDate);
                $('#edit_training_control_no').val(orientation.training_control_no);
                $('#edit_event_name').val(orientation.event_name);
                $('#edit_venue').val(orientation.venue);
                $('#edit_participants').val(orientation.participants);
                $('#edit_province').val(orientation.province);
                $('#edit_municipality').val(orientation.municipality);
                $('#edit_mode').val(orientation.mode);
                $('#edit_status').val(orientation.status);
                $('#edit_no_of_attendees').val(orientation.no_of_attendees);
                $('#edit_no_of_downloaded_and_verified').val(orientation.no_of_downloaded_and_verified);
                $('#edit_male').val(orientation.male);
                $('#edit_female').val(orientation.female);
                $('#edit_link').val(orientation.link);
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

