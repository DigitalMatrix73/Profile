<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    protected $fillable = [
        'top_raise',
        'access',
        'range_raise', 
        'total_watching', 
        'face_image',
        'face_access',
        'face_comments',
        'face_save',
        'face_share',  
        'youtube_watsh',
        'youtube_image',
        'youtube_profits',
        'youtube_period', 
        'analysis_image',
        'analysis_growth',
        'analysis_watches',
        
        'overall_growth_image',
        'overall_growth_calling',
        'overall_growth_response',
        'overall_growth_chats',
        'overall_growth_watches',
        'overall_growth_reaction',
    ];
}
