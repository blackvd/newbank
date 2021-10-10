<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pret extends Model
{
    use HasFactory;

    protected $fillable = ['montant', 'reste', 'statut', 'client_id', 'motif', 'agence'];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected $hidden = [
        'client_id',
    ];
}
