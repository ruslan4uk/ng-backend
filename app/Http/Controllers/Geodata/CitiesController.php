<?php

namespace App\Http\Controllers\Geodata;

use App\Geodata\Cities;
use App\Geodata\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('q')) {
            return Cities::WhereRaw("MATCH(city.city) AGAINST('" . $request->get('q') . "*' IN BOOLEAN MODE)")
                    ->limit(25)
                    ->select('city.id','city.city','city.city_iso_code','city.region', 'country.country_name')
                    ->join('country', 'country.country_iso_code', '=', 'city.city_iso_code')
                    ->get();
        }
        if($request->get('id')) {
            return Cities::where('id', $request->get('id'))
                    ->limit(25)
                    ->select('city.id','city.city','city.city_iso_code','city.region', 'country.country_name')
                    ->join('country', 'country.country_iso_code', '=', 'city.city_iso_code')
                    ->first();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Geodata\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function show(Cities $cities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Geodata\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function edit(Cities $cities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Geodata\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cities $cities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Geodata\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cities $cities)
    {
        //
    }
}
