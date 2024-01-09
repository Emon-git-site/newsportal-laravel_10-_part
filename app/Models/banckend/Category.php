<?php

namespace App\Models\banckend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_bn',
        'category_en',
        // Add other fields if necessary
    ];

    public function subcategory(){
        return $this->hasMany(Subcategory::class, 'category_id');
    }
}
