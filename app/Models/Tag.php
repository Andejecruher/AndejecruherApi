<?php

// app/Models/Tag.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'nombre'
    ];

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'articulo_tags');
    }
}
