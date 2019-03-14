<?php

namespace App\Http\Controllers\Frontend;

use Tour;
use App\Geodata\Cities;
use App\Geodata\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    
    public function search(Request $request)
    {
        if($request->get('q')) {
            return Cities::WhereRaw("MATCH(city.city) AGAINST('" . $request->get('q') . "*' IN BOOLEAN MODE)")
                    ->limit(25)
                    ->select('city.id','city.city','city.city_iso_code','city.region', 'country.country_name')
                    ->join('country', 'country.country_iso_code', '=', 'city.city_iso_code')
                    ->get();
        }
    }
}
