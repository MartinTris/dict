@extends('layouts.app')
@include('hrforms.create')
@push('styles')
    <style>
        .accordion-button {
            transition: background-color 0.1s ease;
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
                                                    <div>{{ $form->title }}</div>
                                                    <div>
                                                        <a href="{{ route('hrforms.download', $form->id) }}"
                                                            class="btn btn-sm btn-success" style="background-color: #003566;">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                        <form action="{{ route('hrforms.destroy', $form->id) }}" method="POST"
                                                            class="d-inline delete-form">
                                                            @csrf @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger delete-btn">
                                                                <i class="fas fa-trash"></i> Delete
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
</script>