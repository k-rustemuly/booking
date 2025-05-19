<?php

namespace App\Http\Requests\Booking;

use App\Rules\HousingAvailable;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'housing_id'    => ['required', 'exists:App\Models\Housing,id'],
            'check_in'      => ['required', 'date_format:Y-m-d H:i:s'],
            'check_out'     => ['required', 'date_format:Y-m-d H:i:s', 'after:check_in', new HousingAvailable($this->housing_id, $this->check_in)],
        ];
    }
}
