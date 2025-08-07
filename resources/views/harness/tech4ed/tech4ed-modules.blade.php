@extends('layouts.app')

@section('contents')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 font-weight-bold" style="color: #003566;">Tech4Ed Modules</h1>
            <button class="btn btn-sm text-white" style="background-color: #003566;" data-bs-toggle="modal"
                data-bs-target="#addModuleModal">
                <i class="fas fa-plus"></i> Add New Module
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Uploaded Modules</h6>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form method="GET" action="{{ route('tech4ed-modules.index') }}" class="mb-3">
                    <div class="row g-2 align-items-end">
                        <!-- Search Input -->
                        <div class="col-md-8 col-12">
                            <div class="input-group">
                                <input type="text" name="search" id="searchInput" class="form-control"
                                    placeholder="Search by title or file type..." value="{{ request('search') }}">
                                @if (request('search'))
                                    <a href="{{ route('tech4ed-modules.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn text-white" type="submit" style="background-color: #003566;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- File Type Filter -->
                        <div class="col-md-2 col-6">
                            <select name="file_type" id="filterFileType" class="form-select">
                                <option value="">All File Types</option>
                                <option value="pdf" {{ request('file_type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                <option value="ppt" {{ request('file_type') == 'ppt' ? 'selected' : '' }}>PPT</option>
                                <option value="pptx" {{ request('file_type') == 'pptx' ? 'selected' : '' }}>PPTX</option>
                                <option value="mp4" {{ request('file_type') == 'mp4' ? 'selected' : '' }}>MP4</option>
                                <option value="png" {{ request('file_type') == 'png' ? 'selected' : '' }}>PNG</option>
                                <option value="jpeg" {{ request('file_type') == 'jpeg' ? 'selected' : '' }}>JPEG</option>
                                <option value="jpg" {{ request('file_type') == 'jpg' ? 'selected' : '' }}>JPG</option>
                                <option value="xlsx" {{ request('file_type') == 'xlsx' ? 'selected' : '' }}>XLSX</option>
                            </select>
                        </div>

                        <!-- Sort By -->
                        <div class="col-md-2 col-6">
                            <select name="sort" id="filterSort" class="form-select">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First
                                </option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First
                                </option>
                                <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title A-Z
                                </option>
                                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title
                                    Z-A</option>
                            </select>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>Title</th>
                                <th>File Type</th>
                                <th>Uploaded</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr>
                                    <td>{{ $module->title }}</td>
                                    <td>{{ strtoupper($module->file_type) }}</td>
                                    <td>{{ $module->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" disabled style="margin-left:2px;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('tech4ed-modules.download', $module->id) }}"
                                            class="btn btn-sm btn-success"><i class="fas fa-download"></i></a>
                                        <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $module->id }}"
                                            data-title="{{ $module->title }}" data-bs-toggle="modal"
                                            data-bs-target="#editModuleModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $module->id }}" data-title="{{ $module->title }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                        <div class="text-muted small">
                            Showing {{ $modules->firstItem() }} to {{ $modules->lastItem() }} of {{ $modules->total() }}
                            results
                        </div>
                        <div>
                            {{ $modules->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Module Modal -->
    <div class="modal fade" id="addModuleModal" tabindex="-1" aria-labelledby="addModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addModuleForm" action="{{ route('tech4ed-modules.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModuleModalLabel">Add New Module</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload File</label>
                            <div id="dropZone" class="drop-zone">

                                <span id="dropZoneText">Drag & drop a file here or click to browse</span>
                                <input type="file" name="file" class="form-control" id="fileInput"
                                    accept=".mp4,.ppt,.pptx,.pdf,.png,.jpeg,.jpg,.xlsx" required hidden>
                            </div>
                            <!-- Allowed file types info -->
                            <small class="form-text text-muted mt-2 d-block">
                                Allowed file types: .mp4, .ppt, .pptx, .pdf, .png, .jpeg, .jpg, .xlsx
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Module Modal -->
    <div class="modal fade" id="editModuleModal" tabindex="-1" aria-labelledby="editModuleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editModuleForm" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModuleModalLabel">Edit Module</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-id">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Replace File (optional)</label>
                            <input type="file" name="file" class="form-control"
                                accept=".mp4,.ppt,.pptx,.pdf,.png,.jpeg,.jpg,.xlsx">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Styling -->
    <style>
        .drop-zone {
            border: 2px dashed #6c757d;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            position: relative;
            transition: background-color 0.2s ease;
        }

        .drop-zone:hover {
            background-color: #f8f9fa;
        }

        .drop-zone.dragover {
            background-color: #e9ecef;
            border-color: #007bff;
        }

        .drop-zone input[type="file"] {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        #searchInput {
            padding-right: 2.5rem;
        }

        .custom-search-btn {
            flex: 0 0 auto;
            padding: 0.375rem 0.9rem;
            background-color: #003566;
            color: white;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-item .page-link {
            color: #003566;
            border-radius: 6px;
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background-color: #003566;
            border-color: #003566;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #aaa;
        }

        /* Ensure proper alignment */
        .table th,
        .table td {
            white-space: nowrap;
            vertical-align: middle;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            form.mb-3 .row {
                flex-direction: column;
                gap: 0.5rem;
            }

            .input-group {
                width: 100% !important;
            }

            .card-header .btn {
                width: 100%;
            }

            .card-header h6 {
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Success message handling
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif

        // Error message handling
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        @endif

        // Edit button functionality
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const title = this.dataset.title;

                const form = document.getElementById('editModuleForm');
                form.action = `/tech4ed-modules/${id}`;

                document.getElementById('edit-title').value = title;
            });
        });

        // Delete confirmation with SweetAlert
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const title = this.dataset.title;

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Do you want to delete "${title}"? This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create and submit delete form
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/tech4ed-modules/${id}`;

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';

                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';

                        form.appendChild(csrfToken);
                        form.appendChild(methodField);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });

        // Form submission with SweetAlert loading
        document.getElementById('addModuleForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            submitBtn.disabled = true;
        });

        document.getElementById('editModuleForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
            submitBtn.disabled = true;
        });

        // Auto-submit form when filters change
        document.getElementById('filterFileType').addEventListener('change', function() {
            this.closest('form').submit();
        });

        document.getElementById('filterSort').addEventListener('change', function() {
            this.closest('form').submit();
        });

        // Download confirmation
        document.querySelectorAll('a[href*="/download"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');

                Swal.fire({
                    title: 'Download File',
                    text: 'Are you sure you want to download this file?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, download!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const dropZoneText = document.getElementById('dropZoneText');

        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');

            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                dropZoneText.textContent = e.dataTransfer.files[0].name;
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) {
                dropZoneText.textContent = fileInput.files[0].name;
            }
        });
    </script>
@endsection
