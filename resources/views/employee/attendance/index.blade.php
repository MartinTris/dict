@extends('layouts.employee.app')

@section('title', 'Attendance')

@section('styles')
<style>
    .attendance-day {
        width: 100%;
        min-height: 80px;
        border: 1px solid #e3e6f0;
        border-radius: 6px;
        padding: 6px;
        background-color: #fff;
    }

    .attendance-day.worked {
        background-color: #e8f5e9;
        border-color: #28a745;
    }

    .attendance-day .date-number {
        font-weight: 700;
        color: #4e73df;
    }

    .calendar-table th,
    .calendar-table td {
        vertical-align: top;
        padding: 6px;
    }

    .month-button.active {
        background-color: #003566;
        color: #fff;
    }
</style>
@endsection

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fa-solid fa-clipboard-check mr-2"></i>Attendance - {{ $selectedMonth->format('F Y') }}
        </h6>
    </div>
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2 mb-4">
            @foreach ($months as $month)
                <a href="{{ route('employee.attendance.index', ['month' => $month->format('Y-m')]) }}"
                   class="btn btn-sm month-button {{ $month->format('Y-m') === $selectedMonth->format('Y-m') ? 'active' : 'btn-outline-primary' }}">
                    {{ $month->format('M') }}
                </a>
            @endforeach
        </div>

        <div class="table-responsive">
            <table class="table calendar-table">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">Sun</th>
                        <th class="text-center">Mon</th>
                        <th class="text-center">Tue</th>
                        <th class="text-center">Wed</th>
                        <th class="text-center">Thu</th>
                        <th class="text-center">Fri</th>
                        <th class="text-center">Sat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weeks as $week)
                        <tr>
                            @foreach ($week as $day)
                                <td>
                                    @if ($day)
                                        @php
                                            $dayKey = $day->format('Y-m-d');
                                            $worked = in_array($dayKey, $workedDates, true);
                                        @endphp
                                        <div class="attendance-day {{ $worked ? 'worked' : '' }}">
                                            <div class="date-number">{{ $day->format('j') }}</div>
                                            @if ($worked)
                                                <span class="badge badge-success">Worked</span>
                                            @else
                                                <span class="text-muted small">—</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="attendance-day bg-light border-0"></div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-right">
            <strong>Total Worked Days:</strong> {{ $workedCount }}
        </div>
    </div>
</div>
@endsection