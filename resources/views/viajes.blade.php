<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Gestión de Viajes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            display: flex;
            height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .sidebar-menu {
            flex: 1;
            padding: 1rem 0;
            list-style: none;
        }

        .sidebar-menu li {
            margin: 0.5rem 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 1rem;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid #fff;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .navbar-title {
            color: #333;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: #f0f0f0;
        }

        .navbar-links {
            display: flex;
            gap: 1.5rem;
        }

        .navbar-links a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover {
            color: #667eea;
        }

        /* Content Area */
        .content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #666;
            font-size: 1rem;
        }

        /* Dashboard Stats */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-sublabel {
            color: #999;
            font-size: 0.8rem;
        }

        .stat-programados { color: #007bff; }
        .stat-transito { color: #ffc107; }
        .stat-entregados { color: #28a745; }
        .stat-retrasados { color: #dc3545; }
        .stat-combustible { color: #6f42c1; }

        /* Tabs */
        .tabs-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .tabs-header {
            display: flex;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .tab-button {
            flex: 1;
            padding: 1rem 1.5rem;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            color: #666;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .tab-button.active {
            background: white;
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .tab-button:hover:not(.active) {
            background: #e9ecef;
        }

        .tab-content {
            display: none;
            padding: 2rem;
        }

        .tab-content.active {
            display: block;
        }

        /* Table Styles */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .table-title {
            font-size: 1.5rem;
            color: #333;
            font-weight: 600;
        }

        .table-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
            min-width: 200px;
        }

        .table-container {
            overflow-x: auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
        }

        .table tr:hover {
            background: #f8f9fa;
        }

        .table td {
            font-size: 0.9rem;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-programado { background: #e3f2fd; color: #1565c0; }
        .status-transito { background: #fff8e1; color: #f57c00; }
        .status-entregado { background: #e8f5e8; color: #2e7d32; }
        .status-retrasado { background: #ffebee; color: #c62828; }
        .status-espera { background: #f3e5f5; color: #7b1fa2; }

        /* Progress Bar */
        .progress-bar {
            width: 100px;
            height: 6px;
            background: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                transform: translateX(-100%);
                height: 100vh;
                z-index: 1001;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                display: none;
            }

            .overlay.active {
                display: block;
            }

            .main-content {
                width: 100%;
            }

            .navbar-content {
                padding: 1rem;
            }

            .content {
                padding: 1rem;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .tabs-header {
                flex-direction: column;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .table-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .table-actions {
                justify-content: center;
            }
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">Siscamino</a>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="/dashboard">📊 Panel Administrativo</a>
            </li>
            <li>
                <a href="/camiones">🚛 Camiones</a>
            </li>
            <li>
                <a href="/viajes" class="active">📋 Viajes</a>
            </li>
            <li>
                <a href="/mantenimiento">🔧 Mantenimiento</a>
            </li>
            <li>
                <a href="/conductores">👥 Conductores</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.75rem;">Sistema</div>
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
                    <h1 class="navbar-title">Gestión de Viajes</h1>
                </div>
                <div class="navbar-links">
                    <a href="/profile">Perfil</a>
                    <a href="#">Notificaciones</a>
                    <a href="#" onclick="logout()">Cerrar Sesión</a>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="content-wrapper fade-in">
                
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Gestión de Viajes</h1>
                        <p class="page-subtitle">Administra y supervisa todos los viajes de la flotilla</p>
                    </div>
                    <button class="btn btn-primary" onclick="window.location.href='/asignarViaje'">
                        ➕ Asignar Nuevo Viaje
                    </button>
                </div>
                
                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-number stat-programados" id="programados">12</div>
                        <div class="stat-label">Programados</div>
                        <div class="stat-sublabel">Próximos 7 días</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-transito" id="transito">8</div>
                        <div class="stat-label">En Tránsito</div>
                        <div class="stat-sublabel">Actualmente en ruta</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-entregados" id="entregados">156</div>
                        <div class="stat-label">Entregados</div>
                        <div class="stat-sublabel">Este mes</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-retrasados" id="retrasados">3</div>
                        <div class="stat-label">Retrasados</div>
                        <div class="stat-sublabel">Requieren atención</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-combustible" id="combustible">85%</div>
                        <div class="stat-label">Eficiencia</div>
                        <div class="stat-sublabel">Consumo combustible</div>
                    </div>
                </div>

                <!-- Tabs Container -->
                <div class="tabs-container">
                    <div class="tabs-header">
                        <button class="tab-button active" data-tab="viajes">📋 Lista de Viajes</button>
                        <button class="tab-button" data-tab="monitoreo">📡 Monitoreo en Tiempo Real</button>
                        <button class="tab-button" data-tab="combustible">⛽ Control de Combustible</button>
                    </div>

                    <!-- Tab: Lista de Viajes -->
                    <div class="tab-content active" id="viajes">
                        <div class="table-header">
                            <h3 class="table-title">Todos los Viajes</h3>
                            <div class="table-actions">
                                <input type="text" class="search-input" placeholder="Buscar viaje..." id="searchViajes">
                                <select class="search-input" style="max-width: 150px;" id="filterEstado">
                                    <option value="">Todos los estados</option>
                                    <option value="programado">Programados</option>
                                    <option value="transito">En Tránsito</option>
                                    <option value="entregado">Entregados</option>
                                    <option value="retrasado">Retrasados</option>
                                </select>
                                <button class="btn btn-secondary btn-sm">📊 Exportar</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID Viaje</th>
                                        <th>Camión</th>
                                        <th>Conductor</th>
                                        <th>Cliente</th>
                                        <th>Ruta</th>
                                        <th>Fecha Salida</th>
                                        <th>Fecha Llegada</th>
                                        <th>Estado</th>
                                        <th>Progreso</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="viajesTableBody">
                                    <tr>
                                        <td><strong>VJ-001</strong></td>
                                        <td>CAM-001</td>
                                        <td>Juan Pérez</td>
                                        <td>Transportes ABC</td>
                                        <td>Córdoba → México DF</td>
                                        <td>03/06/2024 06:00</td>
                                        <td>03/06/2024 14:30</td>
                                        <td><span class="status-badge status-transito">🚛 En Tránsito</span></td>
                                        <td>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 65%"></div>
                                            </div>
                                            <small>65%</small>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-warning btn-sm">✏️</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>VJ-002</strong></td>
                                        <td>CAM-002</td>
                                        <td>María González</td>
                                        <td>Logística XYZ</td>
                                        <td>Veracruz → Puebla</td>
                                        <td>03/06/2024 08:00</td>
                                        <td>03/06/2024 12:15</td>
                                        <td><span class="status-badge status-entregado">✅ Entregado</span></td>
                                        <td>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 100%"></div>
                                            </div>
                                            <small>100%</small>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-warning btn-sm">✏️</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>VJ-003</strong></td>
                                        <td>CAM-003</td>
                                        <td>Carlos López</td>
                                        <td>Carga Segura SA</td>
                                        <td>México DF → Guadalajara</td>
                                        <td>04/06/2024 05:30</td>
                                        <td>04/06/2024 16:00</td>
                                        <td><span class="status-badge status-programado">📅 Programado</span></td>
                                        <td>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 0%"></div>
                                            </div>
                                            <small>0%</small>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-warning btn-sm">✏️</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>VJ-004</strong></td>
                                        <td>CAM-004</td>
                                        <td>Ana Martínez</td>
                                        <td>Express Maya</td>
                                        <td>Toluca → Mérida</td>
                                        <td>02/06/2024 04:00</td>
                                        <td>03/06/2024 18:00</td>
                                        <td><span class="status-badge status-retrasado">⚠️ Retrasado</span></td>
                                        <td>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 80%"></div>
                                            </div>
                                            <small>80%</small>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-danger btn-sm">🚨</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab: Monitoreo en Tiempo Real -->
                    <div class="tab-content" id="monitoreo">
                        <div class="table-header">
                            <h3 class="table-title">Monitoreo en Tiempo Real</h3>
                            <div class="table-actions">
                                <button class="btn btn-secondary btn-sm">🔄 Actualizar</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Viaje</th>
                                        <th>Camión</th>
                                        <th>Ubicación Actual</th>
                                        <th>Velocidad</th>
                                        <th>Combustible</th>
                                        <th>Tiempo Restante</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>VJ-001</strong></td>
                                        <td>CAM-001</td>
                                        <td>Carretera México-Puebla Km 180</td>
                                        <td>85 km/h</td>
                                        <td>45%</td>
                                        <td>3h 15min</td>
                                        <td><span class="status-badge status-transito">🚛 En Tránsito</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>VJ-004</strong></td>
                                        <td>CAM-004</td>
                                        <td>Autopista Mérida Km 45</td>
                                        <td>0 km/h</td>
                                        <td>25%</td>
                                        <td>4h 30min</td>
                                        <td><span class="status-badge status-retrasado">⚠️ Detenido</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab: Control de Combustible -->
                    <div class="tab-content" id="combustible">
                        <div class="table-header">
                            <h3 class="table-title">Control de Combustible por Viaje</h3>
                            <div class="table-actions">
                                <button class="btn btn-primary btn-sm">⛽ Registrar Carga</button>
                                <button class="btn btn-secondary btn-sm">📊 Reporte</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Viaje</th>
                                        <th>Camión</th>
                                        <th>Combustible Inicial</th>
                                        <th>Combustible Actual</th>
                                        <th>Consumo</th>
                                        <th>Eficiencia</th>
                                        <th>Costo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>VJ-001</strong></td>
                                        <td>CAM-001</td>
                                        <td>100%</td>
                                        <td>45%</td>
                                        <td>55%</td>
                                        <td>12.5 km/l</td>
                                        <td>$1,250.00</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm">⛽ Cargar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>VJ-002</strong></td>
                                        <td>CAM-002</td>
                                        <td>90%</td>
                                        <td>65%</td>
                                        <td>25%</td>
                                        <td>15.2 km/l</td>
                                        <td>$890.00</td>
                                        <td>
                                            <button class="btn btn-success btn-sm">✅ Completo</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>VJ-004</strong></td>
                                        <td>CAM-004</td>
                                        <td>95%</td>
                                        <td>25%</td>
                                        <td>70%</td>
                                        <td>8.9 km/l</td>
                                        <td>$2,100.00</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">🚨 Crítico</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
        });

        function setupEventListeners() {
            // Sidebar toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Tab navigation
            document.querySelectorAll('.tab-button').forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    cambiarTab(tabId);
                });
            });

            // Search functionality
            if (document.getElementById('searchViajes')) {
                document.getElementById('searchViajes').addEventListener('input', function() {
                    filtrarViajes(this.value);
                });
            }

            // Filter by status
            if (document.getElementById('filterEstado')) {
                document.getElementById('filterEstado').addEventListener('change', function() {
                    filtrarPorEstado(this.value);
                });
            }
        }

        function cambiarTab(tabId) {
            // Remover active de todos los botones y contenidos
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            // Activar el tab seleccionado
            document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }

        function filtrarViajes(termino) {
            const rows = document.querySelectorAll('#viajesTableBody tr');
            
            rows.forEach(row => {
                const texto = row.textContent.toLowerCase();
                if (texto.includes(termino.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filtrarPorEstado(estado) {
            const rows = document.querySelectorAll('#viajesTableBody tr');
            
            rows.forEach(row => {
                const statusBadge = row.querySelector('.status-badge');
                if (statusBadge) {
                    const estadoViaje = statusBadge.className.split('status-')[1].split(' ')[0];
                    if (!estado || estadoViaje === estado) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                alert('Cerrando sesión...');
            }
        }
    </script>
</body>
</html>