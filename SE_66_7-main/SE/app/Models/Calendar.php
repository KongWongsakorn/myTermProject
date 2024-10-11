<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'event_dates'; // กำหนดชื่อตารางในฐานข้อมูล
    protected $primaryKey = 'id'; // กำหนดชื่อคีย์หลัก
    public $timestamps = false; // ระบุว่าไม่มีการใช้งานฟิลด์ 'created_at' และ 'updated_at'

    // สามารถกำหนด fillable หรือ guarded ตามความเหมาะสม
    public function dateName()
    {
        return $this->belongsTo(datename::class, 'dateN_id');
    }
    protected $fillable = [
        'date', 'dateN_id', 'checkRest', 'detail',
    ];
}
