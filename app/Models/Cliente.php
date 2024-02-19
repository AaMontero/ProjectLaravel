<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula', 'nombres', 'apellidos', 'numTelefonico', 'email', 'provincia' , 'ciudad', 'activo'
    ]; 
    public function user(): BelongsTo{
        return $this ->belongsTo(User::class); 
    }

    //$table->string('usuario'); 
    //$table->foreignId('user_id')->constrained()->cascadeOnDelete();
}
