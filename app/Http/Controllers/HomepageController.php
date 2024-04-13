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
            $join->on('news.news_id', '=', 'images.foreign_key')
                //  ->where('images.type', '=', 'News')
                //  ->where('images.is_active', '=',  '1')
                //  ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = news.news_id and type = "news" and is_active = "1")');
       
        })
        ->select('news.title as news_title', 'news.news_id as news_id', 'news.description', 'images.url', 'news.created_at')
        ->where('news.is_active', '=', '1')
        ->orderBy('news.created_at', 'desc')
        ->take(3)
        ->get();

        $newsItem->transform(function ($item) {
            if ($item->url) {
                $item->url = str_replace('public/', '', $item->url);
            }
            return $item;
        });

        //fetch workshops
        $workshopItem = DB::table('workshops')
        ->leftJoin('images', function ($join) {
            $join->on('workshops.workshop_id', '=', 'images.foreign_key')
                // ->where('images.is_active', '=', '1')
                // ->where('images.type', '=', 'workshop')
                // ->take(1)
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = workshops.workshop_id and type = "workshop" and is_active = "1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('workshops.workshop_id', '=', 'docs.foreign_key')
                // ->where('docs.type', '=', 'workshop')
                // ->where('docs.is_active', '=', '1')
                // ->take(1)
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = workshops.workshop_id and type = "workshop" and is_active="1")');
        })
        ->where('workshops.is_active', '=', '1')
        ->select('workshops.title as workshop_title', 'workshops.description', 'workshops.workshop_id as workshop_id', 'images.url as image_url', 'docs.url as doc_url', 'workshops.created_at')
        ->orderBy('workshops.created_at', 'desc')
        ->take(3)
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


        
        //fetch slider images
        $sliderItem = DB::table('sliders')
        ->leftJoin('images', function ($join) {
            $join->on('sliders.slider_id', '=', 'images.foreign_key')
                ->where('images.type', '=', 'slider')
                ->where('images.is_active', '=', '1');
            
                // ->whereRaw('images.image_id = (
                //     select MAX(imageid)
                //     from images
                //     where foreign_key = sliders.slider_id
                //     and type = "slider"
                //     and is_active = "1"
                // )');
        })
        ->where('sliders.is_active', '1')
        ->select('sliders.title as slider_title', 'sliders.description as slider_content', 'sliders.slider_id as slider_id', DB::raw('COALESCE(images.url, "default_image_url") as image_url'))
        ->orderBy('sliders.created_at', 'desc')
        ->get();

        $sliderItem->transform(function ($item) {
            if ($item->image_url) {
                $item->image_url = str_replace('public/', 'storage/', $item->image_url);
            }
            return $item;
        });








        //fetch online facility item
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
        ->take(3)
        ->get();

        $facilitiesItem->transform(function ($item) {
            if ($item->image_url) {
                $item->image_url = str_replace('public/', 'storage/', $item->image_url);
            }
            return $item;
        });





        //fetch Events
        $eventItem = DB::table('events')
        ->leftJoin('images', function ($join) {
            $join->on('events.event_id', '=', 'images.foreign_key')
                // ->where('images.type', '=', 'event')
                // ->where('images.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('images.image_id = (select MIN(image_id) from images where foreign_key = events.event_id and type = "event" and is_active="1")');
        })
        ->leftJoin('docs', function ($join) {
            $join->on('events.event_id', '=', 'docs.foreign_key')
                // ->where('docs.type', '=', 'event')
                // ->where('docs.is_active', '=',  '1')
                // ->take(1);
                ->whereRaw('docs.doc_id = (select MIN(doc_id) from docs where foreign_key = events.event_id and type = "event" and is_active="1")');
        })
        ->where('events.is_active', '!=', '0' )
        ->select('events.title as event_title', 'events.description', 'events.event_id as event_id', 'images.url as image_url', 'docs.url as event_doc_url')
        ->orderBy('events.created_at', 'desc')
        ->take(3)
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



       

    
        // @dd($News);
        return view('homapage', compact(['newsItem','workshopItem','sliderItem','eventItem','facilitiesItem']));
    }

}
