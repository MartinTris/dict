@extends('layouts.app')
  
@section('contents')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add TECH4ED Center</h1>
            <a href="{{ route('tech4ed') }}" class="btn btn-sm btn-secondary" style="background-color:#6a84a0; border:none">
                <i class="fas fa-arrow-left"></i> Back to List
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
                <form action="{{ route('tech4ed.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="congressional_district">Congressional District</label>
                                <input type="text" name="congressional_district" class="form-control" placeholder="Enter Congressional District" required>
                            </div>
                            <div class="form-group">
                                <label for="municipality">Municipality</label>
                                <input type="text" name="municipality" class="form-control" placeholder="Enter Municipality" required>
                            </div>
                            <div class="form-group">
                                <label for="specific_center_location">Specific Center Location</label>
                                <input type="text" name="specific_center_location" class="form-control" placeholder="Enter Specific Center Location" required>
                            </div>
                            <div class="form-group">
                                <label for="center_name">Center Name</label>
                                <input type="text" name="center_name" class="form-control" placeholder="Enter Center Name" required>
                            </div>
                            <div class="form-group">
                                <label for="center_model">Center Model</label>
                                <select name="center_model" class="form-control" required>
                                    <option value="">Select Center Model</option>
                                    <option value="FITS">FITS</option>
                                    <option value="LGU">LGU</option>
                                    <option value="LIBRARY">LIBRARY</option>
                                    <option value="Negosyo Center">Negosyo Center</option>
                                    <option value="NGA">NGA</option>
                                    <option value="Private">Private</option>
                                    <option value="Provincial Training Center">Provincial Training Center</option>
                                    <option value="RIS">RIS</option>
                                    <option value="School">School</option>
                                    <option value="Mobile">Mobile</option>
                                    <option value="BJMP">BJMP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cm_name">CM Name</label>
                                <input type="text" name="cm_name" class="form-control" placeholder="Enter CM Name" required>
                            </div>
                            <div class="form-group">
                                <label for="cm_email">CM Email</label>
                                <input type="text" name="cm_email" class="form-control" placeholder="Enter CM Email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cm_mobile">CM Mobile</label>
                                <input type="text" name="cm_mobile" class="form-control" placeholder="Enter CM Mobile" required>
                            </div>
                            <div class="form-group">
                                <label for="cm_sex">CM Sex</label>
                                <select name="cm_sex" class="form-control" required>
                                    <option value="">Select CM Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_of_launching">Date of Launching</label>
                                <input type="date" name="date_of_launching" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="operational">Operational</label>
                                <select name="operational" class="form-control" required>
                                    <option value="">Select Operational Status</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Unverified">Unverified</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="with_donation">With Donation</label>
                                <select name="with_donation" class="form-control" required>
                                    <option value="">Select Donation Status</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Unverified">Unverified</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type_of_donation">Type of Donation</label>
                                <input type="text" name="type_of_donation" class="form-control" placeholder="Enter Type of Donation (if any)">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <button type="submit" class="btn" style="background-color: #003566; color: white;">
                            <i class="fas fa-save mx-1"></i> Save Record
                        </button>
                        <a href="{{ route('pnpki') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection