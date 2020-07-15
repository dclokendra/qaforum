<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'=>'required|string|unique:categories|max:191',
            'rank'=>'required|integer|min:1',
        ];
    }
    function messages()
    {
        return[
            'name.required'=>$this->required_messages('name'),
            'rank.required'=>$this->required_messages('rank'),
            'name.unique'=>'Name is already taken',
        ];
    }
    private function required_messages($field){
        return "Please Enter ".$field;
    }
}
