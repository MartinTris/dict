@extends('layouts.app')
@include('connect.fw4a.create')
@include('connect.fw4a.edit')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">FW4A Management</h1>

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
                    <a href="{{--route('pnpki.visualization')--}}" class="btn btn-sm text-white"
                        style="background-color: #003566;">
                        <i class="fas fa-chart-bar"></i> Data Visualization
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover nowrap w-100" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Site Code</th>
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
                                        <form action="{{ route('fw4a.destroy', $fw4a->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger mb-1 delete-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @if(session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Styling -->
    <style>
        /* Ensure proper alignment */
        .table th,
        .table td {
            white-space: nowrap;
            vertical-align: middle;
            text-align: center;
        }

        /* Responsive tweaks */
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

<!-- Make sure jQuery is loaded before SweetAlert2 and your script -->
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
</script>