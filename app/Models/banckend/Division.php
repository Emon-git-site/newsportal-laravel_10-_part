<?php

namespace App\Models\banckend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_bn',
        'division_en',
        // Add other fields if necessary
    ];

    public function district(){
        return $this->hasMany(District::class, 'division_id');
    }
}
