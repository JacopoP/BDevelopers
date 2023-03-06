<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'version',
        'logo_path',
        'description',
    ];

    public function developers()
    {
        return $this->belongsToMany(Developer::class);
    }
}

