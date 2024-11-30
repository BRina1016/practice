<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $primaryKey = 'store_id';
    protected $fillable = ['name', 'description', 'area_id', 'genre_id'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'store_id', 'store_id');
    }

    public function getAverageRatingAttribute()
    {
        $average = $this->reviews->avg('rating');
        return $average ? round($average, 1) : 0;
    }
}
