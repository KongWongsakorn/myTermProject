<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeleave extends Model
{
    public $timestamps = false; //...
    protected $table = 'typeleaves';
    protected $fillable = ['*'  ];
    use HasFactory;
}
