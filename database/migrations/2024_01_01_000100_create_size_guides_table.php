<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('size_guides', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['men', 'women']);
            $table->string('eu');
            $table->string('uk');
            $table->string('us');
            $table->string('length_cm');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('size_guides');
    }
};
