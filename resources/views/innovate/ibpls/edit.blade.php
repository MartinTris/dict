@extends('layouts.app')

@section('title', 'Edit IBPLS Record')

@section('contents')
<div class="container-fluid">
    <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('ibpls') }}" class="btn btn-sm btn-secondary" style="background-color:#6a84a0; border:none">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    <div class="card shadow">
        <div class="card-header" style="background-color: #003566; color: white;">
            <h5 class="m-0 font-weight-bold">Edit IBPLS Record</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('ibpls.update', $ibpls->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                        id="location" name="location" value="{{ old('location', $ibpls->location) }}" required>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" class="form-control @error('district') is-invalid @enderror" 
                        id="district" name="district" value="{{ old('district', $ibpls->district) }}" required>
                    @error('district')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="operation">Operation</label>
                    <select class="form-control @error('operation') is-invalid @enderror" 
                        id="operation" name="operation" required>
                        <option value="">Select Operation</option>
                        <option value="Operational" {{ old('operation', $ibpls->operation) == 'Operational' ? 'selected' : '' }}>Operational</option>
                        <option value="ETRACS/Others" {{ old('operation', $ibpls->operation) == 'ETRACS/Others' ? 'selected' : '' }}>ETRACS/Others</option>
                        <option value="Ongoing eLGU V2" {{ old('operation', $ibpls->operation) == 'Ongoing eLGU V2' ? 'selected' : '' }}>Ongoing eLGU V2</option>
                    </select>
                    @error('operation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" 
                        id="status" name="status">
                        <option value="">Select Status (Optional)</option>
                        <option value="Integrated" {{ old('status', $ibpls->status) == 'Integrated' ? 'selected' : '' }}>Integrated</option>
                        <option value="Pending" {{ old('status', $ibpls->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="text-right">
                        <button type="submit" class="btn" style="background-color: #003566; color: white;">
                            <i class="fas fa-save mx-1"></i> Update
                        </button>
                        <a href="{{ route('ibpls') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection