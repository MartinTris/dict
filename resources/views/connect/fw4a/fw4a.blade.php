@extends('layouts.app')
@include('connect.fw4a.create')
@include('connect.fw4a.edit')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">FW4A Site Management</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">FW4A Sites</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-sm text-white" data-bs-toggle="modal"
                        data-bs-target="#addSiteModal" style="background-color: #003566;">
                        <i class="fas fa-plus"></i> Add New Site
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" style="color:white; background-color: #003566;">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('fw4a.export', 'xlsx') }}">Export as Excel
                                    (.xlsx)</a></li>
                            <li><a class="dropdown-item" href="{{ route('fw4a.export', 'csv') }}">Export as CSV (.csv)</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('fw4a.export', 'pdf') }}">Export as PDF (.pdf)</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <form method="GET" action="{{ route('fw4a') }}" class="mb-3">
                    <div class="row g-2 align-items-end">
                        <!-- Search Input -->
                        <div class="col-md-8 col-12">
                            <div class="input-group">
                                <input type="text" name="search" id="searchInput" class="form-control"
                                    placeholder="Site code, name, contractor..." value="{{ request('search') }}">
                                @if (request('search'))
                                    <a href="{{ route('fw4a') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn text-white" type="submit" style="background-color: #003566;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- District Filter -->
                        <div class="col-md-2 col-6">
                            <select name="district_id" id="filterDistrict" class="form-select">
                                <option value="">All Districts</option>
                            </select>
                        </div>

                        <!-- Locality Filter -->
                        <div class="col-md-2 col-6">
                            <select name="locality_id" id="filterLocality" class="form-select">
                                <option value="">All Localities</option>
                            </select>
                        </div>
                </form>


                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover nowrap w-100" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Site Code</th>
                                <th class="text-center">AP MAC Address</th>
                                <th class="text-center">Site Name</th>
                                <th class="text-center">Region</th>
                                <th class="text-center">Province</th>
                                <th class="text-center">District</th>
                                <th class="text-center">Locality</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Contract</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Contractor</th>
                                <th class="text-center">Latitude</th>
                                <th class="text-center">Longitude</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fw4as as $fw4a)
                                <tr>
                                    <td class="text-center">{{ $fw4a->site_code }}</td>
                                    <td class="text-center">{{ $fw4a->ap_mac_address }}</td>
                                    <td class="text-center">{{ $fw4a->site_name }}</td>
                                    <td class="text-center">{{ $fw4a->region->region_code }}</td>
                                    <td class="text-center">{{ $fw4a->province->province_name }}</td>
                                    <td class="text-center">{{ $fw4a->district->district_name }}</td>
                                    <td class="text-center">{{ $fw4a->locality->locality_name }}</td>
                                    <td class="text-center">{{ $fw4a->contract_status }}</td>
                                    <td class="text-center">{{ $fw4a->contract }}</td>
                                    <td class="text-center">{{ $fw4a->category }}</td>
                                    <td class="text-center">{{ $fw4a->contractor }}</td>
                                    <td class="text-center">{{ $fw4a->latitude }}</td>
                                    <td class="text-center">{{ $fw4a->longitude }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('fw4a.show', $fw4a->id) }}" class="btn btn-sm btn-info mb-1"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-primary mb-1 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editSiteModal" data-fw4a='@json($fw4a)'>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('fw4a.destroy', $fw4a->id) }}" method="POST"
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
                            Showing {{ $fw4as->firstItem() }} to {{ $fw4as->lastItem() }} of {{ $fw4as->total() }}
                            results
                        </div>
                        <div>
                            {{ $fw4as->links('pagination::bootstrap-4') }}
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
    //deletion
    $(document).ready(function () {
        const province_id = 1;
        const provinceId = 1; // fixed province ID
        const districtSelect = document.getElementById('filterDistrict');
        const localitySelect = document.getElementById('filterLocality');

        function fetchDistricts() {
            fetch(`/get-districts/${provinceId}`)
                .then(res => res.json())
                .then(data => {
                    districtSelect.innerHTML = `<option value="">Filter by District</option>`;
                    data.forEach(d => {
                        districtSelect.innerHTML +=
                            `<option value="${d.id}">${d.district_name}</option>`;
                    });

                    // Restore selected district if exists
                    const selected = @json(request('district_id'));
                    if (selected) districtSelect.value = selected;
                });
        }

        function fetchLocalities(districtId) {
            fetch(`/get-localities/${districtId}`)
                .then(res => res.json())
                .then(data => {
                    localitySelect.innerHTML = `<option value="">Filter by Locality</option>`;
                    data.forEach(l => {
                        localitySelect.innerHTML +=
                            `<option value="${l.id}">${l.locality_name}</option>`;
                    });

                    // Restore selected locality if exists
                    const selected = @json(request('locality_id'));
                    if (selected) localitySelect.value = selected;
                });
        }

        // Load districts on page load
        fetchDistricts();

        // Load localities when district changes
        districtSelect.addEventListener('change', function () {
            const districtId = this.value;
            if (districtId) {
                fetchLocalities(districtId);
            } else {
                localitySelect.innerHTML = `<option value="">Filter by Locality</option>`;
            }
        });

        // If there's a selected district from query params, fetch its localities on load
        const initialDistrict = @json(request('district_id'));
        if (initialDistrict) {
            fetchLocalities(initialDistrict);
        }
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


                const raw = $(this).attr('data-fw4a');

                let fw4a;

                try {
                    fw4a = JSON.parse(raw);
                } catch (e) {
                    return;
                }

                // Set form action
                $('#editSiteForm').attr('action', `/fw4a/${fw4a.id}`);
                // Set hidden field
                $('#edit_fw4a_id').val(fw4a.id);

                // Set fields
                $('#edit_site_code').val(fw4a.site_code);
                $('#edit_ap_mac_address').val(fw4a.ap_mac_address);
                $('#edit_site_name').val(fw4a.site_name);
                $('#edit_contract_status').val(fw4a.contract_status);
                $('#edit_contract').val(fw4a.contract);
                $('#edit_category').val(fw4a.category);
                $('#edit_contractor').val(fw4a.contractor);
                $('#edit_latitude').val(fw4a.latitude);
                $('#edit_longitude').val(fw4a.longitude);

                // Load and set region
                $('#edit_region').val(fw4a.region_id);

                // Load provinces for the selected region
                if (fw4a.region_id) {
                    $.get(`/get-provinces/${fw4a.region_id}`, function (data) {
                        $('#edit_province').html('<option value="">Select Province</option>');
                        data.forEach(p => {
                            $('#edit_province').append(
                                `<option value="${p.id}">${p.province_name}</option>`);
                        });
                        $('#edit_province').val(fw4a.province_id);

                        // Load districts for the selected province
                        if (fw4a.province_id) {
                            $.get(`/get-districts/${fw4a.province_id}`, function (data) {
                                $('#edit_district').html(
                                    '<option value="">Select District</option>');
                                data.forEach(d => {
                                    $('#edit_district').append(
                                        `<option value="${d.id}">${d.district_name}</option>`
                                    );
                                });
                                $('#edit_district').val(fw4a.district_id);

                                // Load localities for the selected district
                                if (fw4a.district_id) {
                                    $.get(`/get-localities/${fw4a.district_id}`, function (
                                        data) {
                                        $('#edit_locality').html(
                                            '<option value="">Select Locality</option>'
                                        );
                                        data.forEach(l => {
                                            $('#edit_locality').append(
                                                `<option value="${l.id}">${l.locality_name}</option>`
                                            );
                                        });
                                        $('#edit_locality').val(fw4a.locality_id);
                                    });
                                }
                            });
                        }
                    });
                }
            });

            // dropdowns for edit modal
            $('#edit_region').on('change', function () {
                let regionId = $(this).val();
                $('#edit_province').html('<option value="">Select Province</option>');
                $('#edit_district').html('<option value="">Select District</option>');
                $('#edit_locality').html('<option value="">Select Locality</option>');

                if (regionId) {
                    $.get(`/get-provinces/${regionId}`, function (data) {
                        data.forEach(p => {
                            $('#edit_province').append(
                                `<option value="${p.id}">${p.province_name}</option>`);
                        });
                    });
                }
            });

            $('#edit_province').on('change', function () {
                let provinceId = $(this).val();
                $('#edit_district').html('<option value="">Select District</option>');
                $('#edit_locality').html('<option value="">Select Locality</option>');

                if (provinceId) {
                    $.get(`/get-districts/${provinceId}`, function (data) {
                        data.forEach(d => {
                            $('#edit_district').append(
                                `<option value="${d.id}">${d.district_name}</option>`);
                        });
                    });
                }
            });

            $('#edit_district').on('change', function () {
                let districtId = $(this).val();
                $('#edit_locality').html('<option value="">Select Locality</option>');

                if (districtId) {
                    $.get(`/get-localities/${districtId}`, function (data) {
                        data.forEach(l => {
                            $('#edit_locality').append(
                                `<option value="${l.id}">${l.locality_name}</option>`);
                        });
                    });
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
                });
            }
        } else {
            setTimeout(initScripts, 100);
        }
    }

    initScripts();
</script>