<?php

namespace App\Models;
use App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'description', // Add any other columns you want to be fillable here
    ];

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'news_id');
    }
}
