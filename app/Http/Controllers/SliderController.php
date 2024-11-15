<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $sliderItem = DB::table('sliders')
        ->leftJoin('images', function ($join) {
            $join->on('sliders.slider_id', '=', 'images.foreign_key')
                ->where('images.type', '=', 'slider')
                ->where('images.is_active', '=', '1');
            
                // ->whereRaw('images.image_id = (
                //     select MAX(imageid)
                //     from images
                //     where foreign_key = sliders.slider_id
                //     and type = "slider"
                //     and is_active = "1"
                // )');
        })
        ->where('sliders.is_active', '1')
        ->select('sliders.title as slider_title', 'sliders.description as slider_content', 'sliders.slider_id as slider_id', DB::raw('COALESCE(images.url, "default_image_url") as image_url'))
        ->orderBy('sliders.created_at', 'asc')
        ->get();

        $sliderItem->transform(function ($item) {
            if ($item->image_url) {
                $item->image_url = str_replace('public/', '', $item->image_url);
            }
            return $item;
        });

    return view('slider.slider', compact('sliderItem'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'slider_title.required' => 'The slider title is required.',
            'slider_content.required' => 'The slider content is required.',
            'slider_photos.*.mimes' => 'Photo must be a file of type: :values.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'slider_title' => 'required',
            'slider_content' => 'required',
            'slider_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
        ], $messages);


        $sliderTitle = $request->input('slider_title');
        $sliderContent = $request->input('slider_content');
        $sliderPhoto = $request->file('slider_photo');

         $slidersId = DB::table('sliders')->insertGetId([
             'title' => $sliderTitle,
             'description' => $sliderContent,
             'created_at' => now(),
             'updated_at' => now(),
         ]);

    // Store photo for slider section
    if ($sliderPhoto) {
        // $photoPath = $sliderPhoto->move(public_path('images'));
        $photoPath = $sliderPhoto->store('public/images');
        DB::table('images')->insert([
            'url' => $photoPath,
            'foreign_key' => $slidersId,
            'type' => 'slider',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->back()->with('success', 'Data stored successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = DB::table('sliders')
        ->where('slider_id', $id)
        ->where('is_active', '!=', 0)
        ->first();


        if (!$slider) {
            abort(404); // slider not found
        }
        
        // Fetching all images related to the article
        $sliderImages = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'slider')
                    ->where('images.is_active', '1')
                    ->get();

    return view('slider.editslider', compact('slider', 'sliderImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slider_id)
    {
        $messages = [
            'slider_title.required' => 'The slider title is required.',
            'slider_content.required' => 'The slider content is required.',
            'slider_photos.*.mimes' => 'Photo must be a file of type: :values.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'slider_title' => 'required',
            'slider_content' => 'required',
            'slider_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
        ], $messages);

        $slider = Slider::findOrFail($slider_id);

        try {
            $slider->title = $request->input('slider_title');
            $slider->description = $request->input('slider_content');
            $slider->updated_at =  now();
            $slider->save();

            // $existingDoc = DB::table('docs')
            // ->where('foreign_key', $form_id)
            // ->where('type', 'form')
            // ->where('is_active', 1)
            // ->first();

        // Store docs for form section if no active document exists
        // if ($request->hasFile('form_doc') && !$existingDoc) {
            $sliderImages = $request->file('slider_photos');
            foreach ($sliderImages as $image) {
                $imagePath = $image->store('public/docs');
                DB::table('images')->insert([
                    'url' => $imagePath,
                    'foreign_key' => $slider_id,
                    'type' => 'form',
                    'is_active' => 1, // Set the new document as active
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        
    
        return redirect()->back()->with('success', 'slider updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating slider');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function deactivate($id)
    {
    try {
        $slider = Slider::findOrFail($id);
        $slider->is_active = 0;
        $slider->save();

        return redirect()->back()->with('success', 'slider deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while deleting the slider.');
    }

    
    }
}
