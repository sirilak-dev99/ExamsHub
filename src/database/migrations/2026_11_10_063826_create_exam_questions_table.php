<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง exam_questions สำหรับเก็บข้อมูลข้อสอบที่ถูกสุ่มขึ้นมา
    public function up(): void
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id(); // primary key

            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            // ลบข้อสอบเมื่อ exam ถูกลบ
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            // ลบข้อสอบเมื่อ question ถูกลบ

            $table->integer('sort_order')->default(0)->comment('ลำดับข้อสอบ');
            // ลำดับข้อสอบที่ถูกสุ่มขึ้นมา

            $table->decimal('score', 5, 2)->comment('คะแนนของข้อนี้');
            // คะแนนของข้อนี้ที่ถูกสุ่มขึ้นมา

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_questions');
    }
};
