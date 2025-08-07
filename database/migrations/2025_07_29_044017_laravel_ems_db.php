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
        Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('first_name', 50);
        $table->string('second_name', 50);
        $table->string('email', 254);
        $table->string('gender', 10);
        $table->string('department', 100);
        $table->string('image', 100)->nullable();
        $table->boolean('is_active')->default(1);
        $table->boolean('is_deleted')->default(0);
        $table->string('department_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
