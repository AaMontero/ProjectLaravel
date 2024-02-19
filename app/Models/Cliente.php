<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula', 'nombres', 'apellidos', 'numTelefonico', 'email', 'provincia' , 'ciudad', 'activo'
    ]; 

    //$table->string('usuario'); 
    //$table->foreignId('user_id')->constrained()->cascadeOnDelete();
}
