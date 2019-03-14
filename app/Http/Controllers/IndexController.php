<?php

namespace App\Http\Controllers;

use Auth;
use App\Tour;
use App\User;
use App\UserData;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() 
    {

        $tours = Tour::where('active', 1)->with('user_data')->limit(9)->get();

        $guides = User::where('role', 'guide')->where('active', 1)->with('userdata')->with(['tour' => function($query){
            $query->where('active', 1);
        }])->limit(10)->get();

        $data = UserData::where('user_id', Auth::id())->first();
        return view('index', compact('data', 'tours', 'guides'));
    }

    public function search($id) 
    {

        if($id) {
            $tours = Tour::where('active', 1)->where('city', $id)->with('user_data')->limit(9)->get();

            $guides = User::where('role', 'guide')
                            ->where('active', 1)
                            ->with('userdata')
                            ->with(['tour' => function($query) {
                                $query->where('active', 1);
                            }])
                            //->whereHas('city', 'like', '%' . $id . '%')
                            ->whereHas('userdata', function($q) use ($id){
                                $q->where('city', 'like', '%' . $id . '%');
                             })
                            ->limit(10)
                            ->get();

            $data = UserData::where('user_id', Auth::id())->first();
            return view('index', compact('data', 'tours', 'guides'));
        } else {
            return abort();
        }
    }
}
