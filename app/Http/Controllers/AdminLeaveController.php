<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class AdminLeaveController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['status', 'from', 'to', 'search']);

        $leaves = Leave::with(['employee', 'type'])
            ->filter($filters)
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('management.leaves.index', compact('leaves'));
    }

    public function approve(Leave $leave)
    {
        $leave->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Leave approved.');
    }

    public function reject(Leave $leave)
    {
        $leave->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Leave rejected.');
    }
}