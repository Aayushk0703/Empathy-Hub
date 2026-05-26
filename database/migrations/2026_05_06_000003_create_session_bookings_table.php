<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('session_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedTinyInteger('age');
            $table->string('gender', 50);
            $table->string('service');
            $table->string('session_mode', 100);
            $table->date('preferred_date');
            $table->string('preferred_time', 50);
            $table->date('alternate_date')->nullable();
            $table->string('alternate_time', 50)->nullable();
            $table->string('previous_therapy', 10);
            $table->text('concerns');
            $table->text('additional_notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->index(['status', 'preferred_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('session_bookings');
    }
};
