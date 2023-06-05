<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    public function formatted_amount()
    {
        return 'Rs ' . $this->price / 100;

    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}