@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">PNPKI Record Details</h1>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">PNPKI Activity Details</h6>
                <div>
                    <a href="{{ route('pnpki.edit', $pnpki->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('pnpki') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 40%;">Date Conducted:</th>
                                <td>{{ $pnpki->date_conducted }}</td>
                            </tr>
                            <tr>
                                <th>Time Conducted:</th>
                                <td>{{ $pnpki->time_conducted }}</td>
                            </tr>
                            <tr>
                                <th>Organizer:</th>
                                <td>{{ $pnpki->organizer }}</td>
                            </tr>
                            <tr>
                                <th>Province:</th>
                                <td>{{ $pnpki->province }}</td>
                            </tr>
                            <tr>
                                <th>Activity Title:</th>
                                <td>{{ $pnpki->activity_title }}</td>
                            </tr>
                            <tr>
                                <th>Type of Activity:</th>
                                <td>{{ $pnpki->type_of_activity }}</td>
                            </tr>
                            <tr>
                                <th>Mode of Implementation:</th>
                                <td>{{ $pnpki->mode_of_implementation }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 40%;">Zoom Link:</th>
                                <td>
                                    @if($pnpki->zoom_link)
                                        <a href="{{ $pnpki->zoom_link }}" target="_blank">{{ $pnpki->zoom_link }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Male Participants:</th>
                                <td>{{ $pnpki->male_participants }}</td>
                            </tr>
                            <tr>
                                <th>Female Participants:</th>
                                <td>{{ $pnpki->female_participants }}</td>
                            </tr>
                            <tr>
                                <th>Total Participants:</th>
                                <td><strong>{{ $pnpki->total_participants }}</strong></td>
                            </tr>
                            <tr>
                                <th>Resource Person:</th>
                                <td>{{ $pnpki->resource_person }}</td>
                            </tr>
                            <tr>
                                <th>FB Posting:</th>
                                <td>
                                    @if($pnpki->fb_posting)
                                        <a href="{{ $pnpki->fb_posting }}" target="_blank">{{ $pnpki->fb_posting }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Number of Engagement:</th>
                                <td>{{ $pnpki->number_of_engagement ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold" style="color: #003566;">Participant Details</h6>
                            </div>
                            <div class="card-body">
                                {{ $pnpki->participant_details }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold" style="color: #003566;">List of Engaged Partners</h6>
                            </div>
                            <div class="card-body">
                                {{ $pnpki->list_of_engaged_partners }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection