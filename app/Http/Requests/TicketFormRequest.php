<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'description' => 'required|min:10',
            'type_id' => 'required',
            'category_id' => 'required',
            'created_date' => 'required',
            'type_id' => 'required',
            'category_id' => 'required',
            'responsible_tech' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo 'nome' é obrigatório",
            'description.required' => "O campo 'descrição' é obrigatório",
            'name.min' => "O campo de nome precisa ter pelo menos 5 caracteres",
            'description.min' => "O campo de nome precisa ter pelo menos 10 caracteres",
            'created_date.required' => "O campo  'data de criação' é obrigatório",
        ];
    }

}
