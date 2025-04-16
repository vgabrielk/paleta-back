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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->uuid('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('template_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
