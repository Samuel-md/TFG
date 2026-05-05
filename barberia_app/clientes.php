<?php
session_start();
include("config/conexion.php");

// SEGURIDAD: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

// LÓGICA PARA AÑADIR CLIENTE MANUAL (El que anota el barbero)
if (isset($_POST['add'])) {
    $n = mysqli_real_escape_string($conn, $_POST['n']);
    $t = mysqli_real_escape_string($conn, $_POST['t']);
    $e = mysqli_real_escape_string($conn, $_POST['e']);
    $conn->query("INSERT INTO clientes (nombre, telefono, email) VALUES ('$n', '$t', '$e')");
}

// CONSULTA UNIFICADA: Junta los clientes manuales y los usuarios registrados
$sql = "SELECT nombre, telefono, email, 'Manual' as tipo FROM clientes 
        UNION 
        SELECT usuario as nombre, 'N/A' as telefono, 'Cuenta Web' as email, 'Usuario' as tipo 
        FROM usuarios WHERE rol = 'cliente'
        ORDER BY nombre ASC";

$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css?v=1.9">
    <title>Base de Datos | Martin Barber</title>
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
        <div class="split-layout">
            <div class="card">
                <h2>Registrar Nuevo</h2>
                <form method="POST">
                    <input type="text" name="n" placeholder="Nombre completo" required>
                    <input type="text" name="t" placeholder="Teléfono">
                    <input type="email" name="e" placeholder="Email">
                    <button type="submit" name="add" class="btn-gold">Añadir a mano</button>
                </form>
            </div>

            <div class="table-container">
                <h2>Todos los Clientes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre / Usuario</th>
                            <th>Contacto</th>
                            <th>Origen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($f = $res->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo $f['nombre']; ?></strong></td>
                            <td><?php echo $f['telefono']; ?></td>
                            <td>
                                <span style="background: <?php echo ($f['tipo'] == 'Usuario') ? '#d4af37' : '#444'; ?>; 
                                             color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">
                                    <?php echo $f['tipo']; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>