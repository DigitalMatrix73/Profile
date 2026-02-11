<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $fillable = [
        'address', 
        'email', 
        'phone', 
        'phone2', 
        
        'lat', 
        'lng', 
        'facebook', 
        'tweeter', 
        'linked_in', 
        'instagram', 
        'tiktok', 
    ];
}
