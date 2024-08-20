<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Image;
use App\Models\Doc;
use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function list(){
        $workshopItem = DB::table('workshops')
        ->leftJoin('images', function ($join) {
            $join->on('workshops.workshop_id', '=', 'images.foreign_key')
                // ->where('images.type', '=', 'workshop')
                // ->where('images.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = workshops.workshop_id and type = "workshop" and images.is_active="1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('workshops.workshop_id', '=', 'docs.foreign_key')
                // ->where('docs.type', '=', 'workshop')
                // ->where('docs.is_active', '=', '1')
                // ->take(1);
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = workshops.workshop_id and type = "workshop" and docs.is_active="1")');
        })
        ->where('workshops.is_active', '!=', '0')
        ->select('workshops.title as workshop_title', 'workshops.description', 'workshops.workshop_id as workshop_id', 'images.url as image_url', 'docs.url as doc_url')
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

    return view('workshop', compact('workshopItem'));
    }



    public function display($id){
        $workshop = DB::table('workshops')
        ->where('workshop_id', $id)
        ->where('workshops.is_active', '!=', 0)
        ->first();


        if (!$workshop) {
            abort(404); // Workshop not found
        }
        
        // Fetching all images related to the article
        $images = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'workshop')
                    ->where('images.is_active', '1')
                    ->get();

        $docs = DB::table('docs')
                    ->where('foreign_key', $id)
                    ->where('type', 'workshop')
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

        return view('workshopshow', compact('workshop', 'docs', 'mainImage', 'images'));
    }




    // multipl image
    public function index()
{
    $workshopItem = DB::table('workshops')
        ->leftJoin('images', function ($join) {
            $join->on('workshops.workshop_id', '=', 'images.foreign_key')
                // ->where('images.type', '=', 'workshop')
                // ->where('images.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = workshops.workshop_id and type = "workshop" and is_active="1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('workshops.workshop_id', '=', 'docs.foreign_key')
                // ->where('docs.type', '=', 'workshop')
                // ->where('docs.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = workshops.workshop_id and type = "workshop" and is_active="1")');
        })
        ->where('workshops.is_active', '!=', '0')
        ->select('workshops.title as workshop_title', 'workshops.description', 'workshops.workshop_id as workshop_id', 'images.url as image_url', 'docs.url as doc_url')
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
        $messages = [
            'ws_title.required' => 'The workshop title is required.',
            'ws_content.required' => 'The workshop content is required.',
            'ws_location.required' => 'The workshop location is required.',
            'start_datetime.required' => 'Please provide the starting date and time of the workshop.',
            'end_datetime.required' => 'Please provide the end date and time of the workshop.',
            // 'ws_photos.*.image' => 'The attribute must be an image file.',
            'ws_photos.*.mimes' => 'Photo must be a file of type: :values.',
            'ws_doc.*.mimes' => 'The :attribute must be a PDF file.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'ws_title' => 'required',
            'ws_content' => 'required',
            'ws_location' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'ws_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
            'ws_doc.*' => 'mimes:pdf',
        ], $messages);
    

        try {
        $wsTitle = $request->input('ws_title');
        $wsContent = $request->input('ws_content');
        $wsloc = $request->input('ws_location');
        $wsPhoto = $request->file('ws_photo');
        $wsDoc = $request->file('ws_doc');
        $start_datetime = $request->input('start_datetime');
        $end_datetime = $request->input('end_datetime');

        $wsId = DB::table('workshops')->insertGetId([
            'title' => $wsTitle,
            'description' => $wsContent,
            'location' => $wsloc,
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
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
            
            foreach($wsDoc as $wsDoc){
                $docPath = $wsDoc->store('public/docs');
                DB::table('docs')->insert([
                    'url' => $docPath,
                    'foreign_key' => $wsId,
                    'type' => 'Workshop',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'workshop stored successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while storing data.');
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $workshop = DB::table('workshops')
        // ->where('workshop_id', $id)
        // ->where('is_active', '!=', 0)
        // ->first();


        // if (!$workshop) {
        //     abort(404); // Workshop not found
        // }
        
        // // Fetching all images related to the article
        // $images = DB::table('images')
        //             ->where('foreign_key', $id)
        //             ->where('type', 'workshop')
        //             ->get();

        // $docs = DB::table('docs')
        //             ->where('foreign_key', $id)
        //             ->where('type', 'workshop')
        //             ->get();

        // $images->transform(function ($item) {
        //     if ($item->url) {
        //         $item->url = str_replace('public/', '', $item->url);
        //     }
        //     return $item;
        // });

        // $docs->transform(function ($item) {
        //     if ($item->url) {
        //         $item->url = str_replace('public/', '', $item->url);
        //     }
        //     return $item;
        // });

        
        // return view('workshop.editworkshop', compact('workshop', 'docs', 'images'));        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $workshop = DB::table('workshops')
        ->where('workshop_id', $id)
        ->where('is_active', '!=', 0)
        ->first();


        if (!$workshop) {
            abort(404); // Workshop not found
        }
        
        // Fetching all images related to the article
        $workshopImages = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'workshop')
                    ->where('images.is_active', '1')
                    ->get();

        $workshopDocs = DB::table('docs')
                    ->where('foreign_key', $id)
                    ->where('type', 'workshop')
                    ->where('docs.is_active', '1')
                    ->get();

    return view('workshop.editworkshop', compact('workshop', 'workshopImages', 'workshopDocs'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    public function update(Request $request, $workshop_id)
{

    $messages = [
        'ws_title.required' => 'The workshop title is required.',
        'ws_content.required' => 'The workshop content is required.',
        'ws_location.required' => 'The workshop location is required.',
        // 'ws_photos.required' => 'The workshop image is required.',
        // 'ws_photos.*.image' => 'The attribute must be an image file.',
        'ws_photos.*.mimes' => 'Photo must be a file of type: :values.',
        'ws_doc.*.mimes' => 'The :attribute must be a PDF file.',
    ];

    $validatedData = $request->validate([
        'ws_title' => 'required',
        'ws_content' => 'required',
        'ws_location' => 'required',
        // 'ws_photos' => 'required',
        'ws_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
        'ws_docs.*' => 'mimes:pdf',
    ], $messages);
    

    $workshop = Workshop::findOrFail($workshop_id);


    try {
        $workshop->title = $request->input('ws_title');
        $workshop->description = $request->input('ws_content');
        $workshop->location = $request->input('ws_location');
        $workshop->save();

        // Handle photo uploads
        // if ($request->hasFile('ws_photos')) {
        //     $wsPhotos = $request->file('ws_photos');
        //     foreach ($wsPhotos as $wsPhoto) {
        //         $photoPath = $wsPhoto->store('public/images');
        //         Image::create([
        //             'url' => $photoPath,
        //             'foreign_key' => $workshop_id,
        //             'type' => 'Workshop',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }
        // }

        // Handle document uploads
        // if ($request->hasFile('ws_docs')) {
        //     $wsDocs = $request->file('ws_docs');
        //     foreach ($wsDocs as $wsDoc) {
        //         $docPath = $wsDoc->store('public/docs');
        //         Doc::create([
        //             'url' => $docPath,
        //             'foreign_key' => $workshop->workshop_id,
        //             'type' => 'Workshop',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }
        // }


        if ($request->hasFile('ws_photos')) {
            $wsPhotos = $request->file('ws_photos');
        
            foreach ($wsPhotos as $wsPhoto) {
                $photoPath = $wsPhoto->store('public/images');
                DB::table('images')->insert([
                    'url' => $photoPath,
                    'foreign_key' => $workshop_id,
                    'type' => 'Workshop',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Store docs for workshop section
        if ($request ->hasFile('ws_doc')) {
            $wsDoc = $request->file('ws_doc');
            
            foreach($wsDoc as $wsDoc){
                $docPath = $wsDoc->store('public/docs');
                DB::table('docs')->insert([
                    'url' => $docPath,
                    'foreign_key' => $workshop_id,
                    'type' => 'Workshop',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    //     return redirect()->route('workshops.index')->with('success', 'Workshop updated successfully');
    // } catch (\Exception $e) {
    //     return redirect()->back()->with('error', 'An error occurred while updating the workshop.');
    // }

    return redirect()->back()->with('success', 'workshop updated successfully');
} catch (\Exception $e) {
    return redirect()->back()->with('error', 'An error occurred while updating workshop');
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
        $workshop = Workshop::findOrFail($id);
        $workshop->is_active = 0;
        $workshop->save();

        return redirect()->route('workshop.index')->with('success', 'Workshop deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while deleting the workshop.');
    }

    
}

}