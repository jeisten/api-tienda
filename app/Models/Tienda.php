<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tienda extends Model
{
    use HasFactory;

    protected $table = 'tiendas';
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'propietario_id',
        'fecha_permiso',
        'foto_url',
        'certificado_bomberos',
        'sayco_acinpro',
        'latitud',
        'longitud',
        'direccion_tienda'
    ];

    protected $casts = [
        'fecha_permiso' => 'date',
        'latitud' => 'decimal:8',
        'longitud' => 'decimal:8'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }

    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }
}
