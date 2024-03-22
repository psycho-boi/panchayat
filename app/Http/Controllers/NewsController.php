<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use  App\Models\News;
use  App\Models\Image;


class NewsController extends Controller
{
    


    public function index()
    {
        $newsItem = DB::table('news')
        ->leftJoin('images', function ($join) {
            $join->on('news.news_id', '=', 'images.foreign_key')
                 ->where('images.type', '=', 'News');
        })
        ->where('news.is_active', '!=', '0' )
        ->select('news.title as news_title', 'news.description', 'images.url')
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
        'news_title.required' => 'The workshop title is required.',
        'news_content.required' => 'The workshop content is required.',
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
    $newsPhoto = $request->file('news_photo');

    $newsId = DB::table('news')->insertGetId([
        'title' => $newsTitle,
        'description' => $newsContent,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Store photo for news section
    if ($newsPhoto) {
        
        $photoPath = $newsPhoto->store('public/images');
        DB::table('images')->insert([
            'url' => $photoPath,
            'foreign_key' => $newsId,
            'type' => 'news',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // if ($request->hasFile('news_photos')) {
    //     $newsPhoto = $request->file('news_photo');
    //     foreach ($newsPhoto as $newsPhoto) {
    //         $photoPath = $newsPhoto->store('public/images');
    //         DB::table('images')->insert([
    //             'url' => $photoPath,
    //             'foreign_key' => $newsId,
    //             'type' => 'news',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }
    // }

    // Store docs for news section
    // $newsDoc = $request->file('news_doc');
    // if ($newsDoc) {
    //     $docPath = $newsDoc->store('docs');
    //     DB::table('docs')->insert([
    //         'title' => $newsTitle,
    //         'description' => $newsContent,
    //         'category' => 'news',
    //         'path' => $docPath,
    //     ]);
    // }

    // Similar logic for other sections (workshop, event, notice)

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
