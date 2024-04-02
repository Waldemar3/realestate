<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settlement;

class House extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'price_usd', 
        'floors', 
        'bedrooms', 
        'area', 
        'type',  
        'settlement_id'
    ];

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }
}
