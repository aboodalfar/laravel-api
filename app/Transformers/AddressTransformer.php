<?php namespace App\Transformers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use League\Fractal\TransformerAbstract;
use App\Address;

class AddressTransformer extends TransformerAbstract{
    
    public function transform(Address $Address)
    {
        return [
            'uuid' => $Address->uuid,
            'city' => $Address->city,
            'country' => $Address->country,
            'street' => $Address->street,
            'postal_code' => $Address->postal_code,
            'cellular_number' => $Address->cellular_number,
            'neighborhood' => $Address->neighborhood,
            'created_at' => $Address->created_at,
            'updated_at' => $Address->updated_at
        ];
    }
}
