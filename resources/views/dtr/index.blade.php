@extends('layouts.employee.app')

@section('title', 'Daily Time Record')

@section('contents')
    <div class="row">
        <div class="col-12">
            {{-- Flash messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Current Day Section --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Today ({{ $nowManila->format('F d, Y') }})</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="d-flex flex-column">
                                <small class="text-muted">Clock In</small>
                                <strong class="fs-5">
                                    @if ($todayRecord && $todayRecord->clock_in)
                                        {{ \Carbon\Carbon::parse($todayRecord->clock_in, 'UTC')->setTimezone('Asia/Manila')->format('h:i A') }}
                                    @else
                                        —
                                    @endif
                                </strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-column">
                                <small class="text-muted">Clock Out</small>
                                <strong class="fs-5">
                                    @if ($todayRecord && $todayRecord->clock_out)
                                        {{ \Carbon\Carbon::parse($todayRecord->clock_out, 'UTC')->setTimezone('Asia/Manila')->format('h:i A') }}
                                    @else
                                        —
                                    @endif
                                </strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-column">
                                <small class="text-muted">Total Hours</small>
                                <strong class="fs-5">
                                    @if ($todayRecord && $todayRecord->total_hours)
                                        {{ number_format((float)$todayRecord->total_hours, 2) }} hrs
                                    @else
                                        —
                                    @endif
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <form action="{{ route('dtr.clock-in') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit"
                                    class="btn btn-success"
                                    @if ($todayRecord && $todayRecord->clock_in) disabled @endif>
                                <i class="fas fa-sign-in-alt"></i> Clock In
                            </button>
                        </form>

                        <form action="{{ route('dtr.clock-out') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit"
                                    class="btn btn-danger"
                                    @if (!$todayRecord || !$todayRecord->clock_in || $todayRecord->clock_out) disabled @endif>
                                <i class="fas fa-sign-out-alt"></i> Clock Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Historical Records Section --}}
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">History</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Total Hours</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($history as $record)
                                <tr>
                                    <td>{{ $record->date->format('M d, Y') }}</td>
                                    <td>
                                        @if ($record->clock_in)
                                            {{ \Carbon\Carbon::parse($record->clock_in, 'UTC')->setTimezone('Asia/Manila')->format('h:i A') }}
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($record->clock_out)
                                            {{ \Carbon\Carbon::parse($record->clock_out, 'UTC')->setTimezone('Asia/Manila')->format('h:i A') }}
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($record->total_hours)
                                            <span class="badge bg-info">{{ number_format((float)$record->total_hours, 2) }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No records yet.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($history->count() > 0)
                        <div class="d-flex justify-content-center mt-3">
                            {{ $history->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
