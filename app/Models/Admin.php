<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'username',
        "name",
        "code",
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'agent');
    }
}
