<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compte extends Model
{
    use HasFactory;

    const TYPE_COMPTE = [
        "COURANT" => 1,
        "EPARGNE" => 2
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function carte()
    {
        return $this->hasOne(Carte::class);
    }


    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
