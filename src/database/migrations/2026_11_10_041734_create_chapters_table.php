<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ฟังก์ชัน up() ใช้สำหรับสร้างตาราง chapters ในฐานข้อมูล โดยมีคอลัมน์ดังนี้:
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id(); // - id: คอลัมน์ชนิด ID อัตโนมัติ
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // - course_id: คอลัมน์ชนิด foreign key ใช้เชื่อมโยงกับตาราง courses
            $table->integer('no')->comment('บทที่'); // - no: คอลัมน์ชนิด integer ใช้เก็บหมายเลขบท
            $table->string('name')->comment('ชื่อบทเรียน'); // - name: คอลัมน์ชนิด string ใช้เก็บชื่อบทเรียน
            $table->timestamps(); // - timestamps: คอลัมน์ created_at และ updated_at อัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
