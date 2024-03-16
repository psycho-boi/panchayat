<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use  App\Models\News;
use  App\Models\Image;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
        // // $News = News::latest()->get();
        // // return view('admin.news', compact('News'));

        // // Get all news items
        // $newsItem = DB::table('news')->get();

        // // For each news item, retrieve the associated photo
        // foreach ($newsItem as $news) {
        //     // Fetch the associated photo
        //     $photo = DB::table('Images')
        //                ->where('foreign', $news->news_id)
        //                ->where('type', 'App\Models\News')
        //                ->first();

        //     // Assign the photo path to the news item
        //     $news->photo = $photo ? asset($photo->path) : null;
        // }

        // // Pass the data to the view
        // return view('news.news', compact('newsItem'));




    public function index()
    {
        $newsItem = DB::table('workshops')
        ->leftJoin('images', function ($join) {
            $join->on('workshop.workshop_id', '=', 'images.foreign')
                 ->where('images.type', '=', 'News');
        })
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
    // Store data for news section
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
        // $photoPath = $newsPhoto->move(public_path('images'));
        $photoPath = $newsPhoto->store('public/images');
        DB::table('images')->insert([
            'url' => $photoPath,
            'foreign' => $newsId,
            'type' => 'news',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

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
