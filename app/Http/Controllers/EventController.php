<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(){
        $eventItem = DB::table('events')
        ->leftJoin('images', function ($join) {
            $join->on('events.event_id', '=', 'images.foreign_key')
                ->where('images.type', '=', 'event')
                ->where('images.is_active', '=',  '1')
                ->take(1)
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = events.event_id and type = "event" and is_active="1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('events.event_id', '=', 'docs.foreign_key')
                ->where('docs.type', '=', 'event')
                ->where('docs.is_active', '=',  '1')
                ->take(1)
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = events.event_id and type = "event" and is_active="1")');
        })
        ->where('events.is_active', '!=', '0' )
        ->select('events.title as event_title', 'events.description', 'events.event_id as event_id', 'images.url as image_url', 'docs.url as event_doc_url ')
        ->orderBy('events.created_at', 'desc')
        ->get();

        // $eventItem->transform(function ($item) {
        //     if ($item->image_url) {
        //         $item->image_url = str_replace('public/', '', $item->image_url);
        //     }
        //     if ($item->event_doc_url) {
        //         $item->event_doc_url = str_replace('public/', '', $item->event_doc_url);
        //      }
        //     return $item;
        // });

        return view('event', compact('eventItem'));
    }


    public function display($id){
        $event = DB::table('events')
        ->where('event_id', $id)
        ->where('is_active', '1')
        ->first();


        if (!$event) {
            abort(404); // event not found
        }
        
        // Fetching all images related to the article
        $images = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'event')
                    ->where('images.is_active', '1')
                    ->get();

        $docs = DB::table('docs')
                    ->where('foreign_key', $id)
                    ->where('type', 'event')
                    ->where('docs.is_active', '1')
                    ->get();

        $images->transform(function ($item) {
            if ($item->url) {
                $item->url = str_replace('public/', '', $item->url);
            }
            return $item;
        });

        $docs->transform(function ($item) {
            if ($item->url) {
                $item->url = str_replace('public/', '', $item->url);
            }
            return $item;
        });
        
        // Separate the first image from the rest
        $mainImage = $images->shift(); // Removes and returns the first item

        return view('eventshow', compact('event', 'docs', 'mainImage', 'images'));
    }


    public function index()
    {
        $eventItem = DB::table('events')
        ->leftJoin('images', function ($join) {
            $join->on('events.event_id', '=', 'images.foreign_key')
                ->where('images.type', '=', 'event')
                ->where('images.is_active', '=',  '1')
                ->take(1)
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = events.event_id and type = "event" and is_active="1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('events.event_id', '=', 'docs.foreign_key')
                ->where('docs.type', '=', 'event')
                ->where('docs.is_active', '=',  '1')
                ->take(1)
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = events.event_id and type = "event" and is_active="1")');
        })
        ->where('events.is_active', '=', '1' )
        ->select('events.title as event_title', 'events.description', 'events.event_id as event_id', 'images.url as image_url', 'docs.url as event_doc_url')
        ->orderBy('events.created_at', 'desc')
        ->get();

    $eventItem->transform(function ($item) {
        if ($item->image_url) {
            $item->image_url = str_replace('public/', '', $item->image_url);
        }
        if ($item->event_doc_url) {
            $item->event_doc_url = str_replace('public/', '', $item->event_doc_url);
        }
        return $item;
    });

    return view('event.event', compact('eventItem'));
    }



    public function showDoc($doc_url)
    {
        // Assuming the documents are stored in the 'storage/docs' directory
        $docPath = storage_path( $doc_url);

        // Check if the document file exists
        if (!file_exists($docPath)) {
            abort(404);
        }

        // Return a view to display the document
        return response()->file($docPath);
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
            'start_datetime.required' => 'Please provide the starting date and time of the workshop.',
            'end_datetime.required' => 'Please provide the end date and time of the workshop.',
            'event_photos.*.mimes' => 'Photo must be a file of type: :values.',
            'event_doc.*.mimes' => 'The :attribute must be a PDF file.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'event_title' => 'required',
            'event_content' => 'required',
            'event_location' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'event_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
            'event_doc.*' => 'mimes:pdf',
        ], $messages);
    

        try {
        $eventTitle = $request->input('event_title');
        $eventContent = $request->input('event_content');
        $eventloc = $request->input('event_location');
        $start_datetime = $request->input('start_datetime');
        $end_datetime = $request->input('end_datetime');
        $eventPhoto = $request->file('event_photo');
        $eventDoc = $request->file('event_doc');

        $eventId = DB::table('events')->insertGetId([
            'title' => $eventTitle,
            'description' => $eventContent,
            'location' => $eventloc,
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
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
        $event = DB::table('events')
        ->where('event_id', $id)
        ->where('is_active', '!=', 0)
        ->first();


        if (!$event) {
            abort(404); // event not found
        }
        
        // Fetching all images related to the article
        $eventImages = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'event')
                    ->where('images.is_active', '1')
                    ->get();

        $eventDocs = DB::table('docs')
                    ->where('foreign_key', $id)
                    ->where('type', 'event')
                    ->where('docs.is_active', '1')
                    ->get();

    return view('event.editevent', compact('event', 'eventImages', 'eventDocs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $event_id)
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


        $event = Event::findOrFail($event_id);

    try {
        $event->title = $request->input('event_title');
        $event->description = $request->input('event_content');
        $event->location = $request->input('event_location');
        $event->updated_at =  now();
        $event->save();


        if ($request->hasFile('event_photos')) {
            $eventPhotos = $request->file('event_photos');
        
            foreach ($eventPhotos as $eventPhoto) {
                $photoPath = $eventPhoto->store('public/images');
                DB::table('images')->insert([
                    'url' => $photoPath,
                    'foreign_key' => $event_id,
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
                    'foreign_key' => $event_id,
                    'type' => 'event',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


    return redirect()->back()->with('success', 'event updated successfully');
} catch (\Exception $e) {
    return redirect()->back()->with('error', 'An error occurred while updating event');
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
        $event = Event::findOrFail($id);
        $event->is_active = 0;
        $event->save();

        return redirect()->back()->with('success', 'Event deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while deleting the event.');
    }

    
    }
}
