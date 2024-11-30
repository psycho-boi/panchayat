<?php

namespace App\Http\Controllers;

use App\Models\OnlineFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacilitiesController extends Controller
{

    public function list(){
        $facilitiesItem = DB::table('online_facilities')
        ->leftJoin('images', function ($join) {
            $join->on('online_facilities.facility_id', '=', 'images.foreign_key')
                // ->where('images.type', '=', 'online_facilities')
                // ->where('images.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = online_facilities.facility_id and type = "online_facilities" and is_active="1")');
        })
        ->where('online_facilities.is_active', '!=', '0' )
        ->select('online_facilities.title as facilities_title', 'online_facilities.description', 'online_facilities.facility_id as facility_id', 'images.url as image_url')
        ->orderBy('online_facilities.created_at', 'desc')
        ->get();

        $facilitiesItem->transform(function ($item) {
            if ($item->image_url) {
                $item->image_url = str_replace('public/', 'storage/', $item->image_url);
            }
            return $item;
        });

        return view('facilities', compact('facilitiesItem'));

    }

        public function display($id){
            $facilitiesItem = DB::table('online_facilities')
            ->where('facility_id', $id)
            ->where('is_active', '1')
            ->first();
    
    
            if (!$facilitiesItem) {
                abort(404); // online_facilities not found
            }
            
            // Fetching all images related to the article
            $images = DB::table('images')
                        ->where('foreign_key', $id)
                        ->where('type', 'online_facilities')
                        ->where('images.is_active', '1')
                        ->get();
    
            $images->transform(function ($item) {
                if ($item->url) {
                    $item->url = str_replace('public/', 'storage/', $item->url);
                }
                return $item;
            });
            
            // Separate the first image from the rest
            $mainImage = $images->shift(); // Removes and returns the first item
    
            return view('facilitiesshow', compact('facilitiesItem', 'mainImage', 'images'));
        }
    



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilitiesItem = DB::table('online_facilities')
        ->leftJoin('images', function ($join) {
            $join->on('online_facilities.facility_id', '=', 'images.foreign_key')
                // ->where('images.type', '=', 'online_facilities')
                // ->where('images.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = online_facilities.facility_id and type = "online_facilities" and is_active="1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('online_facilities.facility_id', '=', 'docs.foreign_key')
                // ->where('docs.type', '=', 'online_facilities')
                // ->where('docs.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = online_facilities.facility_id and type = "online_facilities" and is_active="1")');
        })
        ->where('online_facilities.is_active', '=', '1' )
        ->select('online_facilities.title as facilities_title', 'online_facilities.description', 'online_facilities.facility_id as facility_id', 'images.url as image_url', 'docs.url as facilities_doc_url')
        ->orderBy('online_facilities.created_at', 'desc')
        ->get();

    $facilitiesItem->transform(function ($item) {
        if ($item->image_url) {
            $item->image_url = str_replace('public/', '', $item->image_url);
        }
        if ($item->facilities_doc_url) {
            $item->facilities_doc_url = str_replace('public/', '', $item->facilities_doc_url);
        }
        return $item;
    });

    return view('facilities.facilities', compact('facilitiesItem'));
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
            'facilities_title.required' => 'The online_facilities title is required.',
            'facilities_content.required' => 'The online_facilities content is required.',
            // 'facilities_location.required' => 'The online_facilities location is required.',
            // 'facilities_photos.*.image' => 'The attribute must be an image file.',
            'facilities_photos.*.mimes' => 'Photo must be a file of type: :values.',
            'facilities_doc.*.mimes' => 'The :attribute must be a PDF file.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'facilities_title' => 'required',
            'facilities_content' => 'required',
            // 'facilities_location' => 'required',
            'facilities_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
            'facilities_doc.*' => 'mimes:pdf',
        ], $messages);
    

        try {
        $facilitiesTitle = $request->input('facilities_title');
        $facilitiesContent = $request->input('facilities_content');
        // $facilitiesloc = $request->input('facilities_location');
        $facilitiesPhoto = $request->file('facilities_photo');
        // $facilitiesDoc = $request->file('facilities_doc');

        $facilitiesId = DB::table('online_facilities')->insertGetId([
            'title' => $facilitiesTitle,
            'description' => $facilitiesContent,
            // 'location' => $facilitiesloc,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Store photo for online_facilities section
        if ($request->hasFile('facilities_photos')) {
            $facilitiesPhotos = $request->file('facilities_photos');
        
            foreach ($facilitiesPhotos as $facilitiesPhoto) {
                $photoPath = $facilitiesPhoto->store('public/images');
                DB::table('images')->insert([
                    'url' => $photoPath,
                    'foreign_key' => $facilitiesId,
                    'type' => 'online_facilities',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'online_facilities stored successfully');
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
        $facilities = DB::table('online_facilities')
        ->where('facility_id', $id)
        ->where('is_active', '!=', 0)
        ->first();


        if (!$facilities) {
            abort(404); // online_facilities not found
        }
        
        // Fetching all images related to the article
        $facilitiesImages = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'online_facilities')
                    ->where('images.is_active', '1')
                    ->get();

        // $facilitiesDocs = DB::table('docs')
        //             ->where('foreign_key', $id)
        //             ->where('type', 'online_facilities')
        //             ->where('docs.is_active', '1')
        //             ->get();

    return view('facilities.editfacilities', compact('facilities', 'facilitiesImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $facility_id)
    {
        $messages = [
            'facilities_title.required' => 'The online_facilities title is required.',
            'facilities_content.required' => 'The online_facilities content is required.',
            // 'facilities_location.required' => 'The online_facilities location is required.',
            // 'facilities_photos.*.image' => 'The attribute must be an image file.',
            'facilities_photos.*.mimes' => 'Photo must be a file of type: :values.',
            // 'facilities_doc.*.mimes' => 'The :attribute must be a PDF file.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'facilities_title' => 'required',
            'facilities_content' => 'required',
            // 'facilities_location' => 'required',
            'facilities_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
            // 'facilities_doc.*' => 'mimes:pdf',
        ], $messages);


        $online_facilities = OnlineFacility::findOrFail($facility_id);

    try {
        $online_facilities->title = $request->input('facilities_title');
        $online_facilities->description = $request->input('facilities_content');
        // $online_facilities->location = $request->input('facilities_location');
        $online_facilities->updated_at =  now();
        $online_facilities->save();


        if ($request->hasFile('facilities_photos')) {
            $facilitiesPhotos = $request->file('facilities_photos');
        
            foreach ($facilitiesPhotos as $facilitiesPhoto) {
                $photoPath = $facilitiesPhoto->store('public/images');
                DB::table('images')->insert([
                    'url' => $photoPath,
                    'foreign_key' => $facility_id,
                    'type' => 'online_facilities',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


    return redirect()->back()->with('success', 'online_facilities updated successfully');
} catch (\Exception $e) {
    return redirect()->back()->with('error', 'An error occurred while updating online_facilities');
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
        $online_facilities = OnlineFacility::findOrFail($id);
        $online_facilities->is_active = 0;
        $online_facilities->save();

        return redirect()->back()->with('success', 'online_facilities deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while deleting the online_facilities.');
    }

    
    }
}

