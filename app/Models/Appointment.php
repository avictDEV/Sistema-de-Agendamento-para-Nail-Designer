<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    // Campos permitidos para gravação
    protected $fillable = [
        'user_id',
        'service_id',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
        'notes'
    ];

    // Diz ao Laravel que o campo 'user_id' se conecta com a tabela de Usuários
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Diz ao Laravel que o campo 'service_id' se conecta com a tabela de Serviços
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}