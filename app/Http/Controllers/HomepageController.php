<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Workshop;
use App\Models\Slider;
use App\Models\Event;
use App\Models\OnlineFacility;

class HomepageController extends Controller
{
    public function index(){
        $News = News::latest()->take(3)->get();
        $Workshop = Workshop::latest()->take(3)->get();
        $Slider = Slider::latest()->take(3)->get();
        $Event = Event::latest()->take(3)->get();
        $OnlineFacility = OnlineFacility::latest()->take(3)->get();

    
        // @dd($News);
        return view('homapage', compact(['News','Workshop','Slider','Event','OnlineFacility']));
    }

}
