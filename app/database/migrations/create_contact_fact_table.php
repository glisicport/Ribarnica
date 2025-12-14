
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('contact_facts', function (Blueprint $table) {
        $table->id();
        $table->string('icon')->nullable(); // fa-icon klasa tipa "fas fa-store"
        $table->string('text');             // tekst brzih činjenica
        $table->integer('order')->default(0); // radi sortiranja
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('contact_facts');
}
};