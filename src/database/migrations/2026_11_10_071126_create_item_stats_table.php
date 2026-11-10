<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //ตารางเก็บสถิติของแต่ละข้อสอบ รวมถึงค่าความยากง่าย ค่าอำนาจจำแนก และสัดส่วนคนเลือกแต่ละตัวเลือก
    public function up(): void
    {
        Schema::create('item_stats', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade'); //เป็น foreign key ไปยังตาราง questions
            $table->foreignId('exam_id')->nullable()->constrained('exams')->onDelete('cascade')->comment('null = ค่าสถิติสะสมรวมทุกชุดสอบ'); //เป็น foreign key ไปยังตาราง exams (null = ค่าสถิติสะสมรวมทุกชุดสอบ)

            $table->integer('n')->default(0)->comment('จำนวนผู้ตอบข้อนี้');
            $table->decimal('p', 4, 3)->nullable()->comment('ค่าความยากง่าย (Difficulty index: 0.00 - 1.00)');
            $table->decimal('r', 4, 3)->nullable()->comment('ค่าอำนาจจำแนก (Discrimination index: -1.00 ถึง 1.00)');

            $table->json('option_pct_json')->nullable()->comment('สัดส่วนคนเลือกแต่ละตัวเลือก (% Distractor analysis)'); 
            //สัดส่วนคนเลือกแต่ละตัวเลือก (% Distractor analysis) จะถูกเก็บไว้ในรูปแบบ JSON เช่น {"1": 0.2, "2": 0.5, "3": 0.3} หมายถึง ตัวเลือกที่ 1 มีคนเลือก 20%, ตัวเลือกที่ 2 มีคนเลือก 50%, ตัวเลือกที่ 3 มีคนเลือก 30%
            
            $table->string('flag')->nullable()->comment('การแจ้งเตือนคุณภาพข้อสอบ (เช่น difficulty_too_high, negative_r)'); 
            //ระดับการแจ้งเตือนคุณภาพข้อสอบ (เช่น difficulty_too_high, negative_r) เพื่อให้ผู้สอนทราบว่าข้อนี้อาจมีปัญหา
            
            $table->timestamp('computed_at')->useCurrent()->comment('เวลาที่คำนวณล่าสุด'); 
            //เวลาที่คำนวณล่าสุด

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_stats');
    }
};
