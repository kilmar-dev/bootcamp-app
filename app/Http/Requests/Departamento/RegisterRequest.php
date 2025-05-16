<?php

namespace App\Http\Requests\Departamento;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nombre' => 'required|string|max:100',
            'id_pais' => 'required|exists:paises,id'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del pais es requerido.',
            'nombre.string' => 'El nombre del pais debe de ser texto.',
            'nombre.max' => 'El nombre del pais debe de tener como maxino 100 caracteres',
            'id_pais.required'=> 'El pais es obligatorio',
            'id_pais.exists' => 'El pais seleccionado no existe'
        ];
    }
}
