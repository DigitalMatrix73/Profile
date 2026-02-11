<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    protected $fillable = [
        'years', 
        'clients', 
        'projects', 
        'msg', 
        'vision', 
        'benifits', 
    ];
}
