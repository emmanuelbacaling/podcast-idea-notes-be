<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'summary',
        'category',
        'estimatedDuration',
        'status',
    ];
}
