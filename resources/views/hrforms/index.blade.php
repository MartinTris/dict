@extends('layouts.app')

@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">HR Forms Library</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Downloadable Forms</h6>
            </div>

            <div class="card-body">
                <div class="accordion" id="hrFormsAccordion">
                    @foreach ($categories as $category)
                        <div class="accordion-item mb-3 border">
                            <h2 class="accordion-header" id="heading{{ $category->id }}">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $category->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $category->id }}">
                                    📁 {{ $category->name }}
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
                                                        <a href="{{ route('hrforms.view', $form->id) }}" class="btn btn-sm btn-info"
                                                            target="_blank">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                        <a href="{{ route('hrforms.download', $form->id) }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
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