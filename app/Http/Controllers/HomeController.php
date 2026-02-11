<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CompanyInfo;
use App\Models\Marketing;
use App\Models\Project;
use App\Models\Team;
use App\Models\Vision;

class HomeController extends Controller
{
    public function index(){
        $company_info = CompanyInfo::first([
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
        ]);
        $marketing = Marketing::first([
            'top_raise',
            'access',
            'range_raise',
            'total_watching',
            'youtube_watsh',
            'youtube_image',
            'youtube_profits',
            'youtube_period',
            'face_image',
            'face_access',
            'face_comments',
            'face_save',
            'face_share', 
            'overall_growth_image',
            'overall_growth_calling',
            'overall_growth_response',
            'overall_growth_chats',
            'overall_growth_watches',
            'overall_growth_reaction',
            'analysis_image',
            'analysis_growth',
            'analysis_watches',
        ]);
        $projects = Project::get([ 
            'name',
            'description',
            'image',
            'technics',
            'type',
        ]);
        $team = Team::get([
            'name', 
            'position', 
            'image', 
        ]);
        $vision = Vision::
        first([ 
            'years', 
            'clients', 
            'projects', 
            'msg', 
            'vision', 
            'benifits', 
        ]);

        return view('welcome', 
        compact("company_info", "marketing", "projects", "team", "vision"));
    }
}
