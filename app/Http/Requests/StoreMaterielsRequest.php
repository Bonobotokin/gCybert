<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterielsRequest extends FormRequest
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
            'designation' => 'required',
            'totale'  => ['required','numeric'],
            // 'prix_vente'  => ['required','numeric'],
            'conditionnement' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'designation' => 'Veuillez indiquer le nom du nouveaux materiels',
            'conditionnement' => 'Veuillez rensiegner le conditionnement de ce nouveuz materiels',
            'totale' => 'Donner la totalite',
            // 'prix_vente' => 'Donner le prix de vente'
        ];
    }
}
