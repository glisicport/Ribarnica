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
        Schema::create('ambijent', function (Blueprint $table) {
            $table->id();
            $table->string('naziv'); // npr. "Terasa", "Unutrašnji deo"
            $table->string('slika'); // naziv fajla slike u /public/images/galerija
            $table->text('opis')->nullable(); // opcioni opis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambijent');
    }
};
