<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel; // Import the Hotel model

class Region extends Model
{
    protected $fillable = ['name', 'image','description','score'];

    
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
