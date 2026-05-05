<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveRejectLeaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    public function rules(): array
    {
        return [
            'action' => ['required','in:approve,reject'],
            'admin_remarks' => ['nullable','string','max:2000'],
        ];
    }
}