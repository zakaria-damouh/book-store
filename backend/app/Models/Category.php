<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['ref', 'name', 'desc'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
