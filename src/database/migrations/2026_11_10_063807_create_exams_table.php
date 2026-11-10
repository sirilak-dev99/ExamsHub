<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง exams สำหรับเก็บข้อมูลชุดข้อสอบ
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            // รหัสวิชา (course_id) เป็น foreign key ที่เชื่อมกับตาราง courses และเมื่อมีการลบวิชา จะลบชุดข้อสอบที่เกี่ยวข้องด้วย
            
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            // รหัสบทเรียน (chapter_id) เป็น foreign key ที่เชื่อมกับตาราง chapters และเมื่อมีการลบบทเรียน จะลบชุดข้อสอบที่เกี่ยวข้องด้วย

            $table->string('kind')->comment('ประเภทการสอบ เช่น midterm, final, quiz');
            // รหัสบทเรียน (chapter_id) เป็น foreign key ที่เชื่อมกับตาราง chapters และเมื่อมีการลบบทเรียน จะลบชุดข้อสอบที่เกี่ยวข้องด้วย
           
            $table->string('title')->comment('ชื่อชุดสอบ');
            // ชื่อชุดสอบ
            
            $table->string('mode')->comment('รูปแบบการจัดชุดข้อสอบ: fixed (เลือกเอง), blueprint (สุ่มตามสัดส่วน)');
            // รูปแบบการจัดชุดข้อสอบ: fixed (เลือกเอง), blueprint (สุ่มตามสัดส่วน)
            
            $table->integer('duration_min')->comment('เวลาในการสอบ (นาที)');
            // เวลาในการสอบ (นาที)

            $table->integer('max_attempts')->default(1)->comment('จำนวนครั้งที่อนุญาตให้สอบได้');
            // จำนวนครั้งที่อนุญาตให้สอบได้ (default 1)

            $table->dateTime('open_at')->nullable()->comment('เวลาเปิดสอบ');
            // เวลาเปิดสอบ (สามารถเป็น null ได้ถ้าไม่กำหนดเวลาเปิดสอบ)

            $table->dateTime('close_at')->nullable()->comment('เวลาปิดสอบ');
            // เวลาปิดสอบ (สามารถเป็น null ได้ถ้าไม่กำหนดเวลาปิดสอบ)

            $table->boolean('show_answer')->default(false)->comment('อนุญาตให้ดูเฉลยหลังสอบเสร็จหรือไม่');
            // อนุญาตให้ดูเฉลยหลังสอบเสร็จหรือไม่ (default false)

            $table->boolean('shuffle_questions')->default(true)->comment('สลับลำดับข้อสอบหรือไม่');
            // สลับลำดับข้อสอบหรือไม่ (default true)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
