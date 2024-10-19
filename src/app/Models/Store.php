<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $primaryKey = 'store_id';

    public function area() {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function genre() {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
