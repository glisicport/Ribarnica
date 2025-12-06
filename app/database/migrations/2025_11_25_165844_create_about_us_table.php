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
    Schema::create('about_us', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();
        $table->string('short_description', 500)->nullable();
        $table->text('long_description')->nullable();
        $table->string('image')->nullable(); // putanja do slike (npr. storage/about/image.jpg)

        $table->text('mission')->nullable();
        $table->text('vision')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
