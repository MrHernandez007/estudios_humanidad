<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieUpdateRequest extends FormRequest
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
    public function rules()
{
    return [
        'nombre' => 'required|max:255|unique:series,nombre,' . $this->serie->id,
        'descripcion' => 'nullable',
        'estado' => 'required|boolean',
    ];
}

}
