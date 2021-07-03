<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    public function amount()
    {
        return $this->products->count();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('id');
    }
}
