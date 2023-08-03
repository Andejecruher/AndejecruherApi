<?php
// app/Models/Articulo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = [
        'titulo', 'contenido', 'image_destacada', 'descripcion', 'fecha_publicacion', 'usuario_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'articulo_categorias');
    }
}
