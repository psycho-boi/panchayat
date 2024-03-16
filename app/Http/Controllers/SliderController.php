<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('slider.slider');
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
            'foreign' => $slidersId,
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
