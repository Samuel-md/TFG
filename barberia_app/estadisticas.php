<?php
session_start();
include("config/conexion.php");

// SEGURIDAD: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

// CONSULTAS PARA LOS DATOS
$citas_total = $conn->query("SELECT COUNT(*) as total FROM citas")->fetch_assoc()['total'];
$clientes_total = $conn->query("SELECT COUNT(*) as total FROM clientes")->fetch_assoc()['total'];
$ingresos = $conn->query("SELECT SUM(servicios.precio) as total FROM citas JOIN servicios ON citas.servicio_id = servicios.id")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css?v=1.7">
    <title>Reportes | Martin Barber</title>
</head>
<body>
    <header>
        <h1>MARTIN BARBER</h1>
        <nav>
            <a href="dashboard.php" class="nav-link">Inicio</a>
         <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
         <a href="clientes.php" class="nav-link">Clientes</a>
         <a href="servicios.php" class="nav-link">Servicios</a>
         <a href="estadisticas.php" class="nav-link">Reportes</a>
         <?php endif; ?>
         <a href="citas.php" class="nav-link">Agenda</a>
         <a href="galeria.php" class="nav-link">Galería</a>
         <a href="resenas.php" class="nav-link">Reseñas</a>
            <a href="logout.php" class="nav-link salir">Salir</a>
        </nav>
    </header>

    <div class="main-container">
        <h2 style="text-align:center; margin-bottom:30px;">Análisis del Negocio</h2>
        
        <div class="full-stats">
            <div class="card" style="text-align:center;">
                <h3 style="color:var(--gold); font-size:2rem;"><?php echo $citas_total; ?></h3>
                <p>Citas Totales</p>
            </div>
            <div class="card" style="text-align:center;">
                <h3 style="color:var(--gold); font-size:2rem;"><?php echo $clientes_total; ?></h3>
                <p>Clientes Registrados</p>
            </div>
            <div class="card" style="text-align:center;">
                <h3 style="color:var(--gold); font-size:2rem;"><?php echo number_format($ingresos, 2); ?>€</h3>
                <p>Ingresos Estimados</p>
            </div>
        </div>

        <div class="card" style="margin-top:30px; text-align:center;">
            <p style="color:#888;">Estos datos se calculan en base a los servicios realizados y registrados en la agenda.</p>
        </div>
    </div>
</body>
</html>