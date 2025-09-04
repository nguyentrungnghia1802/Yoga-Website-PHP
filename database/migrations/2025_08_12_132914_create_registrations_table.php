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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();

            $table->unsignedTinyInteger('package_months');
            $table->decimal('discount', 5, 2);
            $table->decimal('final_price', 10, 2);


            $table->string('status', 20)->default('PENDING');
            $table->string('note', 255)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['customer_id', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
