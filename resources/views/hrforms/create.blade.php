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

                    <div class="col-md-6 position-relative">
                        <label>Category</label>
                        <div class="dropdown">
                            <button class="btn btn-light border w-100 d-flex justify-content-between align-items-center"
                                    type="button" id="dropdownCategoryBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                <span id="selectedCategoryText">Select Category</span>
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownCategoryBtn" id="categoryDropdown">
                                @foreach ($categories as $category)
                                    <li class="d-flex justify-content-between align-items-center px-3">
                                        <span class="category-option"
                                              data-id="{{ $category->id }}">{{ $category->name }}</span>
                                        <button type="button" class="btn btn-sm text-danger delete-category"
                                                data-id="{{ $category->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </li>
                                @endforeach
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-primary" href="#" id="addNewCategoryBtn">+ Add
                                        New Category</a></li>
                            </ul>
                        </div>
                        <input type="hidden" name="category_id" id="selectedCategoryId" required>
                    </div>
                    <div class="col-md-6">
                        <label>Upload Form File</label>
                        <div id="dropZone" class="drop-zone position-relative">
                            <span id="dropZoneText">Drag & drop a file here or click to browse</span>
                            <input type="file" name="file_path" class="form-control file-input" id="fileInput"
                                   accept=".doc,.docx,.jpeg,.xls,.xlsx,.pdf,.png" required>
                        </div>
                        <!-- Allowed file types info -->
                        <small class="form-text text-muted">Allowed file types: .doc, .docx, .jpeg, .pdf, .png, .xls,
                            .xlsx</small>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn" id="submitFormBtn" style="background-color: #003566; color: white;">
                        <i class="fas fa-save mx-1"></i> Save Form
                    </button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
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

        // Select category
        $(document).on('click', '.category-option', function () {
            const id = $(this).data('id');
            const name = $(this).text();
            $('#selectedCategoryId').val(id);
            $('#selectedCategoryText').text(name);
        });

        // Delete category
        $(document).on('click', '.delete-category', function (e) {
            e.stopPropagation();
            const id = $(this).data('id');
            const name = $(this).siblings('.category-option').text();

            Swal.fire({
                title: 'Are you sure?',
                html: `Delete category <strong>${name}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/hr-forms/categories/${id}`,
                        type: 'DELETE',
                        success: function () {
                            $(`#categoryDropdown .category-option[data-id="${id}"]`)
                                .closest('li').remove();
                            if ($('#selectedCategoryId').val() == id) {
                                $('#selectedCategoryId').val('');
                                $('#selectedCategoryText').text('Select Category');
                            }
                            Swal.fire('Deleted!', 'Category removed.', 'success');
                        },
                        error: function () {
                            Swal.fire('Error', 'Failed to delete category.',
                                'error');
                        }
                    });
                }
            });
        });

        // Open modal for new category
        $('#addNewCategoryBtn').on('click', function (e) {
            e.preventDefault();
            $('#addCategoryModal').modal('show');
        });

        // Submit new category AJAX (without page reload)
        $('#addCategoryForm').on('submit', function (e) {
            e.preventDefault();
            const categoryName = $('input[name="name"]', this).val();

            $.ajax({
                url: "{{ route('hrforms.categories.store') }}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: categoryName
                },
                success: function (res) {
                    // Add new category to dropdown
                    const newItem = `
                        <li class="d-flex justify-content-between align-items-center px-3">
                            <span class="category-option" data-id="${res.id}">${res.name}</span>
                            <button type="button" class="btn btn-sm text-danger delete-category" data-id="${res.id}">
                                <i class="fas fa-times"></i>
                            </button>
                        </li>
                    `;
                    $('#categoryDropdown').prepend(newItem);

                    // Auto-select the new category
                    $('#selectedCategoryId').val(res.id);
                    $('#selectedCategoryText').text(res.name);

                    // Close modal and reset form
                    $('#addCategoryModal').modal('hide');
                    $('#addCategoryForm')[0].reset();

                    // Show success message
                    Swal.fire('Success!', 'Category added successfully.', 'success');
                },
                error: function (xhr) {
                    Swal.fire('Error', 'Failed to add category.', 'error');
                    console.log(xhr.responseText);
                }
            });
        });

        // Prevent form submission if category not selected
        $('#addFormForm').on('submit', function (e) {
            const categoryId = $('#selectedCategoryId').val();
            if (!categoryId) {
                e.preventDefault();
                Swal.fire('Warning', 'Please select a category before uploading.', 'warning');
                return false;
            }
        });

        // Drag & Drop functionality for file upload
        const dropZone = $('#dropZone');
        const fileInput = $('#fileInput');
        const dropZoneText = $('#dropZoneText');

        dropZone.on('dragover', function (e) {
            e.preventDefault();
            dropZone.addClass('drop-zone--active');
            dropZoneText.text('Release to upload file');
        });

        dropZone.on('dragleave dragend drop', function (e) {
            e.preventDefault();
            dropZone.removeClass('drop-zone--active');
            dropZoneText.text('Drag & drop a file here or click to browse');
        });

        dropZone.on('drop', function (e) {
            e.preventDefault();
            const files = e.originalEvent.dataTransfer.files;
            if (files.length) {
                fileInput[0].files = files;
                dropZoneText.text(files[0].name);
            }
        });

        fileInput.on('change', function () {
            if (fileInput[0].files.length) {
                dropZoneText.text(fileInput[0].files[0].name);
            } else {
                dropZoneText.text('Drag & drop a file here or click to browse');
            }
        });
    });
</script>

<style>
    .drop-zone {
        border: 2px dashed #87939e;
        border-radius: 8px;
        padding: 30px 10px;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s;
        background: #f8f9fa;
        position: relative;
    }

    .drop-zone--active {
        border-color: #0d6efd;
        background: #e9f5ff;
    }

    .drop-zone .file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    #categoryDropdown li {
        cursor: pointer;
    }

    #categoryDropdown li:hover {
        background-color: #f1f1f1;
    }
</style>
