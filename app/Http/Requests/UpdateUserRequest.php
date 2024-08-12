<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'between:3,30'],//, 'no_repeated_chars'
            'apellidopaterno' => ['required','string', 'between:3,30'],//, 'no_repeated_chars'
            'apellidomaterno' => ['required','string', 'between:3,30'],//, 'no_repeated_chars'
            // 'email'=>'required',
            // 'ci' => 'required',
            'genero' => 'required',
            'cargo' => 'required',
            'unidad' => 'required',
            // 'fnacimiento' => [
            //     function ($attribute, $value, $fail) {
            //         if (!empty($value)) {
            //             $fechaNacimiento = Carbon::parse($value);
            //             $edad = $fechaNacimiento->age;

            //             if ($edad < 18) {
            //                 $fail('Debes tener al menos 18 años.');
            //             }

            //             if ($edad > 75) {
            //                 $fail('No puedes tener más de 75 años.');
            //             }

            //             // Verificar la fecha máxima permitida
            //             $fechaActual = Carbon::now();
            //             if ($fechaNacimiento->greaterThan($fechaActual)) {
            //                 $fail('La fecha de nacimiento no puede estar en el futuro.');
            //             }
            //         }
            //     },
            // ],
            'role' => 'required',

        ];
    }
}
