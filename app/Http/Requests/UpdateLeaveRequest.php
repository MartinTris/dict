<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'leave_type_id' => ['required','exists:leave_types,id'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date','after_or_equal:start_date'],
            'reason' => ['nullable','string','max:2000'],
            'action' => ['required','in:draft,preview,submit'],
        ];
    }
}