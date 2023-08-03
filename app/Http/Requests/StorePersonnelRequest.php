<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonnelRequest extends FormRequest
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
            //
            'nom' => 'required',
            'age' => 'required',
            'salaire' => 'required',
            'telephone' => ['required', 'numeric'],
            'adresse' => 'required',
            'cin' => ['required', 'numeric']
            
        ];
    }

    public function messages()
    {
        return 
        [
            'nom' => 'Veuillez indiquer le nom et prenom du personnel',
            'age' => 'Donner son age',
            'age' => 'Donner son salaire de base',
            'telephone' => 'veuillez renseigner le contact',
            'adresse' => 'Une personne doit toujour avoir une adresse',
            'cin' => 'presiser le cin du personnel',
        ];
    }
}
