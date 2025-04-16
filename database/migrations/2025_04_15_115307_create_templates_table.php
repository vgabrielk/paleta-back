<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
  {
      Schema::create('templates', function (Blueprint $table) {
          $table->id();
          $table->string('nome');
          $table->string('slug')->unique();
          $table->text('descricao')->nullable();
          $table->string('preview_url')->nullable();
          $table->timestamps();
      });
  }

    public function down()
    {
        Schema::dropIfExists('templates');
    }
};
