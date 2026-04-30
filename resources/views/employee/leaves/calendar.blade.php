@extends('layouts.employee.app')

@section('title', 'Leave Calendar')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
@endpush

@section('contents')
<div id="leaveCalendar" class="bg-white p-3 shadow-sm rounded"></div>
@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('leaveCalendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '{{ route('employee.leaves.calendar.fetch') }}',
    });

    calendar.render();
});
</script>
@endpush