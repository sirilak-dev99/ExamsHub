<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->nullable()->unique()->comment('รหัสนิสิต (ว่างได้ถ้าเป็นอาจารย์)');
            $table->string('display_name')->comment('ชื่อ-นามสกุลที่แสดงผล');
            $table->string('email')->unique()->comment('อีเมลมหาวิทยาลัย');
            $table->string('status')->nullable()->comment('สถานะนิสิต (กำลังศึกษา/ลาพัก/พ้นสภาพ/สำเร็จ)');
            $table->boolean('active')->default(true)->comment('สถานะการใช้งานบัญชี');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
