<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Leave Type</label>
        <select name="leave_type_id" class="form-select" required>
            @foreach($types as $type)
                <option value="{{ $type->id }}" @selected(old('leave_type_id', $leave->leave_type_id ?? '') == $type->id)>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Start Date</label>
        <input type="date" name="start_date" class="form-control"
               value="{{ old('start_date', optional($leave->start_date ?? null)->format('Y-m-d')) }}" required>
    </div>

    <div class="col-md-3">
        <label class="form-label">End Date</label>
        <input type="date" name="end_date" class="form-control"
               value="{{ old('end_date', optional($leave->end_date ?? null)->format('Y-m-d')) }}" required>
    </div>

    <div class="col-12">
        <label class="form-label">Reason</label>
        <textarea name="reason" class="form-control" rows="4">{{ old('reason', $leave->reason ?? '') }}</textarea>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button class="btn btn-outline-secondary" type="submit" name="action" value="draft">Save Draft</button>
    <button class="btn btn-primary" type="submit" name="action" value="submit">Submit</button>
    <button class="btn btn-warning" type="submit" formaction="{{ route('employee.leaves.preview') }}">Preview</button>
</div>