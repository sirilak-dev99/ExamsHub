<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //ลำดับที่สุ่มมาให้ นิสิตแต่ละคน (sort_order) และลำดับตัวเลือกที่สุ่ม (option_order) จะถูกเก็บไว้ในตารางนี้
    public function up(): void
    {
        Schema::create('attempt_questions', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('attempt_id')->constrained('attempts')->onDelete('cascade'); // Foreign key to attempts table
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade'); // Foreign key to questions table

            $table->integer('sort_order')->comment('ลำดับที่สุ่มมาให้คนนี้'); //ลำดับที่สุ่มมาให้ นิสิตแต่ละคน (sort_order) 
            $table->json('option_order')->nullable()->comment('ลำดับตัวเลือกที่สุ่ม (เช่น [3,1,4,2])'); //ตัวเลือกที่สุ่ม (เช่น [3,1,4,2]) จะถูกเก็บไว้ในรูปแบบ JSON

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempt_questions');
    }
};
