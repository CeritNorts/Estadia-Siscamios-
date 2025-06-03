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
            padding: 1.5rem;
            overflow-y: auto;
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

        /* View Toggle */
        .view-toggle {
            display: flex;
            background: white;
            border-radius: 10px;
            padding: 0.5rem;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .view-btn {
            flex: 1;
            padding: 0.75rem 1rem;
            background: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            color: #666;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .view-btn.active {
            background: #667eea;
            color: white;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
        }

        .view-btn:hover:not(.active) {
            background: #f8f9fa;
        }

        /* Quick Filters */
        .quick-filters {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .filter-label {
            font-weight: 500;
            color: #333;
            font-size: 0.9rem;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            background: white;
            border-radius: 20px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .filter-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .filter-btn:hover:not(.active) {
            background: #f0f0f0;
        }

        .filter-input {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 0.9rem;
            min-width: 150px;
        }

        .filter-input:focus {
            outline: none;
            border-color: #667eea;
        }

        /* Cards View */
        .cards-view {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .viaje-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .viaje-card:hover {
            transform: translateY(-2px);
        }

        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-weight: 600;
            color: #333;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .ruta-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .ciudad {
            font-weight: 500;
            color: #333;
        }

        .arrow {
            color: #667eea;
            font-weight: bold;
        }

        .viaje-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .detail-label {
            font-size: 0.8rem;
            color: #666;
            text-transform: uppercase;
            font-weight: 500;
        }

        .detail-value {
            font-weight: 500;
            color: #333;
        }

        .progress-section {
            margin-top: 1rem;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
            margin: 0.5rem 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .card-footer {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .combustible-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .fuel-icon {
            color: #ffc107;
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

        /* Table View */
        .table-view {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
        }

        .table-actions {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5a6fd8;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            color: #667eea;
            border: 1px solid #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
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

        /* Timeline View */
        .timeline-view {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 1rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, #667eea, #764ba2);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-left: 1rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.75rem;
            top: 1.5rem;
            width: 12px;
            height: 12px;
            background: #667eea;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #667eea;
        }

        .timeline-time {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .timeline-content {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            align-items: center;
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .fab:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.6);
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

            .cards-view {
                grid-template-columns: 1fr;
            }

            .viaje-details {
                grid-template-columns: 1fr;
            }

            .quick-filters {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                justify-content: center;
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
                    <div style="color: #ffffff; font-weight: 500;">Admin User</div>
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

            <!-- View Toggle -->
            <div class="view-toggle">
                <button class="view-btn active" data-view="cards">
                    🃏 Vista de Tarjetas
                </button>
                <button class="view-btn" data-view="table">
                    📊 Vista de Tabla
                </button>
                <button class="view-btn" data-view="timeline">
                    📅 Línea de Tiempo
                </button>
            </div>

            <!-- Quick Filters -->
            <div class="quick-filters">
                <div class="filter-group">
                    <span class="filter-label">Estado:</span>
                    <button class="filter-btn active" data-filter="todos">Todos</button>
                    <button class="filter-btn" data-filter="programado">Programados</button>
                    <button class="filter-btn" data-filter="transito">En Tránsito</button>
                    <button class="filter-btn" data-filter="entregado">Entregados</button>
                    <button class="filter-btn" data-filter="retrasado">Retrasados</button>
                </div>
                
                <div class="filter-group">
                    <span class="filter-label">Buscar:</span>
                    <input type="text" class="filter-input" placeholder="Cliente, destino, camión..." id="searchInput">
                </div>
                
                <div class="filter-group">
                    <span class="filter-label">Fecha:</span>
                    <input type="date" class="filter-input" id="fechaFiltro">
                </div>
            </div>

            <!-- Cards View -->
            <div class="cards-view" id="cardsView">
                <!-- Las tarjetas se generarán dinámicamente -->
            </div>

            <!-- Table View -->
            <div class="table-view" id="tableView" style="display: none;">
                <div class="table-header">
                    <h3 class="table-title">Lista de Viajes</h3>
                    <div class="table-actions">
                        <button class="btn btn-outline" onclick="exportarViajes()">📊 Exportar</button>
                        <button class="btn btn-primary" onclick="nuevoViaje()">➕ Nuevo Viaje</button>
                    </div>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Viaje</th>
                            <th>Ruta</th>
                            <th>Camión</th>
                            <th>Conductor</th>
                            <th>Cliente</th>
                            <th>Fecha Salida</th>
                            <th>Estado</th>
                            <th>Combustible</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Los datos se cargarán dinámicamente -->
                    </tbody>
                </table>
            </div>

            <!-- Timeline View -->
            <div class="timeline-view" id="timelineView" style="display: none;">
                <h3 style="margin-bottom: 2rem; color: #333;">Cronología de Viajes</h3>
                <div class="timeline" id="timelineContainer">
                    <!-- Los elementos del timeline se generarán dinámicamente -->
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <button class="fab" onclick="nuevoViaje()" title="Nuevo Viaje">
        ➕
    </button>

    <script>
        // Datos simulados de viajes
        const viajesData = [
            {
                id: 'VJ-001',
                origen: 'Córdoba, Ver.',
                destino: 'México, DF',
                camion: 'CAM-001',
                conductor: 'Juan Pérez',
                cliente: 'Transportes ABC',
                fechaSalida: '2024-06-03',
                horaSalida: '06:00',
                fechaLlegada: '2024-06-03',
                horaLlegada: '14:30',
                estado: 'transito',
                progreso: 65,
                combustibleInicial: 100,
                combustibleActual: 45,
                distancia: 420,
                carga: 'Electrodomésticos',
                peso: 18.5
            },
            {
                id: 'VJ-002',
                origen: 'Veracruz, Ver.',
                destino: 'Puebla, Pue.',
                camion: 'CAM-002',
                conductor: 'María González',
                cliente: 'Logística XYZ',
                fechaSalida: '2024-06-03',
                horaSalida: '08:00',
                fechaLlegada: '2024-06-03',
                horaLlegada: '12:15',
                estado: 'entregado',
                progreso: 100,
                combustibleInicial: 90,
                combustibleActual: 65,
                distancia: 280,
                carga: 'Materiales de construcción',
                peso: 25.0
            },
            {
                id: 'VJ-003',
                origen: 'México, DF',
                destino: 'Guadalajara, Jal.',
                camion: 'CAM-003',
                conductor: 'Carlos López',
                cliente: 'Carga Segura SA',
                fechaSalida: '2024-06-04',
                horaSalida: '05:30',
                fechaLlegada: '2024-06-04',
                horaLlegada: '16:00',
                estado: 'programado',
                progreso: 0,
                combustibleInicial: 100,
                combustibleActual: 100,
                distancia: 540,
                carga: 'Productos químicos',
                peso: 22.8
            },
            {
                id: 'VJ-004',
                origen: 'Toluca, Edo. Méx.',
                destino: 'Mérida, Yuc.',
                camion: 'CAM-004',
                conductor: 'Ana Martínez',
                cliente: 'Express Maya',
                fechaSalida: '2024-06-02',
                horaSalida: '04:00',
                fechaLlegada: '2024-06-03',
                horaLlegada: '18:00',
                estado: 'retrasado',
                progreso: 80,
                combustibleInicial: 95,
                combustibleActual: 25,
                distancia: 950,
                carga: 'Alimentos perecederos',
                peso: 20.5
            }
        ];

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            initializeApp();
        });

        function initializeApp() {
            setupEventListeners();
            cargarViajes();
            actualizarEstadisticas();
        }

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

            // View toggle
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const view = this.getAttribute('data-view');
                    cambiarVista(view);
                });
            });

            // Filters
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const filter = this.getAttribute('data-filter');
                    filtrarViajes(filter);
                });
            });

            // Search
            document.getElementById('searchInput').addEventListener('input', function() {
                buscarViajes(this.value);
            });

            // Date filter
            document.getElementById('fechaFiltro').addEventListener('change', function() {
                filtrarPorFecha(this.value);
            });
        }

        function cambiarVista(vista) {
            // Actualizar botones
            document.querySelectorAll('.view-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`[data-view="${vista}"]`).classList.add('active');

            // Ocultar todas las vistas
            document.getElementById('cardsView').style.display = 'none';
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('timelineView').style.display = 'none';

            // Mostrar vista seleccionada
            switch(vista) {
                case 'cards':
                    document.getElementById('cardsView').style.display = 'grid';
                    break;
                case 'table':
                    document.getElementById('tableView').style.display = 'block';
                    cargarTablaViajes();
                    break;
                case 'timeline':
                    document.getElementById('timelineView').style.display = 'block';
                    cargarTimeline();
                    break;
            }
        }

        function cargarViajes() {
            const container = document.getElementById('cardsView');
            container.innerHTML = '';

            viajesData.forEach(viaje => {
                const card = crearTarjetaViaje(viaje);
                container.appendChild(card);
            });
        }

        function crearTarjetaViaje(viaje) {
            const card = document.createElement('div');
            card.className = 'viaje-card';
            card.innerHTML = `
                <div class="card-header">
                    <div class="card-title">${viaje.id}</div>
                    <span class="status-badge status-${viaje.estado}">
                        ${getStatusIcon(viaje.estado)} ${getStatusLabel(viaje.estado)}
                    </span>
                </div>
                <div class="card-body">
                    <div class="ruta-info">
                        <span class="ciudad">${viaje.origen}</span>
                        <span class="arrow">→</span>
                        <span class="ciudad">${viaje.destino}</span>
                    </div>
                    
                    <div class="viaje-details">
                        <div class="detail-item">
                            <span class="detail-label">Camión</span>
                            <span class="detail-value">${viaje.camion}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Conductor</span>
                            <span class="detail-value">${viaje.conductor}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Cliente</span>
                            <span class="detail-value">${viaje.cliente}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Carga</span>
                            <span class="detail-value">${viaje.carga}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Salida</span>
                            <span class="detail-value">${formatearFecha(viaje.fechaSalida)} ${viaje.horaSalida}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Llegada Est.</span>
                            <span class="detail-value">${formatearFecha(viaje.fechaLlegada)} ${viaje.horaLlegada}</span>
                        </div>
                    </div>
                    
                    ${viaje.estado !== 'programado' ? `
                    <div class="progress-section">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <span style="font-size: 0.9rem; color: #666;">Progreso del viaje</span>
                            <span style="font-size: 0.9rem; font-weight: 600; color: #333;">${viaje.progreso}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: ${viaje.progreso}%"></div>
                        </div>
                    </div>
                    ` : ''}
                </div>
                <div class="card-footer">
                    <div class="combustible-info">
                        <span class="fuel-icon">⛽</span>
                        <span>${viaje.combustibleActual}% / ${viaje.combustibleInicial}%</span>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <button class="btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;" onclick="verDetalles('${viaje.id}')">
                            👁️ Ver
                        </button>
                        <button class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;" onclick="editarViaje('${viaje.id}')">
                            ✏️ Editar
                        </button>
                    </div>
                </div>
            `;
            return card;
        }

        function cargarTablaViajes() {
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            viajesData.forEach(viaje => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><strong>${viaje.id}</strong></td>
                    <td>${viaje.origen} → ${viaje.destino}</td>
                    <td>${viaje.camion}</td>
                    <td>${viaje.conductor}</td>
                    <td>${viaje.cliente}</td>
                    <td>${formatearFecha(viaje.fechaSalida)} ${viaje.horaSalida}</td>
                    <td><span class="status-badge status-${viaje.estado}">${getStatusLabel(viaje.estado)}</span></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 0.8rem;">⛽</span>
                            <span>${viaje.combustibleActual}%</span>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <button class="btn-outline" style="padding: 0.25rem 0.5rem; font-size: 0.7rem;" onclick="verDetalles('${viaje.id}')">Ver</button>
                            <button class="btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.7rem;" onclick="editarViaje('${viaje.id}')">Editar</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function cargarTimeline() {
            const container = document.getElementById('timelineContainer');
            container.innerHTML = '';

            // Ordenar viajes por fecha
            const viajesOrdenados = [...viajesData].sort((a, b) => new Date(a.fechaSalida) - new Date(b.fechaSalida));

            viajesOrdenados.forEach(viaje => {
                const item = document.createElement('div');
                item.className = 'timeline-item';
                item.innerHTML = `
                    <div class="timeline-time">${formatearFecha(viaje.fechaSalida)} - ${viaje.horaSalida}</div>
                    <div class="timeline-content">
                        <div>
                            <div style="font-weight: 600; margin-bottom: 0.5rem;">${viaje.id} - ${viaje.origen} → ${viaje.destino}</div>
                            <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                                ${viaje.camion} | ${viaje.conductor} | ${viaje.cliente}
                            </div>
                            <div style="font-size: 0.8rem; color: #666;">
                                Carga: ${viaje.carga} (${viaje.peso} ton) | Distancia: ${viaje.distancia} km
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: end; gap: 0.5rem;">
                            <span class="status-badge status-${viaje.estado}">${getStatusLabel(viaje.estado)}</span>
                            <div style="font-size: 0.8rem; color: #666;">⛽ ${viaje.combustibleActual}%</div>
                        </div>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function getStatusIcon(estado) {
            const icons = {
                'programado': '📅',
                'transito': '🚛',
                'entregado': '✅',
                'retrasado': '⚠️',
                'espera': '⏱️'
            };
            return icons[estado] || '📋';
        }

        function getStatusLabel(estado) {
            const labels = {
                'programado': 'Programado',
                'transito': 'En Tránsito',
                'entregado': 'Entregado',
                'retrasado': 'Retrasado',
                'espera': 'En Espera'
            };
            return labels[estado] || estado;
        }

        function formatearFecha(fecha) {
            const opciones = { month: 'short', day: 'numeric' };
            return new Date(fecha).toLocaleDateString('es-ES', opciones);
        }

        function actualizarEstadisticas() {
            const stats = {
                programados: 0,
                transito: 0,
                entregados: 0,
                retrasados: 0,
                combustiblePromedio: 0
            };

            viajesData.forEach(viaje => {
                stats[viaje.estado]++;
                stats.combustiblePromedio += viaje.combustibleActual;
            });

            stats.combustiblePromedio = Math.round(stats.combustiblePromedio / viajesData.length);

            document.getElementById('programados').textContent = stats.programados;
            document.getElementById('transito').textContent = stats.transito;
            document.getElementById('entregados').textContent = stats.entregados;
            document.getElementById('retrasados').textContent = stats.retrasados;
            document.getElementById('combustible').textContent = stats.combustiblePromedio + '%';
        }

        function filtrarViajes(filtro) {
            const cards = document.querySelectorAll('.viaje-card');
            
            cards.forEach(card => {
                const statusBadge = card.querySelector('.status-badge');
                const estado = statusBadge.className.split('status-')[1].split(' ')[0];
                
                if (filtro === 'todos' || estado === filtro) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function buscarViajes(termino) {
            const cards = document.querySelectorAll('.viaje-card');
            
            cards.forEach(card => {
                const texto = card.textContent.toLowerCase();
                if (texto.includes(termino.toLowerCase())) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function filtrarPorFecha(fecha) {
            if (!fecha) {
                cargarViajes();
                return;
            }

            const viajesFiltrados = viajesData.filter(viaje => 
                viaje.fechaSalida === fecha || viaje.fechaLlegada === fecha
            );

            const container = document.getElementById('cardsView');
            container.innerHTML = '';

            viajesFiltrados.forEach(viaje => {
                const card = crearTarjetaViaje(viaje);
                container.appendChild(card);
            });
        }

        function verDetalles(viajeId) {
            const viaje = viajesData.find(v => v.id === viajeId);
            if (viaje) {
                alert(`Detalles del viaje ${viajeId}:\n\nRuta: ${viaje.origen} → ${viaje.destino}\nCamión: ${viaje.camion}\nConductor: ${viaje.conductor}\nCliente: ${viaje.cliente}\nEstado: ${getStatusLabel(viaje.estado)}\nProgreso: ${viaje.progreso}%\nCombustible: ${viaje.combustibleActual}%`);
            }
        }

        function editarViaje(viajeId) {
            alert(`Función de edición para el viaje ${viajeId} - Por implementar`);
        }

        function nuevoViaje() {
            alert('Función para crear nuevo viaje - Por implementar');
        }

        function exportarViajes() {
            const csv = convertirViajesACSV(viajesData);
            descargarCSV(csv, 'viajes_data.csv');
            alert('Datos de viajes exportados exitosamente');
        }

        function convertirViajesACSV(data) {
            const headers = ['ID', 'Origen', 'Destino', 'Camión', 'Conductor', 'Cliente', 'Fecha Salida', 'Estado', 'Progreso', 'Combustible'];
            const rows = data.map(viaje => [
                viaje.id,
                viaje.origen,
                viaje.destino,
                viaje.camion,
                viaje.conductor,
                viaje.cliente,
                viaje.fechaSalida,
                viaje.estado,
                viaje.progreso + '%',
                viaje.combustibleActual + '%'
            ]);
            
            return [headers, ...rows].map(row => row.join(',')).join('\n');
        }

        function descargarCSV(csv, filename) {
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.setAttribute('hidden', '');
            a.setAttribute('href', url);
            a.setAttribute('download', filename);
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                alert('Cerrando sesión...');
            }
        }