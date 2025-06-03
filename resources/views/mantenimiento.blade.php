<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Siscamino-Mantenimiento</title>
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
        content: "🔧";
        font-size: 1.8rem;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        margin: 0;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #666;
        text-decoration: none;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 2px 8px;
    }

    .sidebar-menu a:hover {
        background-color: #f0f9ff;
        color: #2563eb;
        transform: translateX(5px);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
    }

    .sidebar-menu-icon {
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
        margin-right: 12px;
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

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .dashboard-card {
        background: rgba(11, 23, 57, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        color: #ffffff;
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        border-color: rgba(59, 130, 246, 0.3);
    }

    .dashboard-card h3 {
        margin-bottom: 1rem;
        color: #3b82f6;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dashboard-card p {
        color: #94a3b8;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    /* Maintenance specific styles */
    .maintenance-section {
        background: rgba(11, 23, 57, 0.4);
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .section-title {
        color: #ffffff;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .maintenance-table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        overflow: hidden;
    }

    .maintenance-table th,
    .maintenance-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .maintenance-table th {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        font-weight: 600;
    }

    .maintenance-table td {
        color: #ffffff;
    }

    .maintenance-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-due {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .status-upcoming {
        background: rgba(251, 191, 36, 0.2);
        color: #fbbf24;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }

    .status-current {
        background: rgba(34, 197, 94, 0.2);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-warning {
        background: rgba(251, 191, 36, 0.1);
        border: 1px solid rgba(251, 191, 36, 0.3);
        color: #fbbf24;
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #f87171;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: #3b82f6;
        margin-bottom: 0.5rem;
    }

    .metric-label {
        color: #94a3b8;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
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

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .maintenance-table {
            font-size: 0.875rem;
        }

        .maintenance-table th,
        .maintenance-table td {
            padding: 8px 12px;
        }
    }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">Mantenimiento</a>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="/dashboard">
                    <span class="sidebar-menu-icon">📊</span>
                    Panel Administrativo
                </a>
            </li>
            <li>
                <a href="/camiones">
                    <span class="sidebar-menu-icon">🚛</span>
                    Camiones
                </a>
            </li>
            <li>
                <a href="/viajes">
                    <span class="sidebar-menu-icon">🛣️</span>
                    Viajes
                </a>
            </li>
            <li>
                <a href="/mantenimiento" class="active">
                    <span class="sidebar-menu-icon">🔧</span>
                    Mantenimiento
                </a>
            </li>
            <li>
                <a href="/conductores">
                    <span class="sidebar-menu-icon">👨‍✈️</span>
                    Conductores
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">JD</div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">Juan Doe</div>
                    <div style="font-size: 0.75rem;">Administrador</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-content">
                <button class="sidebar-toggle" id="sidebarToggle">☰</button>
                <h1 class="navbar-title">Sistema de Mantenimiento</h1>
                <div class="navbar-links">
                    <a href="#preventivo">Preventivo</a>
                    <a href="#reparaciones">Reparaciones</a>
                    <a href="#documentos">Documentos</a>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="content">
            <div class="content-wrapper">
                <!-- Alertas -->
                <div class="alert alert-danger">
                    <span>⚠️</span>
                    <div>
                        <strong>3 unidades</strong> requieren mantenimiento inmediato
                    </div>
                </div>

                <div class="alert alert-warning">
                    <span>🔔</span>
                    <div>
                        <strong>5 pólizas de seguro</strong> vencen en los próximos 30 días
                    </div>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <h3> Mantenimientos Pendientes</h3>
                        <div class="metric-value">12</div>
                        <div class="metric-label">Unidades requieren servicio</div>
                        <p>8 preventivos programados, 4 correctivos urgentes</p>
                        <a href="#" class="btn btn-primary">Ver Detalles</a>
                    </div>

                    <div class="dashboard-card">
                        <h3> Costo Mensual</h3>
                        <div class="metric-value">$45,320</div>
                        <div class="metric-label">Gastos en mantenimiento</div>
                        <p>Refacciones: $28,500 | Mano de obra: $16,820</p>
                        <a href="#" class="btn btn-secondary">Ver Reporte</a>
                    </div>

                    <div class="dashboard-card">
                        <h3> Documentos por Vencer</h3>
                        <div class="metric-value">8</div>
                        <div class="metric-label">Próximos 60 días</div>
                        <p>5 pólizas de seguro, 3 permisos de circulación</p>
                        <a href="#" class="btn btn-primary">Renovar</a>
                    </div>

                    <div class="dashboard-card">
                        <h3> Disponibilidad</h3>
                        <div class="metric-value">85%</div>
                        <div class="metric-label">Flotilla operativa</div>
                        <p>34 de 40 unidades en servicio activo</p>
                        <a href="#" class="btn btn-secondary">Ver Estado</a>
                    </div>
                </div>

                <!-- Programación de Mantenimientos Preventivos -->
                <div class="maintenance-section" id="preventivo">
                    <h2 class="section-title">
                        <span>🗓️</span>
                        Programación de Mantenimientos Preventivos
                    </h2>
                    
                    <table class="maintenance-table">
                        <thead>
                            <tr>
                                <th>Unidad</th>
                                <th>Tipo de Servicio</th>
                                <th>Kilometraje Actual</th>
                                <th>Próximo Servicio</th>
                                <th>Estado</th>
                                <th>Días Restantes</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>CAM-001</strong></td>
                                <td>Servicio Mayor</td>
                                <td>148,500 km</td>
                                <td>150,000 km</td>
                                <td><span class="status-badge status-upcoming">Próximo</span></td>
                                <td>15 días</td>
                                <td>
                                    <a href="#" class="btn btn-primary" style="font-size: 0.75rem; padding: 4px 8px;">Programar</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>CAM-015</strong></td>
                                <td>Cambio de Aceite</td>
                                <td>89,800 km</td>
                                <td>90,000 km</td>
                                <td><span class="status-badge status-due">Vencido</span></td>
                                <td>-3 días</td>
                                <td>
                                    <a href="#" class="btn btn-primary" style="font-size: 0.75rem; padding: 4px 8px;">Urgente</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>CAM-023</strong></td>
                                <td>Revisión de Frenos</td>
                                <td>67,200 km</td>
                                <td>75,000 km</td>
                                <td><span class="status-badge status-current">Al día</span></td>
                                <td>45 días</td>
                                <td>
                                    <a href="#" class="btn btn-secondary" style="font-size: 0.75rem; padding: 4px 8px;">Ver</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Registro de Reparaciones -->
                <div class="maintenance-section" id="reparaciones">
                    <h2 class="section-title">
                        <span>🔨</span>
                        Registro de Reparaciones
                    </h2>
                    
                    <table class="maintenance-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Unidad</th>
                                <th>Tipo de Reparación</th>
                                <th>Proveedor</th>
                                <th>Refacciones</th>
                                <th>Mano de Obra</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>28/05/2025</td>
                                <td><strong>CAM-008</strong></td>
                                <td>Reparación de Motor</td>
                                <td>Talleres Hernández</td>
                                <td>$12,500</td>
                                <td>$3,200</td>
                                <td><strong>$15,700</strong></td>
                                <td><span class="status-badge status-current">Completado</span></td>
                            </tr>
                            <tr>
                                <td>25/05/2025</td>
                                <td><strong>CAM-012</strong></td>
                                <td>Cambio de Transmisión</td>
                                <td>Servicios Industriales</td>
                                <td>$18,900</td>
                                <td>$4,500</td>
                                <td><strong>$23,400</strong></td>
                                <td><span class="status-badge status-upcoming">En proceso</span></td>
                            </tr>
                            <tr>
                                <td>22/05/2025</td>
                                <td><strong>CAM-003</strong></td>
                                <td>Balatas y Discos</td>
                                <td>Refacciones García</td>
                                <td>$2,800</td>
                                <td>$1,200</td>
                                <td><strong>$4,000</strong></td>
                                <td><span class="status-badge status-current">Completado</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Control de Documentos -->
                <div class="maintenance-section" id="documentos">
                    <h2 class="section-title">
                        <span>📄</span>
                        Control de Documentos
                    </h2>
                    
                    <table class="maintenance-table">
                        <thead>
                            <tr>
                                <th>Unidad</th>
                                <th>Tipo de Documento</th>
                                <th>Número de Póliza/Permiso</th>
                                <th>Fecha de Vencimiento</th>
                                <th>Estado</th>
                                <th>Días para Vencer</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>CAM-001</strong></td>
                                <td>Póliza de Seguro</td>
                                <td>POL-2024-1158</td>
                                <td>15/06/2025</td>
                                <td><span class="status-badge status-upcoming">Por vencer</span></td>
                                <td>15 días</td>
                                <td>
                                    <a href="#" class="btn btn-primary" style="font-size: 0.75rem; padding: 4px 8px;">Renovar</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>CAM-007</strong></td>
                                <td>Permiso SCT</td>
                                <td>SCT-2024-4477</td>
                                <td>02/06/2025</td>
                                <td><span class="status-badge status-due">Vencido</span></td>
                                <td>-2 días</td>
                                <td>
                                    <a href="#" class="btn btn-primary" style="font-size: 0.75rem; padding: 4px 8px;">Urgente</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>CAM-019</strong></td>
                                <td>Verificación Vehicular</td>
                                <td>VER-2025-3344</td>
                                <td>30/08/2025</td>
                                <td><span class="status-badge status-current">Vigente</span></td>
                                <td>91 días</td>
                                <td>
                                    <a href="#" class="btn btn-secondary" style="font-size: 0.75rem; padding: 4px 8px;">Ver</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', toggleSidebar);
        }
        
        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }

        // Solo cerrar sidebar en móvil al hacer click en un enlace
        const menuLinks = document.querySelectorAll('.sidebar-menu a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    setTimeout(() => {
                        toggleSidebar();
                    }, 200);
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

        // Smooth scroll para navegación interna
        document.querySelectorAll('.navbar-links a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>