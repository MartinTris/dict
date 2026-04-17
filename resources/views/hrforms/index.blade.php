@extends('layouts.app')
@include('hrforms.create')
@include('hrforms.preview')
@push('styles')
    <style>
        .accordion-button {
            transition: background-color 0.1s ease;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: nowrap;
        }

        .action-buttons .btn {
            min-width: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
        }

        .btn i {
            margin-right: 0 !important;
        }

        @media (max-width: 576px) {
            .action-buttons {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
        }

        [data-tooltip] {
            position: relative;
            cursor: pointer;
        }

        [data-tooltip]::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 125%;
            /* Show above the element */
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.75);
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            white-space: nowrap;
            font-size: 12px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            z-index: 9999;
        }

        [data-tooltip]:hover::after {
            opacity: 1;
        }

        /* Search and Filter Styling */
        #searchInput {
            padding-right: 2.5rem;
        }

        .custom-search-btn {
            flex: 0 0 auto;
            padding: 0.375rem 0.9rem;
            background-color: #003566;
            color: white;
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
        }

        /* Pagination Styling */
        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-link {
            color: #003566;
            border-color: #dee2e6;
        }

        .pagination .page-item.active .page-link {
            background-color: #003566;
            border-color: #003566;
        }

        .pagination .page-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: #6c757d;
        }

        /* Accordion badge styling */
        .accordion-button .badge {
            font-size: 0.75rem;
        }
    </style>
@endpush
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">HR Forms Library</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    Something went wrong.
                    {{--@foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach--}}
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Downloadable Forms</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-sm text-white" data-bs-toggle="modal"
                        data-bs-target="#addFormModal" style="background-color: #003566;">
                        <i class="fas fa-plus"></i> Upload New Forms
                    </button>
                </div>
            </div>

            <div class="card-body">
                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('hrforms.index') }}" class="mb-3">
                    <div class="row g-2 align-items-end">
                        <!-- Search Input -->
                        <div class="col-md-6 col-12">
                            <div class="input-group">
                                <input type="text" name="search" id="searchInput" class="form-control"
                                    placeholder="Search by file name..." value="{{ request('search') }}">
                                @if (request('search'))
                                    <a href="{{ route('hrforms.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn text-white" type="submit" style="background-color: #003566;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="col-md-3 col-12">
                            <select name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Per Page Selector -->
                        <div class="col-md-3 col-12">
                            <select name="per_page" class="form-select">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 per page</option>
                                <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10 per page</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 per page</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                            </select>
                        </div>
                    </div>
                </form>

                <div class="accordion" id="hrFormsAccordion">
                    @foreach ($filteredCategories as $category)
                        @php
                            $categoryForms = $paginatedForms[$category->id] ?? null;
                        @endphp
                        @if($categoryForms && $categoryForms->count() > 0)
                            <div class="accordion-item mb-3 border">
                                <h2 class="accordion-header" id="heading{{ $category->id }}">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $category->id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $category->id }}">
                                        {{ $category->name }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $category->id }}" data-bs-parent="#hrFormsAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-group">
                                            @foreach ($categoryForms as $form)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    @php
                                                        $extension = pathinfo($form->file_path, PATHINFO_EXTENSION);
                                                    @endphp
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span>{{ $form->title }}</span>
                                                        <span class="badge bg-secondary text-uppercase">{{ $extension }}</span>
                                                    </div>
                                                    <div class="action-buttons">
                                                        <button type="button" data-tooltip="Preview form"
                                                            class="btn btn-sm btn-primary preview-btn" data-title="{{ $form->title }}"
                                                            data-file="{{ asset('storage/' . $form->file_path) }}"
                                                            data-bs-toggle="modal" data-bs-target="#previewModal"
                                                            style="background-color: #5076a8; border-color: #5076a8;">
                                                            <i class="fas fa-eye"></i>
                                                        </button>

                                                        <a href="{{ route('hrforms.download', $form->id) }}"
                                                            data-tooltip="Download file" class="btn btn-sm btn-success"
                                                            style="background-color: #003566;">
                                                            <i class="fas fa-download"></i>
                                                        </a>

                                                        <form action="{{ route('hrforms.destroy', $form->id) }}" method="POST"
                                                            class="d-inline delete-form m-0 p-0"
                                                            style="display: flex; align-items: center;">
                                                            @csrf @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                                data-tooltip="Delete file">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <!-- Pagination for this category -->
                                        @if($categoryForms->hasPages())
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div class="pagination-info">
                                                    Showing {{ $categoryForms->firstItem() ?? 0 }} to {{ $categoryForms->lastItem() ?? 0 }} of {{ $categoryForms->total() }} results
                                                </div>
                                                <nav aria-label="Pagination for {{ $category->name }}">
                                                    {{ $categoryForms->appends(request()->query())->links('pagination::bootstrap-5') }}
                                                </nav>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($categoryForms && $categoryForms->total() == 0)
                            <div class="accordion-item mb-3 border">
                                <h2 class="accordion-header" id="heading{{ $category->id }}">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $category->id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $category->id }}">
                                        {{ $category->name }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $category->id }}" data-bs-parent="#hrFormsAccordion">
                                    <div class="accordion-body">
                                        <div class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i>
                                            <p class="mb-0">No forms found in this category.</p>
                                            @if(request('search'))
                                                <small>Try adjusting your search terms.</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Auto-submit form when category filter changes
        $('select[name="category_id"]').on('change', function() {
            $(this).closest('form').submit();
        });

        // Auto-submit form when per-page selector changes
        $('select[name="per_page"]').on('change', function() {
            $(this).closest('form').submit();
        });

        // Clear search functionality
        $('#searchInput').on('keyup', function(e) {
            if (e.key === 'Enter') {
                $(this).closest('form').submit();
            }
        });

        // Show loading state when form is submitted
        $('form').on('submit', function() {
            $('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        });

        // SweetAlert delete confirmation
        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const formTitle = $(this).closest('.list-group-item').find('div > span').first().text().trim();
            Swal.fire({
                title: 'Are you sure?',
                html: `You are about to delete <span style="color: red; font-style: italic; font-style: underline;">${formTitle}</span>. This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    $(document).on('click', '.preview-btn', function () {
        const title = $(this).data('title');
        const fileUrl = $(this).data('file');
        const extension = fileUrl.split('.').pop().toLowerCase();

        $('#previewTitle').text(title);
        let content = '';

        if (['pdf'].includes(extension)) {
            content = `<iframe src="${fileUrl}" frameborder="0" style="width: 100%; height: 80vh;"></iframe>`;
        } else if (['png', 'jpeg', 'jpg'].includes(extension)) {
            content = `<img src="${fileUrl}" class="img-fluid d-block mx-auto" alt="${title}" />`;
        } else if (['doc', 'docx', 'xls', 'xlsx'].includes(extension)) {
            content = `
                <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(fileUrl)}"
                        frameborder="0" style="width: 100%; height: 80vh;"></iframe>
                <p class="text-muted text-center mt-2">Rendered via Microsoft Office Online Viewer</p>`;
        } else {
            content = `<p class="text-danger">Preview not available for this file type.</p>`;
        }

        $('#previewContent').html(content);
    });
</script>
