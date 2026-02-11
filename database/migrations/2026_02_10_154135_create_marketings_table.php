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
        Schema::create('marketings', function (Blueprint $table) {
            $table->id();
            $table->string('top_raise');
            $table->string('access');
            $table->string('range_raise');
            $table->string('total_watching');
            $table->string('youtube_watsh');
            $table->string('youtube_image');
            $table->string('youtube_profits');
            $table->string('youtube_period');
            $table->string('face_image');
            $table->string('face_access');
            $table->string('face_comments');
            $table->string('face_save');
            $table->string('face_share');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketings');
    }
};
