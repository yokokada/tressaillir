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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('kanri_flag')->nullable();
            $table->string('nickname');
            $table->string('icon')->nullable()->default('img/defo_img.png');
            $table->string('hobby');
            $table->integer('sex');
            $table->integer('firstdrink');
            $table->integer('main_guest')->nullable();
            $table->foreignId('event_id')->constrained();
            // $table->string('event_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
