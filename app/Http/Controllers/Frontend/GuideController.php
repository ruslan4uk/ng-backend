<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Redirect;
use App\User;
use App\UserData;
use App\Tour;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    public function index($guide_id) 
    {
        //$user = User::where('id', $guide_id)->first();
        $data = UserData::where('user_id', Auth::id())->with('user')->first();

        $guide = UserData::where('user_id', $guide_id)->first();

        $tour = Tour::where('user_id', $guide_id)->get();

        $email = $guide->user->email;

        $comments = Comment::with('user_data')->where('guide_id', $guide_id)->get();

        return view('frontend.guide.index', compact('data', 'guide', 'tour', 'email', 'comments'));
    }

    public function addComment($id, Request $request) {

        if($id && $request->get('comment') && Comment::create(['guide_id' => $id, 'author_id' => Auth::id(), 'text' => $request->get('comment')])) {
            return Redirect::back()->withSuccess('Комментарий отправлен');
        } else {
            return Redirect::back()->withError('Комментарий не может быть пустым');
        }

    }
}
