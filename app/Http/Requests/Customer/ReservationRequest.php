<?php

namespace App\Http\Requests\Customer;

use App\Enums\RoomCategory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
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
        if (request()->method() == 'PUT') {
            return [
                'name' => ['required', 'string', 'max:255'],
                'start' => ['required', 'string'],
                'end' => ['required', 'string'],
                'type' => ['required', Rule::Enum(RoomCategory::class), 'string'],
                'guests' => ['required', 'string'],
                'room_reservation_id' => ['required', 'string', 'exists:room_reservations,id'],
            ];
        }

        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:customers,email'],
            'message' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Preserve cart data before validation redirect
        //        $newInput = $this->except('_token');
        //        $preservedData = array_merge($newInput, ['cart' => session('cart', [])]);
        //
        //        // Replace all flashed data
        //        $this->session()->replace($preservedData);
        //
        //        parent::failedValidation($validator);
    }
}
