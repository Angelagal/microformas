<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BitacoraAcceso extends Model
{
    use HasFactory;

    protected $table = 'bitacora_acceso';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'user_id',
        'fecha_acceso',
        'fecha_salida',
    ];

    // Conversión automática a objetos Carbon
    protected $dates = [
        'fecha_acceso',
        'fecha_salida',
        'created_at',
        'updated_at',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
