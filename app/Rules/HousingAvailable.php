<?php

namespace App\Rules;

use App\Models\Book;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HousingAvailable implements ValidationRule
{

    public function __construct(private int $housingId,
        private string $checkInDate
    ){}
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(
            Book::where('housing_id', $this->housingId)
                ->where(function ($query) use($value) {
                    $query->whereBetween('check_in', [$this->checkInDate, $value])
                        ->orWhereBetween('check_out', [$this->checkInDate, $value])
                        ->orWhere(function ($q) use($value) {
                            $q->where('check_in', '<=', $this->checkInDate)
                                ->where('check_out', '>=', $value);
                        });
                })
                ->exists()
        ) {
            $fail(__('api.housing_unavailable'));
        }
    }
}
