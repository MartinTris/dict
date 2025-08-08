<div class="modal fade" id="editSiteModal" tabindex="-1" aria-labelledby="editSiteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="editSiteForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="fw4a_id" id="edit_fw4a_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Site</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3 px-4">
                    <div class="col-md-3">
                        <label>Site Code</label>
                        <input type="text" name="site_code" id="edit_site_code" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>AP MAC Address</label>
                        <input type="text" name="ap_mac_address" id="edit_ap_mac_address" class="form-control"
                            required>
                    </div>
                    <div class="col-md-5">
                        <label>Site Name</label>
                        <input type="text" name="site_name" id="edit_site_name" class="form-control" required>
                    </div>

                    <!-- Region -->
                    <div class="col-md-3">
                        <label>Region</label>
                        <select name="region_id" id="edit_region" class="form-select" required>
                            <option value="">Select Region</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->region_code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Province -->
                    <div class="col-md-3">
                        <label>Province</label>
                        <select name="province_id" id="edit_province" class="form-select" required>
                            <option value="">Select Province</option>
                        </select>
                    </div>

                    <!-- District -->
                    <div class="col-md-3">
                        <label>District</label>
                        <select name="district_id" id="edit_district" class="form-select" required>
                            <option value="">Select District</option>
                        </select>
                    </div>

                    <!-- Locality -->
                    <div class="col-md-3">
                        <label>Locality</label>
                        <select name="locality_id" id="edit_locality" class="form-select" required>
                            <option value="">Select Locality</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Contract Status</label>
                        <input type="text" name="contract_status" id="edit_contract_status" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Contract</label>
                        <input type="text" name="contract" id="edit_contract" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Category</label>
                        <input type="text" name="category" id="edit_category" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Contractor</label>
                        <input type="text" name="contractor" id="edit_contractor" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Latitude</label>
                        <input type="text" name="latitude" id="edit_latitude" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Longitude</label>
                        <input type="text" name="longitude" id="edit_longitude" class="form-control">
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="submit" class="btn" style="background-color: #003566; color: white;">
                        <i class="fas fa-save mx-1"></i> Update Site
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
