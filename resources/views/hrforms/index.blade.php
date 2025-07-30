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
                <div class="accordion" id="hrFormsAccordion">
                    @foreach ($categories as $category)
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
                                    @if ($category->forms->count())
                                        <ul class="list-group">
                                            @foreach ($category->forms as $form)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    @php
                                                        $extension = pathinfo($form->original_file_path, PATHINFO_EXTENSION);
                                                    @endphp
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span>{{ $form->title }}</span>
                                                        <span class="badge bg-secondary text-uppercase">{{ $extension }}</span>
                                                    </div>
                                                    <div class="action-buttons">
                                                        <button type="button" data-tooltip="Preview form"
                                                            class="btn btn-sm btn-primary preview-btn" data-title="{{ $form->title }}"
                                                            data-file="{{ asset('storage/' . $form->file_path) }}"
                                                            data-bs-toggle="modal" data-bs-target="#previewModal">
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
                                    @else
                                        <p class="text-muted">No forms available in this category.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
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
        // SweetAlert delete confirmation
        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const formTitle = $(this).closest('.list-group-item').find('div').first().text();
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