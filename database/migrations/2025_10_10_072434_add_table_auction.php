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
        Schema::create('test2', function (Blueprint $table) {
              $table->id();
              $table->string('name',255);
              $table->string('designation',255);
              $table->enum('role', ['User', 'company']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test2', function (Blueprint $table) {
            //
        });
    }
};
