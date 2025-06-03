<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Gestión de Camiones</title>
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

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid #667eea;
            text-align: center;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .dashboard-card h3 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .dashboard-card .card-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .dashboard-card .card-label {
            color: #666;
            font-size: 0.9rem;
        }

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

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
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

        /* Forms */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        /* Tables */
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
        }

        .table tr:hover {
            background: #f8f9fa;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-activo { background: #d4edda; color: #155724; }
        .status-mantenimiento { background: #f8d7da; color: #721c24; }
        .status-inactivo { background: #f8f9fa; color: #6c757d; }
        .status-disponible { background: #d1ecf1; color: #0c5460; }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 10px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #999;
        }

        .modal-close:hover {
            color: #333;
        }

        .modal-body {
            padding: 1.5rem;
        }

        /* Truck Cards View */
        .trucks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .truck-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .truck-card:hover {
            transform: translateY(-5px);
        }

        .truck-card-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .truck-id {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .truck-model {
            opacity: 0.9;
        }

        .truck-card-body {
            padding: 1.5rem;
        }

        .truck-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
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

        .truck-card-footer {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .form-grid {
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

            .trucks-grid {
                grid-template-columns: 1fr;
            }

            .truck-details {
                grid-template-columns: 1fr;
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
                <a href="/dashboard">
                    📊 Panel Administrativo
                </a>
            </li>
            <li>
                <a href="/camiones" class="active">
                    🚛 Camiones
                </a>
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
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">Administrador</div>
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
                    <h1 class="navbar-title">Gestión de Camiones</h1>
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
                        <h1 class="page-title">Gestión de Camiones</h1>
                        <p class="page-subtitle">Administra y supervisa toda tu flotilla vehicular</p>
                    </div>
                    <button class="btn btn-primary" onclick="window.location.href='/registroCamiones'">
                        ➕ Nuevo Camión
                    </button>
                </div>
                
                <!-- Dashboard Cards -->
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <h3>Total Camiones</h3>
                        <div class="card-number" id="totalCamiones">18</div>
                        <div class="card-label">En la flotilla</div>
                    </div>
                    <div class="dashboard-card">
                        <h3>Disponibles</h3>
                        <div class="card-number" id="disponibles">8</div>
                        <div class="card-label">Listos para viaje</div>
                    </div>
                    <div class="dashboard-card">
                        <h3>En Ruta</h3>
                        <div class="card-number" id="enRuta">5</div>
                        <div class="card-label">Viajes activos</div>
                    </div>
                    <div class="dashboard-card">
                        <h3>Mantenimiento</h3>
                        <div class="card-number" id="mantenimiento">3</div>
                        <div class="card-label">Fuera de servicio</div>
                    </div>
                    <div class="dashboard-card">
                        <h3>Inactivos</h3>
                        <div class="card-number" id="inactivos">2</div>
                        <div class="card-label">Sin asignar</div>
                    </div>
                </div>

                <!-- Tabs Container -->
                <div class="tabs-container">
                    <div class="tabs-header">
                        <button class="tab-button active" data-tab="table">📊 Lista de Camiones</button>
                        <button class="tab-button" data-tab="historial">📊 Historial de Viajes</button>
                    </div>

                    <!-- Tab: Table View (Principal) -->
                    <div class="tab-content active" id="table">
                        <div class="table-header">
                            <h3 class="table-title">Lista Completa de Camiones</h3>
                            <div class="table-actions">
                                <input type="text" class="search-input" placeholder="Buscar camión..." id="searchTable">
                                <button class="btn btn-success btn-sm" onclick="window.location.href='/registroCamiones'">➕ Nuevo Camión</button>
                                <button class="btn btn-secondary btn-sm" onclick="exportarDatos()">📊 Exportar</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Placa</th>
                                        <th>Modelo</th>
                                        <th>Año</th>
                                        <th>Capacidad</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="trucksTableBody">
                                    <!-- Los datos se cargarán aquí dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    <!-- Tab: Historial de Viajes -->
                    <div class="tab-content" id="historial">
                        <div class="table-header">
                            <h3 class="table-title">Historial de Viajes por Camión</h3>
                            <div class="table-actions">
                                <select class="search-input" id="filtroCamion" style="max-width: 200px;">
                                    <option value="">Todos los camiones</option>
                                </select>
                                <input type="date" class="search-input" id="fechaInicio" style="max-width: 150px;">
                                <input type="date" class="search-input" id="fechaFin" style="max-width: 150px;">
                                <button class="btn btn-primary btn-sm" onclick="filtrarHistorial()">🔍 Filtrar</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Camión</th>
                                        <th>Conductor</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Cliente</th>
                                        <th>Tiempo</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="historialTableBody">
                                    <!-- Los datos se cargarán aquí dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal para Nuevo/Editar Camión -->
    <div class="modal" id="modalCamion">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Nuevo Camión</h3>
                <button class="modal-close" onclick="cerrarModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formModalCamion">
                    <input type="hidden" id="modalCamionId" name="id">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Placa del Vehículo</label>
                            <input type="text" class="form-control" id="modalPlaca" name="placa" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="modalModelo" name="modelo" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Año</label>
                            <input type="number" class="form-control" id="modalAño" name="año" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Capacidad (Ton)</label>
                            <input type="number" class="form-control" id="modalCapacidad" name="capacidad" step="0.5" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Estado</label>
                            <select class="form-control" id="modalEstado" name="estado" required>
                                <option value="activo">Activo</option>
                                <option value="mantenimiento">En Mantenimiento</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Conductor</label>
                            <input type="text" class="form-control" id="modalConductor" name="conductor" placeholder="Sin asignar">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">💾 Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Datos simulados de camiones
        let camionesData = [
            {
                id: 1,
                placa: 'CAM-001',
                modelo: 'Freightliner Cascadia',
                año: 2020,
                marca: 'freightliner',
                capacidadCarga: 25.5,
                estado: 'activo',
                conductor: 'Juan Pérez',
                kilometraje: 120000,
                numeroEconomico: 'ECO-001',
                color: 'Blanco',
                combustible: 85
            },
            {
                id: 2,
                placa: 'CAM-002',
                modelo: 'Kenworth T680',
                año: 2019,
                marca: 'kenworth',
                capacidadCarga: 30.0,
                estado: 'activo',
                conductor: 'María González',
                kilometraje: 95000,
                numeroEconomico: 'ECO-002',
                color: 'Azul',
                combustible: 62
            },
            {
                id: 3,
                placa: 'CAM-003',
                modelo: 'Volvo VNL',
                año: 2021,
                marca: 'volvo',
                capacidadCarga: 28.0,
                estado: 'mantenimiento',
                conductor: 'Sin asignar',
                kilometraje: 45000,
                numeroEconomico: 'ECO-003',
                color: 'Rojo',
                combustible: 78
            },
            {
                id: 4,
                placa: 'CAM-004',
                modelo: 'Peterbilt 579',
                año: 2018,
                marca: 'peterbilt',
                capacidadCarga: 26.5,
                estado: 'activo',
                conductor: 'Carlos López',
                kilometraje: 180000,
                numeroEconomico: 'ECO-004',
                color: 'Negro',
                combustible: 45
            },
            {
                id: 5,
                placa: 'CAM-005',
                modelo: 'Mack Anthem',
                año: 2022,
                marca: 'mack',
                capacidadCarga: 32.0,
                estado: 'inactivo',
                conductor: 'Sin asignar',
                kilometraje: 25000,
                numeroEconomico: 'ECO-005',
                color: 'Verde',
                combustible: 92
            }
        ];

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            initializeApp();
        });

        function initializeApp() {
            setupEventListeners();
            cargarTablaCamiones();
            cargarTablaHistorial();
            cargarFiltroCamiones();
            actualizarEstadisticas();
        }

        function cargarTablaHistorial() {
            const tbody = document.getElementById('historialTableBody');
            tbody.innerHTML = '';

            // Datos simulados de historial de viajes
            const historialViajes = [
                {
                    fecha: '2024-06-01',
                    camion: 'CAM-001',
                    conductor: 'Juan Pérez',
                    origen: 'Córdoba, Ver.',
                    destino: 'México, DF',
                    cliente: 'Transportes ABC',
                    tiempo: '6h 30min',
                    estado: 'completado'
                },
                {
                    fecha: '2024-05-30',
                    camion: 'CAM-002',
                    conductor: 'María González',
                    origen: 'Veracruz, Ver.',
                    destino: 'Puebla, Pue.',
                    cliente: 'Logística XYZ',
                    tiempo: '4h 15min',
                    estado: 'completado'
                },
                {
                    fecha: '2024-05-28',
                    camion: 'CAM-001',
                    conductor: 'Juan Pérez',
                    origen: 'México, DF',
                    destino: 'Guadalajara, Jal.',
                    cliente: 'Carga Segura SA',
                    tiempo: '8h 45min',
                    estado: 'completado'
                }
            ];

            historialViajes.forEach(viaje => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${formatearFecha(viaje.fecha)}</td>
                    <td><strong>${viaje.camion}</strong></td>
                    <td>${viaje.conductor}</td>
                    <td>${viaje.origen}</td>
                    <td>${viaje.destino}</td>
                    <td>${viaje.cliente}</td>
                    <td>${viaje.tiempo}</td>
                    <td><span class="status-badge status-activo">${viaje.estado.toUpperCase()}</span></td>
                `;
                tbody.appendChild(row);
            });
        }

        function cargarFiltroCamiones() {
            const select = document.getElementById('filtroCamion');
            if (select) {
                select.innerHTML = '<option value="">Todos los camiones</option>';
                
                camionesData.forEach(camion => {
                    const option = document.createElement('option');
                    option.value = camion.placa;
                    option.textContent = `${camion.placa} - ${camion.modelo}`;
                    select.appendChild(option);
                });
            }
        }

        function filtrarHistorial() {
            // Esta función se puede implementar según las necesidades específicas
            mostrarNotificacion('Filtro aplicado al historial de viajes', 'success');
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

            // Tab navigation
            document.querySelectorAll('.tab-button').forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    cambiarTab(tabId);
                });
            });

            // Search functionality
            if (document.getElementById('searchTable')) {
                document.getElementById('searchTable').addEventListener('input', function() {
                    filtrarTabla(this.value);
                });
            }
        }

        function irARegistroCamion() {
            // Simular redirección a página de registro
            mostrarNotificacion('Redirigiendo a formulario de registro...', 'success');
            setTimeout(() => {
                // En un proyecto real, esto sería: window.location.href = '/camiones/registro';
                alert('En la aplicación real, esto te llevaría a la página: /camiones/registro');
            }, 1000);
        }

        function cambiarTab(tabId) {
            // Remover active de todos los botones y contenidos
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            // Activar el tab seleccionado
            document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
            document.getElementById(tabId).classList.add('active');

            // Recargar datos si es necesario
            if (tabId === 'table') {
                cargarTablaCamiones();
            } else if (tabId === 'historial') {
                cargarTablaHistorial();
                cargarFiltroCamiones();
            }
        }

        function cargarTablaCamiones() {
            const tbody = document.getElementById('trucksTableBody');
            tbody.innerHTML = '';

            camionesData.forEach(camion => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><strong>${camion.placa}</strong></td>
                    <td>${camion.modelo}</td>
                    <td>${camion.año}</td>
                    <td>${camion.capacidadCarga} Ton</td>
                    <td><span class="status-badge status-${camion.estado}">${getEstadoLabel(camion.estado)}</span></td>
                    <td>${camion.conductor}</td>
                    <td>${camion.kilometraje.toLocaleString()} km</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <button class="btn btn-secondary btn-sm" onclick="editarCamion(${camion.id})">✏️</button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarCamion(${camion.id})">🗑️</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function getEstadoLabel(estado) {
            const labels = {
                'activo': 'Activo',
                'mantenimiento': 'Mantenimiento',
                'inactivo': 'Inactivo'
            };
            return labels[estado] || estado;
        }

        function actualizarEstadisticas() {
            const stats = {
                total: camionesData.length,
                activo: 0,
                mantenimiento: 0,
                inactivo: 0
            };

            camionesData.forEach(camion => {
                stats[camion.estado]++;
            });

            document.getElementById('totalCamiones').textContent = stats.total;
            document.getElementById('disponibles').textContent = stats.activo;
            document.getElementById('mantenimiento').textContent = stats.mantenimiento;
            document.getElementById('inactivos').textContent = stats.inactivo;
            
            // Simular camiones en ruta
            document.getElementById('enRuta').textContent = Math.floor(stats.activo * 0.6);
        }

        function guardarCamion(form) {
            const formData = new FormData(form);
            const nuevoCamion = {
                id: camionesData.length + 1,
                placa: formData.get('placa'),
                modelo: formData.get('modelo'),
                año: parseInt(formData.get('año')),
                marca: formData.get('marca'),
                capacidadCarga: parseFloat(formData.get('capacidadCarga')),
                estado: formData.get('estado'),
                conductor: 'Sin asignar',
                kilometraje: parseInt(formData.get('kilometraje')) || 0,
                numeroEconomico: formData.get('numeroEconomico') || `ECO-${String(camionesData.length + 1).padStart(3, '0')}`,
                color: formData.get('color') || 'Blanco',
                combustible: 100,
                numeroSerie: formData.get('numeroSerie') || '',
                tipoCombustible: formData.get('tipoCombustible') || 'diesel',
                fechaCompra: formData.get('fechaCompra') || '',
                observaciones: formData.get('observaciones') || ''
            };

            camionesData.push(nuevoCamion);
            cargarTablaCamiones();
            actualizarEstadisticas();
            limpiarFormulario();
            
            mostrarNotificacion('Camión registrado exitosamente', 'success');
        }

        function guardarCamionModal(form) {
            // Esta función permanece para la edición de camiones existentes
            const formData = new FormData(form);
            const id = formData.get('id');

            if (id) {
                // Editar camión existente
                const camionIndex = camionesData.findIndex(c => c.id === parseInt(id));
                if (camionIndex !== -1) {
                    camionesData[camionIndex] = {
                        ...camionesData[camionIndex],
                        placa: formData.get('placa'),
                        modelo: formData.get('modelo'),
                        año: parseInt(formData.get('año')),
                        capacidadCarga: parseFloat(formData.get('capacidad')),
                        estado: formData.get('estado'),
                        conductor: formData.get('conductor') || 'Sin asignar'
                    };
                    mostrarNotificacion('Camión actualizado exitosamente', 'success');
                }
            }

            cargarTablaCamiones();
            actualizarEstadisticas();
            cerrarModal();
        }

        function editarCamion(id) {
            const camion = camionesData.find(c => c.id === id);
            if (camion) {
                document.getElementById('modalTitle').textContent = 'Editar Camión';
                document.getElementById('modalCamionId').value = camion.id;
                document.getElementById('modalPlaca').value = camion.placa;
                document.getElementById('modalModelo').value = camion.modelo;
                document.getElementById('modalAño').value = camion.año;
                document.getElementById('modalCapacidad').value = camion.capacidadCarga;
                document.getElementById('modalEstado').value = camion.estado;
                document.getElementById('modalConductor').value = camion.conductor !== 'Sin asignar' ? camion.conductor : '';
                
                document.getElementById('modalCamion').classList.add('active');
            }
        }

        function eliminarCamion(id) {
            if (confirm('¿Está seguro de que desea eliminar este camión?')) {
                camionesData = camionesData.filter(c => c.id !== id);
                cargarTablaCamiones();
                actualizarEstadisticas();
                mostrarNotificacion('Camión eliminado exitosamente', 'success');
            }
        }

        function abrirModalNuevoCamion() {
            // Función removida - ahora redirige a página separada
        }

        function cerrarModal() {
            document.getElementById('modalCamion').classList.remove('active');
        }

        function limpiarFormulario() {
            document.getElementById('formRegistroCamion').reset();
        }

        function filtrarTarjetas(termino) {
            // Función removida - ya no se usa vista de tarjetas
        }

        function filtrarTabla(termino) {
            const rows = document.querySelectorAll('#trucksTableBody tr');
            
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
            // Función removida - ya no se usa vista de tarjetas
        }

        function exportarDatos() {
            const csv = convertirACSV(camionesData);
            descargarCSV(csv, 'camiones_flotilla.csv');
            mostrarNotificacion('Datos exportados exitosamente', 'success');
        }

        function convertirACSV(data) {
            const headers = ['Placa', 'Modelo', 'Año', 'Marca', 'Capacidad', 'Estado', 'Conductor', 'Kilometraje', 'Color'];
            const rows = data.map(camion => [
                camion.placa,
                camion.modelo,
                camion.año,
                camion.marca,
                camion.capacidadCarga,
                camion.estado,
                camion.conductor,
                camion.kilometraje,
                camion.color
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

        function cargarTablaHistorial() {
            const tbody = document.getElementById('historialTableBody');
            tbody.innerHTML = '';

            // Datos simulados de historial de viajes
            const historialViajes = [
                {
                    fecha: '2024-06-01',
                    camion: 'CAM-001',
                    conductor: 'Juan Pérez',
                    origen: 'Córdoba, Ver.',
                    destino: 'México, DF',
                    cliente: 'Transportes ABC',
                    tiempo: '6h 30min',
                    estado: 'completado'
                },
                {
                    fecha: '2024-05-30',
                    camion: 'CAM-002',
                    conductor: 'María González',
                    origen: 'Veracruz, Ver.',
                    destino: 'Puebla, Pue.',
                    cliente: 'Logística XYZ',
                    tiempo: '4h 15min',
                    estado: 'completado'
                },
                {
                    fecha: '2024-05-28',
                    camion: 'CAM-001',
                    conductor: 'Juan Pérez',
                    origen: 'México, DF',
                    destino: 'Guadalajara, Jal.',
                    cliente: 'Carga Segura SA',
                    tiempo: '8h 45min',
                    estado: 'completado'
                }
            ];

            historialViajes.forEach(viaje => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${formatearFecha(viaje.fecha)}</td>
                    <td><strong>${viaje.camion}</strong></td>
                    <td>${viaje.conductor}</td>
                    <td>${viaje.origen}</td>
                    <td>${viaje.destino}</td>
                    <td>${viaje.cliente}</td>
                    <td>${viaje.tiempo}</td>
                    <td><span class="status-badge status-activo">${viaje.estado.toUpperCase()}</span></td>
                `;
                tbody.appendChild(row);
            });
        }

        function cargarFiltroCamiones() {
            const select = document.getElementById('filtroCamion');
            if (select) {
                select.innerHTML = '<option value="">Todos los camiones</option>';
                
                camionesData.forEach(camion => {
                    const option = document.createElement('option');
                    option.value = camion.placa;
                    option.textContent = `${camion.placa} - ${camion.modelo}`;
                    select.appendChild(option);
                });
            }
        }

        function filtrarHistorial() {
            const camionSeleccionado = document.getElementById('filtroCamion').value;
            const fechaInicio = document.getElementById('fechaInicio').value;
            const fechaFin = document.getElementById('fechaFin').value;
            
            mostrarNotificacion('Filtro aplicado al historial de viajes', 'success');
        }

        function formatearFecha(fecha) {
            const opciones = { month: 'short', day: 'numeric' };
            return new Date(fecha).toLocaleDateString('es-ES', opciones);
        }

        function mostrarNotificacion(mensaje, tipo) {
            // Crear elemento de notificación
            const notificacion = document.createElement('div');
            notificacion.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 1rem 1.5rem;
                background: ${tipo === 'success' ? '#28a745' : '#dc3545'};
                color: white;
                border-radius: 5px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                z-index: 9999;
                font-weight: 500;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notificacion.textContent = mensaje;
            
            document.body.appendChild(notificacion);
            
            // Animar entrada
            setTimeout(() => {
                notificacion.style.transform = 'translateX(0)';
            }, 100);
            
            // Remover después de 3 segundos
            setTimeout(() => {
                notificacion.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notificacion);
                }, 300);
            }, 3000);
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                mostrarNotificacion('Cerrando sesión...', 'success');
                setTimeout(() => {
                    // Aquí iría la lógica de logout real
                    window.location.href = '/login';
                }, 1000);
            }
        }active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            // Activar el tab seleccionado
            document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
            document.getElementById(tabId).classList.add('active');

            // Recargar datos si es necesario
            if (tabId === 'cards') {
                cargarTarjetasCamiones();
            } else if (tabId === 'table') {
                cargarTablaCamiones();
            }
        }

        function cargarTarjetasCamiones() {
            const container = document.getElementById('trucksGrid');
            container.innerHTML = '';

            camionesData.forEach(camion => {
                const card = crearTarjetaCamion(camion);
                container.appendChild(card);
            });
        }

        function crearTarjetaCamion(camion) {
            const card = document.createElement('div');
            card.className = 'truck-card';
            card.setAttribute('data-status', camion.estado);
            card.innerHTML = `
                <div class="truck-card-header">
                    <div class="truck-id">${camion.placa}</div>
                    <div class="truck-model">${camion.modelo} (${camion.año})</div>
                </div>
                <div class="truck-card-body">
                    <div class="truck-details">
                        <div class="detail-item">
                            <span class="detail-label">Conductor</span>
                            <span class="detail-value">${camion.conductor}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Capacidad</span>
                            <span class="detail-value">${camion.capacidadCarga} Ton</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Estado</span>
                            <span class="detail-value">
                                <span class="status-badge status-${camion.estado}">${getEstadoLabel(camion.estado)}</span>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Kilometraje</span>
                            <span class="detail-value">${camion.kilometraje.toLocaleString()} km</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Combustible</span>
                            <span class="detail-value">⛽ ${camion.combustible}%</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Color</span>
                            <span class="detail-value">${camion.color}</span>
                        </div>
                    </div>
                </div>
                <div class="truck-card-footer">
                    <span style="font-size: 0.9rem; color: #666;">${camion.numeroEconomico}</span>
                    <div style="display: flex; gap: 0.5rem;">
                        <button class="btn btn-secondary btn-sm" onclick="editarCamion(${camion.id})">✏️ Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarCamion(${camion.id})">🗑️ Eliminar</button>
                    </div>
                </div>
            `;
            return card;
        }

        function cargarTablaCamiones() {
            const tbody = document.getElementById('trucksTableBody');
            tbody.innerHTML = '';

            camionesData.forEach(camion => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><strong>${camion.placa}</strong></td>
                    <td>${camion.modelo}</td>
                    <td>${camion.año}</td>
                    <td>${camion.capacidadCarga} Ton</td>
                    <td><span class="status-badge status-${camion.estado}">${getEstadoLabel(camion.estado)}</span></td>
                    <td>${camion.conductor}</td>
                    <td>${camion.kilometraje.toLocaleString()} km</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <button class="btn btn-secondary btn-sm" onclick="editarCamion(${camion.id})">✏️</button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarCamion(${camion.id})">🗑️</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function getEstadoLabel(estado) {
            const labels = {
                'activo': 'Activo',
                'mantenimiento': 'Mantenimiento',
                'inactivo': 'Inactivo'
            };
            return labels[estado] || estado;
        }

        function actualizarEstadisticas() {
            const stats = {
                total: camionesData.length,
                activo: 0,
                mantenimiento: 0,
                inactivo: 0
            };

            camionesData.forEach(camion => {
                stats[camion.estado]++;
            });

            document.getElementById('totalCamiones').textContent = stats.total;
            document.getElementById('disponibles').textContent = stats.activo;
            document.getElementById('mantenimiento').textContent = stats.mantenimiento;
            document.getElementById('inactivos').textContent = stats.inactivo;
            
            // Simular camiones en ruta
            document.getElementById('enRuta').textContent = Math.floor(stats.activo * 0.6);
        }

        function guardarCamion(form) {
            const formData = new FormData(form);
            const nuevoCamion = {
                id: camionesData.length + 1,
                placa: formData.get('placa'),
                modelo: formData.get('modelo'),
                año: parseInt(formData.get('año')),
                marca: formData.get('marca'),
                capacidadCarga: parseFloat(formData.get('capacidadCarga')),
                estado: formData.get('estado'),
                conductor: 'Sin asignar',
                kilometraje: 0,
                numeroEconomico: `ECO-${String(camionesData.length + 1).padStart(3, '0')}`,
                color: 'Blanco',
                combustible: 100
            };

            camionesData.push(nuevoCamion);
            cargarTarjetasCamiones();
            cargarTablaCamiones();
            actualizarEstadisticas();
            limpiarFormulario();
            
            mostrarNotificacion('Camión registrado exitosamente', 'success');
        }

        function guardarCamionModal(form) {
            const formData = new FormData(form);
            const id = formData.get('id');

            if (id) {
                // Editar camión existente
                const camionIndex = camionesData.findIndex(c => c.id === parseInt(id));
                if (camionIndex !== -1) {
                    camionesData[camionIndex] = {
                        ...camionesData[camionIndex],
                        placa: formData.get('placa'),
                        modelo: formData.get('modelo'),
                        año: parseInt(formData.get('año')),
                        capacidadCarga: parseFloat(formData.get('capacidad')),
                        estado: formData.get('estado'),
                        conductor: formData.get('conductor') || 'Sin asignar'
                    };
                    mostrarNotificacion('Camión actualizado exitosamente', 'success');
                }
            } else {
                // Nuevo camión
                const nuevoCamion = {
                    id: camionesData.length + 1,
                    placa: formData.get('placa'),
                    modelo: formData.get('modelo'),
                    año: parseInt(formData.get('año')),
                    marca: 'freightliner', // Default
                    capacidadCarga: parseFloat(formData.get('capacidad')),
                    estado: formData.get('estado'),
                    conductor: formData.get('conductor') || 'Sin asignar',
                    kilometraje: 0,
                    numeroEconomico: `ECO-${String(camionesData.length + 1).padStart(3, '0')}`,
                    color: 'Blanco',
                    combustible: 100
                };
                camionesData.push(nuevoCamion);
                mostrarNotificacion('Camión registrado exitosamente', 'success');
            }

            cargarTarjetasCamiones();
            cargarTablaCamiones();
            actualizarEstadisticas();
            cerrarModal();
        }

        function editarCamion(id) {
            const camion = camionesData.find(c => c.id === id);
            if (camion) {
                document.getElementById('modalTitle').textContent = 'Editar Camión';
                document.getElementById('modalCamionId').value = camion.id;
                document.getElementById('modalPlaca').value = camion.placa;
                document.getElementById('modalModelo').value = camion.modelo;
                document.getElementById('modalAño').value = camion.año;
                document.getElementById('modalCapacidad').value = camion.capacidadCarga;
                document.getElementById('modalEstado').value = camion.estado;
                document.getElementById('modalConductor').value = camion.conductor !== 'Sin asignar' ? camion.conductor : '';
                
                document.getElementById('modalCamion').classList.add('active');
            }
        }

        function eliminarCamion(id) {
            if (confirm('¿Está seguro de que desea eliminar este camión?')) {
                camionesData = camionesData.filter(c => c.id !== id);
                cargarTarjetasCamiones();
                cargarTablaCamiones();
                actualizarEstadisticas();
                mostrarNotificacion('Camión eliminado exitosamente', 'success');
            }
        }

        function abrirModalNuevoCamion() {
            document.getElementById('modalTitle').textContent = 'Nuevo Camión';
            document.getElementById('formModalCamion').reset();
            document.getElementById('modalCamionId').value = '';
            document.getElementById('modalCamion').classList.add('active');
        }

        function cerrarModal() {
            document.getElementById('modalCamion').classList.remove('active');
        }

        function limpiarFormulario() {
            document.getElementById('formRegistroCamion').reset();
        }

        function filtrarTarjetas(termino) {
            const cards = document.querySelectorAll('.truck-card');
            
            cards.forEach(card => {
                const texto = card.textContent.toLowerCase();
                if (texto.includes(termino.toLowerCase())) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function filtrarTabla(termino) {
            const rows = document.querySelectorAll('#trucksTableBody tr');
            
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
            const cards = document.querySelectorAll('.truck-card');
            
            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (!estado || cardStatus === estado) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function exportarDatos() {
            const csv = convertirACSV(camionesData);
            descargarCSV(csv, 'camiones_flotilla.csv');
            mostrarNotificacion('Datos exportados exitosamente', 'success');
        }

        function convertirACSV(data) {
            const headers = ['Placa', 'Modelo', 'Año', 'Marca', 'Capacidad', 'Estado', 'Conductor', 'Kilometraje', 'Color'];
            const rows = data.map(camion => [
                camion.placa,
                camion.modelo,
                camion.año,
                camion.marca,
                camion.capacidadCarga,
                camion.estado,
                camion.conductor,
                camion.kilometraje,
                camion.color
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

        function mostrarNotificacion(mensaje, tipo) {
            // Crear elemento de notificación
            const notificacion = document.createElement('div');
            notificacion.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 1rem 1.5rem;
                background: ${tipo === 'success' ? '#28a745' : '#dc3545'};
                color: white;
                border-radius: 5px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                z-index: 9999;
                font-weight: 500;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notificacion.textContent = mensaje;
            
            document.body.appendChild(notificacion);
            
            // Animar entrada
            setTimeout(() => {
                notificacion.style.transform = 'translateX(0)';
            }, 100);
            
            // Remover después de 3 segundos
            setTimeout(() => {
                notificacion.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notificacion);
                }, 300);
            }, 3000);
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                mostrarNotificacion('Cerrando sesión...', 'success');
                setTimeout(() => {
                    // Aquí iría la lógica de logout real
                    window.location.href = '/login';
                }, 1000);
            }
        }