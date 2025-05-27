<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Siscamino-Flotilla</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #081028;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Sidebar Styles */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 260px;
        height: 100vh;
        background: linear-gradient(180deg, #0B1739 0%, #081028 100%);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 1000;
        transition: transform 0.3s ease;
    }

    .sidebar-header {
        padding: 2rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-brand {
        color: #ffffff;
        font-size: 1.5rem;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sidebar-brand::before {
        content: "";
        font-size: 1.8rem;
    }

    .sidebar-menu {
        list-style: none;
        padding: 1rem 0;
    }

    .sidebar-menu li {
        margin: 0.25rem 0;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 0.875rem 1.5rem;
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
        gap: 0.75rem;
    }

    .sidebar-menu a:hover {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.05);
        border-left-color: #3b82f6;
    }

    .sidebar-menu a.active {
        color: #ffffff;
        background-color: rgba(59, 130, 246, 0.1);
        border-left-color: #3b82f6;
    }

    .sidebar-menu-icon {
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
    }

    .sidebar-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #94a3b8;
        font-size: 0.875rem;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(45deg, #3b82f6, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    
    .main-content {
        margin-left: 260px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .navbar {
        background-color: rgba(11, 23, 57, 0.8);
        backdrop-filter: blur(10px);
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .navbar-content {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
    }

    .navbar-title {
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: 500;
    }

    .navbar-links {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .navbar-links a {
        color: #94a3b8;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }

    .navbar-links a:hover {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .content {
        flex: 1;
        padding: 2rem;
    }

    .content-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    
    .sidebar-toggle {
        display: none;
        background: none;
        border: none;
        color: #ffffff;
        font-size: 1.25rem;
        cursor: pointer;
        padding: 0.5rem;
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar-toggle {
            display: block;
        }

        .overlay.active {
            display: block;
        }

        .navbar-content {
            padding: 0 1rem;
        }

        .content {
            padding: 1rem;
        }
    }

    
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .dashboard-card {
        background: rgba(11, 23, 57, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        color: #ffffff;
    }

    .dashboard-card h3 {
        margin-bottom: 0.5rem;
        color: #3b82f6;
    }

    .dashboard-card p {
        color: #94a3b8;
        font-size: 0.875rem;
    }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">Logo</a>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="#" class="active">
                    <span class="sidebar-menu-icon"></span>
                    Panel Administrativo
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="sidebar-menu-icon"></span>
                    Camiones
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="sidebar-menu-icon"></span>
                    Viajes
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="sidebar-menu-icon"></span>
                    Mantenimiento
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="sidebar-menu-icon"></span>
                    Conductores
                </a>
            </li>
            
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">JD</div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.75rem;">Administrador</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Content -->
    <div class="main-content">
        <nav class="navbar">
            <div class="navbar-content">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <button class="sidebar-toggle" id="sidebarToggle">☰</button>
                    <h1 class="navbar-title">Siscamino-Flotilla</h1>
                </div>
                <div class="navbar-links">
                    <a href="/profile">Perfil</a>
                    <a href="#">Notificaciones</a>
                    <a href="{{ route('login') }}">Cerrar Sesión</a>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="content-wrapper">
                
                
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <h3>Unidades Disponibles</h3>
                        <p>--------</p>
                    </div>
                    <div class="dashboard-card">
                        <h3>Unidades en Ruta</h3>
                        <p>--------</p>
                    </div>
                    <div class="dashboard-card">
                        <h3>Unidades en Trancito</h3>
                        <p>--------------</p>
                    </div>
                    <div class="dashboard-card">
                        <h3>Unidades en Mantenimiento</h3>
                        <p>----------------------</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar en móviles
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Activar enlaces del menú
        const menuLinks = document.querySelectorAll('.sidebar-menu a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remover clase active de todos los enlaces
                menuLinks.forEach(l => l.classList.remove('active'));
                
                // Agregar clase active al enlace clickeado
                this.classList.add('active');
                
                // Cerrar sidebar en móvil después de hacer click
                if (window.innerWidth <= 768) {
                    toggleSidebar();
                }
            });
        });

        // Cerrar sidebar al redimensionar pantalla
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>
</body>
</html>