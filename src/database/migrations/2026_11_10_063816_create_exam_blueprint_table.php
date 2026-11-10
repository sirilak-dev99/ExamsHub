<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง exam_blueprint สำหรับเก็บข้อมูลโครงสร้างชุดข้อสอบ
    public function up(): void
    {
        Schema::create('exam_blueprint', function (Blueprint $table) {
            $table->id();
            // foreign key
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade'); 
            // ลบ blueprint เมื่อ exam ถูกลบ
            
            $table->foreignId('chapter_id')->constrained('chapters')->onDelete('cascade');
            // ลบ blueprint เมื่อ chapter ถูกลบ

            $table->string('bloom_code', 5)->nullable()->comment('รหัสระดับการวัด (R,U,A,An,E,C)'); 
            // รหัสระดับการวัดตาม Bloom's Taxonomy
            
            $table->integer('count')->comment('จำนวนข้อที่ต้องการสุ่ม'); 
            // จำนวนข้อที่ต้องการสุ่มจาก chapter

            $table->decimal('score_each', 5, 2)->comment('คะแนนต่อข้อ'); 
            // คะแนนต่อข้อที่ต้องการให้กับแต่ละข้อ

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_blueprint');
    }
};
