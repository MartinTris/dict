@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Add New PNPKI Record</h1>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Create PNPKI Record</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pnpki.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_conducted">Date Conducted</label>
                                <input type="date" class="form-control @error('date_conducted') is-invalid @enderror" 
                                    id="date_conducted" name="date_conducted" value="{{ old('date_conducted') }}" required>
                                @error('date_conducted')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time_conducted">Time Conducted</label>
                                <input type="text" class="form-control @error('time_conducted') is-invalid @enderror" 
                                    id="time_conducted" name="time_conducted" value="{{ old('time_conducted') }}" 
                                    placeholder="e.g., 9:00 AM - 11:00 AM" required>
                                @error('time_conducted')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="organizer">Organizer</label>
                                <input type="text" class="form-control @error('organizer') is-invalid @enderror" 
                                    id="organizer" name="organizer" value="{{ old('organizer') }}" required>
                                @error('organizer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" 
                                    id="province" name="province" value="{{ old('province') }}" required>
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipality">Municipality</label>
                                <input type="text" class="form-control @error('municipality') is-invalid @enderror" 
                                    id="municipality" name="municipality" value="{{ old('municipality') }}" required>
                                @error('municipality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district">District</label>
                                <select class="form-control @error('district') is-invalid @enderror" 
                                    id="district" name="district" required>
                                    <option value="">Select District</option>
                                    <option value="1ST" {{ old('district') == '1ST' ? 'selected' : '' }}>1ST DISTRICT</option>
                                    <option value="2ND" {{ old('district') == '2ND' ? 'selected' : '' }}>2ND DISTRICT</option>
                                    <option value="3RD" {{ old('district') == '3RD' ? 'selected' : '' }}>3RD DISTRICT</option>
                                    <option value="4TH" {{ old('district') == '4TH' ? 'selected' : '' }}>4TH DISTRICT</option>
                                    <option value="5TH" {{ old('district') == '5TH' ? 'selected' : '' }}>5TH DISTRICT</option>
                                    <option value="6TH" {{ old('district') == '6TH' ? 'selected' : '' }}>6TH DISTRICT</option>
                                    <option value="7TH" {{ old('district') == '7TH' ? 'selected' : '' }}>7TH DISTRICT</option>
                                    <option value="8TH" {{ old('district') == '8TH' ? 'selected' : '' }}>8TH DISTRICT</option>
                                </select>
                                @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="activity_title">Activity Title</label>
                        <input type="text" class="form-control @error('activity_title') is-invalid @enderror" 
                            id="activity_title" name="activity_title" value="{{ old('activity_title') }}" required>
                        @error('activity_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type_of_activity">Type of Activity</label>
                                <select class="form-control @error('type_of_activity') is-invalid @enderror" 
                                    id="type_of_activity" name="type_of_activity" required>
                                    <option value="">Select Type</option>
                                    <option value="PNPKI Orientation" {{ old('type_of_activity') == 'PNPKI Orientation' ? 'selected' : '' }}>PNPKI Orientation</option>
                                    <option value="PNPKI Personnel Training" {{ old('type_of_activity') == 'PNPKI Personnel Training' ? 'selected' : '' }}>PNPKI Personnel Training</option>
                                    <option value="PNPKI User's Training" {{ old('type_of_activity') == "PNPKI User's Training" ? 'selected' : '' }}>PNPKI User's Training</option>
                                </select>
                                @error('type_of_activity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mode_of_implementation">Mode of Implementation</label>
                                <input type="text" class="form-control @error('mode_of_implementation') is-invalid @enderror" 
                                    id="mode_of_implementation" name="mode_of_implementation" value="{{ old('mode_of_implementation') }}" required>
                                @error('mode_of_implementation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="zoom_link">Zoom Link (Optional)</label>
                        <input type="text" class="form-control @error('zoom_link') is-invalid @enderror" 
                            id="zoom_link" name="zoom_link" value="{{ old('zoom_link') }}">
                        @error('zoom_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="male_participants">Number of Male Participants</label>
                                <input type="number" class="form-control @error('male_participants') is-invalid @enderror" 
                                    id="male_participants" name="male_participants" value="{{ old('male_participants', 0) }}" 
                                    min="0" required onchange="calculateTotal()">
                                @error('male_participants')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="female_participants">Number of Female Participants</label>
                                <input type="number" class="form-control @error('female_participants') is-invalid @enderror" 
                                    id="female_participants" name="female_participants" value="{{ old('female_participants', 0) }}" 
                                    min="0" required onchange="calculateTotal()">
                                @error('female_participants')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_participants">Total Participants</label>
                                <input type="number" class="form-control" id="total_participants" value="0" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="participant_details">Participant Details</label>
                        <textarea class="form-control @error('participant_details') is-invalid @enderror" 
                            id="participant_details" name="participant_details" rows="3" required>{{ old('participant_details') }}</textarea>
                        @error('participant_details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="resource_person">Resource Person</label>
                        <input type="text" class="form-control @error('resource_person') is-invalid @enderror" 
                            id="resource_person" name="resource_person" value="{{ old('resource_person') }}" required>
                        @error('resource_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fb_posting">FB Posting (Optional)</label>
                                <input type="text" class="form-control @error('fb_posting') is-invalid @enderror" 
                                    id="fb_posting" name="fb_posting" value="{{ old('fb_posting') }}">
                                @error('fb_posting')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="number_of_engagement">Number of Engagement (Optional)</label>
                                <input type="number" class="form-control @error('number_of_engagement') is-invalid @enderror" 
                                    id="number_of_engagement" name="number_of_engagement" value="{{ old('number_of_engagement') }}" min="0">
                                @error('number_of_engagement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="list_of_engaged_partners">List of Engaged Partners</label>
                        <textarea class="form-control @error('list_of_engaged_partners') is-invalid @enderror" 
                            id="list_of_engaged_partners" name="list_of_engaged_partners" rows="3" required>{{ old('list_of_engaged_partners') }}</textarea>
                        @error('list_of_engaged_partners')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn mr-2" style="background-color: #003566; color: white;">Save Record</button>
                        <a href="{{ route('pnpki') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function calculateTotal() {
            const male = parseInt(document.getElementById('male_participants').value) || 0;
            const female = parseInt(document.getElementById('female_participants').value) || 0;
            document.getElementById('total_participants').value = male + female;
        }
        
        // Calculate on page load
        window.onload = function() {
            calculateTotal();
        };
    </script>
@endsection