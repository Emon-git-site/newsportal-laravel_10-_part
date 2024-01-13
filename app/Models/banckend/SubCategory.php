<?php

namespace App\Models\banckend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $primaryKey = 'id';

     protected $fillable = [
        'category_id',
        'subcategory_bn',
        'subcategory_en',
         ];
        
         public function getCategory()
         {
            return $this->belongsTo(Category::class, 'category_id');
         }    

         public function post()
         {
            return $this->hasMany(Post::class, 'subcategory_id');
         }
}
