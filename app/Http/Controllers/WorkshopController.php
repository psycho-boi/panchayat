<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // multipl image
    public function index()
{
    $workshopItem = DB::table('workshops')
        ->leftJoin('images', function ($join) {
            $join->on('workshops.workshop_id', '=', 'images.foreign_key')
                ->where('images.type', '=', 'workshop')
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = workshops.workshop_id and type = "workshop")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('workshops.workshop_id', '=', 'docs.foreign_key')
                ->where('docs.type', '=', 'workshop');
        })
        ->select('workshops.title as workshop_title', 'workshops.description', 'images.url as image_url', 'docs.url as doc_url')
        ->orderBy('workshops.created_at', 'desc')
        ->get();

    $workshopItem->transform(function ($item) {
        if ($item->image_url) {
            $item->image_url = str_replace('public/', '', $item->image_url);
        }
        if ($item->doc_url) {
            $item->doc_url = str_replace('public/', '', $item->doc_url);
        }
        return $item;
    });

    return view('workshop.workshop', compact('workshopItem'));
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Store data for workshop section
    $wsTitle = $request->input('ws_title');
    $wsContent = $request->input('ws_content');
    $wsloc = $request->input('ws_location');
    // $wsPhoto = $request->file('ws_photo');
    // $wsDoc = $request->file('ws_doc');

    $wsId = DB::table('workshops')->insertGetId([
        'title' => $wsTitle,
        'description' => $wsContent,
        'location' => $wsloc,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Store photo for workshop section
    if ($request->hasFile('ws_photos')) {
        $wsPhotos = $request->file('ws_photos');
    
        foreach ($wsPhotos as $wsPhoto) {
            $photoPath = $wsPhoto->store('public/images');
            DB::table('images')->insert([
                'url' => $photoPath,
                'foreign_key' => $wsId,
                'type' => 'Workshop',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Store docs for workshop section
    if ($request ->hasFile('ws_doc')) {
        $wsDoc = $request->file('ws_doc');
        $docPath = $wsDoc->store('public/docs');
        DB::table('docs')->insert([
            'url' => $docPath,
            'foreign_key' => $wsId,
            'type' => 'Workshop',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Similar logic for other sections (workshop, event, notice)

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
