<?php

namespace App\Http\Requests\Pais;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'nombre'=>'required|string|max:100',
            'status' => 'required|integer|in:1,2'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'=> 'El nombre es obligatorio.',
            'nombre.string'=> 'El nombre debe de ser una cadena de texto.',
            'nombre.max'=> 'El nombre no debe de pasar los 100 caracteres.',
            'status.required'=>'El estado es obligatorio',
            'status.integer'=>'El estado debe de ser un numero',
            'status.in'=>'El estado debe de ser entre 1 o 2 donde 1 es activo y 2 es inactivo'
        ];
    }
}
