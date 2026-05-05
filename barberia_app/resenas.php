<?php
session_start();
include("config/conexion.php");
if(!isset($_SESSION['usuario'])) { header("Location: index.php"); exit(); }
$rol = $_SESSION['rol'];

if(isset($_POST['enviar'])){
    $u = mysqli_real_escape_string($conn, $_SESSION['usuario']);
    $p = (int)$_POST['puntos'];
    $c = mysqli_real_escape_string($conn, $_POST['comentario']);
    $conn->query("INSERT INTO resenas (usuario, puntos, comentario) VALUES ('$u', '$p', '$c')");
}
$todas = $conn->query("SELECT * FROM resenas ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css?v=2.2">
    <title>Reseñas | Martin Barber</title>
</head>
<body>
    <header>
        <h1>MARTIN BARBER</h1>
        <nav>
            <a href="dashboard.php" class="nav-link">Inicio</a>
            <?php if($rol == 'admin'): ?>
                <a href="clientes.php" class="nav-link">Clientes</a>
                <a href="servicios.php" class="nav-link">Servicios</a>
                <a href="estadisticas.php" class="nav-link">Reportes</a>
            <?php endif; ?>
            <a href="citas.php" class="nav-link">Agenda</a>
            <a href="galeria.php" class="nav-link">Galería</a>
            <a href="resenas.php" class="nav-link active">Reseñas</a>
            <a href="logout.php" class="nav-link salir">Salir</a>
        </nav>
    </header>
    <div class="main-container">
        <div class="split-layout">
            <div class="card">
                <h3>Danos tu valoración</h3>
                <form method="POST">
                    <select name="puntos" required style="width:100%; padding:10px; background:#111; color:white; margin-bottom:15px;">
                        <option value="5">⭐⭐⭐⭐⭐ Excelente</option>
                        <option value="4">⭐⭐⭐⭐ Muy bueno</option>
                        <option value="3">⭐⭐⭐ Normal</option>
                    </select>
                    <textarea name="comentario" placeholder="¿Cómo ha sido tu experiencia?" required style="width:100%; height:100px; background:#111; color:white; border:1px solid #444; padding:10px;"></textarea>
                    <button type="submit" name="enviar" class="btn-gold" style="margin-top:15px; width:100%;">Publicar</button>
                </form>
            </div>
            <div class="table-container">
                <h3>Opiniones de la comunidad</h3>
                <?php while($r = $todas->fetch_assoc()): ?>
                    <div class="card" style="margin-bottom:10px; background: rgba(255,255,255,0.03);">
                        <strong style="color:var(--gold);"><?php echo htmlspecialchars($r['usuario']); ?></strong>
                        <span><?php echo str_repeat("⭐", $r['puntos']); ?></span>
                        <p style="font-size:0.9rem; margin-top:5px;">"<?php echo htmlspecialchars($r['comentario']); ?>"</p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>