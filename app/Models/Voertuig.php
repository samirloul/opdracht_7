<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Voertuig extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'kenteken',
        'type',
        'bouwjaar',
        'brandstof',
        'type_voertuig_id',
        'is_actief',
        'opmerking',
        'datum_aangemaakt',
        'datum_gewijzigd',
    ];

    protected $casts = [
        'bouwjaar' => 'date',
        'is_actief' => 'boolean',
        'datum_aangemaakt' => 'datetime',
        'datum_gewijzigd' => 'datetime',
    ];

    public function typeVoertuig(): BelongsTo
    {
        return $this->belongsTo(TypeVoertuig::class);
    }

    public function toewijzing(): HasOne
    {
        return $this->hasOne(VoertuigInstructeur::class);
    }
}
