<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Gestión de Conductores</title>
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

        .stat-total { color: #007bff; }
        .stat-activos { color: #28a745; }
        .stat-inactivos { color: #6c757d; }
        .stat-viajes { color: #ffc107; }
        .stat-licencias { color: #dc3545; }

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

        .status-activo { background: #e8f5e8; color: #2e7d32; }
        .status-inactivo { background: #f8f9fa; color: #6c757d; }
        .status-disponible { background: #e3f2fd; color: #1565c0; }
        .status-ocupado { background: #fff8e1; color: #f57c00; }
        .status-vencida { background: #ffebee; color: #c62828; }
        .status-vigente { background: #e8f5e8; color: #2e7d32; }

        /* Driver Cards */
        .drivers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .driver-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .driver-card:hover {
            transform: translateY(-2px);
        }

        .driver-card-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .driver-name {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .driver-id {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .driver-card-body {
            padding: 1.5rem;
        }

        .driver-details {
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

        .driver-card-footer {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Alert Cards */
        .alert-card {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
        }

        .alert-card.urgent {
            background: #f8d7da;
            border-left-color: #dc3545;
        }

        .alert-title {
            font-weight: 600;
            color: #856404;
            margin-bottom: 0.5rem;
        }

        .alert-card.urgent .alert-title {
            color: #721c24;
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

            .drivers-grid {
                grid-template-columns: 1fr;
            }

            .driver-details {
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
                <a href="/dashboard">📊 Panel Administrativo</a>
            </li>
            <li>
                <a href="/camiones">🚛 Camiones</a>
            </li>
            <li>
                <a href="/viajes">📋 Viajes</a>
            </li>
            <li>
                <a href="/mantenimiento">🔧 Mantenimiento</a>
            </li>
            <li>
                <a href="/conductores" class="active">👥 Conductores</a>
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
                    <h1 class="navbar-title">Gestión de Conductores</h1>
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
                        <h1 class="page-title">Gestión de Conductores</h1>
                        <p class="page-subtitle">Administra la información de todos los conductores de la flotilla</p>
                    </div>
                    <button class="btn btn-primary" onclick="window.location.href='/registrarConductor'">
                        ➕ Registrar Conductor
                    </button>
                </div>

                <!-- Alertas -->
                <div class="alert-card urgent">
                    <div class="alert-title">🚨 Licencias por Vencer</div>
                    <p>2 conductores tienen licencias que vencen en los próximos 30 días</p>
                </div>
                
                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-number stat-total" id="totalConductores">15</div>
                        <div class="stat-label">Total Conductores</div>
                        <div class="stat-sublabel">En la empresa</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-activos" id="activos">12</div>
                        <div class="stat-label">Activos</div>
                        <div class="stat-sublabel">Disponibles para viajes</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-inactivos" id="inactivos">3</div>
                        <div class="stat-label">Inactivos</div>
                        <div class="stat-sublabel">No disponibles</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-viajes" id="enViaje">5</div>
                        <div class="stat-label">En Viaje</div>
                        <div class="stat-sublabel">Actualmente conduciendo</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-licencias" id="licenciasVencen">2</div>
                        <div class="stat-label">Licencias por Vencer</div>
                        <div class="stat-sublabel">Próximos 30 días</div>
                    </div>
                </div>

                <!-- Tabs Container -->
                <div class="tabs-container">
                    <div class="tabs-header">
                        <button class="tab-button active" data-tab="conductores">👥 Lista de Conductores</button>
                        <button class="tab-button" data-tab="tarjetas">🃏 Vista de Tarjetas</button>
                        <button class="tab-button" data-tab="licencias">📄 Control de Licencias</button>
                    </div>

                    <!-- Tab: Lista de Conductores -->
                    <div class="tab-content active" id="conductores">
                        <div class="table-header">
                            <h3 class="table-title">Todos los Conductores</h3>
                            <div class="table-actions">
                                <input type="text" class="search-input" placeholder="Buscar conductor..." id="searchConductores">
                                <select class="search-input" style="max-width: 150px;" id="filterEstado">
                                    <option value="">Todos los estados</option>
                                    <option value="activo">Activos</option>
                                    <option value="inactivo">Inactivos</option>
                                    <option value="ocupado">En Viaje</option>
                                </select>
                                <button class="btn btn-secondary btn-sm">📊 Exportar</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Completo</th>
                                        <th>Teléfono</th>
                                        <th>Licencia</th>
                                        <th>Vencimiento</th>
                                        <th>Estado</th>
                                        <th>Camión Asignado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>CH-001</strong></td>
                                        <td>Juan Pérez García</td>
                                        <td>+52 271 123 4567</td>
                                        <td>LIC-2024-001</td>
                                        <td>15/12/2025</td>
                                        <td><span class="status-badge status-ocupado">En Viaje</span></td>
                                        <td>CAM-001</td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-warning btn-sm">✏️</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CH-002</strong></td>
                                        <td>María González López</td>
                                        <td>+52 271 234 5678</td>
                                        <td>LIC-2024-002</td>
                                        <td>08/07/2024</td>
                                        <td><span class="status-badge status-ocupado">En Viaje</span></td>
                                        <td>CAM-002</td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-danger btn-sm">⚠️</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CH-003</strong></td>
                                        <td>Carlos López Martínez</td>
                                        <td>+52 271 345 6789</td>
                                        <td>LIC-2024-003</td>
                                        <td>22/11/2025</td>
                                        <td><span class="status-badge status-disponible">Disponible</span></td>
                                        <td>Sin asignar</td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-success btn-sm">🚛</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CH-004</strong></td>
                                        <td>Ana Martínez Rodríguez</td>
                                        <td>+52 271 456 7890</td>
                                        <td>LIC-2024-004</td>
                                        <td>30/06/2024</td>
                                        <td><span class="status-badge status-ocupado">En Viaje</span></td>
                                        <td>CAM-004</td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-danger btn-sm">🚨</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CH-005</strong></td>
                                        <td>Roberto Silva Hernández</td>
                                        <td>+52 271 567 8901</td>
                                        <td>LIC-2024-005</td>
                                        <td>18/09/2025</td>
                                        <td><span class="status-badge status-disponible">Disponible</span></td>
                                        <td>Sin asignar</td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-warning btn-sm">✏️</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab: Vista de Tarjetas -->
                    <div class="tab-content" id="tarjetas">
                        <div class="table-header">
                            <h3 class="table-title">Conductores - Vista de Tarjetas</h3>
                            <div class="table-actions">
                                <input type="text" class="search-input" placeholder="Buscar conductor..." id="searchTarjetas">
                            </div>
                        </div>
                        
                        <div class="drivers-grid">
                            <div class="driver-card">
                                <div class="driver-card-header">
                                    <div class="driver-name">Juan Pérez García</div>
                                    <div class="driver-id">CH-001</div>
                                </div>
                                <div class="driver-card-body">
                                    <div class="driver-details">
                                        <div class="detail-item">
                                            <span class="detail-label">Teléfono</span>
                                            <span class="detail-value">+52 271 123 4567</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Licencia</span>
                                            <span class="detail-value">LIC-2024-001</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Vencimiento</span>
                                            <span class="detail-value">15/12/2025</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Camión</span>
                                            <span class="detail-value">CAM-001</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="driver-card-footer">
                                    <span class="status-badge status-ocupado">En Viaje</span>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <button class="btn btn-secondary btn-sm">👁️</button>
                                        <button class="btn btn-warning btn-sm">✏️</button>
                                    </div>
                                </div>
                            </div>

                            <div class="driver-card">
                                <div class="driver-card-header">
                                    <div class="driver-name">María González López</div>
                                    <div class="driver-id">CH-002</div>
                                </div>
                                <div class="driver-card-body">
                                    <div class="driver-details">
                                        <div class="detail-item">
                                            <span class="detail-label">Teléfono</span>
                                            <span class="detail-value">+52 271 234 5678</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Licencia</span>
                                            <span class="detail-value">LIC-2024-002</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Vencimiento</span>
                                            <span class="detail-value">08/07/2024</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Camión</span>
                                            <span class="detail-value">CAM-002</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="driver-card-footer">
                                    <span class="status-badge status-vencida">Licencia Vencida</span>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <button class="btn btn-secondary btn-sm">👁️</button>
                                        <button class="btn btn-danger btn-sm">⚠️</button>
                                    </div>
                                </div>
                            </div>

                            <div class="driver-card">
                                <div class="driver-card-header">
                                    <div class="driver-name">Carlos López Martínez</div>
                                    <div class="driver-id">CH-003</div>
                                </div>
                                <div class="driver-card-body">
                                    <div class="driver-details">
                                        <div class="detail-item">
                                            <span class="detail-label">Teléfono</span>
                                            <span class="detail-value">+52 271 345 6789</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Licencia</span>
                                            <span class="detail-value">LIC-2024-003</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Vencimiento</span>
                                            <span class="detail-value">22/11/2025</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Camión</span>
                                            <span class="detail-value">Sin asignar</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="driver-card-footer">
                                    <span class="status-badge status-disponible">Disponible</span>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <button class="btn btn-secondary btn-sm">👁️</button>
                                        <button class="btn btn-success btn-sm">🚛</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Control de Licencias -->
                    <div class="tab-content" id="licencias">
                        <div class="table-header">
                            <h3 class="table-title">Control de Vigencia de Licencias</h3>
                            <div class="table-actions">
                                <button class="btn btn-warning btn-sm">⚠️ Próximas a Vencer</button>
                                <button class="btn btn-secondary btn-sm">📊 Reporte</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Conductor</th>
                                        <th>Número de Licencia</th>
                                        <th>Tipo</th>
                                        <th>Fecha de Expedición</th>
                                        <th>Fecha de Vencimiento</th>
                                        <th>Días Restantes</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Juan Pérez García</strong></td>
                                        <td>LIC-2024-001</td>
                                        <td>Tipo A</td>
                                        <td>15/12/2020</td>
                                        <td>15/12/2025</td>
                                        <td>191 días</td>
                                        <td><span class="status-badge status-vigente">Vigente</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">📄</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>María González López</strong></td>
                                        <td>LIC-2024-002</td>
                                        <td>Tipo A</td>
                                        <td>08/07/2019</td>
                                        <td>08/07/2024</td>
                                        <td>-1 día</td>
                                        <td><span class="status-badge status-vencida">Vencida</span></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">🚨 Renovar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Carlos López Martínez</strong></td>
                                        <td>LIC-2024-003</td>
                                        <td>Tipo A</td>
                                        <td>22/11/2020</td>
                                        <td>22/11/2025</td>
                                        <td>137 días</td>
                                        <td><span class="status-badge status-vigente">Vigente</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">📄</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ana Martínez Rodríguez</strong></td>
                                        <td>LIC-2024-004</td>
                                        <td>Tipo A</td>
                                        <td>30/06/2019</td>
                                        <td>30/06/2024</td>
                                        <td>-7 días</td>
                                        <td><span class="status-badge status-vencida">Vencida</span></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">🚨 Renovar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Roberto Silva Hernández</strong></td>
                                        <td>LIC-2024-005</td>
                                        <td>Tipo A</td>
                                        <td>18/09/2020</td>
                                        <td>18/09/2025</td>
                                        <td>103 días</td>
                                        <td><span class="status-badge status-vigente">Vigente</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">📄</button>
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
            if (document.getElementById('searchConductores')) {
                document.getElementById('searchConductores').addEventListener('input', function() {
                    filtrarConductores(this.value);
                });
            }

            if (document.getElementById('searchTarjetas')) {
                document.getElementById('searchTarjetas').addEventListener('input', function() {
                    filtrarTarjetas(this.value);
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

        function filtrarConductores(termino) {
            const rows = document.querySelectorAll('#conductores tbody tr');
            
            rows.forEach(row => {
                const texto = row.textContent.toLowerCase();
                if (texto.includes(termino.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filtrarTarjetas(termino) {
            const cards = document.querySelectorAll('.driver-card');
            
            cards.forEach(card => {
                const texto = card.textContent.toLowerCase();
                if (texto.includes(termino.toLowerCase())) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function filtrarPorEstado(estado) {
            const rows = document.querySelectorAll('#conductores tbody tr');
            
            rows.forEach(row => {
                const statusBadge = row.querySelector('.status-badge');
                if (statusBadge) {
                    const estadoConductor = statusBadge.className.split('status-')[1].split(' ')[0];
                    if (!estado || estadoConductor === estado) {
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