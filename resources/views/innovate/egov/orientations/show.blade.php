@extends('layouts.app')
@include('innovate.egov.orientations.edit')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">eGov Orientation Details</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Orientation Information</h6>
                <div>
                    <a href="#" class="btn btn-sm btn-primary edit-btn" style="background-color:#003566; border:none"
                        data-bs-toggle="modal" data-bs-target="#editOrientationModal"
                        data-orientation='@json($egovOrientation)'>
                        <i class="fas fa-edit" style="color: white;"></i> Edit
                    </a>
                    <a href="{{ route('egov-orientation.index') }}" class="btn btn-sm btn-secondary"
                        style="background-color:#6a84a0; border:none">
                        <i class="fas fa-arrow-left" style="color: white;"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6 mb-3">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 40%;">Date:</th>
                                <td>{{ $egovOrientation->date->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Training Control No.:</th>
                                <td>{{ $egovOrientation->training_control_no }}</td>
                            </tr>
                            <tr>
                                <th>Event Name:</th>
                                <td>{{ $egovOrientation->event_name }}</td>
                            </tr>
                            <tr>
                                <th>Event Type:</th>
                                <td>{{ $egovOrientation->event_type ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Venue:</th>
                                <td>{{ $egovOrientation->venue }}</td>
                            </tr>
                            <tr>
                                <th>Participants:</th>
                                <td>{{ $egovOrientation->participants }}</td>
                            </tr>
                            <tr>
                                <th>Province:</th>
                                <td>{{ $egovOrientation->province }}</td>
                            </tr>
                            <tr>
                                <th>Municipality:</th>
                                <td>{{ $egovOrientation->municipality }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6 mb-3">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 40%;">Mode:</th>
                                <td>{{ $egovOrientation->mode }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>{{ $egovOrientation->status }}</td>
                            </tr>
                            <tr>
                                <th>No. of Attendees:</th>
                                <td>{{ $egovOrientation->no_of_attendees }}</td>
                            </tr>
                            <tr>
                                <th>No. of Downloaded & Verified:</th>
                                <td>{{ $egovOrientation->no_of_downloaded_and_verified }}</td>
                            </tr>
                            <tr>
                                <th>Male:</th>
                                <td>{{ $egovOrientation->male }}</td>
                            </tr>
                            <tr>
                                <th>Female:</th>
                                <td>{{ $egovOrientation->female }}</td>
                            </tr>
                            <tr>
                                <th>Link:</th>
                                <td>
                                    @if ($egovOrientation->link)
                                        <a href="{{ $egovOrientation->link }}" target="_blank" class="btn btn-sm btn-link">
                                            <i class="fas fa-external-link-alt"></i> View Link
                                        </a>
                                    @else
                                        <span class="text-muted">No link available</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Additional Information Section --}}
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="mb-3" style="color: #003566;">Additional Information</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h6 class="text-muted">Total Participants</h6>
                                            @php
                                                $male = intval($egovOrientation->male);
                                                $female = intval($egovOrientation->female);
                                                $totalParticipants = $male + $female;
                                            @endphp
                                            <h4 class="text-primary">{{ $totalParticipants }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h6 class="text-muted">Male Participants</h6>
                                            <h4 style="color: #007bff;">{{ intval($egovOrientation->male) }}</h4>
                                            {{-- Blue --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h6 class="text-muted">Female Participants</h6>
                                            <h4 style="color: #e83e8c;">{{ intval($egovOrientation->female) }}</h4>
                                            {{-- Pink --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <h6 class="text-muted">Gender Distribution</h6>
                                            <div class="progress" style="height: 25px;">
                                                @php
                                                    $male = intval($egovOrientation->male);
                                                    $female = intval($egovOrientation->female);
                                                    $total = $male + $female;
                                                    $malePercent = $total > 0 ? round(($male / $total) * 100) : 0;
                                                    $femalePercent = $total > 0 ? round(($female / $total) * 100) : 0;
                                                @endphp
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $malePercent }}%; background-color: #007bff;"
                                                    aria-valuenow="{{ $malePercent }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    Male: {{ $malePercent }}%
                                                </div>
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $femalePercent }}%; background-color: #e83e8c;"
                                                    aria-valuenow="{{ $femalePercent }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    Female: {{ $femalePercent }}%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table-borderless th {
            font-weight: 600;
            color: #003566;
        }

        .card {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
        }

        .text-primary {
            color: #003566 !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Wait for jQuery 
        function initScripts() {
            if (typeof jQuery !== 'undefined') {
                // edit modal functionality
                $(document).on('click', '.edit-btn', function() {
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
                    $('#edit_event_type').val(orientation.event_type);
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
            } else {
                setTimeout(initScripts, 100);
            }
        }

        initScripts();
    </script>
@endsection
