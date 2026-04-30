<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Leave Summary</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .title { font-size: 16px; font-weight: bold; margin-bottom: 10px; }
        .row { margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="title">Leave Request Summary</div>
    <div class="row"><strong>Employee:</strong> {{ $leave->employee->name }}</div>
    <div class="row"><strong>Type:</strong> {{ $leave->type->name }}</div>
    <div class="row"><strong>Dates:</strong> {{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}</div>
    <div class="row"><strong>Days:</strong> {{ $leave->number_of_days }}</div>
    <div class="row"><strong>Status:</strong> {{ $leave->display_status }}</div>
    <div class="row"><strong>Reason:</strong> {{ $leave->reason ?? 'N/A' }}</div>
</body>
</html>