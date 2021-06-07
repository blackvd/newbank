<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    const TYPE_COMPTE = [
        "COURANT" => 1,
        "EPARGNE" => 2
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function carte(){
        return $this->hasOne(Carte::class);
    }
}
