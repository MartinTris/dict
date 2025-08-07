<!-- Add Orientation Modal -->
<div class="modal fade" id="addOrientationModal" tabindex="-1" aria-labelledby="addOrientationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #003566; color: white;">
                <h5 class="modal-title" id="addOrientationModalLabel">Add New eGov Orientation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('egov-orientation.store') }}" method="POST" id="addOrientationForm">
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
                            <label for="training_control_no" class="form-label">Training Control No.</label>
                            <input type="text" class="form-control @error('training_control_no') is-invalid @enderror" id="training_control_no" name="training_control_no" value="{{ old('training_control_no') }}">
                            @error('training_control_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="event_name" class="form-label">Event Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" value="{{ old('event_name') }}" required>
                            @error('event_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="event_type" class="form-label">Event Type</label>
                            <input type="text" class="form-control @error('event_type') is-invalid @enderror" id="event_type" name="event_type" value="{{ old('event_type') }}" placeholder="e.g., Training, Workshop, Seminar">
                            @error('event_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="venue" class="form-label">Venue <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('venue') is-invalid @enderror" id="venue" name="venue" value="{{ old('venue') }}" required>
                            @error('venue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="participants" class="form-label">Participants <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('participants') is-invalid @enderror" id="participants" name="participants" value="{{ old('participants') }}" required>
                            @error('participants')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province') }}" required>
                            @error('province')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="municipality" class="form-label">Municipality <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('municipality') is-invalid @enderror" id="municipality" name="municipality" value="{{ old('municipality') }}" required>
                            @error('municipality')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mode" class="form-label">Mode <span class="text-danger">*</span></label>
                            <select class="form-select @error('mode') is-invalid @enderror" id="mode" name="mode" required>
                                <option value="">Select Mode</option>
                                <option value="Online" {{ old('mode') == 'Online' ? 'selected' : '' }}>Online</option>
                                <option value="Face to Face" {{ old('mode') == 'Face to Face' ? 'selected' : '' }}>Face to Face</option>
                            </select>
                            @error('mode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status') }}" required>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="no_of_attendees" class="form-label">No. of Attendees <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_of_attendees') is-invalid @enderror" id="no_of_attendees" name="no_of_attendees" value="{{ old('no_of_attendees') }}" required>
                            @error('no_of_attendees')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_of_downloaded_and_verified" class="form-label">No. of Downloaded & Verified <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_of_downloaded_and_verified') is-invalid @enderror" id="no_of_downloaded_and_verified" name="no_of_downloaded_and_verified" value="{{ old('no_of_downloaded_and_verified') }}" required>
                            @error('no_of_downloaded_and_verified')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="male" class="form-label">Male <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('male') is-invalid @enderror" id="male" name="male" value="{{ old('male') }}" required>
                            @error('male')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="female" class="form-label">Female <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('female') is-invalid @enderror" id="female" name="female" value="{{ old('female') }}" required>
                            @error('female')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="https://example.com">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white" style="background-color: #003566;">Save Orientation</button>
                </div>
            </form>
        </div>
    </div>
</div> 