<?php

namespace App\Http\Controllers\Admin\Api\v1;

use App\User;
use App\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\admin\Guide as GuideResource;
use App\Http\Resources\admin\GuideCollection;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GuideCollection(User::all());
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $id)
    {
        
        return new GuideResource(User::with('userdata')->find($id));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage. 
     * PUT / PATH method
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());

        $data = json_decode(json_encode($request->get('data')), FALSE);

        //dd($data);

        $userData = UserData::firstOrFail()->where('user_id', $id);
        $userData->update([
            'about' => $data->about,
            'language' => json_encode($data->language, true),
            'contact' => json_encode($data->contact, true),
            'other_contact' => json_encode($data->other_contact, true),
            'avatar' => $data->avatar,
            'services' => json_encode($data->services, true),
            'country' => json_encode($data->country, true),
            'city' => json_encode($data->city, true),
            'time_to_call' => json_encode($data->time_to_call, true),
            'user_files' => json_encode($data->user_files, true),
            'properties' => json_encode($data->properties, true),
        ]);
        
        return response()->json(['success' => 'Изменения сохранены'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
