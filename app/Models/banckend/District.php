<?php

namespace App\Models\banckend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';
    protected $primaryKey = 'id';

     protected $fillable = [
        'division_id',
        'district_en',
        'district_bn',
         ];
        
         public function getDivision(){
            return $this->belongsTo(Division::class, 'division_id');
        }  
}
