<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveOfAbsence extends Model
{
    use HasFactory;
    protected $table = 'leaveofabsences';
    protected $fillable = [
        'u_id',
        'typeL_id',
        'firstDate',
        'endDate',
        'detail',
        'file',
        'date',
        'status',
        'u_approve',
        'acknowledge',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'u_id','id');
    }

    public function typeLeave()
    {
        return $this->belongsTo(TypeLeave::class,'typeL_id','id');
    }
    
    public function approver()
    {
        return $this->belongsTo(User::class,'u_approver','id');
    }
    public function userapprover()
    {
        return $this->belongsTo(User::class, 'u_approver');
    }

}
