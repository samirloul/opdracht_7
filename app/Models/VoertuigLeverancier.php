<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class VoertuigLeverancier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'voertuig_id',
        'leverancier_id',
        'leverdatum',
        'is_actief',
        'opmerking',
        'datum_aangemaakt',
        'datum_gewijzigd',
    ];

    protected $casts = [
        'leverdatum' => 'date',
        'is_actief' => 'boolean',
        'datum_aangemaakt' => 'datetime',
        'datum_gewijzigd' => 'datetime',
    ];

    public function voertuig(): BelongsTo
    {
        return $this->belongsTo(Voertuig::class);
    }

    public function leverancier(): BelongsTo
    {
        return $this->belongsTo(Leverancier::class);
    }
}
