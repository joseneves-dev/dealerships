<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('vehicles_owners');
            $table->string('brand');
            $table->string('model');
            $table->string('version');
            $table->string('cc');
            $table->string('fuel');
            $table->string('first_date_license_plate');
            $table->string('license_plate');
            $table->string('chassi_number');
            $table->string('color');
            $table->string('km');
            $table->string('last_inspection');
            $table->string('last_inspection_km');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
