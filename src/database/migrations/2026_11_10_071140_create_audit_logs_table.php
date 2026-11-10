<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //บันทึกกิจกรรมของผู้ใช้ เช่น การสร้าง, แก้ไข, ลบ, เปลี่ยนคะแนน, เปลี่ยนบทบาทผู้ใช้
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->comment('ผู้กระทำกิจกรรม'); 
            //ผู้กระทำกิจกรรม (user_id) ให้เป็น nullable เผื่อกรณีผู้ใช้ถูกลบออกจากระบบ

            $table->string('action')->comment('การกระทำ เช่น create, update, delete, override_score, change_role');
            //การกระทำ (action) เช่น create, update, delete, override_score, change_role
            $table->string('entity')->comment('ตารางหรือวัตถุที่ถูกแก้ไข เช่น question, exam, user_role');
            //ตารางหรือวัตถุที่ถูกแก้ไข เช่น question, exam, user_role
            $table->unsignedBigInteger('entity_id')->nullable()->comment('ID ของวัตถุที่ถูกแก้ไข');
            //ID ของวัตถุที่ถูกแก้ไข (entity_id) ให้เป็น nullable เผื่อกรณีที่ไม่มี ID เช่น การสร้างวัตถุใหม่

            $table->json('old_values')->nullable()->comment('ค่าก่อนแก้ไข (ถ้ามี)'); //ค่าก่อนแก้ไข (old_values) ให้เป็น nullable เผื่อกรณีที่ไม่มีค่าก่อนแก้ไข เช่น การสร้างวัตถุใหม่
            $table->json('new_values')->nullable()->comment('ค่าหลังแก้ไข (ถ้ามี)'); //ค่าหลังแก้ไข (new_values) ให้เป็น nullable เผื่อกรณีที่ไม่มีค่าหลังแก้ไข เช่น การลบวัตถุ
            $table->timestamp('at')->useCurrent()->comment('เวลาที่เกิดกิจกรรม'); //เวลาที่เกิดกิจกรรม (at) ให้ใช้เวลาปัจจุบันเป็นค่าเริ่มต้น

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
