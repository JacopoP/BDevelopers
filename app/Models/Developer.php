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

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
    public function sponsors()
    {
        // return $this->belongsToMany(Sponsor::class);
        return $this->belongsToMany(Sponsor::class)->withPivot('date_start', 'date_end')->withTimestamps();
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function ratings()
    {
        return $this->belongsToMany(Rating::class);
    }
}