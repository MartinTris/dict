@extends('layouts.employee.app')

@section('title', 'Edit Leave Request')

@section('contents')
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('employee.leaves.update', $leave) }}">
            @csrf
            @method('PUT')
            @include('employee.leaves._form')
        </form>
    </div>
</div>
@endsection