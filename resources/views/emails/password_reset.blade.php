<!-- resources/views/emails/password_reset.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Recuperación de Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Recuperación de Contraseña') }}</div>
                    <div class="card-body">
                        <p>Hola {{ $user->name }},</p>
                        <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
                        <a href="{{ $url.$token }}" class="btn btn-primary">
                            {{ __('Restablecer Contraseña') }}
                        </a>
                        <p class="mt-3">Si no solicitaste el restablecimiento de contraseña, puedes ignorar este correo electrónico.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
