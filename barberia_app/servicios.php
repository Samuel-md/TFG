<?php
session_start();
include("config/conexion.php");

// ESCUDO: Solo entra el admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

// Lógica para añadir servicio
if (isset($_POST['add'])) {
    $n = mysqli_real_escape_string($conn, $_POST['n']);
    $p = mysqli_real_escape_string($conn, $_POST['p']);
    $conn->query("INSERT INTO servicios (nombre, precio) VALUES ('$n', '$p')");
}

// Sacamos los servicios de la base de datos para que la tabla no esté vacía
$res = $conn->query("SELECT * FROM servicios ORDER BY nombre ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css?v=1.8">
    <title>Servicios | Martin Barber</title>
</head>
<body>
    <header>
        <h1>MARTIN BARBER</h1>
        <nav>
            <a href="dashboard.php" class="nav-link">Inicio</a>
            <a href="clientes.php" class="nav-link">Clientes</a>
            <a href="servicios.php" class="nav-link">Servicios</a>
            <a href="estadisticas.php" class="nav-link">Reportes</a>
            <a href="citas.php" class="nav-link">Agenda</a>
            <a href="galeria.php" class="nav-link">Galería</a>
            <a href="resenas.php" class="nav-link">Reseñas</a>
            <a href="logout.php" class="nav-link salir">Salir</a>
        </nav>
    </header>

    <div class="main-container">
        <div class="split-layout">
            <div class="card">
                <h2>Nuevo Servicio</h2>
                <form method="POST">
                    <input type="text" name="n" placeholder="Nombre del servicio" required>
                    <input type="number" step="0.01" name="p" placeholder="Precio (€)" required>
                    <button type="submit" name="add" class="btn-gold">Guardar</button>
                </form>
            </div>

            <div class="table-container">
                <h2>Lista de Precios</h2>
                <table>
                    <thead>
                        <tr><th>Servicio</th><th>Precio</th></tr>
                    </thead>
                    <tbody>
                        <?php while($f = $res->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $f['nombre']; ?></td>
                            <td><strong><?php echo $f['precio']; ?>€</strong></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>