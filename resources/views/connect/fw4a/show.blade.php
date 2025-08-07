@extends('layouts.app')
@include('connect.fw4a.edit')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">FW4A Site Details</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Site Information</h6>
                <div>
                    <a href="#" class="btn btn-sm btn-primary edit-btn" style="background-color:#003566; border:none"
                    data-bs-toggle="modal" data-bs-target="#editSiteModal" data-fw4a='@json($fw4a)'>
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('fw4a') }}" class="btn btn-sm btn-secondary" style="background-color:#6a84a0; border:none">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6 mb-3">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 40%;">Site Code:</th>
                                <td>{{ $fw4a->site_code }}</td>
                            </tr>
                            <tr>
                                <th>AP MAC Address:</th>
                                <td>{{ $fw4a->ap_mac_address }}</td>
                            </tr>
                            <tr>
                                <th>Site Name:</th>
                                <td>{{ $fw4a->site_name }}</td>
                            </tr>
                            <tr>
                                <th>Region:</th>
                                <td>{{ $fw4a->region->region_code }}</td>
                            </tr>
                            <tr>
                                <th>Province:</th>
                                <td>{{ $fw4a->province->province_name }}</td>
                            </tr>
                            <tr>
                                <th>District:</th>
                                <td>{{ $fw4a->district->district_name }}</td>
                            </tr>
                            <tr>
                                <th>Locality:</th>
                                <td>{{ $fw4a->locality->locality_name }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6 mb-3">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 40%;">Contract Status:</th>
                                <td>{{ $fw4a->contract_status }}</td>
                            </tr>
                            <tr>
                                <th>Contract:</th>
                                <td>{{ $fw4a->contract }}</td>
                            </tr>
                            <tr>
                                <th>Category:</th>
                                <td>{{ $fw4a->category }}</td>
                            </tr>
                            <tr>
                                <th>Contractor:</th>
                                <td>{{ $fw4a->contractor }}</td>
                            </tr>
                            <tr>
                                <th>Latitude:</th>
                                <td>{{ $fw4a->latitude }}</td>
                            </tr>
                            <tr>
                                <th>Longitude:</th>
                                <td>{{ $fw4a->longitude }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Map Display --}}
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="mb-3" style="color: #003566;">Map Location</h5>
                        <div id="fw4a-map" style="height: 400px;" class="rounded shadow-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        #fw4a-map {
            height: 400px;
            width: 100%;
            border-radius: 8px;
        }
    </style>
@endsection

@section('scripts')
    <!-- Leaflet CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        function decodeEntities(encodedString) {
            const txt = document.createElement('textarea');
            txt.innerHTML = encodedString;
            return txt.value;
        }

        function parseCoordinate(input) {
            input = input.trim();

            if (!isNaN(input)) return parseFloat(input);

            const dmsRegex = /(\d+)[°\s](\d+)[\'\s](\d+(?:\.\d+)?)[\"\s]?([NSEW])/i;
            const match = input.match(dmsRegex);
            if (!match) return null;

            const degrees = parseFloat(match[1]);
            const minutes = parseFloat(match[2]);
            const seconds = parseFloat(match[3]);
            const direction = match[4].toUpperCase();

            let decimal = degrees + (minutes / 60) + (seconds / 3600);
            if (direction === 'S' || direction === 'W') decimal *= -1;

            return decimal;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const rawLat = decodeEntities("{{ $fw4a->latitude }}");
            const rawLng = decodeEntities("{{ $fw4a->longitude }}");

            const lat = parseCoordinate(rawLat);
            const lng = parseCoordinate(rawLng);

            console.log("Parsed Coordinates:", lat, lng);

            if (!lat || !lng) {
                console.error("Invalid coordinates:", rawLat, rawLng);
                return;
            }

            const map = L.map('fw4a-map').setView([lat, lng], 18);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([lat, lng])
                .addTo(map)
                .bindPopup(`<strong>{{ $fw4a->site_name }}</strong><br>{{ $fw4a->province->province_name }}`)
                .openPopup();
        });

    </script>
    <script>
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
                                $('#edit_province').append(`<option value="${p.id}">${p.province_name}</option>`);
                            });
                            $('#edit_province').val(fw4a.province_id);

                            // Load districts for the selected province
                            if (fw4a.province_id) {
                                $.get(`/get-districts/${fw4a.province_id}`, function (data) {
                                    $('#edit_district').html('<option value="">Select District</option>');
                                    data.forEach(d => {
                                        $('#edit_district').append(`<option value="${d.id}">${d.district_name}</option>`);
                                    });
                                    $('#edit_district').val(fw4a.district_id);

                                    // Load localities for the selected district
                                    if (fw4a.district_id) {
                                        $.get(`/get-localities/${fw4a.district_id}`, function (data) {
                                            $('#edit_locality').html('<option value="">Select Locality</option>');
                                            data.forEach(l => {
                                                $('#edit_locality').append(`<option value="${l.id}">${l.locality_name}</option>`);
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
                                $('#edit_province').append(`<option value="${p.id}">${p.province_name}</option>`);
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
                                $('#edit_district').append(`<option value="${d.id}">${d.district_name}</option>`);
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
                                $('#edit_locality').append(`<option value="${l.id}">${l.locality_name}</option>`);
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
                        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        order: [[0, 'desc']],
                    });
                }
            } else {
                setTimeout(initScripts, 100);
            }
        }

        initScripts();
    </script>
@endsection