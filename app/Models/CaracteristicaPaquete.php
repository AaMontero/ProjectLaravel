<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaracteristicaPaquete extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripción',
    ];
    public function Paquete(){
        return $this->belongsTo(Paquete::class); 
    }
}