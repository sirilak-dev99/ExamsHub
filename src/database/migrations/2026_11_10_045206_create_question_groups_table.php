<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง question_groups สำหรับเก็บกลุ่มโจทย์ที่มี stem และรูปภาพร่วมกัน
    public function up(): void
    {
        Schema::create('question_groups', function (Blueprint $table) {
            $table->id(); // เพิ่มคอลัมน์ id เป็น primary key อัตโนมัติ
            $table->text('stem_text')->nullable()->comment('เนื้อหาโจทย์หลักที่ใช้ร่วมกัน'); // เพิ่มคอลัมน์ stem_text เป็น text และสามารถเป็น null ได้ ใช้เก็บเนื้อหาโจทย์หลักที่ใช้ร่วมกัน
            $table->string('image')->nullable()->comment('รูปภาพที่ใช้ร่วมกัน'); // เพิ่มคอลัมน์ image เป็น string และสามารถเป็น null ได้ ใช้เก็บรูปภาพที่ใช้ร่วมกัน
            $table->timestamps(); // เพิ่มคอลัมน์ created_at และ updated_at อัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_groups');
    }
};
