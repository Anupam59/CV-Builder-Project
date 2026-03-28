<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('title', 200);
            $table->string('title_bn', 200)->nullable();
            $table->string('role', 150)->nullable();
            $table->string('role_bn', 150)->nullable();
            $table->string('technologies', 300)->nullable();
            $table->string('technologies_bn', 300)->nullable();
            $table->string('project_url', 300)->nullable();
            $table->text('description')->nullable();
            $table->text('description_bn')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
