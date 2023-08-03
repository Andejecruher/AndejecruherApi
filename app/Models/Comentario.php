<?php
// app/Models/Comentario.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'contenido', 'nombre_autor', 'articulo_id', 'user_id', 'ip_address'
    ];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
