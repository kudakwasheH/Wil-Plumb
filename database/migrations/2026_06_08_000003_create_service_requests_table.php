<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('address');
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->date('preferred_date');
            $table->text('problem_description');
            $table->string('status')->default('pending'); // pending, in_progress, completed, cancelled
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
