<?php

namespace App\Http\Controllers\Profile;

use Auth;
use Storage;
use App\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * Check auth
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        
        $data = UserData::where('user_id', $user_id)->first();

        $json = json_encode([
            'id' => $data->id,
            'user_id' => $data->user_id,
            'name' => $data->name,
            'secondname' => $data->secondname,
            'about' => $data->about,
            'language' => json_decode($data->language),
            'contact' => json_decode($data->contact),
            'other_contact' => json_decode($data->other_contact),
            'avatar' => $data->avatar,
            'services' => json_decode($data->services),
            'country' => $data->country,
            'city' => json_decode($data->city),
            'time_to_call' => json_decode($data->time_to_call),
            'user_files' => json_decode($data->user_files),
            'properties' => $data->properties,
        ]);

        return view('profile.index', compact('data', 'json'));
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function show(UserData $userData)
    {
        $user_id = Auth::id();
        $data = UserData::where('user_id', $user_id)->first();
        return response()->json([
            'id' => $data->id,
            'user_id' => $data->user_id,
            'name' => $data->name,
            'secondname' => $data->secondname,
            'about' => $data->about,
            'language' => json_decode($data->language),
            'contact' => $data->contact,
            'other_contact' => $data->other_contact,
            'avatar' => $data->avatar,
            'services' => $data->services,
            'country' => $data->country,
            'city' => json_decode($data->city),
            'time_to_call' => $data->time_to_call,
            'user_files' => json_decode($data->user_files),
            'properties' => $data->properties,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserData $userData)
    {
        $user = UserData::where('user_id', Auth::id())->first();
        $user->name = $request->get('name');
        $user->services = $request->get('services');
        $user->language = json_encode($request->get('language'));
        $user->city = json_encode(array_filter($request->get('city')));
        $user->contact = json_encode($request->get('contact'));
        $user->time_to_call = json_encode($request->get('time_to_call'));
        $user->services = json_encode($request->get('services'));
        $user->other_contact = json_encode($request->get('other_contact'));
        $user->about = $request->get('about');

        if($user->save()) {
            return response()->json(['message' => 'Успешно']);
        }
        
        
    }


    /**
     * Uploader user avatar
     *
     * @param Request $request
     * @return void
     */
    public function avatar (Request $request) 
    {
        $max_size = (int)ini_get('upload_max_filesize') * 500000;
        $all_ext = implode(',', $this->image_ext);

        $this->validate($request, [
            'file' => 'required|file|mimes:' . $all_ext . '|max:' . $max_size
        ]);

        $image = Image::make($request->file('file'))->fit(400, 400)->encode('jpg');
        
        if(Storage::disk('public')->put('users/' . Auth::id() . '/avatar.jpg', (string) $image))
        {
            $user_data = UserData::where('user_id', Auth::id())->first();
            $user_data->avatar = 'storage/users/' . Auth::id() . '/avatar.jpg';
            $user_data->save();
            return 'storage/users/' . Auth::id() . '/avatar.jpg';
        }
    }

    public function uploadLicense(Request $request) {

        $user_data = UserData::where('user_id', Auth::id())->first();
        $user_files = (array) json_decode($user_data->user_files);
 
        if($request->get('id') >= 0 && is_numeric($request->get('id'))) {
            Storage::disk('public')->delete('users/' . Auth::id() . '/license/' . $user_files[$request->get('id')]->filename);
            \array_splice($user_files, $request->get('id'), 1);
            $user_data->user_files = json_encode($user_files);
            $user_data->save();
            return \response()->json($user_files);
        }

        $i = 0;
        $path = [];
        foreach ($request->file('files') as $file) {
            $i++;
            $image = Image::make($file)->encode('jpg');

            if(Storage::disk('public')->put('users/' . Auth::id() . '/license/' . md5($i . time()). '.jpg', (string) $image))
            {
                $path[$i]['path'] = 'storage/users/' . Auth::id() . '/license/' . md5($i . time()) . '.jpg';
                $path[$i]['filename'] = md5($i . time()). '.jpg';
            }
            $license = array_merge($user_files, $path);
        }    

        //$license = $user_data->user_files ? array_merge($user_files, $path) : $path;
        $user_data->user_files = json_encode($license);
        $user_data->save();

        return response()->json($license);    
    }
}
