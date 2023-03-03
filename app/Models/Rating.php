<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
    ];



    public function developers()
    {
        return $this->belongsToMany(Developer::class);
    }
}
