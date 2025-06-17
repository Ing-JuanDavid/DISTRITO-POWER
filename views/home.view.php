<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', ['title' => 'Inicio', 'style' => 'home.css']) ?>

<body class="min-vh-100 d-flex flex-column">
    
    <?php view('partials/nav.php', ['links' => $links]); ?>

<div class="container py-5">
    <!-- Bienvenida -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="fw-bold mb-3 dp-section-title">¡Bienvenido a Distrito Power!</h1>
            <p class="lead text-secondary">
                Tu gimnasio de confianza para alcanzar tus metas de salud y bienestar.<br>
                Instalaciones modernas, entrenadores certificados y un ambiente motivador.
            </p>
        </div>
    </div>

    <!-- Sobre Nosotros -->
    <div class="row mb-5 align-items-center" id="nosotros">
        <div class="col-12 col-md-6 mb-4 mb-md-0">
            <div class="p-4 dp-card shadow-sm h-100">
                <h2 class="dp-section-title mb-3">Sobre Nosotros</h2>
                <p>
                    En <b>Distrito Power</b> creemos que el fitness es para todos. Desde 2010, hemos ayudado a cientos de personas a transformar su vida a través del ejercicio y la alimentación saludable. Nuestro compromiso es brindarte un espacio seguro, limpio y motivador, donde puedas superarte cada día.
                </p>
                <ul class="mb-0">
                    <li>Más de 10 años de experiencia en el sector fitness.</li>
                    <li>Programas personalizados para todas las edades y niveles.</li>
                    <li>Eventos, retos y actividades para mantenerte motivado.</li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 text-center">
            <img src="/img/equipos-en-el-gimnasio.jpg" alt="Instalaciones Distrito Power" class="img-fluid rounded-4 shadow" style="max-height:320px; border:4px solid #17a2b8;">
        </div>
    </div>

    <!-- Equipo -->
    <div class="row mb-5" id="equipo">
        <div class="col-12">
            <h2 class="dp-section-title mb-4 text-center">Nuestro Equipo</h2>
        </div>
        <div class="col-12 col-md-4 text-center mb-4">
            <div class="dp-card p-4 h-100">
                <img src="/img/entrenador1.png" alt="Entrenador 1" class="dp-team-img">
                <h5 class="mb-1" style="color:#17a2b8;">Carlos Gómez</h5>
                <p class="text-muted mb-0">Entrenador Personal</p>
                <small>Especialista en fuerza y acondicionamiento físico.</small>
            </div>
        </div>
        <div class="col-12 col-md-4 text-center mb-4">
            <div class="dp-card p-4 h-100">
                <img src="/img/entrenador2.png" alt="Entrenadora 2" class="dp-team-img">
                <h5 class="mb-1" style="color:#17a2b8;">María López</h5>
                <p class="text-muted mb-0">Nutricionista</p>
                <small>Asesoría nutricional y planes alimenticios personalizados.</small>
            </div>
        </div>
        <div class="col-12 col-md-4 text-center mb-4">
            <div class="dp-card p-4 h-100">
                <img src="/img/entrenador3.png" alt="Entrenador 3" class="dp-team-img">
                <h5 class="mb-1" style="color:#17a2b8;">Juan Pérez</h5>
                <p class="text-muted mb-0">Instructor de Clases Grupales</p>
                <small>Clases de spinning, HIIT y funcional.</small>
            </div>
        </div>
    </div>

    <!-- Servicios -->
    <div class="row mb-5" id="servicios">
        <div class="col-12">
            <h2 class="dp-section-title mb-4 text-center">Nuestros Servicios</h2>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="dp-card shadow-sm p-4 h-100">
                <h5 class="mb-2" style="color:#17a2b8;">Entrenamiento Personalizado</h5>
                <p class="mb-0">Planes de entrenamiento adaptados a tus objetivos, con seguimiento profesional.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="dp-card shadow-sm p-4 h-100">
                <h5 class="mb-2" style="color:#17a2b8;">Clases Grupales</h5>
                <p class="mb-0">Spinning, HIIT, yoga, pilates, funcional y más. ¡Diviértete entrenando en grupo!</p>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="dp-card shadow-sm p-4 h-100">
                <h5 class="mb-2" style="color:#17a2b8;">Asesoría Nutricional</h5>
                <p class="mb-0">Consulta con nuestra nutricionista para lograr tus metas de salud y rendimiento.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="dp-card shadow-sm p-4 h-100">
                <h5 class="mb-2" style="color:#17a2b8;">Zona de Pesas y Cardio</h5>
                <p class="mb-0">Equipos modernos, área de pesas libres, máquinas y zona de cardio.</p>
            </div>
        </div>
    </div>

    <!-- Horarios, Ubicación y Contacto -->
    <div class="row mb-5" id="contacto">
        <div class="col-12 col-md-4 mb-4">
            <div class="dp-card-info card h-100 shadow-sm border-0 p-4">
                <h5 class="card-title mb-3">Horarios</h5>
                <p class="card-text mb-0">
                    Lunes a Viernes: 6:00 am - 10:00 pm<br>
                    Sábados: 8:00 am - 6:00 pm<br>
                    Domingos: Cerrado
                </p>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-4">
            <div class="dp-card-info card h-100 shadow-sm border-0 p-4">
                <h5 class="card-title mb-3">Ubicación</h5>
                <p class="card-text mb-2">
                    Calle Principal #123<br>
                    Ciudad, País
                </p>
                <a href="https://maps.google.com" target="_blank" class="dp-link btn btn-link btn-sm px-0">Ver en Google Maps</a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-4">
            <div class="dp-card-info card h-100 shadow-sm border-0 p-4">
                <h5 class="card-title mb-3">Contáctanos</h5>
                <p class="card-text mb-2">
                    Tel: (123) 456-7890<br>
                    Email: info@distritopower.com
                </p>
                <form>
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="Tu nombre" required>
                    </div>
                    <div class="mb-2">
                        <input type="email" class="form-control" placeholder="Tu email" required>
                    </div>
                    <div class="mb-2">
                        <textarea class="form-control" rows="2" placeholder="Tu mensaje" required></textarea>
                    </div>
                    <button type="submit" class="dp-btn btn btn-sm w-100">Enviar</button>
                </form>
            </div>
        </div>
    </div>

   
</div>
    
    

    <?php view('partials/footer.php') ?>

    <!-- Bootstrapt -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>