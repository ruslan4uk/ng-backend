<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class GuideController extends Controller
{
    public function showProfile($id)
    {
        if($user_data = User::findOrFail($id)->userData && $user = User::findOrFail($id))
        {
            return view('guide.profile', compact('user','user_data'));
        } else {
            return abort('404');
        }
        
    }
}
