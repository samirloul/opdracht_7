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
        Schema::create('voertuig_instructeurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voertuig_id')->unique()->constrained('voertuigs')->cascadeOnDelete();
            $table->foreignId('instructeur_id')->constrained('instructeurs')->cascadeOnDelete();
            $table->date('datum_toekenning');
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
        Schema::dropIfExists('voertuig_instructeurs');
    }
};
