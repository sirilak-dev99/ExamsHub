<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง questions สำหรับเก็บข้อมูลโจทย์ข้อสอบ
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // เพิ่มคอลัมน์ id เป็น primary key อัตโนมัติ

            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); 
            // เพิ่มคอลัมน์ course_id เป็น foreign key ที่เชื่อมกับตาราง courses และเมื่อมีการลบวิชา จะลบโจทย์ที่เกี่ยวข้องด้วย

            $table->foreignId('chapter_id')->nullable()->constrained('chapters')->onDelete('set null'); 
            // เพิ่มคอลัมน์ chapter_id เป็น foreign key ที่เชื่อมกับตาราง chapters และเมื่อมีการลบบทเรียน จะตั้งค่าเป็น null (สามารถเป็น null ได้ถ้าโจทย์ไม่ได้อยู่ในบทเรียนใด)
            
            $table->foreignId('objective_id')->nullable()->constrained('objectives')->onDelete('set null'); 
            // เพิ่มคอลัมน์ objective_id เป็น foreign key ที่เชื่อมกับตาราง objectives และเมื่อมีการลบจุดประสงค์ จะตั้งค่าเป็น null (สามารถเป็น null ได้ถ้าโจทย์ไม่ได้อยู่ในจุดประสงค์ใด)
            
            $table->string('bloom_code', 5)->nullable()->comment('รหัสระดับการวัด (R,U,A,An,E,C)'); 
            // เพิ่มคอลัมน์ bloom_code เป็น string ขนาด 5 และสามารถเป็น null ได้ ใช้เก็บรหัสระดับการวัดตามโมเดล Bloom (R,U,A,An,E,C)
           
            $table->string('difficulty_level')->nullable()->comment('ระดับความยากง่าย (ง่าย, ปานกลาง, ยาก)'); 
            // เพิ่มคอลัมน์ difficulty_level เป็น string และสามารถเป็น null ได้ ใช้เก็บระดับความยากง่ายของโจทย์ (ง่าย, ปานกลาง, ยาก)
            
            $table->string('type')->comment('รูปแบบข้อสอบ เช่น multiple_choice, essay'); 
            // เพิ่มคอลัมน์ type เป็น string ใช้เก็บรูปแบบข้อสอบ (เช่น multiple_choice, essay)
            
            $table->text('text')->comment('เนื้อหาโจทย์'); 
            // เพิ่มคอลัมน์ text เป็น text ใช้เก็บเนื้อหาโจทย์
            
            $table->string('image')->nullable()->comment('รูปภาพประกอบโจทย์'); 
            // เพิ่มคอลัมน์ image เป็น string และสามารถเป็น null ได้ ใช้เก็บรูปภาพประกอบโจทย์
            
            $table->text('explanation')->nullable()->comment('คำอธิบายเฉลย'); 
            // เพิ่มคอลัมน์ explanation เป็น text และสามารถเป็น null ได้ ใช้เก็บคำอธิบายเฉลยของโจทย์
            
            $table->decimal('p_auto', 3, 2)->nullable()->comment('ค่าความยากง่าย (คำนวณอัตโนมัติ)'); 
            // เพิ่มคอลัมน์ p_auto เป็น decimal ขนาด 3,2 และสามารถเป็น null ได้ ใช้เก็บค่าความยากง่ายของโจทย์ที่คำนวณอัตโนมัติ
            
            $table->decimal('p_manual', 3, 2)->nullable()->comment('ค่าความยากง่าย (กำหนดเอง)'); 
            // เพิ่มคอลัมน์ p_manual เป็น decimal ขนาด 3,2 และสามารถเป็น null ได้ ใช้เก็บค่าความยากง่ายของโจทย์ที่กำหนดเอง
            
            $table->boolean('shuffle_options')->default(true)->comment('สลับตัวเลือกหรือไม่'); 
            // เพิ่มคอลัมน์ shuffle_options เป็น boolean และมีค่า default เป็น true ใช้บ่งบอกว่าต้องการสลับตัวเลือกของโจทย์หรือไม่
            
            $table->boolean('student_visible')->default(false)->comment('ให้นิสิตดูเฉลยข้อนี้ได้หรือไม่'); 
            // เพิ่มคอลัมน์ student_visible เป็น boolean และมีค่า default เป็น false ใช้บ่งบอกว่านิสิตสามารถดูเฉลยของโจทย์นี้ได้หรือไม่

            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null')->comment('ผู้สร้างข้อสอบ'); 
            // เพิ่มคอลัมน์ author_id เป็น foreign key ที่เชื่อมกับตาราง users และสามารถเป็น null ได้ ใช้เก็บผู้สร้างข้อสอบ และเมื่อมีการลบผู้ใช้งาน จะตั้งค่าเป็น null
            
            $table->string('status')->default('draft')->comment('สถานะข้อสอบ (เช่น draft, approved, retired)'); 
            // เพิ่มคอลัมน์ status เป็น string และมีค่า default เป็น 'draft' ใช้เก็บสถานะของข้อสอบ (เช่น draft, approved, retired)
            
            $table->integer('version')->default(1)->comment('เวอร์ชันของข้อสอบ'); 
            // เพิ่มคอลัมน์ version เป็น integer และมีค่า default เป็น 1 ใช้เก็บเวอร์ชันของข้อสอบ

            
            $table->foreignId('group_id')->nullable()->constrained('question_groups')->onDelete('set null');
            // เพิ่ม group_id สำหรับผูกกับโจทย์ชุด (ตามความสัมพันธ์เชิงตรรกะ)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
