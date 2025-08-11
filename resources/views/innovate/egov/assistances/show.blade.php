@extends('layouts.app')
@include('innovate.egov.assistances.edit')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">eGov Assistance Details</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Assistance Information</h6>
                <div>
                    <a href="#" class="btn btn-sm btn-primary edit-btn" style="background-color:#003566; border:none"
                        data-bs-toggle="modal" data-bs-target="#editAssistanceModal"
                        data-assistance='@json($egovAssistance)'>
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('egov-assistance.index') }}" class="btn btn-sm btn-secondary"
                        style="background-color:#6a84a0; border:none">
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
                                <th style="width: 40%;">Date:</th>
                                <td>{{ $egovAssistance->date->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Province:</th>
                                <td>{{ $egovAssistance->province }}</td>
                            </tr>
                            <tr>
                                <th>LGU:</th>
                                <td>{{ $egovAssistance->lgu }}</td>
                            </tr>
                            <tr>
                                <th>Name of Requestee:</th>
                                <td>{{ $egovAssistance->name_of_requestee }}</td>
                            </tr>
                            <tr>
                                <th>Email Address:</th>
                                <td>{{ $egovAssistance->email_address }}</td>
                            </tr>
                            <tr>
                                <th>Contact No.:</th>
                                <td>{{ $egovAssistance->contact_no ?? 'No contact number' }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6 mb-3">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 40%;">System:</th>
                                <td>{{ $egovAssistance->system }}</td>
                            </tr>
                            <tr>
                                <th>Received by:</th>
                                <td>{{ $egovAssistance->received_by }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span
                                        class="badge bg-{{ $egovAssistance->status == 'Resolved' ? 'success' : ($egovAssistance->status == 'Pending' ? 'warning' : 'secondary') }}">
                                        {{ $egovAssistance->status }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Concern Section --}}
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="mb-3" style="color: #003566;">Concern Details</h5>
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-0">{{ $egovAssistance->concern }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Status Information Section --}}
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="mb-3" style="color: #003566;">Status Information</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h6 class="text-muted">Current Status</h6>
                                            <h4
                                                class="text-{{ $egovAssistance->status == 'Resolved' ? 'success' : ($egovAssistance->status == 'Pending' ? 'warning' : 'secondary') }}">
                                                {{ $egovAssistance->status }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h6 class="text-muted">System</h6>
                                            <h4 class="text-primary">{{ $egovAssistance->system }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h6 class="text-muted">Received by</h6>
                                            <h4 class="text-success" style="color: #1c9628">
                                                {{ $egovAssistance->received_by }}</h4>
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
            } else {
                setTimeout(initScripts, 100);
            }
        }

        initScripts();
    </script>
@endsection
