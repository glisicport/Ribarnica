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
    Schema::create('employees', function (Blueprint $table) {
        $table->id();

        // Ime i prezime
        $table->string('name');
        $table->string('last_name');

        // Pozicija (npr. "Prodavac", "Menadžer", "Ribolovac", "Radnik u magacinu")
        $table->string('position')->nullable();

        // Kratka biografija
        $table->text('bio')->nullable();

        // Slika zaposlenog
        $table->string('photo')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
