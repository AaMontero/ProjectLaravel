<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsApp extends Model
{
    use HasFactory;

    protected $table = 'whats_apps';
    protected $primaryKey = 'id';
    public $timestamps = false; // No necesitas timestamps adicionales, ya que tienes 'fecha_hora'

    protected $fillable = [
        'fecha_hora',
        'mensaje_recibido',
        'mensaje_enviado',
        'id_wa',
        'timestamp_wa',
        'telefono_wa',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime', // Asegura que 'fecha_hora' se maneje como un objeto DateTime
    ];
}
