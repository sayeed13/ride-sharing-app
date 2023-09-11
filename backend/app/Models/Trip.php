<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $guarded = []; // For fillable all entry

    //Use cast to recieve data before going to database
    protected $cast = [
        'origin' => 'array',
        'destination' => 'array',
        'driver_location' => 'array',
        'origin' => 'array',
        'is_started' => 'boolean',
        'is_completed' => 'boolean',


    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
