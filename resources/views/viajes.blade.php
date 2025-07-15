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
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: background 0.3s ease;
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
            align-items: center;
        }

        .navbar-links a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover {
            color: #667eea;
        }

        .datetime-display {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.25rem;
        }

        .current-date {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        .current-time {
            font-size: 1rem;
            color: #333;
            font-weight: 600;
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
        .stat-total { color: #6f42c1; }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem;
            border-bottom: 1px solid #eee;
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

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-state .empty-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Cards for mobile table */
        .mobile-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            padding: 1rem;
            border-left: 4px solid #667eea;
            display: none;
        }

        .mobile-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .mobile-card .card-title {
            font-weight: 600;
            color: #333;
            font-size: 1.1rem;
        }

        .mobile-card .card-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .mobile-card .info-item {
            display: flex;
            flex-direction: column;
        }

        .mobile-card .info-label {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .mobile-card .info-value {
            font-size: 0.9rem;
            color: #333;
        }

        .mobile-card .card-actions {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        /* Mobile Responsive */
        @media (max-width: 1200px) {
            .content {
                padding: 1.5rem;
            }
            
            .dashboard-stats {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 260px;
            }
            
            .dashboard-stats {
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            }

            .table-actions {
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            .search-input {
                min-width: 150px;
            }
        }

        @media (max-width: 768px) {
            body {
                height: auto;
                min-height: 100vh;
            }

            .sidebar {
                position: fixed;
                transform: translateX(-100%);
                height: 100vh;
                z-index: 1001;
                width: 280px;
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
                flex-wrap: wrap;
                gap: 1rem;
            }

            .navbar-content > div:last-child {
                order: 1;
                width: 100%;
                justify-content: space-between;
                display: flex;
                align-items: center;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .navbar-title {
                font-size: 1.1rem;
            }

            .current-date {
                font-size: 0.8rem;
            }

            .current-time {
                font-size: 0.9rem;
            }

            .datetime-display {
                align-items: flex-start;
            }

            .content {
                padding: 1rem;
            }

            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.75rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .page-title {
                font-size: 1.75rem;
            }

            .table-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
                padding: 1.5rem;
            }

            .table-actions {
                justify-content: center;
                flex-direction: column;
                align-items: stretch;
            }

            .search-input {
                min-width: unset;
                width: 100%;
            }

            /* Hide table, show cards on mobile */
            .table {
                display: none;
            }

            .mobile-card {
                display: block;
            }

            .btn {
                padding: 0.875rem 1.25rem;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .navbar-content {
                padding: 0.75rem;
            }

            .sidebar-toggle {
                padding: 0.375rem;
                font-size: 1.25rem;
            }

            .content {
                padding: 0.75rem;
            }

            .sidebar {
                width: calc(100% - 60px);
                max-width: 300px;
            }

            .sidebar-header {
                padding: 1.5rem 1.25rem;
            }

            .sidebar-brand {
                font-size: 1.25rem;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 1.25rem;
            }

            .stat-number {
                font-size: 2.25rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
            }

            .table-container {
                border-radius: 8px;
            }

            .table-header {
                padding: 1rem;
            }

            .table-title {
                font-size: 1.25rem;
            }

            .mobile-card {
                padding: 1.25rem;
            }

            .mobile-card .card-info {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .datetime-display {
                order: -1;
                width: auto;
                align-items: flex-start;
                margin-bottom: 0;
            }
        }

        @media (max-width: 320px) {
            .content {
                padding: 0.5rem;
            }

            .sidebar {
                width: calc(100% - 50px);
                max-width: 280px;
            }

            .sidebar-menu a {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            .sidebar-header {
                padding: 1.25rem 1rem;
            }

            .sidebar-brand {
                font-size: 1.1rem;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .navbar-title {
                font-size: 1rem;
            }

            .table-header {
                padding: 0.75rem;
            }

            .mobile-card {
                padding: 1rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        /* Landscape orientation on mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .content {
                padding: 0.75rem;
            }

            .page-header {
                margin-bottom: 1rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .dashboard-stats {
                grid-template-columns: repeat(3, 1fr);
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

        /* Print styles */
        @media print {
            .sidebar,
            .navbar,
            .btn,
            .table-actions {
                display: none;
            }

            .main-content {
                width: 100%;
            }

            .content {
                padding: 0;
            }

            .table-container {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .mobile-card {
                display: none;
            }

            .table {
                display: table !important;
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
                <a href="/viajes" class="active">
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
                <a href="/combustible">⛽ Combustible</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info" onclick="goToProfile()">
                <div class="user-avatar">
                    @auth
                        {{ substr(auth()->user()->name, 0, 2) }}
                    @else
                        AD
                    @endauth
                </div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">
                        @auth
                            {{ auth()->user()->name }}
                        @else
                            Administrador
                        @endauth
                    </div>
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
                    <div class="datetime-display">
                        <div class="current-date" id="currentDate"></div>
                        <div class="current-time" id="currentTime"></div>
                    </div>
                    <a href="#" onclick="logout()">Cerrar Sesión</a>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="content-wrapper fade-in">

                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        ❌ {{ session('error') }}
                    </div>
                @endif
                
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Gestión de Viajes</h1>
                        <p class="page-subtitle">Administra y supervisa todos los viajes de la flotilla</p>
                    </div>
                    <a href="{{ route('viajes.create') }}" class="btn btn-primary">
                        ➕ Asignar Nuevo Viaje
                    </a>
                </div>
                
                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-number stat-programados">{{ $viajes->where('estado', 'programado')->count() }}</div>
                        <div class="stat-label">Programados</div>
                        <div class="stat-sublabel">Próximos viajes</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-transito">{{ $viajes->where('estado', 'transito')->count() }}</div>
                        <div class="stat-label">En Tránsito</div>
                        <div class="stat-sublabel">Actualmente en ruta</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-entregados">{{ $viajes->where('estado', 'entregado')->count() }}</div>
                        <div class="stat-label">Entregados</div>
                        <div class="stat-sublabel">Completados</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-retrasados">{{ $viajes->where('estado', 'retrasado')->count() }}</div>
                        <div class="stat-label">Retrasados</div>
                        <div class="stat-sublabel">Requieren atención</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-total">{{ $viajes->count() }}</div>
                        <div class="stat-label">Total Viajes</div>
                        <div class="stat-sublabel">En el sistema</div>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="table-container">
                    <div class="table-header">
                        <h3 class="table-title">Lista de Viajes</h3>
                        <div class="table-actions">
                            <input type="text" class="search-input" placeholder="Buscar viaje..." id="searchViajes">
                            <select class="search-input" style="max-width: 150px;" id="filterEstado">
                                <option value="">Todos los estados</option>
                                <option value="programado">Programados</option>
                                <option value="transito">En Tránsito</option>
                                <option value="entregado">Entregados</option>
                                <option value="retrasado">Retrasados</option>
                                <option value="espera">En Espera</option>
                            </select>
                            <a href="{{ route('viajes.create') }}" class="btn btn-primary btn-sm">➕ Nuevo Viaje</a>
                        </div>
                    </div>
                    
                    
                    @if($viajes->count() > 0)
                        <!-- Desktop Table -->
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
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="viajesTableBody">
                                @foreach($viajes as $viaje)
                                    <tr data-estado="{{ $viaje->estado }}">
                                        <td><strong>VJ-{{ str_pad($viaje->id, 3, '0', STR_PAD_LEFT) }}</strong></td>
                                        <td>
                                            @if($viaje->camion)
                                                {{ $viaje->camion->placa ?? $viaje->camion->modelo ?? 'CAM-' . str_pad($viaje->camion->id, 3, '0', STR_PAD_LEFT) }}
                                            @else
                                                Sin asignar
                                            @endif
                                        </td>
                                        <td>
                                            @if($viaje->chofer)
                                                {{ $viaje->chofer->nombre }}
                                            @else
                                                Sin asignar
                                            @endif
                                        </td>
                                        <td>
                                            @if($viaje->cliente)
                                                {{ $viaje->cliente->nombre }}
                                            @else
                                                Sin cliente
                                            @endif
                                        </td>
                                        <td>{{ $viaje->ruta }}</td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/Y') }}</div>
                                            <div style="font-size: 0.8rem; color: #666;">{{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('H:i') }}</div>
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($viaje->fecha_llegada)->format('d/m/Y') }}</div>
                                            <div style="font-size: 0.8rem; color: #666;">{{ \Carbon\Carbon::parse($viaje->fecha_llegada)->format('H:i') }}</div>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $viaje->estado }}">
                                                @switch($viaje->estado)
                                                    @case('programado')
                                                        📅 Programado
                                                        @break
                                                    @case('transito')
                                                        🚛 En Tránsito
                                                        @break
                                                    @case('entregado')
                                                        ✅ Entregado
                                                        @break
                                                    @case('retrasado')
                                                        ⚠️ Retrasado
                                                        @break
                                                    @case('espera')
                                                        ⏳ En Espera
                                                        @break
                                                    @default
                                                        {{ ucfirst($viaje->estado) }}
                                                @endswitch
                                            </span>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button onclick="mostrarDetalles('viaje', {{ $viaje->id }}, {{ json_encode($viaje) }})" 
                                                    class="btn btn-secondary btn-sm" title="Ver Detalles">👁️</button>
                                                <a href="{{ route('viajes.edit', $viaje->id) }}" 
                                                   class="btn btn-warning btn-sm" 
                                                   title="Editar">✏️</a>
                                                <form action="{{ route('viajes.destroy', $viaje->id) }}" 
                                                      method="POST" 
                                                      style="display: inline;"
                                                      onsubmit="return confirm('¿Está seguro de que desea eliminar este viaje?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm" 
                                                            title="Eliminar">🗑️</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Mobile Cards -->
                        <div class="mobile-cards" id="mobileCards">
                            @foreach($viajes as $viaje)
                                <div class="mobile-card" data-estado="{{ $viaje->estado }}">
                                    <div class="card-header">
                                        <div class="card-title">VJ-{{ str_pad($viaje->id, 3, '0', STR_PAD_LEFT) }}</div>
                                        <span class="status-badge status-{{ $viaje->estado }}">
                                            @switch($viaje->estado)
                                                @case('programado')
                                                    📅 Programado
                                                    @break
                                                @case('transito')
                                                    🚛 En Tránsito
                                                    @break
                                                @case('entregado')
                                                    ✅ Entregado
                                                    @break
                                                @case('retrasado')
                                                    ⚠️ Retrasado
                                                    @break
                                                @case('espera')
                                                    ⏳ En Espera
                                                    @break
                                                @default
                                                    {{ ucfirst($viaje->estado) }}
                                            @endswitch
                                        </span>
                                    </div>
                                    <div class="card-info">
                                        <div class="info-item">
                                            <div class="info-label">Camión</div>
                                            <div class="info-value">
                                                @if($viaje->camion)
                                                    {{ $viaje->camion->placa ?? $viaje->camion->modelo ?? 'CAM-' . str_pad($viaje->camion->id, 3, '0', STR_PAD_LEFT) }}
                                                @else
                                                    Sin asignar
                                                @endif
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Conductor</div>
                                            <div class="info-value">
                                                @if($viaje->chofer)
                                                    {{ $viaje->chofer->nombre }}
                                                @else
                                                    Sin asignar
                                                @endif
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Cliente</div>
                                            <div class="info-value">
                                                @if($viaje->cliente)
                                                    {{ $viaje->cliente->nombre }}
                                                @else
                                                    Sin cliente
                                                @endif
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Ruta</div>
                                            <div class="info-value">{{ $viaje->ruta }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Salida</div>
                                            <div class="info-value">{{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/Y H:i') }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Llegada</div>
                                            <div class="info-value">{{ \Carbon\Carbon::parse($viaje->fecha_llegada)->format('d/m/Y H:i') }}</div>
                                        </div>
                                    </div>
                                    <div class="card-actions">
                                        <a href="{{ route('viajes.show', $viaje->id) }}" class="btn btn-secondary btn-sm">👁️ Ver</a>
                                        <a href="{{ route('viajes.edit', $viaje->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                                        <form action="{{ route('viajes.destroy', $viaje->id) }}" 
                                              method="POST" 
                                              style="display: inline;"
                                              onsubmit="return confirm('¿Está seguro de que desea eliminar este viaje?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">📋</div>
                            <h3>No hay viajes registrados</h3>
                            <p>Comienza creando tu primer viaje para ver la información aquí.</p>
                            <a href="{{ route('viajes.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                ➕ Crear Primer Viaje
                            </a>
                        </div>
                    @endif<div class="mobile-card" data-estado="entregado">
                            <div class="card-header">
                                <div class="card-title">VJ-003</div>
                                <span class="status-badge status-entregado">✅ Entregado</span>
                            </div>
                            <div class="card-info">
                                <div class="info-item">
                                    <div class="info-label">Camión</div>
                                    <div class="info-value">GHI-9012</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Conductor</div>
                                    <div class="info-value">Carlos Rodríguez</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Cliente</div>
                                    <div class="info-value">Distribuidora Central</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Ruta</div>
                                    <div class="info-value">Puebla - Veracruz</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Salida</div>
                                    <div class="info-value">13/07/2025 10:00</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Llegada</div>
                                    <div class="info-value">13/07/2025 16:30</div>
                                </div>
                            </div>
                            <div class="card-actions">
                                <a href="/viajes/3" class="btn btn-secondary btn-sm">👁️ Ver</a>
                                <a href="/viajes/3/edit" class="btn btn-warning btn-sm">✏️ Editar</a>
                                <button onclick="eliminarViaje(3)" class="btn btn-danger btn-sm">🗑️</button>
                            </div>
                        </div>

                        <div class="mobile-card" data-estado="retrasado">
                            <div class="card-header">
                                <div class="card-title">VJ-004</div>
                                <span class="status-badge status-retrasado">⚠️ Retrasado</span>
                            </div>
                            <div class="card-info">
                                <div class="info-item">
                                    <div class="info-label">Camión</div>
                                    <div class="info-value">JKL-3456</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Conductor</div>
                                    <div class="info-value">Ana Martínez</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Cliente</div>
                                    <div class="info-value">Logística Express</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Ruta</div>
                                    <div class="info-value">Cancún - Mérida</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Salida</div>
                                    <div class="info-value">12/07/2025 14:00</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Llegada</div>
                                    <div class="info-value">13/07/2025 22:00</div>
                                </div>
                            </div>
                            <div class="card-actions">
                                <a href="/viajes/4" class="btn btn-secondary btn-sm">👁️ Ver</a>
                                <a href="/viajes/4/edit" class="btn btn-warning btn-sm">✏️ Editar</a>
                                <button onclick="eliminarViaje(4)" class="btn btn-danger btn-sm">🗑️</button>
                            </div>
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
            updateDateTime();
            setInterval(updateDateTime, 1000);
            updateStats();
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

            // Close sidebar on window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
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

        function updateDateTime() {
            const now = new Date();
            const dateOptions = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            const timeOptions = { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit',
                hour12: true
            };

            document.getElementById('currentDate').textContent = now.toLocaleDateString('es-ES', dateOptions);
            document.getElementById('currentTime').textContent = now.toLocaleTimeString('es-ES', timeOptions);
        }

        function updateStats() {
            // Stats are now calculated server-side with Laravel
            // This function can be used for any dynamic updates if needed
            console.log('Stats updated from server data');
        }

        function filtrarViajes(termino) {
            const tableRows = document.querySelectorAll('#viajesTableBody tr');
            const mobileCards = document.querySelectorAll('.mobile-card');
            
            // Filter table rows
            tableRows.forEach(row => {
                const texto = row.textContent.toLowerCase();
                if (texto.includes(termino.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter mobile cards
            mobileCards.forEach(card => {
                const texto = card.textContent.toLowerCase();
                if (texto.includes(termino.toLowerCase())) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function filtrarPorEstado(estado) {
            const tableRows = document.querySelectorAll('#viajesTableBody tr');
            const mobileCards = document.querySelectorAll('.mobile-card');
            
            // Filter table rows
            tableRows.forEach(row => {
                const estadoViaje = row.getAttribute('data-estado');
                if (!estado || estadoViaje === estado) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter mobile cards
            mobileCards.forEach(card => {
                const estadoViaje = card.getAttribute('data-estado');
                if (!estado || estadoViaje === estado) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function goToProfile() {
            window.location.href = '/profile';
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }

        // Enhanced mobile touch handling
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            if (window.innerWidth <= 768) {
                if (touchEndX < touchStartX - 50) {
                    // Swipe left - close sidebar
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
                if (touchEndX > touchStartX + 50 && touchStartX < 20) {
                    // Swipe right from edge - open sidebar
                    sidebar.classList.add('active');
                    overlay.classList.add('active');
                }
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Escape key to close sidebar
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                if (sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            }
            
            // Ctrl+F to focus search
            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                const searchInput = document.getElementById('searchViajes');
                if (searchInput) {
                    searchInput.focus();
                }
            }
        });

        // Performance optimization: Debounce search
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Apply debounce to search
        if (document.getElementById('searchViajes')) {
            document.getElementById('searchViajes').addEventListener('input', 
                debounce(function() {
                    filtrarViajes(this.value);
                }, 300)
            );
        }
    </script>

    @include('components.modal-detalles')
    
</body>
</html>