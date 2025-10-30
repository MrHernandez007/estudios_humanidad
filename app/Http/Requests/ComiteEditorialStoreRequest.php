<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ComiteEditorialStoreRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //         //
    //     ];
    // }

//     public function rules(): array
// {
//     return [
//         'nombre'      => 'required|string|max:255',
//         'apellido'    => 'required|string|max:255',
//         'dependencia' => 'required|string|max:255',
//         'pais'        => 'required|string|max:255',
//         'estado'      => 'required|boolean',
//     ];
// }

public function rules(): array
{
    return [
        'nombre' => [
            'required',
            'string',
            'max:255',
            Rule::unique('autores', 'nombre') // 👈 aquí indicamos el campo explícitamente
                ->whereNull('deleted_at'),     // ignora los eliminados
        ],
        'apellido'    => 'required|string|max:255',
        'dependencia' => 'required|string|max:255',
        'pais'        => 'required|string|max:255',
        'estado'      => 'required|boolean',
    ];
}

}
