<!DOCTYPE html>
<html>
<head>
    <title>Detalles del Formulario de Contacto</title>
    <!-- Agregar estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Agregar FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #3498db; /* Azul */
        }
        p {
            margin: 10px 0;
        }
        .icon {
            font-size: 24px;
            margin-right: 10px;
            color: #e74c3c; /* Rojo */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Detalles del Formulario de Contacto</h2>

    <p><span class="icon"><i class="fas fa-user"></i></span><strong>Nombre:</strong> {{ $nombre }}</p>
    <p><span class="icon"><i class="fas fa-envelope"></i></span><strong>Correo Electrónico:</strong> {{ $correo }}</p>

    <h4>Mensaje:</h4>
    <p>{{ $mensaje }}</p>

    <p style="text-align: center; margin-top: 40px; color: #27ae60;">¡Gracias por contactarnos!</p>
</div>

</body>
</html>
