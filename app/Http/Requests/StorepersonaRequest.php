<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StorepersonaRequest extends FormRequest
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
            'categoria' => 'required',
            'nombre' => ['required', 'string', 'between:3,30'], //, 'no_repeated_chars'
            'apellidop' => ['string', 'between:3,30'], //, 'no_repeated_chars'
            'apellidom' => ['string', 'between:3,30'], //, 'no_repeated_chars'
            'genero' => 'required',
            'nacionalidad' => 'required',
            'categoria' => 'required',
            'whatsapp' => 'required|string|digits_between:7,15|unique:personas',
            'fnacimiento' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        $fechaNacimiento = Carbon::parse($value);
                        $edad = $fechaNacimiento->age;

                        if ($edad < 18) {
                            $fail('Debes tener al menos 18 años.');
                        }

                        if ($edad > 75) {
                            $fail('No puedes tener más de 75 años.');
                        }

                        // Verificar la fecha máxima permitida
                        $fechaActual = Carbon::now();
                        if ($fechaNacimiento->greaterThan($fechaActual)) {
                            $fail('La fecha de nacimiento no puede estar en el futuro.');
                        }
                    }
                },
            ],
            // 'tipo_persona_id' => 'required|string|max:30',
            'tipo_persona_ids' => 'required|array',
            'tipo_persona_ids.*' => 'exists:tipo_personas,id',
        ];
    }
}
