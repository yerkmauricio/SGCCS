<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateusuarioRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'apellidop' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'apellidom' => ['string', 'between:3,30', 'no_repeated_chars'],
            'ci' => 'required|string|max:10|unique:persona',
            'expedito' => 'required|string|max:2|unique:persona',
            'genero' => 'required',
            'role_id' => 'required',
            'cargo' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
            'unidad' => ['required', 'string', 'between:3,30', 'no_repeated_chars'],
        ];
    }
}
