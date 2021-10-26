<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;

    const TYPE_CARTE = [
        "MASTERCARD" => 1,
        "VISA" => 2,
        "GIM-UEMOA" => 3,
        "MASTERCARD & GIM-UEMOA" => 4,
    ];
    // statut carte soit 
    // 0 = suspendu
    // 1 = activer
    //-1 = bloquer

    protected $fillable = ['type_carte', 'compte_id', "no_carte", 'statut'];

    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }
}
