<?php

namespace App\Models\banckend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_author',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'google_analytics',
        'alexa_analytics',
        'google_varification',
    ];
}
