<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Gestión de Mantenimiento</title>
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

        .stat-programado {
            color: #007bff;
        }

        .stat-proceso {
            color: #ffc107;
        }

        .stat-completado {
            color: #28a745;
        }

        .stat-urgente {
            color: #dc3545;
        }

        .stat-costo {
            color: #6f42c1;
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

        .status-programado {
            background: #e3f2fd;
            color: #1565c0;
        }

        .status-proceso {
            background: #fff8e1;
            color: #f57c00;
        }

        .status-completado {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .status-urgente {
            background: #ffebee;
            color: #c62828;
        }

        .status-pendiente {
            background: #f3e5f5;
            color: #7b1fa2;
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
                <a href="/dashboard">📊 Panel Administrativo</a>
            </li>
            <li>
                <a href="/camiones">🚛 Camiones</a>
            </li>
            <li>
                <a href="/viajes">📋 Viajes</a>
            </li>
            <li>
                <a href="/mantenimiento" class="active">🔧 Mantenimiento</a>
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
                    <h1 class="navbar-title">Gestión de Mantenimiento</h1>
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
                        <h1 class="page-title">Gestión de Mantenimiento</h1>
                        <p class="page-subtitle">Administra el mantenimiento preventivo y correctivo de la flotilla</p>
                    </div>
                    <button class="btn btn-primary" onclick="window.location.href='/registrarMantenimiento'">
                        ➕ Registrar Mantenimiento
                    </button>
                </div>

                <!-- Alertas de Mantenimiento -->
                <div class="alert-card urgent">
                    <div class="alert-title">🚨 Mantenimientos Urgentes</div>
                    <p>3 unidades requieren mantenimiento inmediato por kilometraje excedido</p>
                </div>

                <div class="alert-card">
                    <div class="alert-title">⚠️ Próximos Vencimientos</div>
                    <p>5 pólizas de seguro vencen en los próximos 30 días</p>
                </div>
                
                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-number stat-programado" id="programados">8</div>
                        <div class="stat-label">Programados</div>
                        <div class="stat-sublabel">Próximos 15 días</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-proceso" id="proceso">4</div>
                        <div class="stat-label">En Proceso</div>
                        <div class="stat-sublabel">Actualmente en taller</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-completado" id="completados">23</div>
                        <div class="stat-label">Completados</div>
                        <div class="stat-sublabel">Este mes</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-urgente" id="urgentes">3</div>
                        <div class="stat-label">Urgentes</div>
                        <div class="stat-sublabel">Requieren atención</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-costo" id="costoTotal">$45,200</div>
                        <div class="stat-label">Costo Total</div>
                        <div class="stat-sublabel">Este mes</div>
                    </div>
                </div>

                <!-- Tabs Container -->
                <div class="tabs-container">
                    <div class="tabs-header">
                        <button class="tab-button active" data-tab="mantenimientos">🔧 Mantenimientos</button>
                        <button class="tab-button" data-tab="preventivo">📅 Preventivo</button>
                        <button class="tab-button" data-tab="documentos">📄 Documentos</button>
                    </div>

                    <!-- Tab: Lista de Mantenimientos -->
                    <div class="tab-content active" id="mantenimientos">
                        <div class="table-header">
                            <h3 class="table-title">Registro de Mantenimientos</h3>
                            <div class="table-actions">
                                <input type="text" class="search-input" placeholder="Buscar mantenimiento..." id="searchMantenimientos">
                                <select class="search-input" style="max-width: 150px;" id="filterTipo">
                                    <option value="">Todos los tipos</option>
                                    <option value="preventivo">Preventivo</option>
                                    <option value="correctivo">Correctivo</option>
                                    <option value="emergencia">Emergencia</option>
                                </select>
                                <button class="btn btn-secondary btn-sm">📊 Reporte</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Camión</th>
                                        <th>Tipo</th>
                                        <th>Descripción</th>
                                        <th>Fecha</th>
                                        <th>Costo</th>
                                        <th>Proveedor</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>MNT-001</strong></td>
                                        <td>CAM-001</td>
                                        <td><span class="status-badge status-programado">Preventivo</span></td>
                                        <td>Cambio de aceite y filtros</td>
                                        <td>15/06/2024</td>
                                        <td>$2,500.00</td>
                                        <td>Taller López</td>
                                        <td><span class="status-badge status-completado">Completado</span></td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-warning btn-sm">✏️</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>MNT-002</strong></td>
                                        <td>CAM-003</td>
                                        <td><span class="status-badge status-urgente">Correctivo</span></td>
                                        <td>Reparación de transmisión</td>
                                        <td>10/06/2024</td>
                                        <td>$15,800.00</td>
                                        <td>Mecánica Industrial</td>
                                        <td><span class="status-badge status-proceso">En Proceso</span></td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-warning btn-sm">✏️</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>MNT-003</strong></td>
                                        <td>CAM-002</td>
                                        <td><span class="status-badge status-programado">Preventivo</span></td>
                                        <td>Revisión de frenos</td>
                                        <td>20/06/2024</td>
                                        <td>$3,200.00</td>
                                        <td>AutoServicio Central</td>
                                        <td><span class="status-badge status-programado">Programado</span></td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button class="btn btn-secondary btn-sm">👁️</button>
                                                <button class="btn btn-warning btn-sm">✏️</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>MNT-004</strong></td>
                                        <td>CAM-004</td>
                                        <td><span class="status-badge status-urgente">Emergencia</span></td>
                                        <td>Falla en sistema eléctrico</td>
                                        <td>08/06/2024</td>
                                        <td>$8,500.00</td>
                                        <td>Eléctrica Automotriz</td>
                                        <td><span class="status-badge status-proceso">En Proceso</span></td>
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

                   <!-- Tab: Mantenimiento Preventivo -->
                    <div class="tab-content" id="preventivo">
                        <div class="table-header">
                            <h3 class="table-title">Programación de Mantenimientos Preventivos</h3>
                            <div class="table-actions">
                                <button class="btn btn-primary btn-sm">📅 Programar</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Camión</th>
                                        <th>Kilometraje Actual</th>
                                        <th>Próximo Servicio</th>
                                        <th>Km Restantes</th>
                                        <th>Tipo de Servicio</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>CAM-001</strong></td>
                                        <td>125,000 km</td>
                                        <td>130,000 km</td>
                                        <td>5,000 km</td>
                                        <td>Mantenimiento Mayor</td>
                                        <td><span class="status-badge status-programado">Normal</span></td>
                                        <td>
                                            <button class="btn btn-success btn-sm">📅 Programar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CAM-002</strong></td>
                                        <td>98,500 km</td>
                                        <td>100,000 km</td>
                                        <td>1,500 km</td>
                                        <td>Cambio de Aceite</td>
                                        <td><span class="status-badge status-urgente">Urgente</span></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">🚨 Urgente</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CAM-003</strong></td>
                                        <td>87,200 km</td>
                                        <td>90,000 km</td>
                                        <td>2,800 km</td>
                                        <td>Revisión General</td>
                                        <td><span class="status-badge status-programado">Normal</span></td>
                                        <td>
                                            <button class="btn btn-success btn-sm">📅 Programar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <<!-- Tab: Control de Documentos -->
                    <div class="tab-content" id="documentos">
                        <div class="table-header">
                            <h3 class="table-title">Control de Documentos y Vigencias</h3>
                            <div class="table-actions">
                                <button class="btn btn-primary btn-sm">📄 Nuevo Documento</button>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Camión</th>
                                        <th>Tipo de Documento</th>
                                        <th>Número</th>
                                        <th>Vigencia</th>
                                        <th>Días Restantes</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>CAM-001</strong></td>
                                        <td>Póliza de Seguro</td>
                                        <td>POL-2024-001</td>
                                        <td>15/08/2024</td>
                                        <td>68 días</td>
                                        <td><span class="status-badge status-programado">Vigente</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">📄</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CAM-002</strong></td>
                                        <td>Tarjeta de Circulación</td>
                                        <td>TC-2024-002</td>
                                        <td>25/06/2024</td>
                                        <td>18 días</td>
                                        <td><span class="status-badge status-urgente">Por Vencer</span></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm">⚠️ Renovar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CAM-003</strong></td>
                                        <td>Permiso SCT</td>
                                        <td>SCT-2024-003</td>
                                        <td>30/12/2024</td>
                                        <td>205 días</td>
                                        <td><span class="status-badge status-completado">Vigente</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">📄</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CAM-004</strong></td>
                                        <td>Verificación Ambiental</td>
                                        <td>VA-2024-004</td>
                                        <td>05/06/2024</td>
                                        <td>-2 días</td>
                                        <td><span class="status-badge status-urgente">Vencido</span></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">🚨 Renovar Ya</button>
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
        document.addEventListener('DOMContentLoaded', function () {
            setupEventListeners();
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

            // Tab navigation
            document.querySelectorAll('.tab-button').forEach(button => {
                button.addEventListener('click', function () {
                    const tabId = this.getAttribute('data-tab');
                    cambiarTab(tabId);
                });
            });

            // Search functionality
            if (document.getElementById('searchMantenimientos')) {
                document.getElementById('searchMantenimientos').addEventListener('input', function () {
                    filtrarMantenimientos(this.value);
                });
            }

            // Filter by type
            if (document.getElementById('filterTipo')) {
                document.getElementById('filterTipo').addEventListener('change', function () {
                    filtrarPorTipo(this.value);
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

        function filtrarMantenimientos(termino) {
            const rows = document.querySelectorAll('#mantenimientos tbody tr');

            rows.forEach(row => {
                const texto = row.textContent.toLowerCase();
                if (texto.includes(termino.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filtrarPorTipo(tipo) {
            const rows = document.querySelectorAll('#mantenimientos tbody tr');

            rows.forEach(row => {
                const tipoCell = row.cells[2].textContent.toLowerCase();
                if (!tipo || tipoCell.includes(tipo.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
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