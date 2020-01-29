<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string|max:20|min:3',
            'last_name'  => 'required|string|max:20|min:3',
            'email' => 'required|email',
            'cellular_number'=>'required|regex:/^0[7-9]{2}[0-9]{7}$/',
            'password'=>"required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/"
        ];;
    }
    
    public function message()
    {
        return [
            'password.regex'=>'The :attribute must be 8–16 characters, and include a number, a symbol, a lower and a upper case letter'
        ];
    }
}
