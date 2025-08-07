@extends('layouts.app')

@section('contents')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cybersecurity Activity Details</h1>
            <div>
                <a href="{{ route('cybersecurity.edit', $cybersecurity->id) }}" class="btn btn-sm btn-primary shadow-sm"
                    style="background-color: #003566; border:none;">
                    <i class="fas fa-edit fa-sm text-white-50"></i> Edit
                </a>
                <a href="{{ route('cybersecurity') }}" class="btn btn-sm btn-secondary shadow-sm"
                    style="background-color: #6a84a0; border:none;">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Details Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #003566;">
                <h6 class="m-0 font-weight-bold text-white">{{ $cybersecurity->activity_title }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Date Conducted:</strong>
                            <p>{{ date('F d, Y', strtotime($cybersecurity->date_conducted)) }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Time Conducted:</strong>
                            <p>{{ $cybersecurity->time_conducted }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Organizer:</strong>
                            <p>{{ $cybersecurity->organizer }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Province:</strong>
                            <p>{{ $cybersecurity->province }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Municipality:</strong>
                            <p>{{ $cybersecurity->municipality ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>District:</strong>
                            <p>{{ $cybersecurity->district ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Type of Activity:</strong>
                            <p>{{ $cybersecurity->type_of_activity }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Mode of Implementation:</strong>
                            <p>{{ $cybersecurity->mode_of_implementation }}</p>
                        </div>
                    </div>
                </div>

                @if ($cybersecurity->zoom_link)
                    <div class="mb-3">
                        <strong>Zoom Link:</strong>
                        <p><a href="{{ $cybersecurity->zoom_link }}" target="_blank">{{ $cybersecurity->zoom_link }}</a>
                        </p>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <strong>Male Participants:</strong>
                            <p>{{ $cybersecurity->male_participants }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <strong>Female Participants:</strong>
                            <p>{{ $cybersecurity->female_participants }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <strong>Total Participants:</strong>
                            <p>{{ $cybersecurity->male_participants + $cybersecurity->female_participants }}</p>
                        </div>
                    </div>
                </div>

                @if ($cybersecurity->participant_details)
                    <div class="mb-3">
                        <strong>Participant Details:</strong>
                        <p>{{ $cybersecurity->participant_details }}</p>
                    </div>
                @endif

                <div class="mb-3">
                    <strong>Resource Person:</strong>
                    <p>{{ $cybersecurity->resource_person }}</p>
                </div>

                @if ($cybersecurity->fb_posting)
                    <div class="mb-3">
                        <strong>FB Posting:</strong>
                        <p><a href="{{ $cybersecurity->fb_posting }}" target="_blank">{{ $cybersecurity->fb_posting }}</a>
                        </p>
                    </div>
                @endif

                @if ($cybersecurity->number_of_engagement)
                    <div class="mb-3">
                        <strong>Number of Engagement:</strong>
                        <p>{{ $cybersecurity->number_of_engagement }}</p>
                    </div>
                @endif

                @if ($cybersecurity->list_of_engaged_partners)
                    <div class="mb-3">
                        <strong>List of Engaged Partners:</strong>
                        <p>{{ $cybersecurity->list_of_engaged_partners }}</p>
                    </div>
                @endif

                <div class="form-group text-right mt-4">
                    <a href="{{ route('cybersecurity.visualization') }}" class="btn btn-info"
                        style="background-color: #375d81; border: none; color: white;">
                        <i class="fas fa-chart-bar" style="color: white;"></i> View Data Visualization
                    </a>

                    <form action="{{ route('cybersecurity.destroy', $cybersecurity->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this record?')">
                            <i class="fas fa-trash"></i> Delete Record
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
