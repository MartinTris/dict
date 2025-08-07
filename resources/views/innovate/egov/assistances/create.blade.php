<!-- Add Assistance Modal -->
<div class="modal fade" id="addAssistanceModal" tabindex="-1" aria-labelledby="addAssistanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #003566; color: white;">
                <h5 class="modal-title" id="addAssistanceModalLabel">Add New eGov Assistance</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('egov-assistance.store') }}" method="POST" id="addAssistanceForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province') }}" required>
                            @error('province')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lgu" class="form-label">LGU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('lgu') is-invalid @enderror" id="lgu" name="lgu" value="{{ old('lgu') }}" required>
                            @error('lgu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name_of_requestee" class="form-label">Name of Requestee <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name_of_requestee') is-invalid @enderror" id="name_of_requestee" name="name_of_requestee" value="{{ old('name_of_requestee') }}" required>
                            @error('name_of_requestee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email_address" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email_address') is-invalid @enderror" id="email_address" name="email_address" value="{{ old('email_address') }}" required>
                            @error('email_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contact_no" class="form-label">Contact No.</label>
                            <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" name="contact_no" value="{{ old('contact_no') }}">
                            @error('contact_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="system" class="form-label">System <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('system') is-invalid @enderror" id="system" name="system" value="{{ old('system') }}" required>
                            @error('system')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="received_by" class="form-label">Received by <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('received_by') is-invalid @enderror" id="received_by" name="received_by" value="{{ old('received_by') }}" required>
                            @error('received_by')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Resolved" {{ old('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="concern" class="form-label">Concern <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('concern') is-invalid @enderror" id="concern" name="concern" rows="4" required>{{ old('concern') }}</textarea>
                            @error('concern')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white" style="background-color: #003566;">Save Assistance</button>
                </div>
            </form>
        </div>
    </div>
</div> 