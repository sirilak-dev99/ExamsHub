<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ฟังก์ชัน up() ใช้สำหรับสร้างตาราง bloom_levels ในฐานข้อมูล โดยมีคอลัมน์ดังนี้:
    public function up(): void
    {
        Schema::create('bloom_levels', function (Blueprint $table) {
            $table->id(); // - id: คอลัมน์ชนิด ID อัตโนมัติ
            $table->string('code', 5)->unique()->comment('รหัส เช่น R, U, A, An, E, C'); // - code: คอลัมน์ชนิด string ความยาว 5 ตัวอักษร ใช้เก็บรหัสของระดับการวัด และต้องไม่ซ้ำกัน
            $table->string('name_th')->comment('ชื่อระดับการวัด (ไทย)'); // - name_th: คอลัมน์ชนิด string ใช้เก็บชื่อระดับการวัดเป็นภาษาไทย
            $table->integer('rank')->comment('ลำดับ'); // - rank: คอลัมน์ชนิด integer ใช้เก็บลำดับของระดับการวัด
            $table->timestamps(); // - timestamps: คอลัมน์ created_at และ updated_at อัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloom_levels');
    }
};
