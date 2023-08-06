<?php
// app/Models/Articulo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = [
        'titulo', 'descripcion', 'contenido', 'imagen_destacada','fecha_publicacion', 'usuario_id', 'categoria_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
