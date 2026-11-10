<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง role_user สำหรับเก็บความสัมพันธ์ระหว่างผู้ใช้งานและบทบาท
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id(); // เพิ่มคอลัมน์ id เป็น primary key อัตโนมัติ
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // เพิ่มคอลัมน์ user_id เป็น foreign key ที่เชื่อมกับตาราง users และเมื่อมีการลบผู้ใช้งาน จะลบความสัมพันธ์ที่เกี่ยวข้องด้วย
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // เพิ่มคอลัมน์ role_id เป็น foreign key ที่เชื่อมกับตาราง roles และเมื่อมีการลบบทบาท จะลบความสัมพันธ์ที่เกี่ยวข้องด้วย
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade')->comment('สิทธิ์ระดับวิชา (ถ้ามี)'); // เพิ่มคอลัมน์ course_id เป็น foreign key ที่เชื่อมกับตาราง courses และเมื่อมีการลบวิชา จะลบความสัมพันธ์ที่เกี่ยวข้องด้วย (สามารถเป็น null ได้ถ้าเป็นสิทธิ์ระดับระบบ)

            // ป้องกันการให้สิทธิ์ซ้ำซ้อนในวิชาเดียวกัน
            $table->unique(['user_id', 'role_id', 'course_id']);

            $table->timestamps(); // เพิ่มคอลัมน์ created_at และ updated_at อัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
