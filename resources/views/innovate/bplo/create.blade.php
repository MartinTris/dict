@extends('layouts.app')
@section('contents')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 font-weight-bold" style="color: #003566;">Add New BPLO Record</h1>
        <a href="{{ route('bplo') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong> Please check the form below for errors.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: #003566;">BPLO Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('bplo.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" name="province" class="form-control" placeholder="Province" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="municipality_city">Municipality/City</label>
                            <input type="text" name="municipality_city" class="form-control" placeholder="Municipality/City" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bpco_status">BPCO STATUS</label>
                            <select name="bpco_status" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="ON GOING DATA BUILD UP">ON GOING DATA BUILD UP</option>
                                <option value="FOR PILOT TESTING">FOR PILOT TESTING</option>
                                <option value="ETRACS/Others">ETRACS/Others</option>
                                <option value="OPERATIONAL">OPERATIONAL</option>
                                <option value="PENDING">PENDING</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="form-control" placeholder="Remarks"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="congressional_district">CONGRESSIONAL DISTRICT</label>
                            <select name="congressional_district" class="form-control" required>
                                <option value="">Select District</option>
                                <option value="1ST DISTRICT">1ST DISTRICT</option>
                                <option value="2ND DISTRICT">2ND DISTRICT</option>
                                <option value="3RD DISTRICT">3RD DISTRICT</option>
                                <option value="4TH DISTRICT">4TH DISTRICT</option>
                                <option value="5TH DISTRICT">5TH DISTRICT</option>
                                <option value="6TH DISTRICT">6TH DISTRICT</option>
                                <option value="7TH DISTRICT">7TH DISTRICT</option>
                                <option value="8TH DISTRICT">8TH DISTRICT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="income_class">INCOME CLASS</label>
                            <select name="income_class" class="form-control" required>
                                <option value="">Select Income Class</option>
                                <option value="CITY">CITY</option>
                                <option value="1st Class">1st Class</option>
                                <option value="2nd Class">2nd Class</option>
                                <option value="3rd Class">3rd Class</option>
                                <option value="4th Class">4th Class</option>
                                <option value="5th Class">5th Class</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="text-right">
                        <button type="submit" class="btn" style="background-color: #003566; color: white;">
                            <i class="fas fa-save mx-1"></i> Submit
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection