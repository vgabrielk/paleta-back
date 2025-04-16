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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');
            $table->foreignId('portfolio_id')->nullable()->constrained()->onDelete('cascade')->after('id');
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
