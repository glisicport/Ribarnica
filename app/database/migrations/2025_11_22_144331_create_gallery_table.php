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
        Schema::create('galerija', function (Blueprint $table) {
        $table->id(); 
        $table->string('naziv_slike'); 
        $table->text('opis')->nullable();
        $table->string('putanja'); 
        $table->dateTime('datum_postavljanja')->useCurrent(); 
        $table->timestamps(); 
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
