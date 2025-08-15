<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Propietario extends Model
{
    use HasFactory;

    protected $table = 'propietarios';
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono'
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

    public function tiendas()
    {
        return $this->hasMany(Tienda::class);
    }
}
