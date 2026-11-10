<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //คำตอบของแต่ละข้อสอบที่นิสิตตอบ จะถูกเก็บไว้ในตารางนี้
    public function up(): void
    {
        Schema::create('attempt_answers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('attempt_id')->constrained('attempts')->onDelete('cascade'); //จะเป็น foreign key ไปยังตาราง attempts
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade'); //จะเป็น foreign key ไปยังตาราง questions

            // option_id ให้เป็น nullable เผื่อกรณีเป็นข้อสอบอัตนัยที่ไม่ได้เลือกตัวเลือก
            $table->foreignId('option_id')->nullable()->constrained('question_options')->onDelete('set null'); //ตัวเลือกที่นิสิตตอบ (option_id) ให้เป็น nullable เผื่อกรณีเป็นข้อสอบอัตนัยที่ไม่ได้เลือกตัวเลือก

            $table->timestamp('answered_at')->nullable()->comment('เวลาที่ตอบ');
            $table->boolean('is_correct')->nullable()->comment('ถูกหรือผิด');
            $table->decimal('score', 5, 2)->nullable()->comment('คะแนนที่ได้ข้อนี้');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempt_answers');
    }
};
