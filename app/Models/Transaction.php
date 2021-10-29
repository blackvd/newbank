<?php

namespace App\Models;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    /*
        crediter = ref = 011
        debiter = ref = 012
        agent_crediter = 010
    */

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

    public function getFromDateAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }
}
