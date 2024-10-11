<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acknowledge extends Model
{
    use HasFactory;

    protected $table = 'leaveofabsences';
    
    public $timestamps=false;

    protected $fillable = [
        'u_id',
        'typeL_id',
        'firstDate',
        'endDate',
        'detail',
        'date',
        'file',
        'status',
        'u_approver',
        'acknowledge'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'u_id');
    }

    public function typeleave()
    {
        return $this->belongsTo(Typeleave::class, 'typeL_id');
    }
    
    public function userapprover()
    {
        return $this->belongsTo(User::class, 'u_approver');
    }
}
