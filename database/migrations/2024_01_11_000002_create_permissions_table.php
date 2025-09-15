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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Permission name');
            $table->string('display_name')->comment('Human readable permission name');
            $table->string('module')->comment('Module this permission belongs to');
            $table->text('description')->nullable()->comment('Permission description');
            $table->timestamps();
            
            $table->index(['name']);
            $table->index(['module']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};