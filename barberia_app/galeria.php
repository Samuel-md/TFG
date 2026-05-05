<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location: index.php"); exit(); }
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css?v=2.6">
    <title>Catálogo | Martin Barber</title>
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }
        .item-card {
            background: #111;
            border: 1px solid #333;
            border-radius: 8px;
            overflow: hidden;
            transition: 0.3s;
        }
        .item-card:hover {
            border-color: var(--gold);
            transform: translateY(-5px);
        }
        .item-card img, .item-card video {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }
        .item-info {
            padding: 20px;
        }
        .item-info h3 {
            color: var(--gold);
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        .item-info p {
            font-size: 0.85rem;
            color: #888;
        }
        .section-title {
            text-align: center;
            margin: 60px 0 30px;
            border-bottom: 1px solid #222;
            padding-bottom: 15px;
        }
    </style>
</head>
<body>
    <header>
        <h1>MARTIN BARBER</h1>
        <nav>
            <a href="dashboard.php" class="nav-link">Inicio</a>
            <?php if($rol == 'admin'): ?>
                <a href="clientes.php" class="nav-link">Clientes</a>
                <a href="servicios.php" class="nav-link">Servicios</a>
            <?php endif; ?>
            <a href="citas.php" class="nav-link">Agenda</a>
            <a href="galeria.php" class="nav-link active">Galería</a>
            <a href="resenas.php" class="nav-link">Reseñas</a>
            <a href="logout.php" class="nav-link salir">Salir</a>
        </nav>
    </header>

    <div class="main-container">
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 2.2rem;">CATÁLOGO TÉCNICO</h2>
            <p style="color: var(--gold); letter-spacing: 4px;">ESTILOS & PRODUCTOS 2026</p>
        </div>

        <h2 class="section-title">🎬 Técnicas en Movimiento</h2>
        <div class="gallery-grid">
            
            <div class="item-card">
                <div style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden;">
                    <iframe 
                        style="position:absolute; top:0; left:0; width:100%; height:100%; border:none;" 
                        src="https://www.youtube.com/embed/99eGndTVbIk" 
                        title="Tutorial High Fade" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="item-info" style="border-top: 2px solid var(--gold);">
                    <h3>High Fade Masterclass</h3>
                    <p>Técnica avanzada de desvanecido alto. Transición limpia y sombreado profesional paso a paso.</p>
                </div>
            </div>

            <div class="item-card">
                <img src="https://images.unsplash.com/photo-1621605815971-fbc98d665033?q=80&w=600" alt="Barba">
                <div class="item-info">
                    <h3>Perfilado de Barba</h3>
                    <p>Diseño de barba geométrica con tratamiento de toalla caliente y navaja clásica.</p>
                </div>
            </div>
        </div>

        <h2 class="section-title">✂️ Tendencias Urbanas</h2>
        <div class="gallery-grid">
            <div class="item-card">
                <img src="https://static.wixstatic.com/media/c18d14_6f4e4a6effa14a2396147993ab8b3708~mv2.jpg/v1/fill/w_500,h_575,al_c,q_80,enc_avif,quality_auto/c18d14_6f4e4a6effa14a2396147993ab8b3708~mv2.jpg">
                <div class="item-info">
                    <h3>Buzz Cut Texturizado</h3>
                    <p>Minimalismo y comodidad para el día a día.</p>
                </div>
            </div>
            <div class="item-card">
                <img src="https://cdn.shopify.com/s/files/1/0641/2831/9725/files/Low_fade_haircut.webp?v=1764672540">
                <div class="item-info">
                    <h3>Low Fade</h3>
                    <p>Degradado sutil que nace desde la patilla y nuca, manteniendo densidad en la zona media para un contraste elegante.</p>
                </div>
            </div>
            <div class="item-card">
                <img src="https://www.primor.eu/blog/wp-content/uploads/2023/11/MULLET-HOMBRE-3-683x1024.jpeg">
                <div class="item-info">
                    <h3>Mullet Contemporáneo</h3>
                    <p>El regreso de un clásico con toques de estilo libre.</p>
                </div>
            </div>
        </div>

        <h2 class="section-title">🧴 Cuidado Personal (Ofertas)</h2>
        <div class="gallery-grid">
            <div class="item-card" style="border: 1px solid #d4af3755;">
                <img src="https://m.media-amazon.com/images/I/81E0yXq3UGL.jpg">
                <div class="item-info">
                    <span style="background:var(--gold); color:black; padding:2px 5px; font-size:0.7rem; font-weight:bold; border-radius:3px;">OFERTA</span>
                    <h3>Cera Mate Premium</h3>
                    <p>Fijación fuerte sin brillos. Solo 12,50€ en local.</p>
                </div>
            </div>
            <div class="item-card">
                <img src="https://marhe.es/wp-content/uploads/2021/11/argan-oil.jpg">
                <div class="item-info">
                    <h3>Aceite de Argán</h3>
                    <p>Hidratación profunda para barbas de más de 3 semanas.</p>
                </div>
            </div>
        </div>

        <div style="text-align: center; padding: 40px; color: #555;">
            <p>— Actualizamos nuestro catálogo mensualmente —</p>
        </div>
    </div>
</body>
</html>