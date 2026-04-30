<?php

namespace App\Http\Requests\LeaveType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', 'unique:leave_types,name,' . $this->route('leave_type')->id],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}