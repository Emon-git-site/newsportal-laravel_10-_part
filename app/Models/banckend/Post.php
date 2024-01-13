<?php

namespace App\Models\banckend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        // Add other fields if necessary
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function getSubcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
}
