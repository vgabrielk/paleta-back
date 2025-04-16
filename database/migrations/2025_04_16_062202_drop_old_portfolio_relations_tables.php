<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('portfolio_links');
        Schema::dropIfExists('portfolio_experiences');
        Schema::dropIfExists('portfolio_education');
        Schema::dropIfExists('portfolio_projects');
    }

    public function down(): void
    {
    }
};
