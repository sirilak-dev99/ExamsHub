<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //ตารางเก็บเหตุการณ์ความสมบูรณ์ของข้อสอบ กรณีนิสิตมีความน่าสงสัยว่ามีการโกงข้อสอบ เช่น การสลับหน้าต่าง, ซ่อนหน้าต่าง, ปิดเบราว์เซอร์, หรือออกจากระบบ
    public function up(): void
    {
        Schema::create('integrity_events', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('attempt_id')->constrained('attempts')->onDelete('cascade'); //เป็น foreign key ไปยังตาราง attempts

            $table->string('type')->comment('ประเภทเหตุการณ์ (เช่น blur, hidden, close)'); //ประเภทเหตุการณ์ (เช่น blur, hidden, close)
            $table->string('description')->nullable()->comment('รายละเอียดเพิ่มเติมเกี่ยวกับเหตุการณ์');
            $table->timestamp('at')->comment('เวลาที่เกิดเหตุการณ์');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrity_events');
    }
};
