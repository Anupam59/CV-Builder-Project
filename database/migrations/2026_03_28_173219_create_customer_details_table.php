<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->unique()->constrained()->cascadeOnDelete();

            // Personal Info
            $table->string('father_name', 150)->nullable();
            $table->string('father_name_bn', 150)->nullable();
            $table->string('mother_name', 150)->nullable();
            $table->string('mother_name_bn', 150)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 20)->nullable();          // male, female, other
            $table->string('marital_status', 20)->nullable();  // single, married, divorced
            $table->string('nationality', 100)->nullable();
            $table->string('nationality_bn', 100)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('religion_bn', 100)->nullable();
            $table->string('nid_number', 50)->nullable();

            // Professional Info
            $table->string('profession', 150)->nullable();
            $table->string('profession_bn', 150)->nullable();
            $table->text('profile_summary')->nullable();
            $table->text('profile_summary_bn')->nullable();

            // Online Presence
            $table->string('website', 300)->nullable();
            $table->string('linkedin', 300)->nullable();
            $table->string('github', 300)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_details');
    }
};
