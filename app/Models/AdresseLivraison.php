<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdresseLivraison extends Model
{
    use HasFactory;

    protected $fillable = ["longitude","latitude","description","commande_id"];

    public function commande(){
        return $this->belongsTo(Commande::class);
    }
}
