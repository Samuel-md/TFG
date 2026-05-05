<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location: index.php"); exit(); }
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css?v=2.5">
    <title>Inicio | Martin Barber</title>
    <style>
        /* Arreglo rápido para que las tarjetas se vean bien */
        .full-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card-dash {
            background: rgba(20, 20, 20, 0.9);
            border: 1px solid #333;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            min-height: 200px; /* Esto evita que se pisen */
        }
        .card-dash h3 {
            margin-bottom: 15px;
            letter-spacing: 2px;
            color: #fff;
        }
        .btn-dash {
            background: var(--gold, #d4af37);
            color: #000;
            padding: 12px 25px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            transition: 0.3s;
            display: inline-block;
            margin-top: auto; /* Empuja el botón siempre abajo */
            width: 80%;
        }
        .btn-dash:hover {
            background: #fff;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <header>
        <h1>MARTIN BARBER</h1>
        <nav>
            <a href="dashboard.php" class="nav-link active">Inicio</a>
            <?php if($rol == 'admin'): ?>
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
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 2rem;"><?php echo ($rol == 'admin') ? "Panel de Control" : "Bienvenido, " . $_SESSION['usuario']; ?></h2>
            <p style="color: var(--gold); letter-spacing: 3px; font-size: 0.8rem;">MARTIN BARBER PREMIUM</p>
        </div>

        <div class="full-stats">
            <div class="card-dash">
                <div>
                    <span style="font-size: 2rem;">📅</span>
                    <h3>OPERACIONES</h3>
                </div>
                <a href="citas.php" class="btn-dash">VER AGENDA</a>
            </div>

            <div class="card-dash">
                <div>
                    <span style="font-size: 2rem;">📸</span>
                    <h3>CATÁLOGO</h3>
                </div>
                <a href="galeria.php" class="btn-dash">VER ESTILOS</a>
            </div>

            <div class="card-dash">
                <div>
                    <span style="font-size: 2rem;">⭐</span>
                    <h3>FEEDBACK</h3>
                </div>
                <a href="resenas.php" class="btn-dash">VER OPINIONES</a>
            </div>
        </div>

        <?php if($rol == 'admin'): ?>
            <div class="card-dash" style="margin-top: 30px; width: 100%; min-height: auto; align-items: flex-start;">
                <h3 style="color: var(--gold); font-size: 1rem;">📝 NOTAS RÁPIDAS</h3>
                <textarea style="width:100%; height:60px; background:rgba(0,0,0,0.2); color:#fff; border:1px solid #444; padding:10px; margin-top:10px; resize:none;" placeholder="Recordatorios..."></textarea>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>