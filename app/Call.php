<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\CallSubjects;

class Call extends Model
{
    const STATUS_ABERTO = 'ABERTO';
    const STATUS_AUTORIZADO = 'AUTORIZADO';
    const STATUS_AGUARDANDO_AUTORIZACAO = 'AGUARDANDO AUTORIZACAO';
    const STATUS_CANCELADO = 'CANCELADO';
    const STATUS_DEVOLVIDO = 'DEVOLVIDO';

    public function subject()
    {
        return $this->belongsTo(CallSubjects::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipemnts()
    {
        return $this->hasMany(Equipment::class);
    }
}
