<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Camión - Siscamino</title>
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
            cursor: pointer;
            padding: 0.75rem;
            border-radius: 8px;
            transition: background 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .user-info:hover {
            background: rgba(255, 255, 255, 0.1);
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
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: #666;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .truck-title {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .truck-icon {
            font-size: 3rem;
        }

        .truck-info h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .truck-info p {
            color: #666;
            font-size: 1.1rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-activo {
            background: #d4edda;
            color: #155724;
        }

        .status-mantenimiento {
            background: #f8d7da;
            color: #721c24;
        }

        .status-inactivo {
            background: #f8f9fa;
            color: #6c757d;
        }

        /* Main Content Grid */
        .details-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        /* Info Cards */
        .info-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .info-card h3 {
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            border-bottom: 2px solid #667eea;
            padding-bottom: 0.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 0.875rem;
            color: #666;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .info-value {
            font-size: 1.1rem;
            color: #333;
            font-weight: 600;
        }

        /* Metrics Cards */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .metric-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-2px);
        }

        .metric-card .metric-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .metric-card .metric-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.25rem;
        }

        .metric-card .metric-label {
            font-size: 0.875rem;
            color: #666;
        }

        /* History Section */
        .history-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 1rem;
            transition: background 0.3s ease;
        }

        .history-item:hover {
            background: #f8f9fa;
        }

        .history-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .history-icon.viaje {
            background: #e3f2fd;
            color: #1976d2;
        }

        .history-icon.mantenimiento {
            background: #fff3e0;
            color: #f57c00;
        }

        .history-content {
            flex: 1;
        }

        .history-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .history-description {
            color: #666;
            font-size: 0.9rem;
        }

        .history-date {
            color: #999;
            font-size: 0.875rem;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-align: center;
            font-weight: 500;
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
            background: #f8f9fa;
            color: #333;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #e9ecef;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #666;
        }

        .empty-state .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
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

            .details-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .action-buttons {
                justify-content: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
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
                <a href="/dashboard">
                    📊 Panel Administrativo
                </a>
            </li>
            <li>
                <a href="/camiones">🚛 Camiones</a>
            </li>
            <li>
                <a href="/viajes">
                    📋 Viajes
                </a>
            </li>
            <li>
                <a href="/mantenimiento">
                    🔧 Mantenimiento
                </a>
            </li>
            <li>
                <a href="/conductores">
                    👥 Conductores
                </a>
            </li>
            <li>
                <a href="/clientes">👤 Clientes</a>
            </li>
            <li>
                <a href="{{ route('combustible') }}" class="active">⛽ Combustible</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <a href="/profile" class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.75rem;">Sistema</div>
                </div>
            </a>
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
                    <h1 class="navbar-title">Detalles del Camión</h1>
                </div>
                <div class="navbar-links">
                    <a href="login" onclick="logout()">Cerrar Sesión</a>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="content-wrapper fade-in">

                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="/dashboard">🏠 Inicio</a>
                    <span>›</span>
                    <a href="{{ route('camiones.index') }}">🚛 Camiones</a>
                    <span>›</span>
                    <span>👁️ Detalles</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="truck-title">
                        <div class="truck-icon">🚛</div>
                        <div class="truck-info">
                            <h1 id="truckPlaca">ABC-123</h1>
                            <p id="truckModel">Modelo FH 440 - Año 2020</p>
                            <div style="margin-top: 0.5rem;">
                                <span class="status-badge status-activo" id="truckStatus">
                                    🟢 Activo
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('camiones.edit', $camion->id) }}" class="btn btn-primary">
                            ✏️ Editar
                        </a>
                        <button class="btn btn-success" onclick="assignDriver()">
                            👥 Asignar Conductor
                        </button>
                        <button class="btn btn-warning" onclick="scheduleMaintenance()">
                            🔧 Programar Mantenimiento
                        </button>
                        <a href="{{ route('camiones.index') }}" class="btn btn-secondary">
                            ↩️ Volver
                        </a>
                    </div>
                </div>

                <!-- Metrics Grid -->
                <div class="metrics-grid">
                    <div class="metric-card">
                        <div class="metric-icon">📊</div>
                        <div class="metric-value" id="totalTrips">24</div>
                        <div class="metric-label">Viajes Este Mes</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-icon">⛽</div>
                        <div class="metric-value" id="fuelEfficiency">8.5</div>
                        <div class="metric-label">Km/Litro Promedio</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-icon">🛣️</div>
                        <div class="metric-value" id="totalKm">125,000</div>
                        <div class="metric-label">Kilómetros Totales</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-icon">🔧</div>
                        <div class="metric-value" id="daysSinceMaintenance">15</div>
                        <div class="metric-label">Días Desde Mantenimiento</div>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="details-grid">
                    <!-- Left Column: Truck Information -->
                    <div>
                        <!-- Basic Information -->
                        <div class="info-card">
                            <h3>📋 Información Básica</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Placa</span>
                                    <span class="info-value" id="detailPlaca">ABC-123</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Modelo</span>
                                    <span class="info-value" id="detailModelo">FH 440</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Año</span>
                                    <span class="info-value" id="detailAnio">2020</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Capacidad de Carga</span>
                                    <span class="info-value" id="detailCapacidad">25 Toneladas</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Estado</span>
                                    <span class="info-value" id="detailEstado">Activo</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Conductor Asignado</span>
                                    <span class="info-value" id="detailConductor">Juan Pérez</span>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="info-card">
                            <h3>📈 Actividad Reciente</h3>
                            <div id="recentActivity">
                                <div class="history-item">
                                    <div class="history-icon viaje">🚛</div>
                                    <div class="history-content">
                                        <div class="history-title">Viaje a Guadalajara</div>
                                        <div class="history-description">Carga: 20 ton - Cliente: Transportes ABC</div>
                                        <div class="history-date">Hace 2 días</div>
                                    </div>
                                </div>
                                <div class="history-item">
                                    <div class="history-icon mantenimiento">🔧</div>
                                    <div class="history-content">
                                        <div class="history-title">Mantenimiento Preventivo</div>
                                        <div class="history-description">Cambio de aceite y filtros</div>
                                        <div class="history-date">Hace 1 semana</div>
                                    </div>
                                </div>
                                <div class="history-item">
                                    <div class="history-icon viaje">🚛</div>
                                    <div class="history-content">
                                        <div class="history-title">Viaje a Monterrey</div>
                                        <div class="history-description">Carga: 18 ton - Cliente: Logística XYZ</div>
                                        <div class="history-date">Hace 1 semana</div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: center; margin-top: 1rem;">
                                <a href="#" class="btn btn-secondary btn-sm">Ver Historial Completo</a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Additional Info -->
                    <div>
                        <!-- Current Status -->
                        <div class="info-card">
                            <h3>🔄 Estado Actual</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Ubicación</span>
                                    <span class="info-value">CDMX - Terminal Norte</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Último Viaje</span>
                                    <span class="info-value">12/06/2025</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Próximo Mantenimiento</span>
                                    <span class="info-value">25/06/2025</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Disponibilidad</span>
                                    <span class="info-value" style="color: #28a745;">Disponible</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="info-card">
                            <h3>⚡ Acciones Rápidas</h3>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <button class="btn btn-primary" onclick="createTrip()">
                                    📋 Crear Nuevo Viaje
                                </button>
                                <button class="btn btn-warning" onclick="scheduleMaintenance()">
                                    🔧 Programar Mantenimiento
                                </button>
                                <button class="btn btn-success" onclick="changeStatus()">
                                    🔄 Cambiar Estado
                                </button>
                                <button class="btn btn-secondary" onclick="generateReport()">
                                    📊 Generar Reporte
                                </button>
                            </div>
                        </div>

                        <!-- Observations -->
                        <div class="info-card">
                            <h3>📝 Observaciones</h3>
                            <p id="truckObservations" style="color: #666; line-height: 1.6;">
                                Camión en excelente estado, mantenimiento al día. 
                                Rendimiento de combustible dentro de parámetros normales.
                                Última revisión técnica aprobada sin observaciones.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inicialización
        document.addEventListener('DOMContentLoaded', function () {
            setupEventListeners();
            loadTruckData();
        });

        function setupEventListeners() {
            // Sidebar toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', function () {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }

        function loadTruckData() {
            // En una aplicación real, esto vendría del servidor
            // Aquí simulamos la carga de datos del camión
            const truckData = {
                placa: 'ABC-123',
                modelo: 'FH 440',
                anio: 2020,
                capacidad_carga: 25,
                estado: 'activo',
                conductor: 'Juan Pérez',
                observaciones: 'Camión en excelente estado, mantenimiento al día. Rendimiento de combustible dentro de parámetros normales.'
            };

            // Actualizar elementos de la página
            document.getElementById('truckPlaca').textContent = truckData.placa;
            document.getElementById('truckModel').textContent = `Modelo ${truckData.modelo} - Año ${truckData.anio}`;
            
            const statusBadge = document.getElementById('truckStatus');
            statusBadge.className = `status-badge status-${truckData.estado}`;
            statusBadge.textContent = getStatusText(truckData.estado);

            // Información detallada
            document.getElementById('detailPlaca').textContent = truckData.placa;
            document.getElementById('detailModelo').textContent = truckData.modelo;
            document.getElementById('detailAnio').textContent = truckData.anio;
            document.getElementById('detailCapacidad').textContent = `${truckData.capacidad_carga} Toneladas`;
            document.getElementById('detailEstado').textContent = truckData.estado.charAt(0).toUpperCase() + truckData.estado.slice(1);
            document.getElementById('detailConductor').textContent = truckData.conductor;
            document.getElementById('truckObservations').textContent = truckData.observaciones;
        }

        function getStatusText(estado) {
            switch (estado) {
                case 'activo':
                    return '🟢 Activo';
                case 'mantenimiento':
                    return '🔴 En Mantenimiento';
                case 'inactivo':
                    return '⚪ Inactivo';
                default:
                    return estado;
            }
        }

        // Funciones de acciones
        function assignDriver() {
            if (confirm('¿Desea asignar un nuevo conductor a este camión?')) {
                alert('Funcionalidad de asignación de conductor en desarrollo');
            }
        }

        function scheduleMaintenance() {
            if (confirm('¿Desea programar un mantenimiento para este camión?')) {
                alert('Funcionalidad de programación de mantenimiento en desarrollo');
            }
        }

        function createTrip() {
            if (confirm('¿Desea crear un nuevo viaje para este camión?')) {
                alert('Redirigiendo a crear nuevo viaje...');
                // window.location.href = '/viajes/create?camion=' + encodeURIComponent(document.getElementById('truckPlaca').textContent);
            }
        }

        function changeStatus() {
            const newStatus = prompt('Ingrese el nuevo estado (activo, mantenimiento, inactivo):');
            if (newStatus && ['activo', 'mantenimiento', 'inactivo'].includes(newStatus.toLowerCase())) {
                alert(`Estado cambiado a: ${newStatus}`);
                // Aquí harías la petición al servidor para cambiar el estado
            } else if (newStatus) {
                alert('Estado inválido. Use: activo, mantenimiento o inactivo');
            }
        }

        function generateReport() {
            alert('Generando reporte del camión...');
            // Aquí implementarías la generación de reportes
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }
    </script>
</body>

</html>