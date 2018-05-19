<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfesoresRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>'min:3|max:120|required',  //'required|unique:posts|max:255|min:5|email'
            'apellido'=>'min:4|max:120|required',
            'genero'=>'max:1|required',
            'usuario'=>'min:3|max:20|required|unique:usuarios',
            'password'=>'min:3|max:120|required',
        ];
    }
}
