<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // โค้ดอื่นๆ ของ Model...

    public function getStatusThaiAttribute()
    {
        $statuses = [
            'draft'    => 'ฉบับร่าง',
            'approved' => 'อนุมัติแล้ว',
            'retired'  => 'เลิกใช้งาน',
        ];

        return $statuses[$this->status] ?? 'ไม่ทราบสถานะ';
    }
}