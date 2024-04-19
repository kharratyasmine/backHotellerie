<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['client_id', 'hotel_id', 'status', 'check_in_date', 'check_out_date'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
