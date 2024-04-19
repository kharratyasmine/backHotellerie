<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Region; // Import the Region model

class Hotel extends Model
{
    protected $fillable = ['name', 'description', 'image', 'contact_email', 'city', 'contact_phone', 'promotion', 'price', 'review','starnumber', 'category_hotel_id', 'region_id']; 

    public function category()
    {
        return $this->belongsTo(CategoryHotel::class, 'category_hotel_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}