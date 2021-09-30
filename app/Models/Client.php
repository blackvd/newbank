<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    const STATUT = [
        "EN ATTENTE" => 1,
        "VALIDATION" => 2,
        "OUVERT" => 3,
        "DESACTIVÉ" => 0,
        "REJÉTÉ" => -1,
        "BLOQUER" => -2
    ];


    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function identification()
    {
        return $this->hasOne(Identification::class);
    }

    public function comptes()
    {
        return $this->hasMany(Compte::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function handleBy()
    {
        return $this->belongsTo(Admin::class, 'admin_code');
    }
}
