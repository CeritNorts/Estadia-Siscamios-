<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .status-preventivo {
            background: #e3f2fd;
            color: #1565c0;
        }

        .status-correctivo {
            background: #fff8e1;
            color: #f57c00;
        }

        .status-emergencia {
            background: #ffebee;
            color: #c62828;
        }

        .status-normal {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .status-vigente {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .status-por-vencer {
            background: #fff8e1;
            color: #f57c00;
        }

        .status-vencido {
            background: #ffebee;
            color: #c62828;
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

        /* Success/Error Messages */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 5px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
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

            .tabs-header {
                flex-wrap: wrap;
            }

            .tab-button {
                min-width: 120px;
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

            .tabs-header {
                flex-direction: column;
            }

            .tab-button {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            .tab-content {
                padding: 1.5rem;
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

            .tabs-container {
                border-radius: 8px;
            }

            .tab-content {
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

            .tab-content {
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
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

            .tabs-container {
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
            {{-- Panel Administrativo: Visible para todos, pero su contenido se adaptará por rol --}}
            <li>
                <a href="/dashboard">
                    📊 Panel Administrativo
                </a>
            </li>

            {{-- Camiones: Solo Administrador y Supervisor --}}
            @if(Auth::check() && (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Supervisor')))
                <li>
                    <a href="/camiones">🚛 Camiones</a>
                </li>
            @endif

            {{-- Viajes: Visible para todos (Administrador, Supervisor, Chofer) --}}
            <li>
                <a href="/viajes" class="{{ Request::is('viajes*') ? 'active' : '' }}"> {{-- Mantengo 'active' si es la página de viajes --}}
                    📋 Viajes
                </a>
            </li>
        
            {{-- Mantenimiento: Visible para todos (Administrador, Supervisor, Chofer) --}}
            <li>
                <a href="/mantenimiento">
                    🔧 Mantenimiento
                </a>
            </li>
        
            {{-- Conductores: Solo Administrador y Supervisor --}}
            @if(Auth::check() && (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Supervisor')))
                <li>
                    <a href="/conductores">
                        👥 Conductores
                    </a>
                </li>
            @endif

            {{-- Clientes: Solo Administrador y Supervisor --}}
            @if(Auth::check() && (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Supervisor')))
                <li>
                    <a href="/clientes">👤 Clientes</a>
                </li>
            @endif

            {{-- Combustible: Solo Administrador y Supervisor --}}
            @if(Auth::check() && (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Supervisor')))
                <li>
                    <a href="{{ route('combustible') }}">⛽ Combustible</a>
                </li>
            @endif

            {{-- Gestión de Usuarios: Solo Administrador --}}
            @if(Auth::check() && Auth::user()->hasRole('Administrador'))
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        ⚙️ Gestión de Usuarios
                    </a>
                </li>
            @endif
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
                    <h1 class="navbar-title">Gestión de Mantenimiento</h1>
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
                        <h1 class="page-title">Gestión de Mantenimiento</h1>
                        <p class="page-subtitle">Administra el mantenimiento preventivo y correctivo de la flotilla</p>
                    </div>
                    {{-- Condición para mostrar el botón "Registrar Mantenimiento" --}}
                    @if(Auth::check() && (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Supervisor')))
                        <a href="{{ route('registrarMantenimiento') }}" class="btn btn-primary">
                            ➕ Registrar Mantenimiento
                        </a>
                    @endif
                </div>

                <!-- Alertas de Mantenimiento -->
                @if($estadisticas['urgentes'] > 0)
                    <div class="alert-card urgent">
                        <div class="alert-title">🚨 Mantenimientos Urgentes</div>
                        <p>{{ $estadisticas['urgentes'] }} unidades requieren mantenimiento inmediato</p>
                    </div>
                @endif
                
                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-number stat-programado">{{ $estadisticas['programados'] }}</div>
                        <div class="stat-label">Programados</div>
                        <div class="stat-sublabel">Próximos 15 días</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-proceso">{{ $estadisticas['en_proceso'] }}</div>
                        <div class="stat-label">En Proceso</div>
                        <div class="stat-sublabel">Actualmente en taller</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-completado">{{ $estadisticas['completados'] }}</div>
                        <div class="stat-label">Completados</div>
                        <div class="stat-sublabel">Este mes</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-urgente">{{ $estadisticas['urgentes'] }}</div>
                        <div class="stat-label">Urgentes</div>
                        <div class="stat-sublabel">Requieren atención</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-costo">${{ number_format($estadisticas['costo_total'], 2) }}</div>
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
                        
                        <!-- Desktop Table -->
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
                                <tbody id="mantenimientosTableBody">
                                    @foreach($mantenimientos as $mantenimiento)
                                    <tr data-tipo="{{ $mantenimiento->tipo }}" data-estado="{{ $mantenimiento->estado }}">
                                        <td><strong>MNT-{{ str_pad($mantenimiento->id, 3, '0', STR_PAD_LEFT) }}</strong></td>
                                        <td>{{ $mantenimiento->camion->numero_interno ?? 'N/A' }}</td>
                                        <td><span class="status-badge status-{{ strtolower(str_replace(' ', '-', $mantenimiento->tipo)) }}">{{ ucfirst($mantenimiento->tipo) }}</span></td>
                                        <td>{{ $mantenimiento->descripcion }}</td>
                                        <td>{{ $mantenimiento->fecha_formateada }}</td>
                                        <td>{{ $mantenimiento->costo_formateado }}</td>
                                        <td>{{ $mantenimiento->proveedor ?? 'N/A' }}</td>
                                        <td><span class="status-badge status-{{ $mantenimiento->estado }}">{{ ucfirst($mantenimiento->estado) }}</span></td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button onclick="mostrarDetalles('mantenimiento', {{ $mantenimiento->id }}, {{ json_encode($mantenimiento->load('camion')) }})" 
                                                    class="btn btn-secondary btn-sm">👁️</button>
                                                {{-- Botones de Editar y Eliminar solo para Administrador y Supervisor --}}
                                                @if(Auth::check() && (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Supervisor')))
                                                    <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-warning btn-sm" title="Editar">✏️</a>
                                                    <form method="POST" action="{{ route('mantenimientos.destroy', $mantenimiento) }}" style="display: inline;" onsubmit="return confirm('¿Está seguro de eliminar este mantenimiento?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">🗑️</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="mobile-cards" id="mobileCards">
                            @foreach($mantenimientos as $mantenimiento)
                                <div class="mobile-card" data-tipo="{{ $mantenimiento->tipo }}" data-estado="{{ $mantenimiento->estado }}">
                                    <div class="card-header">
                                        <div class="card-title">MNT-{{ str_pad($mantenimiento->id, 3, '0', STR_PAD_LEFT) }}</div>
                                        <span class="status-badge status-{{ $mantenimiento->estado }}">{{ ucfirst($mantenimiento->estado) }}</span>
                                    </div>
                                    <div class="card-info">
                                        <div class="info-item">
                                            <div class="info-label">Camión</div>
                                            <div class="info-value">{{ $mantenimiento->camion->numero_interno ?? 'N/A' }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Tipo</div>
                                            <div class="info-value">
                                                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $mantenimiento->tipo)) }}">{{ ucfirst($mantenimiento->tipo) }}</span>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Descripción</div>
                                            <div class="info-value">{{ $mantenimiento->descripcion }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Fecha</div>
                                            <div class="info-value">{{ $mantenimiento->fecha_formateada }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Costo</div>
                                            <div class="info-value">{{ $mantenimiento->costo_formateado }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Proveedor</div>
                                            <div class="info-value">{{ $mantenimiento->proveedor ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                    <div class="card-actions">
                                        <a href="{{ route('mantenimientos.show', $mantenimiento) }}" class="btn btn-secondary btn-sm">👁️ Ver</a>
                                        <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                                        <form method="POST" action="{{ route('mantenimientos.destroy', $mantenimiento) }}" style="display: inline;" onsubmit="return confirm('¿Está seguro de eliminar este mantenimiento?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
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
                        
                        <!-- Desktop Table -->
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
                                    @foreach($camiones as $camion)
                                    @php
                                        $kmRestantes = ($camion->proximo_mantenimiento ?? 100000) - ($camion->kilometraje_actual ?? 0);
                                        $estado = $kmRestantes <= 1000 ? 'urgente' : 'normal';
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $camion->numero_interno }}</strong></td>
                                        <td>{{ number_format($camion->kilometraje_actual ?? 0) }} km</td>
                                        <td>{{ number_format($camion->proximo_mantenimiento ?? 100000) }} km</td>
                                        <td>{{ number_format($kmRestantes) }} km</td>
                                        <td>{{ $kmRestantes <= 5000 ? 'Mantenimiento Mayor' : 'Cambio de Aceite' }}</td>
                                        <td><span class="status-badge status-{{ $estado }}">{{ $estado == 'urgente' ? 'Urgente' : 'Normal' }}</span></td>
                                        <td>
                                            @if($estado == 'urgente')
                                                <button class="btn btn-danger btn-sm">🚨 Urgente</button>
                                            @else
                                                <button class="btn btn-success btn-sm">📅 Programar</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards for Preventivo -->
                        <div class="mobile-cards">
                            @foreach($camiones as $camion)
                            @php
                                $kmRestantes = ($camion->proximo_mantenimiento ?? 100000) - ($camion->kilometraje_actual ?? 0);
                                $estado = $kmRestantes <= 1000 ? 'urgente' : 'normal';
                            @endphp
                                <div class="mobile-card">
                                    <div class="card-header">
                                        <div class="card-title">{{ $camion->numero_interno }}</div>
                                        <span class="status-badge status-{{ $estado }}">{{ $estado == 'urgente' ? 'Urgente' : 'Normal' }}</span>
                                    </div>
                                    <div class="card-info">
                                        <div class="info-item">
                                            <div class="info-label">Kilometraje Actual</div>
                                            <div class="info-value">{{ number_format($camion->kilometraje_actual ?? 0) }} km</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Próximo Servicio</div>
                                            <div class="info-value">{{ number_format($camion->proximo_mantenimiento ?? 100000) }} km</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Km Restantes</div>
                                            <div class="info-value">{{ number_format($kmRestantes) }} km</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Tipo de Servicio</div>
                                            <div class="info-value">{{ $kmRestantes <= 5000 ? 'Mantenimiento Mayor' : 'Cambio de Aceite' }}</div>
                                        </div>
                                    </div>
                                    <div class="card-actions">
                                        @if($estado == 'urgente')
                                            <button class="btn btn-danger btn-sm">🚨 Urgente</button>
                                        @else
                                            <button class="btn btn-success btn-sm">📅 Programar</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tab: Control de Documentos -->
                    <div class="tab-content" id="documentos">
                        <div class="table-header">
                            <h3 class="table-title">Control de Documentos y Vigencias</h3>
                            <div class="table-actions">
                                <button class="btn btn-primary btn-sm">📄 Nuevo Documento</button>
                            </div>
                        </div>
                        
                        <!-- Desktop Table -->
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
                                    @foreach($camiones as $camion)
                                    @if($camion->fecha_seguro)
                                    @php
                                        $diasRestantes = \Carbon\Carbon::parse($camion->fecha_seguro)->diffInDays(now(), false);
                                        $estado = $diasRestantes <= 30 ? ($diasRestantes < 0 ? 'vencido' : 'por-vencer') : 'vigente';
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $camion->numero_interno }}</strong></td>
                                        <td>Póliza de Seguro</td>
                                        <td>{{ $camion->numero_poliza ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($camion->fecha_seguro)->format('d/m/Y') }}</td>
                                        <td>{{ $diasRestantes < 0 ? abs($diasRestantes) . ' días vencido' : $diasRestantes . ' días' }}</td>
                                        <td><span class="status-badge status-{{ $estado }}">{{ ucfirst(str_replace('-', ' ', $estado)) }}</span></td>
                                        <td>
                                            @if($estado == 'vencido')
                                                <button class="btn btn-danger btn-sm">🚨 Renovar Ya</button>
                                            @elseif($estado == 'por-vencer')
                                                <button class="btn btn-warning btn-sm">⚠️ Renovar</button>
                                            @else
                                                <button class="btn btn-secondary btn-sm">📄</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards for Documentos -->
                        <div class="mobile-cards">
                            @foreach($camiones as $camion)
                            @if($camion->fecha_seguro)
                            @php
                                $diasRestantes = \Carbon\Carbon::parse($camion->fecha_seguro)->diffInDays(now(), false);
                                $estado = $diasRestantes <= 30 ? ($diasRestantes < 0 ? 'vencido' : 'por-vencer') : 'vigente';
                            @endphp
                                <div class="mobile-card">
                                    <div class="card-header">
                                        <div class="card-title">{{ $camion->numero_interno }}</div>
                                        <span class="status-badge status-{{ $estado }}">{{ ucfirst(str_replace('-', ' ', $estado)) }}</span>
                                    </div>
                                    <div class="card-info">
                                        <div class="info-item">
                                            <div class="info-label">Tipo de Documento</div>
                                            <div class="info-value">Póliza de Seguro</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Número</div>
                                            <div class="info-value">{{ $camion->numero_poliza ?? 'N/A' }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Vigencia</div>
                                            <div class="info-value">{{ \Carbon\Carbon::parse($camion->fecha_seguro)->format('d/m/Y') }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Días Restantes</div>
                                            <div class="info-value">{{ $diasRestantes < 0 ? abs($diasRestantes) . ' días vencido' : $diasRestantes . ' días' }}</div>
                                        </div>
                                    </div>
                                    <div class="card-actions">
                                        @if($estado == 'vencido')
                                            <button class="btn btn-danger btn-sm">🚨 Renovar Ya</button>
                                        @elseif($estado == 'por-vencer')
                                            <button class="btn btn-warning btn-sm">⚠️ Renovar</button>
                                        @else
                                            <button class="btn btn-secondary btn-sm">📄</button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @endforeach
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
            updateDateTime();
            setInterval(updateDateTime, 1000);
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

            // Close sidebar on window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
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

            // Auto-hide alerts
            setTimeout(function() {
                document.querySelectorAll('.alert').forEach(function(alert) {
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 300);
                });
            }, 5000);
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

        function cambiarTab(tabId) {
            // Remover active de todos los botones y contenidos
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            // Activar el tab seleccionado
            document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }

        function filtrarMantenimientos(termino) {
            // Filter table rows
            const tableRows = document.querySelectorAll('#mantenimientosTableBody tr');
            const mobileCards = document.querySelectorAll('#mantenimientos .mobile-card');

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

        function filtrarPorTipo(tipo) {
            // Filter table rows
            const tableRows = document.querySelectorAll('#mantenimientosTableBody tr');
            const mobileCards = document.querySelectorAll('#mantenimientos .mobile-card');

            tableRows.forEach(row => {
                const tipoData = row.getAttribute('data-tipo');
                if (!tipo || tipoData === tipo) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter mobile cards
            mobileCards.forEach(card => {
                const tipoData = card.getAttribute('data-tipo');
                if (!tipo || tipoData === tipo) {
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
            
            // Tab navigation with numbers
            if (e.key >= '1' && e.key <= '3') {
                const tabs = ['mantenimientos', 'preventivo', 'documentos'];
                const tabIndex = parseInt(e.key) - 1;
                if (tabs[tabIndex]) {
                    cambiarTab(tabs[tabIndex]);
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
        if (document.getElementById('searchMantenimientos')) {
            document.getElementById('searchMantenimientos').addEventListener('input', 
                debounce(function() {
                    filtrarMantenimientos(this.value);
                }, 300)
            );
        }
    </script>

    @include('components.modal-detalles')

</body>

</html>