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
        Schema::table('registrations', function (Blueprint $table) {
            // Change discount from decimal(5,2) to decimal(10,2) to handle larger values
            $table->decimal('discount', 10, 2)->change();
            
            // Change final_price from decimal(10,2) to decimal(12,2) to handle larger values
            $table->decimal('final_price', 12, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Revert back to original precision
            $table->decimal('discount', 5, 2)->change();
            $table->decimal('final_price', 10, 2)->change();
        });
    }
};