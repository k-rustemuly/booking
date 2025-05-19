<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search'           => ['nullable', 'string', 'max:255'],
            'check_in_from'    => ['nullable', 'date_format:Y-m-d H:i:s'],
            'check_in_to'      => ['nullable', 'date_format:Y-m-d H:i:s'],
            'check_out_from'   => ['nullable', 'date_format:Y-m-d H:i:s'],
            'check_out_to'     => ['nullable', 'date_format:Y-m-d H:i:s'],
            'sort_by'          => ['nullable', 'in:check_in,check_out,created_at'],
            'sort_dir'         => ['nullable', 'in:asc,desc'],
        ];
    }
}
