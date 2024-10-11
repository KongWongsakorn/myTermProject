<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveofabsences extends Model
{
    use HasFactory;
    protected $table = 'leaveofabsences';
    public function typeleave1()
    {
        return $this->belongsTo(typeleaves::class,'typeL_id','id');
    }

    public function users()
    {
        return $this->belongsTo(users::class,'u_id','id');
    }

    public function approver()
    {
        return $this->belongsTo(users::class,'u_approver','id');
    }

}
