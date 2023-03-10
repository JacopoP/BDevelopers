<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_name',
        'price',
        'length',
    ];


    public function developers()
    {
        return $this->belongsToMany(Developer::class);
    }
}
