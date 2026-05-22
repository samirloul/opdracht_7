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
        Schema::create('voertuig_leveranciers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voertuig_id')->constrained('voertuigs')->cascadeOnDelete();
            $table->foreignId('leverancier_id')->constrained('leveranciers')->cascadeOnDelete();
            $table->date('leverdatum')->nullable();
            $table->boolean('is_actief')->default(true);
            $table->string('opmerking', 250)->nullable();
            $table->dateTime('datum_aangemaakt', 6);
            $table->dateTime('datum_gewijzigd', 6);

            $table->unique(['voertuig_id', 'leverancier_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voertuig_leveranciers');
    }
};
