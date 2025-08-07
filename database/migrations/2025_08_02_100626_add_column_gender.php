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
        schema::table('employees',function(blueprint $table)
        {
             $table->string('gender', 10);
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::table('employees', function (Blueprint $table) {
            $table->string('gender')->nullable(); // Adjust type if needed
        });
    }
};
