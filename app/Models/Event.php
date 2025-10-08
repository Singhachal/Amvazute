<?php

namespace App\Models;
use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $fillable = [
    'title',
    'description',
    'label',
    'latitude',
    'longitude',
    'ip_address',
    'media_path',
    'media_type',
    'media_path',
    'reported_at',
    'status',
];

protected $casts = [
    'reported_at' => 'datetime',
];


 public function media()
    {
        return $this->hasMany(EventMedia::class, 'event_id');
    }


    public function likes()
{
    return $this->hasMany(Like::class);
}

public function likedByUser($userId)
{
    return $this->likes()->where('user_id', $userId)->exists();
}


// ✅ Reusable static method to calculate distance
    public static function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meters

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c); // distance in meters
    }


    public function getTitleTranslatedAttribute()
    {
        $locale = App::getLocale(); // en, hi, etc.
        if ($locale == 'en') return $this->title;

        // Optional: cache translation in DB
        $column = 'title_' . $locale;
        if ($this->$column) return $this->$column;

        $tr = new GoogleTranslate($locale);
        $translated = $tr->translate($this->title);

        // Store translation for next time
        $this->update([$column => $translated]);

        return $translated;
    }

    public function getDescriptionTranslatedAttribute()
    {
        $locale = App::getLocale();
        if ($locale == 'en') return $this->description;

        $column = 'description_' . $locale;
        if ($this->$column) return $this->$column;

        $tr = new GoogleTranslate($locale);
        $translated = $tr->translate($this->description);
        $this->update([$column => $translated]);

        return $translated;
    }


    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



}
