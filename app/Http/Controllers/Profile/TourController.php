<?php

namespace App\Http\Controllers\Profile;

use Auth;
use App\Tour;
use App\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;
use Intervention\Image\Facades\Image;

class TourController extends Controller
{
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UserData::where('user_id', Auth::id())->first();

        $tours = Tour::where('user_id', Auth::id())->where('active', 1)->get();
        
        return view('profile.tour.index', compact('data','tours'));
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
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour, $id)
    {
        $data = UserData::where('user_id', Auth::id())->first();

        $tour = Tour::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        $json = json_encode([
            'id' => $tour->id,
            'name' => $tour->name,
            'cover' => $tour->cover,
            'city' => $tour->city,
            'route' => $tour->route,
            'language' => json_decode($tour->language),
            'category' => $tour->category,
            'active_for' => $tour->active_for,
            'member_count' => $tour->member_count,
            'timing' => json_decode($tour->timing),
            'price' => $tour->price,
            'currency' => $tour->currency,
            'service' => $tour->service,
            'other' => $tour->other,
            'what_to_take' => $tour->what_to_take,
            'photo' => json_decode($tour->photo),
            'about' => $tour->about,

        ]);
        
        return view('profile.tour.edit', compact('data', 'json'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */ 
    public function edit(Tour $tour)
    {
        $data = UserData::where('user_id', Auth::id())->first();

        $json = Tour::create([
            'user_id' => Auth::id()
        ]);
         
        return view('profile.tour.edit', compact('data','json'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $tour = Tour::where('id', $request->get('id'))->where('user_id', Auth::id())->firstOrFail();

        $tour->name = $request->get('name');
        $tour->city = $request->get('city');
        $tour->route = $request->get('route');
        $tour->language = json_encode($request->get('language'));
        $tour->category = $request->get('category');
        $tour->active_for = $request->get('active_for');
        $tour->member_count = $request->get('member_count');
        $tour->timing = json_encode($request->get('timing'));
        // price
        $tour->price = $request->get('price');
        $tour->currency = $request->get('currency');
        $tour->service = $request->get('service');
        $tour->other = $request->get('other');
        $tour->what_to_take = $request->get('what_to_take');
        
        $tour->about = $request->get('about');

        $tour->active = 1;
        
        if($tour->save())
        {
            return response()->json(['message' => 'Успешно']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        //
    }



    /**
     * Uploader user avatar
     *
     * @param Request $request
     * @return void
     */
    public function cover (Request $request) 
    {

        $max_size = (int)ini_get('upload_max_filesize') * 500000;
        $all_ext = implode(',', $this->image_ext);

        $this->validate($request, [
            'file' => 'required|file|mimes:' . $all_ext . '|max:' . $max_size
        ]);

        $image = Image::make($request->file('file'))->fit(450, 450)->encode('jpg');
        $image_big = Image::make($request->file('file'))->fit(900, 500)->encode('jpg');
        
        if(Storage::disk('public')->put('tour/' . $request->get('pageid') . '/cover.jpg', (string) $image) && Storage::disk('public')->put('tour/' . $request->get('pageid') . '/cover_big.jpg', (string) $image_big))
        {
            $tour = Tour::where('user_id', Auth::id())->where('id', $request->get('pageid'))->firstOrFail();
            $tour->cover = 'storage/tour/' . $request->get('pageid') . '/cover.jpg';
            $tour->cover_big = 'storage/tour/' . $request->get('pageid') . '/cover_big.jpg';
            $tour->save();
            return 'storage/tour/' . $request->get('pageid') . '/cover.jpg';
        }
    }

    /**
     * Uploader photo
     *
     * @param Request $request
     * @return void
     */
    public function uploadphoto(Request $request) 
    {

        $tour = Tour::where('id', $request->get('pageid'))->where('user_id', Auth::id())->firstOrFail();
        $tour_photo = (array) json_decode($tour->photo);
 
        // Удаление
        if($request->get('id') >= 0 && is_numeric($request->get('id'))) {
            Storage::disk('public')->delete('tour/' . $request->get('pageid') . '/photo/' . $tour_photo[$request->get('id')]->filename);
            \array_splice($tour_photo, $request->get('id'), 1);
            $tour->photo = json_encode($tour_photo);
            $tour->save();
            return \response()->json($tour_photo);
        }

        $i = 0;
        $path = [];
        $photo = [];
        foreach ($request->file('files') as $file) {
            $i++;
            $image = Image::make($file)->encode('jpg');

            if(Storage::disk('public')->put('tour/' . $request->get('pageid') . '/photo/' . md5($i . time()). '.jpg', (string) $image))
            {
                $path[$i]['path'] = 'storage/tour/' . $request->get('pageid') . '/photo/' . md5($i . time()) . '.jpg';
                $path[$i]['filename'] = md5($i . time()). '.jpg';
            }
            $photo = array_merge($tour_photo, $path);
        }    

        $tour->photo = json_encode($photo);
        $tour->save();

        return response()->json($photo);    
    }
}
