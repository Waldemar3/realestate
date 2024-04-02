<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\House;

class Settlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'address', 
        'area', 
        'hotline', 
        'youtube_video', 
        'photo_path', 
        'presentation_path'
    ];

    public function houses()
    {
        return $this->hasMany(House::class);
    }
}
