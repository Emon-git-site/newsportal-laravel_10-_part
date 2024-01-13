<?php

namespace App\Models\banckend;

use App\Models\banckend\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_bn',
        'category_en',
        // Add other fields if necessary
    ];

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }

    public function post()
    {
        return $this->hasMany(Post::class, 'Category_id');
    }

}
