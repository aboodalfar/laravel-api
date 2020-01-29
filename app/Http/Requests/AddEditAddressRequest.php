<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;

class AddEditAddressRequest extends FormRequest
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
            'uuid' => 'required',
            'country' => 'required||exists:countries,country_code',
            'city'  => 'required|string|max:30|min:3',
            'neighborhood' => 'required|max:30|min:3',
            'street'=>'required|max:30|min:3',
            'postal_code'=>'required|numeric',
            'cellular_number'=>'required|regex:/^0[7-9]{2}[0-9]{7}$/'
        ];;
    }
}
