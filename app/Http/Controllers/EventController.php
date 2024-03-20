<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'event_title.required' => 'The event title is required.',
            'event_content.required' => 'The event content is required.',
            'event_location.required' => 'The event location is required.',
            // 'event_photos.*.image' => 'The attribute must be an image file.',
            'event_photos.*.mimes' => 'Photo must be a file of type: :values.',
            'event_doc.*.mimes' => 'The :attribute must be a PDF file.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'event_title' => 'required',
            'event_content' => 'required',
            'event_location' => 'required',
            'event_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
            'event_doc.*' => 'mimes:pdf',
        ], $messages);
    

        try {
        $eventTitle = $request->input('event_title');
        $eventContent = $request->input('event_content');
        $eventloc = $request->input('event_location');
        $eventPhoto = $request->file('event_photo');
        $eventDoc = $request->file('event_doc');

        $eventId = DB::table('events')->insertGetId([
            'title' => $eventTitle,
            'description' => $eventContent,
            'location' => $eventloc,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Store photo for event section
        if ($request->hasFile('event_photos')) {
            $eventPhotos = $request->file('event_photos');
        
            foreach ($eventPhotos as $eventPhoto) {
                $photoPath = $eventPhoto->store('public/images');
                DB::table('images')->insert([
                    'url' => $photoPath,
                    'foreign_key' => $eventId,
                    'type' => 'event',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Store docs for event section
        if ($request ->hasFile('event_doc')) {
            $eventDoc = $request->file('event_doc');
            
            foreach($eventDoc as $eventDoc){
                $docPath = $eventDoc->store('public/docs');
                DB::table('docs')->insert([
                    'url' => $docPath,
                    'foreign_key' => $eventId,
                    'type' => 'event',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'event stored successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while storing data.');
    }
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
