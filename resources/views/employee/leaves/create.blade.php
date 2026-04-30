@extends('layouts.employee.app')

@section('title', 'Create Leave Request')

@section('contents')
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('employee.leaves.store') }}">
            @csrf
            @include('employee.leaves._form')
        </form>
    </div>
</div>
@endsection