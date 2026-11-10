<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง roles สำหรับเก็บบทบาทของผู้ใช้งาน
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // เพิ่มคอลัมน์ id เป็น primary key อัตโนมัติ
            $table->string('name')->unique()->comment('ชื่อบทบาท (admin, executive, coordinator, author, proctor, student)'); // เพิ่มคอลัมน์ name เป็น unique และมี comment อธิบายบทบาทของผู้ใช้งาน
            $table->timestamps(); // เพิ่มคอลัมน์ created_at และ updated_at อัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
