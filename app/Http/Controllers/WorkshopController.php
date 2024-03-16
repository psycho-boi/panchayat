<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsItem = DB::table('news')
            ->leftJoin('images', function ($join) {
                $join->on('news.news_id', '=', 'images.foreign')
                    ->where('images.type', '=', 'News');
            })
            ->leftJoin('docs', function ($join) {
                $join->on('news.news_id', '=', 'docs.foreign')
                    ->where('docs.type', '=', 'News');
            })
            ->select('news.title as news_title', 'news.description', 'images.url as image_url', 'docs.url as doc_url')
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

        return $newsItem;
}

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
    if ($request->hasFile('ws_photo')) {
        $wsPhoto = $request->file('ws_photo'); 
        // $photoPath = $workshopPhoto->move(public_path('images'));
        $photoPath = $wsPhoto->store('public/images');
        DB::table('images')->insert([
            'url' => $photoPath,
            'foreign' => $wsId,
            'type' => 'Workshop',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Store docs for workshop section
    if ($request ->hasFile('ws_doc')) {
        $wsDoc = $request->file('ws_doc');
        $docPath = $wsDoc->store('docs');
        DB::table('docs')->insert([
            'url' => $docPath,
            'foreign' => $wsId,
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
