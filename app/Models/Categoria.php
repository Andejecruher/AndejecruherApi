<?php
// app/Models/Categoria.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'articulo_categorias');
    }
}
