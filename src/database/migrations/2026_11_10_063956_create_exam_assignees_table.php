<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง exam_assignees สำหรับเก็บข้อมูลนิสิตที่มีสิทธิ์สอบ
    public function up(): void
    {
        Schema::create('exam_assignees', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade'); // ลบชุดสอบเมื่อ exam ถูกลบ

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('นิสิตที่มีสิทธิ์สอบ'); // ลบสิทธิ์สอบเมื่อ user ถูกลบ


            // ป้องกันการเพิ่มชื่อนิสิตซ้ำในชุดสอบเดียวกัน
            $table->unique(['exam_id', 'user_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_assignees');
    }
};
