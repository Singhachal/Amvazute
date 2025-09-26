<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMap extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
    'title', 'description', 'label', 'status', 'reported_at',
    'image', 'latitude', 'longitude'
];

}
