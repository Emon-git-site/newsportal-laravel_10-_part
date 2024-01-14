<?php

namespace App\Models\banckend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livetv extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'embed_code',

    ];
}
