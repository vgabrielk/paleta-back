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
          $table->string('name');
          $table->enum('type', ['free', 'premium'])->default('free');
          $table->timestamps();
      });
  }

    public function down()
    {
        Schema::dropIfExists('templates');
    }
};
