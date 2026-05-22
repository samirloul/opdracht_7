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
        Schema::create('instructeurs', function (Blueprint $table) {
            $table->id();
            $table->string('voornaam', 80);
            $table->string('tussenvoegsel', 30)->nullable();
            $table->string('achternaam', 80);
            $table->string('mobiel', 20);
            $table->date('datum_in_dienst');
            $table->unsignedTinyInteger('aantal_sterren')->default(0);
            $table->boolean('is_actief')->default(true);
            $table->string('opmerking', 250)->nullable();
            $table->dateTime('datum_aangemaakt', 6);
            $table->dateTime('datum_gewijzigd', 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructeurs');
    }
};
