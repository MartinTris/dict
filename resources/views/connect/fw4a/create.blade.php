<div class="modal fade" id="addSiteModal" tabindex="-1" aria-labelledby="addSiteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="addSiteForm" method="POST" action="{{ route('fw4a.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Site</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3 px-4">
                    <div class="col-md-6">
                        <label>Site Code</label>
                        <input type="text" name="site_code" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Site Name</label>
                        <input type="text" name="site_name" class="form-control" required>
                    </div>
                    <!-- Region -->
                    <div class="col-md-3">
                        <label>Region</label>
                        <select name="region_id" id="region" class="form-select" required>
                            <option value="">Select Region</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->region_code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Province -->
                    <div class="col-md-3">
                        <label>Province</label>
                        <select name="province_id" id="province" class="form-select" required disabled>
                            <option value="">Select Province</option>
                        </select>
                    </div>

                    <!-- District -->
                    <div class="col-md-3">
                        <label>District</label>
                        <select name="district_id" id="district" class="form-select" required disabled>
                            <option value="">Select District</option>
                            <option value="add_new_district">+ Add New District</option>
                        </select>
                    </div>

                    <!-- Locality -->
                    <div class="col-md-3">
                        <label>Locality</label>
                        <select name="locality_id" id="locality" class="form-select" required disabled>
                            <option value="">Select Locality</option>
                            <option value="add_new_locality">+ Add New Locality</option>
                        </select>
                    </div>


                    <div class="col-md-4">
                        <label>Contract Status</label>
                        <select name="contract_status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="terminated">Terminated</option>
                            <option value="for renewal">For Renewal</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Contract</label>
                        <select name="contract_id" class="form-select" required>
                            @foreach($contracts as $contract)
                                <option value="{{ $contract->id }}">{{ $contract->contract_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Category</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Contractor</label>
                        <select name="contractor_id" class="form-select" required>
                            @foreach($contractors as $contractor)
                                <option value="{{ $contractor->id }}">{{ $contractor->contractor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="submit" class="btn btn-primary" style="background-color: #003566; border-color: #003566;">
    Save Site
</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- District Modal -->
<div class="modal fade" id="addDistrictModal" tabindex="-1" aria-labelledby="addDistrictLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addDistrictForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDistrictLabel">Add New District</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" name="district_name" class="form-control" placeholder="Enter District Name"
                            required>
                        <input type="hidden" name="province_id" id="districtProvinceId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Locality Modal -->
<div class="modal fade" id="addLocalityModal" tabindex="-1" aria-labelledby="addLocalityLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addLocalityForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLocalityLabel">Add New Locality</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" name="locality_name" class="form-control" placeholder="Enter Locality Name"
                            required>
                        <input type="hidden" name="district_id" id="localityDistrictId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#region').on('change', function () {
            let regionId = $(this).val();
            $('#province').html('<option value="">Loading...</option>').prop('disabled', true);
            $('#district').html('<option value="">Select District</option>').prop('disabled', true);
            $('#locality').html('<option value="">Select Locality</option>').prop('disabled', true);

            if (regionId) {
                $.get(`/get-provinces/${regionId}`, function (data) {
                    $('#province').html('<option value="">Select Province</option>');
                    data.forEach(p => {
                        $('#province').append(`<option value="${p.id}">${p.province_name}</option>`);
                    });
                    $('#province').prop('disabled', false);
                });
            }
        });

        $('#province').on('change', function () {
            let provinceId = $(this).val();
            $('#district').html('<option value="">Loading...</option>').prop('disabled', true);
            $('#locality').html('<option value="">Select Locality</option>').prop('disabled', true);

            if (provinceId) {
                $('#districtProvinceId').val(provinceId);
                $.get(`/get-districts/${provinceId}`, function (data) {
                    $('#district').html('<option value="">Select District</option>');
                    data.forEach(d => {
                        $('#district').append(`<option value="${d.id}">${d.district_name}</option>`);
                    });
                    $('#district').append(`<option value="add_new_district">+ Add New District</option>`);
                    $('#district').prop('disabled', false);
                });
            }
        });

        $('#district').on('change', function () {
            let districtId = $(this).val();
            $('#localityDistrictId').val(districtId);

            if (districtId === 'add_new_district') {
                $('#addDistrictModal').modal('show');
                $(this).val('');
                return;
            }

            if (districtId) {
                $.get(`/get-localities/${districtId}`, function (data) {
                    $('#locality').html('<option value="">Select Locality</option>');
                    data.forEach(l => {
                        $('#locality').append(`<option value="${l.id}">${l.locality_name}</option>`);
                    });
                    $('#locality').append(`<option value="add_new_locality">+ Add New Locality</option>`);
                    $('#locality').prop('disabled', false);
                });
            }
        });

        $('#locality').on('change', function () {
            if ($(this).val() === 'add_new_locality') {
                $('#addLocalityModal').modal('show');
                $(this).val('');
            }
        });

        $('#addDistrictForm').on('submit', function (e) {
            e.preventDefault();
            $.post('/districts', $(this).serialize(), function (res) {
                $('#district').append(`<option value="${res.id}">${res.district_name}</option>`);
                $('#district').val(res.id);
                $('#addDistrictModal').modal('hide');
                $('#addDistrictForm')[0].reset();
            });
        });

        $('#addLocalityForm').on('submit', function (e) {
            e.preventDefault();
            $.post('/localities', $(this).serialize(), function (res) {
                $('#locality').append(`<option value="${res.id}">${res.locality_name}</option>`);
                $('#locality').val(res.id);
                $('#addLocalityModal').modal('hide');
                $('#addLocalityForm')[0].reset();
            });
        });
    </script>
@endsection