<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

// ฟังก์ชัน up() ใช้สำหรับสร้างตาราง academic_terms ในฐานข้อมูล โดยมีคอลัมน์ดังนี้:

    public function up(): void
    {
        Schema::create('academic_terms', function (Blueprint $table) {
            $table->id(); // - id: คอลัมน์ชนิด ID อัตโนมัติ
            $table->string('year', 4)->comment('ปีการศึกษา'); // - year: คอลัมน์ชนิด string ความยาว 4 ตัวอักษร ใช้เก็บปีการศึกษา
            $table->string('semester', 1)->comment('ภาคเรียน'); // - semester: คอลัมน์ชนิด string ความยาว 1 ตัวอักษร ใช้เก็บภาคเรียน
            $table->boolean('active')->default(false)->comment('สถานะใช้งาน'); // - active: คอลัมน์ชนิด boolean ใช้เก็บสถานะการใช้งาน (ค่าเริ่มต้นเป็น false)
            $table->timestamps(); // - timestamps: คอลัมน์ created_at และ updated_at อัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_terms');
    }
};
