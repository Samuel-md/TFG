<?php
// 1. Activamos errores para ver qué pasa si falla algo
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include("config/conexion.php"); // Asegúrate de que esta ruta es correcta

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiamos los datos que entran
    $u = mysqli_real_escape_string($conn, $_POST['u']);
    $p = mysqli_real_escape_string($conn, $_POST['p']);
    
    // Consulta a la base de datos
    $res = $conn->query("SELECT * FROM usuarios WHERE usuario='$u' AND password='$p'");
    
    if ($res && $res->num_rows > 0) {
        $datos = $res->fetch_assoc();
        
        // GUARDAMOS TODO EN LA SESIÓN (La maleta)
        $_SESSION['usuario'] = $datos['usuario'];
        $_SESSION['rol']     = $datos['rol'];
        $_SESSION['user_id'] = $datos['id'];
        
        // Redirigimos al dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Martin Barber</title>
    <link rel="stylesheet" href="style.css?v=1.7">
</head>
<body class="body-login">

    <div class="card">
        <h1 style="color: #d4af37; font-family: 'Cinzel', serif;">MARTIN BARBER</h1>
        <p style="color: #888; margin-bottom: 20px;">Panel de Acceso</p>

        <?php if($error != ""): ?>
            <div style="background: rgba(255,0,0,0.1); color: #ff4d4d; padding: 10px; margin-bottom: 15px; border-radius: 4px; font-size: 0.8rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php">
            <input type="text" name="u" placeholder="Tu usuario" required autocomplete="off">
            <input type="password" name="p" placeholder="Tu contraseña" required>
            <button type="submit" class="btn-gold" style="margin-top: 10px;">Entrar</button>
        </form>
    </div>

</body>
</html>