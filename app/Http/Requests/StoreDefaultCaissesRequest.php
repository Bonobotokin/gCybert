<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDefaultCaissesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'montant' => ['required', 'alpha_num']
        ];
    }

    public function messages()
    {
        return [
            'montant' => 'desoler, le montant ne peut pas etre vide et elle etre toujour en numerique'
        ];
    }
}
