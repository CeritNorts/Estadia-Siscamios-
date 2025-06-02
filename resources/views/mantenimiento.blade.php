<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Mantenimiento de Unidades</title>
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

        .sidebar-menu-icon {
            width: 20px;
            height: 20px;
            background: currentColor;
            mask: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>') no-repeat center;
            mask-size: contain;
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

        /* Quick Stats */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #667eea;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card.warning {
            border-left-color: #ffc107;
        }

        .stat-card.danger {
            border-left-color: #dc3545;
        }

        .stat-card.success {
            border-left-color: #28a745;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .stat-number.warning { color: #ffc107; }
        .stat-number.danger { color: #dc3545; }
        .stat-number.success { color: #28a745; }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Content Cards */
        .content-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .content-card h2 {
            color: #333;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 2rem;
        }

        .tab {
            padding: 1rem 1.5rem;
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .tab:hover {
            background: rgba(102, 126, 234, 0.1);
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
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
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            margin-top: 1rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
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

        .status-pendiente { background: #fff3cd; color: #856404; }
        .status-proceso { background: #cce5ff; color: #0056b3; }
        .status-completado { background: #d4edda; color: #155724; }
        .status-vencido { background: #f8d7da; color: #721c24; }
        .status-alerta { background: #ffeaa7; color: #d63031; }

        /* Forms */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Alert Cards */
        .alert-card {
            background: white;
            border-left: 4px solid #ffc107;
            padding: 1.5rem;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .alert-card.danger {
            border-left-color: #dc3545;
        }

        .alert-header {
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .alert-content {
            color: #666;
            font-size: 0.9rem;
        }

        /* Progress Bar */
        .progress {
            background: #e9ecef;
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
            margin: 0.5rem 0;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s ease;
        }

        .progress-bar.danger {
            background: #dc3545;
        }

        .progress-bar.warning {
            background: #ffc107;
        }

        .progress-bar.success {
            background: #28a745;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .close {
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            color: #999;
        }

        .close:hover {
            color: #333;
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

            .quick-stats {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .tabs {
                flex-wrap: wrap;
            }

            .tab {
                flex: 1;
                min-width: 120px;
            }
        }

        /* Utilities */
        .d-flex { display: flex; }
        .justify-between { justify-content: space-between; }
        .align-center { align-items: center; }
        .gap-1 { gap: 0.5rem; }
        .gap-2 { gap: 1rem; }
        .mb-2 { margin-bottom: 1rem; }
        .mt-2 { margin-top: 1rem; }
        .text-center { text-align: center; }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
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
                    <span class="sidebar-menu-icon"></span>
                    Panel Administrativo
                </a>
            </li>
            <li>
                <a href="/camiones">
                    <span class="sidebar-menu-icon"></span>
                    Camiones
                </a>
            </li>
            <li>
                <a href="/viajes">
                    <span class="sidebar-menu-icon"></span>
                    Viajes
                </a>
            </li>
            <li>
                <a href="/mantenimiento" class="active">
                    <span class="sidebar-menu-icon"></span>
                    Mantenimiento
                </a>
            </li>
            <li>
                <a href="/conductores">
                    <span class="sidebar-menu-icon"></span>
                    Conductores
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
                    <h1 class="navbar-title">Mantenimiento de Unidades</h1>
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
                    <h1 class="page-title">🔧 Mantenimiento de Unidades</h1>
                    <p class="page-subtitle">Gestión integral de mantenimientos preventivos y correctivos</p>
                </div>

                <!-- Quick Stats -->
                <div class="quick-stats">
                    <div class="stat-card danger">
                        <div class="stat-number danger">3</div>
                        <div class="stat-label">Mantenimientos Vencidos</div>
                    </div>
                    <div class="stat-card warning">
                        <div class="stat-number warning">5</div>
                        <div class="stat-label">Próximos a Vencer</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">7</div>
                        <div class="stat-label">En Proceso</div>
                    </div>
                    <div class="stat-card success">
                        <div class="stat-number success">12</div>
                        <div class="stat-label">Completados (Este Mes)</div>
                    </div>
                </div>

                <!-- Alerts Section -->
                <div class="content-card">
                    <h2>🚨 Alertas Prioritarias</h2>
                    
                    <div class="alert-card danger">
                        <div class="alert-header">CAM-003 - Mantenimiento Mayor Vencido</div>
                        <div class="alert-content">
                            Última revisión: 15/03/2024 | Vencimiento: 15/05/2024 | Días transcurridos: 15
                        </div>
                    </div>

                    <div class="alert-card">
                        <div class="alert-header">CAM-007 - Seguro por Vencer</div>
                        <div class="alert-content">
                            Póliza vence: 10/06/2024 | Quedan 11 días | Aseguradora: Seguros Atlas
                        </div>
                    </div>

                    <div class="alert-card">
                        <div class="alert-header">CAM-001 - Próximo Servicio Preventivo</div>
                        <div class="alert-content">
                            Kilometraje actual: 48,500 km | Próximo servicio: 50,000 km | Faltan 1,500 km
                        </div>
                    </div>
                </div>

                <!-- Main Content with Tabs -->
                <div class="content-card">
                    <div class="tabs">
                        <button class="tab active" onclick="showTab('preventivo')">🔄 Mantenimiento Preventivo</button>
                        <button class="tab" onclick="showTab('reparaciones')">🔨 Registro de Reparaciones</button>
                        <button class="tab" onclick="showTab('documentos')">📋 Control de Documentos</button>
                    </div>

                    <!-- Mantenimiento Preventivo Tab -->
                    <div id="preventivo" class="tab-content active">
                        <div class="d-flex justify-between align-center mb-2">
                            <h3>Programación de Mantenimientos Preventivos</h3>
                            <button class="btn btn-primary" onclick="openModal('nuevoMantenimiento')">+ Programar Mantenimiento</button>
                        </div>

                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Unidad</th>
                                        <th>Tipo de Servicio</th>
                                        <th>Último Servicio</th>
                                        <th>Próximo Servicio</th>
                                        <th>Kilometraje Actual</th>
                                        <th>Progreso</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>CAM-001</strong></td>
                                        <td>Servicio Mayor</td>
                                        <td>20/04/2024</td>
                                        <td>20/07/2024</td>
                                        <td>48,500 km</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 85%"></div>
                                            </div>
                                            85%
                                        </td>
                                        <td><span class="status-badge status-alerta">Próximo</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">Ver</button>
                                            <button class="btn btn-warning btn-sm">Programar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CAM-002</strong></td>
                                        <td>Cambio de Aceite</td>
                                        <td>10/05/2024</td>
                                        <td>10/08/2024</td>
                                        <td>32,800 km</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar success" style="width: 45%"></div>
                                            </div>
                                            45%
                                        </td>
                                        <td><span class="status-badge status-completado">Al día</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">Ver</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>CAM-003</strong></td>
                                        <td>Revisión Frenos</td>
                                        <td>15/03/2024</td>
                                        <td>15/05/2024</td>
                                        <td>55,200 km</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar danger" style="width: 100%"></div>
                                            </div>
                                            Vencido
                                        </td>
                                        <td><span class="status-badge status-vencido">Vencido</span></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">Urgente</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Registro de Reparaciones Tab -->
                    <div id="reparaciones" class="tab-content">
                        <div class="d-flex justify-between align-center mb-2">
                            <h3>Registro de Reparaciones</h3>
                            <button class="btn btn-primary" onclick="openModal('nuevaReparacion')">+ Registrar Reparación</button>
                        </div>

                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Unidad</th>
                                        <th>Tipo de Reparación</th>
                                        <th>Proveedor</th>
                                        <th>Refacciones</th>
                                        <th>Costo Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>25/05/2024</td>
                                        <td><strong>CAM-004</strong></td>
                                        <td>Reparación Motor</td>
                                        <td>Taller González</td>
                                        <td>Kit de Empaques, Filtros</td>
                                        <td>$15,750.00</td>
                                        <td><span class="status-badge status-proceso">En Proceso</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">Ver</button>
                                            <button class="btn btn-warning btn-sm">Editar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>20/05/2024</td>
                                        <td><strong>CAM-001</strong></td>
                                        <td>Cambio de Llantas</td>
                                        <td>Llantera Central</td>
                                        <td>4 Llantas 295/75R22.5</td>
                                        <td>$8,200.00</td>
                                        <td><span class="status-badge status-completado">Completado</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">Ver</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>18/05/2024</td>
                                        <td><strong>CAM-002</strong></td>
                                        <td>Reparación Sistema Eléctrico</td>
                                        <td>Eléctrica Hernández</td>
                                        <td>Alternador, Cables</td>
                                        <td>$3,450.00</td>
                                        <td><span class="status-badge status-completado">Completado</span></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm">Ver</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Resumen de Costos -->
                        <div class="form-grid mt-2">
                            <div class="stat-card">
                                <div class="stat-number">$27,400</div>
                                <div class="stat-label">Gastos de Mantenimiento (Este Mes)</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">$145,750</div>
                                <div class="stat-label">Gastos Acumulados (2024)</div>
                            </div>
                        </div>
                    </div>

                    <!-- Control de Documentos Tab -->
                    <div id="documentos" class="tab-content">
                        <div class="d-flex justify-between align-center mb-2">
                            <h3>Control de Documentos y Vigencias</h3>
                            <button class="btn btn-primary" onclick="openModal('nuevoDocumento')">+ Agregar Documento</button>
                        </div>

                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Unidad</th>
                                        <th>Tipo de Documento</th>
                                        <th>Número</th>
                                        <th>Emisión</th>
                                        <th>Vencimiento</th>
                                        <th>Días Restantes</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>CAM-001</strong></td>
                                        <td>Póliza de Seguro</td>
                                        <td>POL-2024-