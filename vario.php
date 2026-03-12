<?php
// Configuración
$destino_email = 'tu-email@ejemplo.com'; // Cambia por tu email
$asunto_default = 'Mensaje desde formulario de contacto';

// Variables para mensajes
$mensaje_exito = '';
$mensaje_error = '';
$errores = [];

// Procesar formulario cuando se envía por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y validar datos
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $asunto = trim($_POST['asunto'] ?? $asunto_default);
    $mensaje = trim($_POST['mensaje'] ?? '');

    // Validaciones
    if (empty($nombre)) {
        $errores[] = 'El nombre es obligatorio.';
    }
    if (empty($email)) {
        $errores[] = 'El email es obligatorio.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email no es válido.';
    }
    if (empty($mensaje)) {
        $errores[] = 'El mensaje es obligatorio.';
    }

    if (empty($errores)) {
        // Preparar el correo
        $cuerpo = "Nombre: $nombre\n";
        $cuerpo .= "Email: $email\n\n";
        $cuerpo .= "Mensaje:\n$mensaje";

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($destino_email, $asunto, $cuerpo, $headers)) {
            $mensaje_exito = '¡Gracias! Tu mensaje ha sido enviado correctamente.';
            $nombre = $email = $asunto = $mensaje = '';
        } else {
            $mensaje_error = 'Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo.';
        }
    } else {
        $mensaje_error = implode('<br>', $errores);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .formulario {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        .campo {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
        }
        input, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #4a90e2;
        }
        button {
            background: #4a90e2;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #357abd;
        }
        .alerta {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .alerta-exito {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alerta-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="formulario">
        <h1>FORMULARIO FELIPE modificadddddddddddddddddddddd</h1>

        <?php if ($mensaje_exito): ?>
            <div class="alerta alerta-exito"><?= htmlspecialchars($mensaje_exito) ?></div>
        <?php endif; ?>

        <?php if ($mensaje_error): ?>
            <div class="alerta alerta-error"><?= $mensaje_error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="campo">
                <label for="nombre">Nombre *</label>
                <input type="text" id="nombre" name="nombre" required 
                       value="<?= htmlspecialchars($nombre ?? '') ?>">
            </div>

            <div class="campo">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required 
                       value="<?= htmlspecialchars($email ?? '') ?>">
            </div>

            <div class="campo">
                <label for="asunto">Asunto</label>
                <input type="text" id="asunto" name="asunto" 
                       value="<?= htmlspecialchars($asunto ?? '') ?>" 
                       placeholder="Opcional">
            </div>

            <div class="campo">
                <label for="mensaje">Mensaje modificaddddddddddddddddddddd*</label>
                <textarea id="mensaje" name="mensaje" required><?= htmlspecialchars($mensaje ?? '') ?></textarea>
            </div>

            <button type="submit">Enviar mensaje</button>
        </form>
    </div>
</body>
</html>
