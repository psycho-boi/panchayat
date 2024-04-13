<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;  
use  App\Models\News;
use  App\Models\Image;


class NewsController extends Controller
{
    
    public function list(){
        $newsItem = DB::table('news')
        ->leftJoin('images', function ($join) {
            $join->on('news.news_id', '=', 'images.foreign_key')
                // ->where('images.type', '=', 'news')
                // ->where('images.is_active', '=', '1')
                // ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = news.news_id and type = "news" and is_active="1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('news.news_id', '=', 'docs.foreign_key')
                ->where('docs.type', '=', 'news')
                ->where('docs.is_active', '=', '1')
                ->take(1);
                // ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = news.news_id and type = "news" and is_active="1")');
        })
        ->where('news.is_active', '!=', '0')
        ->select('news.title as news_title', 'news.description', 'news.news_id as news_id', 'images.url as image_url', 'docs.url as doc_url')
        ->orderBy('news.created_at', 'desc')
        ->get();

    $newsItem->transform(function ($item) {
        if ($item->image_url) {
            $item->image_url = str_replace('public/', '', $item->image_url);
        }
        if ($item->doc_url) {
            $item->doc_url = str_replace('public/', '', $item->doc_url);
        }
        return $item;
    });

    return view('news', compact('newsItem'));
    }




    public function display($id){
        $news = DB::table('news')
        ->where('news_id', $id)
        ->where('news.is_active', '!=', 0)
        ->first();


        if (!$news) {
            abort(404); // news not found
        }
        
        // Fetching all images related to the article
        $images = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'news')
                    ->where('is_active','1')
                    ->get();

        $docs = DB::table('docs')
                    ->where('foreign_key', $id)
                    ->where('type', 'news')
                    ->where('is_active','1')
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

        return view('newsshow', compact('news', 'docs', 'mainImage', 'images'));
    }





    public function index()
    {
        $newsItem = DB::table('news')
        ->leftJoin('images', function ($join) {
            $join->on('news.news_id', '=', 'images.foreign_key')
                // ->where('images.type', '=', 'news')
                // ->where('images.is_active', '=', '1')
                // ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = news.news_id and type = "news" and is_active="1")');
        })
        ->where('news.is_active', '!=', '0' )
        ->select('news.title as news_title', 'news.news_id as news_id', 'news.description', 'images.url')
        ->orderBy('news.created_at', 'desc')
        ->get();

        $newsItem->transform(function ($item) {
            if ($item->url) {
                $item->url = str_replace('public/', '', $item->url);
            }
            return $item;
        });

    return view('news.news', compact('newsItem'));
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
        'news_title.required' => 'The news title is required.',
        'news_content.required' => 'The news content is required.',
        'ws_photos.*.mimes' => 'Photo must be a file of type: :values.',
    ];

    // Validate the request data
    $validatedData = $request->validate([
        'news_title' => 'required',
        'news_content' => 'required',
        'ws_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
    ], $messages);


try {
    $newsTitle = $request->input('news_title');
    $newsContent = $request->input('news_content');
    $newsPhoto = $request->file('news_photos');

    $newsId = DB::table('news')->insertGetId([
        'title' => $newsTitle,
        'description' => $newsContent,
        'created_at' => now(),
        'updated_at' => now(),
    ]);


    if ($request->hasFile('news_photos')) {
        $newsPhotos = $request->file('news_photos');
    
        foreach ($newsPhotos as $newsPhoto) {
            $photoPath = $newsPhoto->store('public/images');
            DB::table('images')->insert([
                'url' => $photoPath,
                'foreign_key' => $newsId,
                'type' => 'news',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Similar logic for other sections (news, news, notice)

    return redirect()->back()->with('success', 'News stored successfully');
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
        $news = DB::table('news')
        ->where('news_id', $id)
        ->where('is_active', '!=', 0)
        ->first();


        if (!$news) {
            abort(404); // news not found
        }
        
        // Fetching all images related to the article
        $newsImages = DB::table('images')
                    ->where('foreign_key', $id)
                    ->where('type', 'news')
                    ->where('images.is_active', '1')
                    ->get();

        $newsDocs = DB::table('docs')
                    ->where('foreign_key', $id)
                    ->where('type', 'news')
                    ->where('docs.is_active', '1')
                    ->get();

    return view('news.editnews', compact('news', 'newsImages', 'newsDocs'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $news_id)
    {
        $messages = [
            'news_title.required' => 'The news title is required.',
            'news_content.required' => 'The news content is required.',
            // 'news_location.required' => 'The news location is required.',
            // 'news_photos.*.image' => 'The attribute must be an image file.',
            'news_photos.*.mimes' => 'Photo must be a file of type: :values.',
            'news_doc.*.mimes' => 'The :attribute must be a PDF file.',
        ];
        
        // Validate the request data
        $validatedData = $request->validate([
            'news_title' => 'required',
            'news_content' => 'required',
            // 'news_location' => 'required',
            'news_photos.*' => 'mimes:jpeg,png,jpg,gif,svg',
            'news_doc.*' => 'mimes:pdf',
        ], $messages);


        $news = news::findOrFail($news_id);

    try {
        $news->title = $request->input('news_title');
        $news->description = $request->input('news_content');
        // $news->location = $request->input('news_location');
        $news->save();


        if ($request->hasFile('news_photos')) {
            $newsPhotos = $request->file('news_photos');
        
            foreach ($newsPhotos as $newsPhoto) {
                $photoPath = $newsPhoto->store('public/images');
                DB::table('images')->insert([
                    'url' => $photoPath,
                    'foreign_key' => $news_id,
                    'type' => 'news',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Store docs for news section
        if ($request ->hasFile('news_doc')) {
            $newsDoc = $request->file('news_doc');
            
            foreach($newsDoc as $newsDoc){
                $docPath = $newsDoc->store('public/docs');
                DB::table('docs')->insert([
                    'url' => $docPath,
                    'foreign_key' => $news_id,
                    'type' => 'news',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


    return redirect()->back()->with('success', 'news updated successfully');
} catch (\Exception $e) {
    return redirect()->back()->with('error', 'An error occurred while updating news');
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
            $news = News::findOrFail($id);
            $news->is_active = 0;
            $news->save();
    
            return redirect()->back()->with('success', 'news deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the news.');
        }
    
        
    }
}
