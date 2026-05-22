<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class VoertuigInstructeur extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'voertuig_id',
        'instructeur_id',
        'datum_toekenning',
        'is_actief',
        'opmerking',
        'datum_aangemaakt',
        'datum_gewijzigd',
    ];

    protected $casts = [
        'datum_toekenning' => 'date',
        'is_actief' => 'boolean',
        'datum_aangemaakt' => 'datetime',
        'datum_gewijzigd' => 'datetime',
    ];

    public function voertuig(): BelongsTo
    {
        return $this->belongsTo(Voertuig::class);
    }

    public function instructeur(): BelongsTo
    {
        return $this->belongsTo(Instructeur::class);
    }
}
