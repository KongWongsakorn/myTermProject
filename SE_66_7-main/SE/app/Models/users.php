<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public function subcategories()
    {
        return $this->belongsTo(subcategories::class,'s_id','id');
    }

    
}
