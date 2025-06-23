@extends('layouts.app')
  
@section('contents')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">TECH4ED Center Details</h1>
            <a href="{{ route('tech4ed') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #003566; color: white;">
                <h6 class="m-0 font-weight-bold">{{ $tech4ed->center_name }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Congressional District:</strong>
                            {{ $tech4ed->congressional_district }}
                        </div>
                        <div class="form-group">
                            <strong>Municipality:</strong>
                            {{ $tech4ed->municipality }}
                        </div>
                        <div class="form-group">
                            <strong>Specific Center Location:</strong>
                            {{ $tech4ed->specific_center_location }}
                        </div>
                        <div class="form-group">
                            <strong>Center Name:</strong>
                            {{ $tech4ed->center_name }}
                        </div>
                        <div class="form-group">
                            <strong>Center Model:</strong>
                            {{ $tech4ed->center_model }}
                        </div>
                        <div class="form-group">
                            <strong>CM Name:</strong>
                            {{ $tech4ed->cm_name }}
                        </div>
                        <div class="form-group">
                            <strong>CM Email:</strong>
                            {{ $tech4ed->cm_email }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>CM Mobile:</strong>
                            {{ $tech4ed->cm_mobile }}
                        </div>
                        <div class="form-group">
                            <strong>CM Sex:</strong>
                            {{ $tech4ed->cm_sex }}
                        </div>
                        <div class="form-group">
                            <strong>Date of Launching:</strong>
                            {{ $tech4ed->date_of_launching }}
                        </div>
                        <div class="form-group">
                            <strong>Operational:</strong>
                            {{ $tech4ed->operational }}
                        </div>
                        <div class="form-group">
                            <strong>With Donation:</strong>
                            {{ $tech4ed->with_donation }}
                        </div>
                        <div class="form-group">
                            <strong>Type of Donation:</strong>
                            {{ $tech4ed->type_of_donation ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('tech4ed.edit', $tech4ed->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection