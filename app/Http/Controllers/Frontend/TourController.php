<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Geodata\Cities;
use App\Tour;
use App\User;
use App\UserData;

class TourController extends Controller
{
    
    public function index($tour_id)
    {
        // User is login avatar and name 
        $data = UserData::where('user_id', Auth::id())->first();
    
        $tour = Tour::where('id', $tour_id)->where('active', 1)->firstOrFail();

        $guide = $tour->user;

        $guide_data = UserData::where('user_id', $guide->id)->firstOrFail();

        $city = Cities::where('id', $tour->city)
                    ->limit(25)
                    ->select('city.id','city.city','city.city_iso_code','city.region', 'country.country_name')
                    ->join('country', 'country.country_iso_code', '=', 'city.city_iso_code')
                    ->first();

        return view('frontend.tour.index', compact('tour', 'guide', 'guide_data', 'city', 'data'));
    }

}
