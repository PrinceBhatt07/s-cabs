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
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('email_verified')->nullable();
            $table->string('email_otp')->nullable();

            $table->string('phone')->unique();
            $table->boolean('phone_verified')->default(false);
            $table->string('sms_otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->string('id_proof_path')->nullable();
            $table->enum('id_proof_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('id_proof_rejection_reason')->nullable();
            $table->enum('role', ['admin', 'customer', 'driver'])->default('customer');

            // Driver Verification
            $table->string('driver_image')->nullable();
            $table->string('car_image')->nullable();
            $table->string('rc_document')->nullable();
            $table->string('driving_license')->nullable();
            $table->string('car_name')->nullable();
            $table->integer('car_year')->nullable();
            $table->enum('driver_verification_status', ['pending', 'approved', 'rejected'])->nullable();
            $table->text('driver_rejection_reason')->nullable();

            $table->string('fcm_token')->nullable();
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
