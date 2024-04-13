<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    public function list(){
        $schemeItem = DB::table('schemes')
        ->leftJoin('images', function ($join) {
            $join->on('schemes.scheme_id', '=', 'images.foreign_key')
                // ->where('images.type', '=', 'scheme')
                // ->where('images.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = schemes.scheme_id and type = "scheme" and is_active="1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('schemes.scheme_id', '=', 'docs.foreign_key')
                // ->where('docs.type', '=', 'scheme')
                // ->where('docs.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = schemes.scheme_id and type = "scheme" and is_active="1")');
        })
        ->where('schemes.is_active', '!=', '0' )
        ->select('schemes.title as scheme_title', 'schemes.scheme_id as scheme_id', 'schemes.eligibility as scheme_eligibility', 'schemes.description', 'schemes.scheme_id as scheme_id', 'images.url as image_url', 'docs.url as scheme_doc_url')
        ->orderBy('schemes.created_at', 'desc')
        ->get();

        $schemeItem->transform(function ($item) {
            if ($item->image_url) {
                $item->image_url = str_replace('public/', '', $item->image_url);
            }
            if ($item->scheme_doc_url) {
                $item->scheme_doc_url = str_replace('public/', '', $item->scheme_doc_url);
             }
            return $item;
        });

        return view('scheme', compact('schemeItem'));
    }

    
    public function display($id){
        $scheme = DB::table('schemes')
        ->where('scheme_id', $id)
        ->where('is_active', '!=', 0)
        ->first();


        if (!$scheme) {
            abort(404); // scheme not found
        }
        
        // Fetching all images related to the article
        $images = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'scheme')
                    ->where('images.is_active', '1')
                    ->get();

        $docs = DB::table('docs')
                    ->where('foreign_key', $id)
                    ->where('type', 'scheme')
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

        return view('schemeshow', compact('scheme', 'docs', 'mainImage', 'images')); 
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schemeItem = DB::table('schemes')
        ->leftJoin('images', function ($join) {
            $join->on('schemes.scheme_id', '=', 'images.foreign_key')
                // ->where('images.type', '=', 'scheme')
                // ->where('images.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = schemes.scheme_id and type = "scheme" and is_active="1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('schemes.scheme_id', '=', 'docs.foreign_key')
                // ->where('docs.type', '=', 'scheme')
                // ->where('docs.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = schemes.scheme_id and type = "scheme" and is_active="1")');
        })
        ->where('schemes.is_active', '!=', '0' )
        ->select('schemes.title as scheme_title', 'schemes.scheme_id as scheme_id', 'schemes.description', 'images.url as image_url', 'docs.url as doc_url')
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
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $scheme = DB::table('schemes')
        ->where('scheme_id', $id)
        ->where('is_active', '!=', 0)
        ->first();


        if (!$scheme) {
            abort(404); // scheme not found
        }
        
        // Fetching all images related to the article
        $schemeImages = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'scheme')
                    ->where('images.is_active', '1')
                    ->get();

        $schemeDocs = DB::table('docs')
                    ->where('foreign_key', $id)
                    ->where('type', 'scheme')
                    ->where('docs.is_active', '1')
                    ->get();

    return view('scheme.editscheme', compact('scheme', 'schemeImages', 'schemeDocs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $scheme_id)
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
            'scheme_eligibility' => 'required',
            'scheme_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
            'scheme_doc.*' => 'mimes:pdf',
        ], $messages);

        $scheme = Scheme::findOrFail($scheme_id);

        try {
            $scheme->title = $request->input('scheme_title');
            $scheme->description = $request->input('scheme_content');
            $scheme->eligibility = $request->input('scheme_eligibility');
            $scheme->updated_at = now();
            $scheme->save();
    
    
            if ($request->hasFile('scheme_photos')) {
                $schemePhotos = $request->file('scheme_photos');
            
                foreach ($schemePhotos as $schemePhoto) {
                    $photoPath = $schemePhoto->store('public/images');
                    DB::table('images')->insert([
                        'url' => $photoPath,
                        'foreign_key' => $scheme_id,
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
                        'foreign_key' => $scheme_id,
                        'type' => 'scheme',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
    
        return redirect()->back()->with('success', 'scheme updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating scheme');
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
        $scheme = Scheme::findOrFail($id);
        $scheme->is_active = 0;
        $scheme->save();

        return redirect()->back()->with('success', 'scheme deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while deleting the scheme.');
    }

    
    }
}
