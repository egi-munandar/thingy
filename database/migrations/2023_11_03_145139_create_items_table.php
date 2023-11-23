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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id', 100)->nullable();
            $table->boolean('archived')->nullable()->default(false);
            $table->string('name', 200)->nullable();
            $table->double('qty', 15, 2)->default(0);
            $table->text('description')->nullable();
            $table->double('purchase_price', 15, 2)->nullable()->default(0);
            $table->string('purchase_from', 200)->nullable();
            $table->dateTime('purchase_time')->nullable();
            $table->string('manufacturer', 200)->nullable();
            $table->string('model_number', 200)->nullable();
            $table->string('serial_number', 200)->nullable();
            $table->boolean('lifetime_warranty')->default(false);
            $table->date('warranty_expires')->nullable();
            $table->text('warranty_details')->nullable();
            $table->string('sold_to', 200)->nullable();
            $table->double('sold_price', 15, 2)->nullable()->default(0);
            $table->dateTime('sold_time')->nullable();
            $table->text('sold_notes')->nullable();
            $table->text('bom')->nullable();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('instance_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
