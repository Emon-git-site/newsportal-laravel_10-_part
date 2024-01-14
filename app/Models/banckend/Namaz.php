<?php

namespace App\Models\banckend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Namaz extends Model
{
    use HasFactory;

    protected $fillable = [
        'fajr',
        'johr',
        'asor',
        'magrib',
        'esha',
    ];
}
