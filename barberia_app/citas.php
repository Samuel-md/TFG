<?php
session_start(); 
include("config/conexion.php");
if(!isset($_SESSION['usuario'])) { header("Location: index.php"); exit(); }
$rol = $_SESSION['rol'];
$uid = $_SESSION['user_id'];

if(isset($_POST['add'])){
    $c_id = ($rol == 'admin') ? $_POST['c'] : $uid;
    $tipo = ($rol == 'admin') ? 'manual' : 'usuario';
    $conn->query("INSERT INTO citas (cliente_id, servicio_id, fecha, hora, notas) VALUES ('$c_id', '".$_POST['s']."', '".$_POST['f']."', '".$_POST['h']."', '$tipo')");
}

$sql = "SELECT citas.id, COALESCE(clientes.nombre, usuarios.usuario) as cl, servicios.nombre as se, citas.fecha, citas.hora 
        FROM citas 
        LEFT JOIN clientes ON citas.cliente_id = clientes.id AND citas.notas = 'manual'
        LEFT JOIN usuarios ON citas.cliente_id = usuarios.id AND citas.notas = 'usuario'
        JOIN servicios ON citas.servicio_id = servicios.id";
if($rol != 'admin') { $sql .= " WHERE (citas.cliente_id = '$uid' AND citas.notas = 'usuario')"; }
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css?v=1.8">
    <title>Agenda | Martin Barber</title>
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
            <a href="citas.php" class="nav-link active">Agenda</a>
            <a href="galeria.php" class="nav-link">Galería</a>
            <a href="resenas.php" class="nav-link">Reseñas</a>
            <a href="logout.php" class="nav-link salir">Salir</a>
        </nav>
    </header>
    <div class="main-container">
        <div class="card" style="max-width: 500px; margin: 0 auto 30px auto;">
            <h2><?php echo ($rol == 'admin') ? "Añadir Cita Manual" : "Reservar mi Cita"; ?></h2>
            <form method="POST">
                <?php if($rol == 'admin'): ?>
                    <label>Cliente:</label>
                    <select name="c" required>
                        <?php 
                        $clts = $conn->query("SELECT * FROM clientes");
                        while($c=$clts->fetch_assoc()) echo "<option value='".$c['id']."'>".$c['nombre']."</option>";
                        ?>
                    </select>
                <?php else: ?>
                    <p>Vas a reservar como: <strong><?php echo $_SESSION['usuario']; ?></strong></p>
                <?php endif; ?>
                <select name="s" required>
                    <?php 
                    $servs = $conn->query("SELECT * FROM servicios");
                    while($s=$servs->fetch_assoc()) echo "<option value='".$s['id']."'>".$s['nombre']." (".$s['precio']."€)</option>";
                    ?>
                </select>
                <input type="date" name="f" required>
                <input type="time" name="h" required>
                <button type="submit" name="add" class="btn-gold">Confirmar</button>
            </form>
        </div>
        <div class="table-container">
            <table>
                <thead><tr><th>Cliente</th><th>Servicio</th><th>Fecha</th><th>Hora</th></tr></thead>
                <tbody>
                    <?php while($r=$res->fetch_assoc()): ?>
                    <tr>
                        <td><strong><?php echo $r['cl']; ?></strong></td>
                        <td><?php echo $r['se']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($r['fecha'])); ?></td>
                        <td><?php echo $r['hora']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>