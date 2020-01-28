<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Address extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
     public function getCreatedAtAttribute($value)
    {
        return date('d F, Y h:i a', strtotime($value));
    }
    
    public function getUpdatedAtAttribute($value)
    {
        return date('d F, Y h:i a', strtotime($value));
    }
}