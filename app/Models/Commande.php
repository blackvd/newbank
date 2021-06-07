<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    const STATUT = [
        "EN ATTENTE" => 1,
        "LIVRAISON" => 2,
        "DELIVRÉ" => 3
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function adresseLivraison(){
        return $this->hasOne(AdresseLivraison::class);
    }
}
