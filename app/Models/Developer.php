<?php

namespace App\Models;

use DateInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use Illuminate\Support\Facades\Auth;

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


    // SPONSORSHIPS SECTION
    // relation
    public function sponsors()
    {
        // return $this->belongsToMany(Sponsor::class);
        return $this->belongsToMany(Sponsor::class)->withPivot('date_start', 'date_end')->withTimestamps();
    }

    /**
     * Add a sponsorship to the logged developer
     */
    public function addSponsorship(DateTime $start_date, $tier_id)
    {
        // Add date
        $end_date = clone($start_date);
        $end_date->add(new DateInterval('PT' . Sponsor::find($tier_id)['length'] . 'H'));

        // Add sposorship
        $this->sponsors()->attach($tier_id, [
            'date_start' => $start_date,
            'date_end' => $end_date
        ]);
    }
}
