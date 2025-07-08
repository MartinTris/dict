@extends('layouts.app')

@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">FW4A Site Details</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Site Information</h6>
                <div>
                    <a href="{{--route('fw4a.edit', $fw4a->id)--}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('fw4a') }}" class="btn btn-sm btn-secondary">
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
@endsection