<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventDate extends Model
{
    use HasFactory;
    protected $table = 'event_dates';
    public function eventdate()
    {
        return $this->belongsTo(datename::class);
    }
}
