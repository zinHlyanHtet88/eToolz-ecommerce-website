<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingImage extends Model
{
    use HasFactory;
    protected $fillable = ['rating_code', 'image'];
}
