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
            $table->string('phone')->unique()->nullable();
            $table->string('photo')->nullable();
            $table->string('password');
            $table->enum('role', ["student", "driver", "admin"])->default('student');
            $table->enum('status', ["active", "inactive", "suspend"])->default('active');
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('show_online')->default(false);
            $table->boolean('show_notification')->default(false);
            $table->boolean('show_routes')->default(false);
            $table->boolean('show_bus')->default(false);
            $table->boolean('show_hiace')->default(false);
            $table->boolean('show_stop')->default(false);
            $table->boolean('show_campus')->default(false);
            $table->boolean('show_students')->default(false);
            $table->boolean('show_mylocation')->default(false);
            $table->boolean('high_accuracy')->default(false);
            $table->timestamps();
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
        Schema::dropIfExists('sessions');
    }
};
