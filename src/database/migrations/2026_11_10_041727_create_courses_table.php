<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ตาราง courses สำหรับเก็บข้อมูลวิชา
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // - id: คอลัมน์ชนิด ID อัตโนมัติ
            $table->string('code')->unique()->comment('รหัสวิชา'); // - code: คอลัมน์ชนิด string ใช้เก็บรหัสวิชา และต้องไม่ซ้ำกัน
            $table->string('name')->comment('ชื่อวิชา'); // - name: คอลัมน์ชนิด string ใช้เก็บชื่อวิชา
            $table->integer('group_id')->nullable()->comment('กลุ่มวิชา'); // - group_id: คอลัมน์ชนิด integer ใช้เก็บกลุ่มวิชา
            $table->decimal('pass_percent', 5, 2)->default(60.00)->comment('เกณฑ์ผ่านร้อยละ'); // - pass_percent: คอลัมน์ชนิด decimal ใช้เก็บเกณฑ์ผ่านร้อยละ
            $table->timestamps(); // - timestamps: คอลัมน์ created_at และ updated_at อัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
