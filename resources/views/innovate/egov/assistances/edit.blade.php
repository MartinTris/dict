<!-- Edit Assistance Modal -->
<div class="modal fade" id="editAssistanceModal" tabindex="-1" aria-labelledby="editAssistanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #003566; color: white;">
                <h5 class="modal-title" id="editAssistanceModalLabel">Edit eGov Assistance</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editAssistanceForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_assistance_id" name="assistance_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="edit_date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="edit_date" name="date" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_province" class="form-label">Province <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('province') is-invalid @enderror" id="edit_province" name="province" required>
                            @error('province')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_lgu" class="form-label">LGU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('lgu') is-invalid @enderror" id="edit_lgu" name="lgu" required>
                            @error('lgu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_name_of_requestee" class="form-label">Name of Requestee <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name_of_requestee') is-invalid @enderror" id="edit_name_of_requestee" name="name_of_requestee" required>
                            @error('name_of_requestee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_email_address" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email_address') is-invalid @enderror" id="edit_email_address" name="email_address">
                            @error('email_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_contact_no" class="form-label">Contact No.</label>
                            <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="edit_contact_no" name="contact_no">
                            @error('contact_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_system" class="form-label">System <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('system') is-invalid @enderror" id="edit_system" name="system" required>
                            @error('system')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_received_by" class="form-label">Received by <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('received_by') is-invalid @enderror" id="edit_received_by" name="received_by" required>
                            @error('received_by')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="edit_status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Closed">Closed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="edit_concern" class="form-label">Concern</label>
                            <textarea class="form-control @error('concern') is-invalid @enderror" id="edit_concern" name="concern" rows="4"></textarea>
                            @error('concern')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white" style="background-color: #003566;">Update Assistance</button>
                </div>
            </form>
        </div>
    </div>
</div> 