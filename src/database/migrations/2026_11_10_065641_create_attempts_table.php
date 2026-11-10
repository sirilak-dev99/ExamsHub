<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade'); // Foreign key to exams table
        
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table

            $table->integer('attempt_no')->default(1)->comment('สอบครั้งที่'); //จำนวนครั้งที่สอบ (1, 2, 3, ...)

            $table->timestamp('started_at')->nullable()->comment('เวลาเริ่มสอบ'); //เวลาที่เริ่มสอบจริง
            $table->timestamp('deadline_at')->nullable()->comment('เวลาที่ต้องส่ง (หมดเวลา)'); //เวลาที่ต้องส่งข้อสอบ (หมดเวลา)
            $table->timestamp('submitted_at')->nullable()->comment('เวลาที่ส่งข้อสอบจริง'); //เวลาที่ส่งข้อสอบจริง

            $table->string('status')->default('in_progress')->comment('สถานะ (in_progress, submitted, graded)'); //สถานะของการสอบ (กำลังสอบ, ส่งแล้ว, ตรวจแล้ว)
            $table->decimal('score', 5, 2)->nullable()->comment('คะแนนที่ได้'); //คะแนนที่ได้จากการสอบ
            $table->decimal('max_score', 5, 2)->nullable()->comment('คะแนนเต็มของชุดสอบนี้'); //คะแนนเต็มของชุดสอบนี้

            // ฟิลด์เพิ่มเติมจากส่วน "ผลสอบเพิ่ม" (Resume Code)
            $table->string('resume_code', 4)->nullable()->comment('รหัส 4 หลักสำหรับกลับเข้าสอบ'); //รหัส 4 หลักสำหรับกลับเข้าสอบ กรณีที่ผู้สอบออกจากระบบหรือปิดเบราว์เซอร์โดยไม่ได้ส่งข้อสอบ
            $table->integer('wrong_code_count')->default(0)->comment('จำนวนครั้งที่กรอกรหัสผิด'); //จำนวนครั้งที่กรอกรหัสผิด
            $table->timestamp('locked_until')->nullable()->comment('ล็อกการเข้าสอบจนถึงเวลา'); 
            $table->timestamp('clicked_at')->nullable()->comment('เวลาที่คลิกเข้าสอบ'); 
            $table->timestamp('delivered_at')->nullable()->comment('เวลาที่โหลดข้อสอบเสร็จ'); 
            $table->timestamp('last_resume_at')->nullable()->comment('เวลากลับเข้าสอบล่าสุด'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempts');
    }
};
