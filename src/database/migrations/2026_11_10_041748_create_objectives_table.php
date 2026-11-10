<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง objectives สำหรับเก็บจุดประสงค์ของบทเรียน
    public function up(): void
    {
        Schema::create('objectives', function (Blueprint $table) {
            $table->id(); //เพิ่มคอลัมน์ id เป็น primary key อัตโนมัติ
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); //รหัสวิชา (course_id) เป็น foreign key ที่เชื่อมกับตาราง courses และเมื่อมีการลบวิชา จะลบจุดประสงค์ที่เกี่ยวข้องด้วย
            $table->foreignId('chapter_id')->constrained('chapters')->onDelete('cascade'); //รหัสบทเรียน (chapter_id) เป็น foreign key ที่เชื่อมกับตาราง chapters และเมื่อมีการลบบทเรียน จะลบจุดประสงค์ที่เกี่ยวข้องด้วย
            $table->string('code')->comment('รหัสจุดประสงค์'); //รหัสจุดประสงค์
            $table->text('text')->comment('รายละเอียดจุดประสงค์'); //รายละเอียดจุดประสงค์
            $table->timestamps(); //เวลาที่สร้างและแก้ไขข้อมูลอัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectives');
    }
};
