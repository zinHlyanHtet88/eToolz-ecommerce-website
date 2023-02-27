<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountItem extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'name', 'normal_price', 'discount_price', 'sim', 'storage', 'processor', 'size', 'description', 'image'];
}
