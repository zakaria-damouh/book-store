<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['ref', 'image', 'name', 'quantity', 'price'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
