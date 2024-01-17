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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('symbol', 10)->nullable();
            $table->string('name', 200)->nullable();
            $table->string('symbol_native', 20)->nullable();
            $table->integer('decimal_digits')->unsigned()->default(2);
            $table->integer('rounding')->unsigned()->default(0);
            $table->string('code', 100)->nullable();
            $table->string('name_plural', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
