@extends('layouts.app')
  
@section('contents')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit TECH4ED Center</h1>
            <a href="{{ route('tech4ed') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #003566; color: white;">
                <h6 class="m-0 font-weight-bold">TECH4ED Center Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('tech4ed.update', $tech4ed->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="congressional_district">Congressional District</label>
                                <input type="text" name="congressional_district" value="{{ $tech4ed->congressional_district }}" class="form-control" placeholder="Enter Congressional District" required>
                            </div>
                            <div class="form-group">
                                <label for="municipality">Municipality</label>
                                <input type="text" name="municipality" value="{{ $tech4ed->municipality }}" class="form-control" placeholder="Enter Municipality" required>
                            </div>
                            <div class="form-group">
                                <label for="specific_center_location">Specific Center Location</label>
                                <input type="text" name="specific_center_location" value="{{ $tech4ed->specific_center_location }}" class="form-control" placeholder="Enter Specific Center Location" required>
                            </div>
                            <div class="form-group">
                                <label for="center_name">Center Name</label>
                                <input type="text" name="center_name" value="{{ $tech4ed->center_name }}" class="form-control" placeholder="Enter Center Name" required>
                            </div>
                            <div class="form-group">
                                <label for="center_model">Center Model</label>
                                <select name="center_model" class="form-control" required>
                                    <option value="">Select Center Model</option>
                                    <option value="FITS" {{ $tech4ed->center_model == 'FITS' ? 'selected' : '' }}>FITS</option>
                                    <option value="LGU" {{ $tech4ed->center_model == 'LGU' ? 'selected' : '' }}>LGU</option>
                                    <option value="LIBRARY" {{ $tech4ed->center_model == 'LIBRARY' ? 'selected' : '' }}>LIBRARY</option>
                                    <option value="Negosyo Center" {{ $tech4ed->center_model == 'Negosyo Center' ? 'selected' : '' }}>Negosyo Center</option>
                                    <option value="NGA" {{ $tech4ed->center_model == 'NGA' ? 'selected' : '' }}>NGA</option>
                                    <option value="Private" {{ $tech4ed->center_model == 'Private' ? 'selected' : '' }}>Private</option>
                                    <option value="Provincial Training Center" {{ $tech4ed->center_model == 'Provincial Training Center' ? 'selected' : '' }}>Provincial Training Center</option>
                                    <option value="RIS" {{ $tech4ed->center_model == 'RIS' ? 'selected' : '' }}>RIS</option>
                                    <option value="School" {{ $tech4ed->center_model == 'School' ? 'selected' : '' }}>School</option>
                                    <option value="Mobile" {{ $tech4ed->center_model == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                                    <option value="BJMP" {{ $tech4ed->center_model == 'BJMP' ? 'selected' : '' }}>BJMP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cm_name">CM Name</label>
                                <input type="text" name="cm_name" value="{{ $tech4ed->cm_name }}" class="form-control" placeholder="Enter CM Name" required>
                            </div>
                            <div class="form-group">
                                <label for="cm_email">CM Email</label>
                                <input type="text" name="cm_email" value="{{ $tech4ed->cm_email }}" class="form-control" placeholder="Enter CM Email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cm_mobile">CM Mobile</label>
                                <input type="text" name="cm_mobile" value="{{ $tech4ed->cm_mobile }}" class="form-control" placeholder="Enter CM Mobile" required>
                            </div>
                            <div class="form-group">
                                <label for="cm_sex">CM Sex</label>
                                <select name="cm_sex" class="form-control" required>
                                    <option value="">Select CM Sex</option>
                                    <option value="Male" {{ $tech4ed->cm_sex == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $tech4ed->cm_sex == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="N/A" {{ $tech4ed->cm_sex == 'N/A' ? 'selected' : '' }}>N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_of_launching">Date of Launching</label>
                                <input type="date" name="date_of_launching" value="{{ $tech4ed->date_of_launching }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="operational">Operational</label>
                                <select name="operational" class="form-control" required>
                                    <option value="">Select Operational Status</option>
                                    <option value="Yes" {{ $tech4ed->operational == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $tech4ed->operational == 'No' ? 'selected' : '' }}>No</option>
                                    <option value="Unverified" {{ $tech4ed->operational == 'Unverified' ? 'selected' : '' }}>Unverified</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="with_donation">With Donation</label>
                                <select name="with_donation" class="form-control" required>
                                    <option value="">Select Donation Status</option>
                                    <option value="Yes" {{ $tech4ed->with_donation == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ $tech4ed->with_donation == 'No' ? 'selected' : '' }}>No</option>
                                    <option value="Unverified" {{ $tech4ed->with_donation == 'Unverified' ? 'selected' : '' }}>Unverified</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type_of_donation">Type of Donation</label>
                                <input type="text" name="type_of_donation" value="{{ $tech4ed->type_of_donation }}" class="form-control" placeholder="Enter Type of Donation (if any)">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn" style="background-color: #003566; color: white;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection