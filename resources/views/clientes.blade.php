<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Gestión de Clientes</title>
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

        .stat-total {
            color: #007bff;
        }

        .stat-activos {
            color: #28a745;
        }

        .stat-empresas {
            color: #17a2b8;
        }

        .stat-recent {
            color: #ffc107;
        }

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

        .status-activo {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .status-empresa {
            background: #e3f2fd;
            color: #1565c0;
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

        .empty-state h3 {
            margin-bottom: 1rem;
            color: #333;
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .modal-title {
            font-size: 1.5rem;
            color: #333;
            font-weight: 600;
        }

        .close {
            color: #999;
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .close:hover {
            color: #333;
        }

        .modal-body {
            line-height: 1.6;
        }

        .detail-item {
            display: flex;
            margin-bottom: 1rem;
        }

        .detail-label {
            font-weight: 600;
            color: #333;
            min-width: 150px;
        }

        .detail-value {
            color: #666;
            flex: 1;
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

            .navbar-content>div:last-child {
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

            .modal-content {
                margin: 10% auto;
                width: 95%;
                padding: 1.5rem;
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

            .modal-content {
                margin: 5% auto;
                padding: 1rem;
            }

            .detail-item {
                flex-direction: column;
                margin-bottom: 1.5rem;
            }

            .detail-label {
                min-width: auto;
                margin-bottom: 0.5rem;
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
                    <h1 class="navbar-title">Gestión de Clientes</h1>
                </div>
                <div class="navbar-links">
                    <div class="datetime-display">
                        <div class="current-date" id="currentDate"></div>
                        <div class="current-time" id="currentTime"></div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #666; cursor: pointer; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#667eea'" onmouseout="this.style.color='#666'">
                            Cerrar Sesión
                        </button>
                    </form>
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
                        <h1 class="page-title">Gestión de Clientes</h1>
                        <p class="page-subtitle">Administra la información de todos los clientes de la empresa</p>
                    </div>
                    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                        ➕ Registrar Cliente
                    </a>
                </div>

                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-number stat-total">{{ $clientes->count() }}</div>
                        <div class="stat-label">Total Clientes</div>
                        <div class="stat-sublabel">En el sistema</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-activos">{{ $clientes->where('estado', 'activo')->count() }}</div>
                        <div class="stat-label">Activos</div>
                        <div class="stat-sublabel">Con servicios vigentes</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-empresas">{{ $clientes->where('tipo', 'empresa')->count() }}</div>
                        <div class="stat-label">Empresas</div>
                        <div class="stat-sublabel">Clientes corporativos</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number stat-recent">
                            {{ $clientes->where('created_at', '>=', now()->subDays(30))->count() }}
                        </div>
                        <div class="stat-label">Nuevos este mes</div>
                        <div class="stat-sublabel">Últimos 30 días</div>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="table-container">
                    <div class="table-header">
                        <h3 class="table-title">Lista de Clientes</h3>
                        <div class="table-actions">
                            <input type="text" class="search-input" placeholder="Buscar cliente..." id="searchClientes">
                            <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm">➕ Nuevo Cliente</a>
                        </div>
                    </div>

                    @if($clientes->count() > 0)
                        <!-- Desktop Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre/Razón Social</th>
                                    <th>Contacto</th>
                                    <th>Información del Contrato</th>
                                    <th>Fecha de Registro</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="clientesTableBody">
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td><strong>CLI-{{ str_pad($cliente->id, 3, '0', STR_PAD_LEFT) }}</strong></td>
                                        <td>
                                            <div style="font-weight: 500;">{{ $cliente->nombre }}</div>
                                            <div style="font-size: 0.8rem; color: #666;">
                                                {{ ucfirst($cliente->tipo ?? 'empresa') }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $cliente->contacto }}</div>
                                        </td>
                                        <td>
                                            <div
                                                style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                {{ $cliente->contrato }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>{{ $cliente->created_at->format('d/m/Y') }}</div>
                                            <div style="font-size: 0.8rem; color: #666;">
                                                {{ $cliente->created_at->diffForHumans() }}
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="status-badge status-{{ $cliente->estado ?? 'activo' }}">{{ ucfirst($cliente->estado ?? 'activo') }}</span>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <button
                                                    onclick="mostrarDetalles('{{ $cliente->id }}', '{{ addslashes($cliente->nombre) }}', '{{ addslashes($cliente->contacto) }}', '{{ addslashes($cliente->contrato) }}', '{{ $cliente->created_at->format('d/m/Y') }}', '{{ $cliente->estado ?? 'activo' }}')"
                                                    class="btn btn-secondary btn-sm" title="Ver detalles">👁️</button>
                                                <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm"
                                                    title="Editar">✏️</a>
                                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
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
                            @foreach($clientes as $cliente)
                                <div class="mobile-card">
                                    <div class="card-header">
                                        <div class="card-title">CLI-{{ str_pad($cliente->id, 3, '0', STR_PAD_LEFT) }}</div>
                                        <span class="status-badge status-{{ $cliente->estado ?? 'activo' }}">
                                            {{ ucfirst($cliente->estado ?? 'activo') }}
                                        </span>
                                    </div>
                                    <div class="card-info">
                                        <div class="info-item">
                                            <div class="info-label">Nombre/Razón Social</div>
                                            <div class="info-value">{{ $cliente->nombre }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Tipo</div>
                                            <div class="info-value">{{ ucfirst($cliente->tipo ?? 'empresa') }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Contacto</div>
                                            <div class="info-value">{{ $cliente->contacto }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Contrato</div>
                                            <div class="info-value">{{ Str::limit($cliente->contrato, 30) }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Fecha de Registro</div>
                                            <div class="info-value">{{ $cliente->created_at->format('d/m/Y') }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Antigüedad</div>
                                            <div class="info-value">{{ $cliente->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="card-actions">
                                        <button
                                            onclick="mostrarDetalles('{{ $cliente->id }}', '{{ addslashes($cliente->nombre) }}', '{{ addslashes($cliente->contacto) }}', '{{ addslashes($cliente->contrato) }}', '{{ $cliente->created_at->format('d/m/Y') }}', '{{ $cliente->estado ?? 'activo' }}')"
                                            class="btn btn-secondary btn-sm">👁️ Ver</button>
                                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm">✏️
                                            Editar</a>
                                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
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
                            <div class="empty-icon">👤</div>
                            <h3>No hay clientes registrados</h3>
                            <p>Comienza registrando tu primer cliente para ver la información aquí.</p>
                            <a href="{{ route('clientes.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                ➕ Registrar primer cliente
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Modal de Detalles -->
    <div id="modalDetalles" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Detalles del Cliente</h2>
                <span class="close" onclick="cerrarModal()">&times;</span>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content will be populated by JavaScript -->
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
            window.addEventListener('resize', function () {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });

            // Search functionality
            const searchInput = document.getElementById('searchClientes');
            if (searchInput) {
                document.getElementById('searchClientes').addEventListener('input',
                    debounce(function () {
                        filtrarClientes(this.value);
                    }, 300)
                );
            }

            // Modal close on outside click
            window.addEventListener('click', function (event) {
                const modal = document.getElementById('modalDetalles');
                if (event.target === modal) {
                    cerrarModal();
                }
            });

            // Auto-hide alerts
            setTimeout(function () {
                document.querySelectorAll('.alert').forEach(function (alert) {
                    alert.style.opacity = '0';
                    setTimeout(function () {
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

        function filtrarClientes(termino) {
            // Filter table rows
            const tableRows = document.querySelectorAll('#clientesTableBody tr');
            const mobileCards = document.querySelectorAll('.mobile-card');

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

            updateVisibleStats();
        }

        function updateVisibleStats() {
            // Update stats based on visible rows only
            const visibleTableRows = document.querySelectorAll('#clientesTableBody tr:not([style*="display: none"])');

            let stats = {
                total: 0
            };

            visibleTableRows.forEach(row => {
                stats.total++;
            });

            // Update stat cards with animation
            animateStatChange('total', stats.total);
        }

        function animateStatChange(type, newValue) {
            const element = document.querySelector(`.stat-${type}`);
            if (element) {
                element.style.transform = 'scale(1.1)';
                element.textContent = newValue;
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 200);
            }
        }

        function mostrarDetalles(id, nombre, contacto, contrato, fecha, estado) {
            const modal = document.getElementById('modalDetalles');
            const modalBody = document.getElementById('modalBody');

            modalBody.innerHTML = `
                <div class="detail-item">
                    <div class="detail-label">ID Cliente:</div>
                    <div class="detail-value">CLI-${String(id).padStart(3, '0')}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Nombre/Razón Social:</div>
                    <div class="detail-value">${nombre}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Información de Contacto:</div>
                    <div class="detail-value">${contacto}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Información del Contrato:</div>
                    <div class="detail-value">${contrato}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Fecha de Registro:</div>
                    <div class="detail-value">${fecha}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Estado:</div>
                    <div class="detail-value">
                        <span class="status-badge status-${estado}">${estado.charAt(0).toUpperCase() + estado.slice(1)}</span>
                    </div>
                </div>
            `;

            modal.style.display = 'block';
        }

        function cerrarModal() {
            const modal = document.getElementById('modalDetalles');
            modal.style.display = 'none';
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

        document.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', function (e) {
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
        document.addEventListener('keydown', function (e) {
            // Escape key to close sidebar or modal
            if (e.key === 'Escape') {
                const modal = document.getElementById('modalDetalles');
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');

                if (modal.style.display === 'block') {
                    cerrarModal();
                } else if (sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            }

            // Ctrl+F to focus search
            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                const searchInput = document.getElementById('searchClientes');
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

        // Enhanced delete confirmation with client details
        function confirmarEliminacion(nombre, id) {
            return confirm(`¿Estás seguro de que deseas eliminar al cliente "${nombre}" (ID: CLI-${String(id).padStart(3, '0')})?
            
Esta acción no se puede deshacer y eliminará toda la información asociada.`);
        }

        // Enhanced delete confirmation for better UX
        document.querySelectorAll('form[onsubmit]').forEach(form => {
            form.addEventListener('submit', function (e) {
                const row = this.closest('tr') || this.closest('.mobile-card');
                if (row) {
                    const nombre = row.querySelector('td:nth-child(2) div')?.textContent ||
                        row.querySelector('.info-value')?.textContent;
                    const id = row.querySelector('strong')?.textContent?.replace('CLI-', '');

                    if (nombre && id) {
                        if (!confirmarEliminacion(nombre, id)) {
                            e.preventDefault();
                        }
                    }
                }
            });
        });

        // Initialize stats calculation
        window.addEventListener('load', function () {
            updateVisibleStats();
        });
    </script>

</body>

</html>