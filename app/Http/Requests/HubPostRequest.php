<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HubPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotelId' => 'required|integer',
            'checkIn' => 'required|date|after_or_equal:today|before:checkOut',
            'checkOut' => 'required|date|after:checkIn|after_or_equal:today',
            'numberOfGuests' => 'required|integer|min:1',
            'numberOfRooms' => 'required|integer|min:1',
            'currency' => 'required|string|size:3',
        ];
    }
}
