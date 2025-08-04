<div class="modal fade" id="addFormModal" tabindex="-1" aria-labelledby="addFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="addFormForm" method="POST" action="{{ route('hrforms.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload New Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3 px-4">
                    <div class="col-md-6">
                        <label>Form Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" id="categorySelect" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            <option value="add_new_category">+ Add New Category</option>
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label>Upload Form File</label>
                        <input type="file" name="file_path" class="form-control" required
                            accept=".doc,.docx,.jpeg,.xls,.xlsx">
                        <small class="form-text text-muted">Allowed file types: .doc, .docx, .jpeg, .pdf, .png, .xls,
                            .xlsx</small>
                    </div>

                </div>
                <div class="modal-footer px-4">
                    <button type="submit" class="btn btn-primary"
                        style="background-color: #003566; border-color: #003566;">
                        Save Form
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addCategoryForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Enter Category Name" required>
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
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#categorySelect').on('change', function () {
            if ($(this).val() === 'add_new_category') {
                $('#addCategoryModal').modal('show');
                $(this).val('');
            }
        });

        $('#addCategoryForm').on('submit', function (e) {
            e.preventDefault();
            $.post("{{ route('hrforms.categories.store') }}", $(this).serialize(), function (res) {
                $('#categorySelect').append(`<option value="${res.id}" selected>${res.name}</option>`);
                $('#addCategoryModal').modal('hide');
                $('#addCategoryForm')[0].reset();
            }).fail(function (err) {
                alert('Error adding category.');
            });
        });
    });
</script>