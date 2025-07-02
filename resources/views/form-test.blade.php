<!-- Include Bootstrap 5 CDN -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<select id="region" name="region_id" class="form-select mb-2">
    <option value="">Select Region</option>
    @foreach ($regions as $region)
        <option value="{{ $region->id }}">{{ $region->region_code }}</option>
    @endforeach
</select>

<select id="province" name="province_id" class="form-select mb-2" disabled>
    <option value="">Select Province</option>
</select>

<select id="district" name="district_id" class="form-select mb-2" disabled>
    <option value="">Select District</option>
    <option value="add_new_district">+ Add New District</option>
</select>

<select id="locality" name="locality_id" class="form-select mb-2" disabled>
    <option value="">Select Locality</option>
    <option value="add_new_locality">+ Add New Locality</option>
</select>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#region').on('change', function () {
        let regionId = $(this).val();
        $('#province').html('<option value="">Loading...</option>').prop('disabled', true);
        $('#district, #locality').html('<option value="">Select</option>').prop('disabled', true);

        if (regionId) {
            $.get(`/get-provinces/${regionId}`, function (data) {
                $('#province').html('<option value="">Select Province</option>');
                $.each(data, function (key, value) {
                    $('#province').append(`<option value="${value.id}">${value.province_name}</option>`);
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
                $.each(data, function (key, value) {
                    $('#district').append(`<option value="${value.id}">${value.district_name}</option>`);
                });
                $('#district').append(`<option value="add_new_district">+ Add New District</option>`);
                $('#district').prop('disabled', false);
            });
        }
    });

    $('#district').on('change', function () {
        let districtId = $(this).val();

        if (districtId === 'add_new_district') {
            $('#addDistrictModal').modal('show');
            $(this).val('');
            return;
        }

        $('#locality').html('<option value="">Loading...</option>').prop('disabled', true);
        $('#localityDistrictId').val(districtId);

        if (districtId) {
            $.get(`/get-localities/${districtId}`, function (data) {
                $('#locality').html('<option value="">Select Locality</option>');
                $.each(data, function (key, value) {
                    $('#locality').append(`<option value="${value.id}">${value.locality_name}</option>`);
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