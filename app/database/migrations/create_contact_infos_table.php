<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('TFZR RIBARNICA');
            $table->string('subtitle')->nullable(); // "Dobrodošli u našu ribarnicu"
            $table->string('phone_label')->default('Telefon');
            $table->string('phone_value')->nullable();
            $table->string('email_label')->default('Email');
            $table->string('email_value')->nullable();
            $table->string('hours_label')->default('Radno vreme');
            $table->text('hours_value')->nullable(); // Pon–Pet: ..., Subota: ...
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
