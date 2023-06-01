<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['brand','model'];
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
