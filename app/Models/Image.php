<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $primaryKey = 'image_id';
    protected $fillable = [
        'url', 'type', 'news_id', // Add any other columns you want to be fillable here
    ];

    public function news()
    {
        return $this->belongsTo('App\Models\News', 'news_id');
    }
}
