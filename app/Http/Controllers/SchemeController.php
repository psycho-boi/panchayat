<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    public function list(){
        $eventItem = DB::table('events')
        ->leftJoin('images', function ($join) {
            $join->on('events.event_id', '=', 'images.foreign_key')
                ->where('images.type', '=', 'event')
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = events.event_id and type = "event")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('events.event_id', '=', 'docs.foreign_key')
                ->where('docs.type', '=', 'event')
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = events.event_id and type = "event")');
        })
        ->where('events.is_active', '!=', '0' )
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

        return view('scheme', compact('schemetItem'));
    }

    


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schemeItem = DB::table('schemes')
        ->leftJoin('images', function ($join) {
            $join->on('schemes.scheme_id', '=', 'images.foreign_key')
                ->where('images.type', '=', 'scheme')
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = schemes.scheme_id and type = "scheme")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('schemes.scheme_id', '=', 'docs.foreign_key')
                ->where('docs.type', '=', 'scheme')
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = schemes.scheme_id and type = "scheme")');
        })
        ->where('schemes.is_active', '!=', '0' )
        ->select('schemes.title as scheme_title', 'schemes.description', 'images.url as image_url', 'docs.url as doc_url')
        ->orderBy('schemes.created_at', 'desc')
        ->get();

    $schemeItem->transform(function ($item) {
        if ($item->image_url) {
            $item->image_url = str_replace('public/', '', $item->image_url);
        }
        if ($item->doc_url) {
            $item->doc_url = str_replace('public/', '', $item->doc_url);
        }
        return $item;
    });

    return view('scheme.scheme', compact('schemeItem'));
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
            'scheme_title.required' => 'The scheme title is required.',
            'scheme_content.required' => 'The scheme content is required.',
            'scheme_eligibility.required' => 'The scheme Eligibility is required.',
            // 'scheme_location.required' => 'The scheme location is required.',
            // 'scheme_photos.*.image' => 'The attribute must be an image file.',
            'scheme_photos.*.mimes' => 'Photo must be a file of type: :values.',
            'scheme_doc.*.mimes' => 'The document must be a PDF file.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'scheme_title' => 'required',
            'scheme_content' => 'required',
            // 'scheme_location' => 'required',
            'scheme_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
            'scheme_doc.*' => 'mimes:pdf',
        ], $messages);
    

        try {
        $schemeTitle = $request->input('scheme_title');
        $schemeContent = $request->input('scheme_content');
        $schemeEli = $request->input('scheme_eligibility');
        $schemePhoto = $request->file('scheme_photo');
        $schemeDoc = $request->file('scheme_doc');

        $schemeId = DB::table('schemes')->insertGetId([
            'title' => $schemeTitle,
            'description' => $schemeContent,
            'eligibility' => $schemeEli,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Store photo for scheme section
        if ($request->hasFile('scheme_photos')) {
            $schemePhotos = $request->file('scheme_photos');
        
            foreach ($schemePhotos as $schemePhoto) {
                $photoPath = $schemePhoto->store('public/images');
                DB::table('images')->insert([
                    'url' => $photoPath,
                    'foreign_key' => $schemeId,
                    'type' => 'scheme',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Store docs for scheme section
        if ($request ->hasFile('scheme_doc')) {
            $schemeDoc = $request->file('scheme_doc');
            
            foreach($schemeDoc as $schemeDoc){
                $docPath = $schemeDoc->store('public/docs');
                DB::table('docs')->insert([
                    'url' => $docPath,
                    'foreign_key' => $schemeId,
                    'type' => 'scheme',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'scheme stored successfully');
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
