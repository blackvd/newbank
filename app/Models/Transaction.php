<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    public $fillable = [
        'credit',
        "solde",
        "libelle",
        "agent",
        "compte", "ref",
    ];


    public function admin()
    {
        return $this->belongsTo(Admin::class, "agent");
    }


    public function compte()
    {
        return $this->belongsTo(Compte::class, "compte");
    }
}
