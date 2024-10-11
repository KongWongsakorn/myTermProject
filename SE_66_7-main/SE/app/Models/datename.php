<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class datename extends Model
{
    use HasFactory;
    protected $table = 'date_names';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    use HasFactory;
    public function eventDates()
{
    return $this->hasMany(Calendar::class, 'dateN_id', 'id');
}
}