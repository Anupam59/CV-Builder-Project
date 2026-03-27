<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('title', 200)->nullable();
            $table->json('data'); // CV snapshot JSON
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
