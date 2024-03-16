<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Workshop;
use App\Models\Slider;
use App\Models\Event;
use App\Models\OnlineFacility;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    
    public function index(){

        //fetch news
        $newsItem = DB::table('news')
        ->leftJoin('images', function ($join) {
            $join->on('news.news_id', '=', 'images.foreign')
                 ->where('images.type', '=', 'News');
        })
        ->select('news.title as news_title', 'news.description', 'images.url', 'news.created_at')
        ->orderBy('news.created_at', 'desc')
        ->get();

        $newsItem->transform(function ($item) {
            if ($item->url) {
                $item->url = str_replace('public/', '', $item->url);
            }
            return $item;
        });



        $Workshop = Workshop::latest()->take(3)->get();
        $Slider = Slider::latest()->take(3)->get();
        $Event = Event::latest()->take(3)->get();
        $OnlineFacility = OnlineFacility::latest()->take(3)->get();

    
        // @dd($News);
        return view('homapage', compact(['newsItem','Workshop','Slider','Event','OnlineFacility']));
    }

}
