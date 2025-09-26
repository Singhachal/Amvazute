<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts'; // make sure table name matches migration

    protected $fillable = [
    'primary_email',
    'alternative_email',
    'primary_number',
    'alternative_number',
    'address',
    'map',
    'linkedin',
    'facebook',
    'instagram',
    'twitter',
    'youtube',
    'website',
];

}
