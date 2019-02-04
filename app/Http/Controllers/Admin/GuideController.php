<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $data = $user->with('userdata')->get();
        
        return view('admin.guide.index', ['users' => $data]);
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
        
        $data = User::with('userdata')->find($id);
        
        return view('admin.guide.show', ['user' => $data]);
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,$id)
    {
        $user->where('id',$id)->delete();
    }


    public function changeStatus(Request $request, $id) 
    {
        // dd($id);
        $status = User::where('id', $id)->update([
            'active' => $request->active
        ]);

        if($status) 
        {
            return Redirect::back()->with('success', ['Пользователь одобрен']);
        } else {
            return Redirect::back()->width('error', ['Ошибка']);
        }
    }
}
