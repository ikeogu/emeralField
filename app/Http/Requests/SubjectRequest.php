<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
           'name' => 'required|string',
           'description' => 'required|string',
           'level' => 'required',
           'class_work' => 'required',
           'home_work' => 'required',
       ];
     }

     
}
