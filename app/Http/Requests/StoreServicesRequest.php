<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicesRequest extends FormRequest
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
            'designation' => 'required',
            'prix' => ['required', 'alpha_num']
        ];
    }

    public function messages()
    {
        return 
         [
            'designation' => 'Veuillez renseigner le nom de la nouvelle services',
            'prix' => 'Une services doit avoir une prix meme s \'il est null'
         ];
    }
}
