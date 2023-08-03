<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDecaissmentRequest extends FormRequest
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
            'description' => 'required',
            'quantite' => 'required',
            'montant' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'description' => 'Veuillez indiquer la raison de votre action',
            'quantite' => 'Renseigner le quantiter',
            'montant' => 'Indiquer la somme ou le montant'
        ];
    }
}
