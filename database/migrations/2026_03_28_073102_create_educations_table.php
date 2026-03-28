<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('degree', 150);
            $table->string('degree_bn', 150)->nullable();
            $table->string('field_of_study', 150)->nullable();
            $table->string('field_of_study_bn', 150)->nullable();
            $table->string('institute', 200);
            $table->string('institute_bn', 200)->nullable();
            $table->string('result', 50)->nullable();
            $table->string('start_year', 10)->nullable();
            $table->string('end_year', 10)->nullable();
            $table->text('description')->nullable();
            $table->text('description_bn')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
