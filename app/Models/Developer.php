<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone_number',
        'profile_path',
        'cv_path',
        'portfolio_url',
        'about_me',
        'performances',
    ];
}
