<?php

namespace App\Http\Requests\Admin;

use App\Enums\RoomCategory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'occupants' => ['nullable', 'integer', 'min:1'],
            'room_category' => [
                'nullable',
                'string',
                Rule::in(array_merge(['any'], array_column(RoomCategory::cases(), 'value'))),
            ],
            'check_in' => [
                'sometimes',
                'required_with:check_out',
                'date_format:Y-m-d',
                'before:check_out',
            ],
            'check_out' => [
                'sometimes',
                'required_with:check_in',
                'date_format:Y-m-d',
                'after:check_in',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'check_in' => $this->check_in ?? now()->format('Y-m-d'),
            'check_out' => $this->check_out ?? now()->addDay()->format('Y-m-d'),
            'room_category' => $this->room_category ?? 'any',
            'occupants' => $this->occupants ?? 2,
        ]);
    }
}
