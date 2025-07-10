<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            overflow: hidden;
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
            flex-shrink: 0;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            color: white;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .sidebar-menu {
            flex: 1;
            padding: 0.5rem 0;
            list-style: none;
            overflow-y: auto;
        }

        .sidebar-menu li {
            margin: 0.25rem 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.875rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 0.75rem;
            font-size: 0.9rem;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid #fff;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 8px;
            position: relative;
        }

        .user-info:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            color: #ffffff;
            font-weight: 500;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .profile-arrow {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.5rem;
            font-weight: bold;
            margin-left: auto;
            transition: all 0.3s ease;
        }

        .user-info:hover .profile-arrow {
            color: white;
            transform: translateX(3px);
        }

        /* DateTime Display Styles */
        .datetime-display {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-right: 1rem;
            text-align: right;
        }

        .date-text {
            font-size: 0.8rem;
            color: #666;
            font-weight: 500;
            line-height: 1;
        }

        .time-text {
            font-size: 0.9rem;
            color: #333;
            font-weight: 600;
            line-height: 1;
            margin-top: 2px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
            flex-shrink: 0;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            min-height: 60px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
            min-width: 0;
        }

        .navbar-title {
            color: #333;
            font-size: 1.1rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 5px;
            transition: background 0.3s ease;
            flex-shrink: 0;
        }

        .sidebar-toggle:hover {
            background: #f0f0f0;
        }

        .navbar-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .navbar-links a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .navbar-links a:hover {
            color: #667eea;
        }

        /* Content Area */
        .content {
            flex: 1;
            overflow-y: auto;
            min-height: 0;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.75rem;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: #666;
            font-size: 0.9rem;
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .dashboard-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid #667eea;
            text-align: center;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .dashboard-card h3 {
            color: #333;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        .dashboard-card .card-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.25rem;
        }

        .dashboard-card .card-label {
            color: #666;
            font-size: 0.8rem;
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
            font-size: 0.9rem;
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
            padding: 1.5rem;
        }

        .tab-content.active {
            display: block;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-weight: 500;
            white-space: nowrap;
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
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
        }

        /* Tables */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .table-title {
            font-size: 1.25rem;
            color: #333;
            font-weight: 600;
        }

        .table-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-input {
            padding: 0.5rem 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.85rem;
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
            min-width: 700px;
        }

        .table th,
        .table td {
            padding: 0.875rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
            font-size: 0.85rem;
        }

        .table tr:hover {
            background: #f8f9fa;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
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

        .status-disponible {
            background: #d1ecf1;
            color: #0c5460;
        }

        /* Alert Messages */
        .alert {
            padding: 0.875rem;
            border-radius: 5px;
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

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #666;
        }

        .empty-state img {
            width: 120px;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Overlay for mobile sidebar */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* Action Buttons Container */
        .action-buttons {
            display: flex;
            gap: 0.25rem;
            align-items: center;
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

        /* Responsive Design */

        /* Large Desktop (1200px+) */
        @media (min-width: 1200px) {
            .sidebar {
                width: 300px;
            }
            
            .sidebar-header {
                padding: 2rem 1.5rem;
            }
            
            .sidebar-brand {
                font-size: 1.5rem;
            }
            
            .sidebar-menu a {
                padding: 1rem 1.5rem;
                font-size: 1rem;
                gap: 1rem;
            }
            
            .navbar-content {
                padding: 1rem 2rem;
            }
            
            .navbar-title {
                font-size: 1.25rem;
            }
            
            .content-wrapper {
                padding: 2rem;
            }
            
            .dashboard-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 1.5rem;
            }
            
            .dashboard-card {
                padding: 2rem;
            }
            
            .dashboard-card .card-number {
                font-size: 2.5rem;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .table-title {
                font-size: 1.5rem;
            }
        }

        /* Medium Desktop (992px - 1199px) */
        @media (max-width: 1199px) and (min-width: 992px) {
            .sidebar {
                width: 260px;
            }
            
            .navbar-links a {
                font-size: 0.85rem;
            }
            
            .dashboard-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Tablet Landscape (768px - 991px) */
        @media (max-width: 991px) and (min-width: 768px) {
            .sidebar {
                width: 240px;
            }
            
            .sidebar-header {
                padding: 1.25rem 1rem;
            }
            
            .sidebar-brand {
                font-size: 1.1rem;
            }
            
            .sidebar-menu a {
                padding: 0.75rem 1rem;
                font-size: 0.85rem;
                gap: 0.5rem;
            }
            
            .navbar-links {
                gap: 0.75rem;
            }
            
            .navbar-links a {
                font-size: 0.8rem;
            }
            
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .dashboard-card {
                padding: 1.25rem;
            }
            
            .dashboard-card .card-number {
                font-size: 1.75rem;
            }
        }

        /* Tablet Portrait & Large Phone (576px - 767px) */
        @media (max-width: 767px) and (min-width: 576px) {
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

            .main-content {
                width: 100%;
            }
            
            .navbar-content {
                padding: 0.75rem;
            }
            
            .navbar-title {
                font-size: 1rem;
            }
            
            .navbar-links {
                gap: 0.5rem;
            }
            
            .navbar-links a {
                font-size: 0.75rem;
            }

            .datetime-display {
                margin-right: 0.5rem;
            }

            .date-text {
                font-size: 0.7rem;
            }

            .time-text {
                font-size: 0.75rem;
            }

            .content-wrapper {
                padding: 1rem;
            }

            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.75rem;
            }
            
            .dashboard-card {
                padding: 1rem;
            }
            
            .dashboard-card .card-number {
                font-size: 1.5rem;
            }
            
            .dashboard-card h3 {
                font-size: 0.9rem;
            }
            
            .dashboard-card .card-label {
                font-size: 0.75rem;
            }

            .page-header {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .table-header {
                flex-direction: column;
                align-items: stretch;
            }

            .table-actions {
                justify-content: center;
                flex-wrap: wrap;
            }

            .search-input {
                min-width: 180px;
                width: 100%;
                max-width: 300px;
            }

            .tabs-header {
                flex-direction: column;
            }

            .tab-button {
                padding: 0.75rem 1rem;
                font-size: 0.85rem;
            }

            .tab-content {
                padding: 1rem;
            }
        }

        /* Small Phone (below 576px) */
        @media (max-width: 575px) {
            body {
                font-size: 14px;
            }
            
            .sidebar {
                position: fixed;
                transform: translateX(-100%);
                height: 100vh;
                z-index: 1001;
                width: 260px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                width: 100%;
            }
            
            .navbar-content {
                padding: 0.5rem;
                min-height: 50px;
            }
            
            .navbar-title {
                font-size: 0.9rem;
            }
            
            .sidebar-toggle {
                font-size: 1.1rem;
                padding: 0.25rem;
            }
            
            .navbar-links {
                gap: 0.25rem;
            }
            
            .navbar-links a {
                font-size: 0.7rem;
                padding: 0.25rem;
            }

            .datetime-display {
                margin-right: 0.25rem;
            }

            .date-text {
                font-size: 0.65rem;
            }

            .time-text {
                font-size: 0.7rem;
            }

            .content-wrapper {
                padding: 0.75rem;
            }

            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.5rem;
            }
            
            .dashboard-card {
                padding: 0.75rem;
            }
            
            .dashboard-card .card-number {
                font-size: 1.25rem;
            }
            
            .dashboard-card h3 {
                font-size: 0.8rem;
                margin-bottom: 0.5rem;
            }
            
            .dashboard-card .card-label {
                font-size: 0.7rem;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .page-subtitle {
                font-size: 0.8rem;
            }

            .table-title {
                font-size: 1rem;
            }

            .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
            }

            .btn-sm {
                padding: 0.35rem 0.5rem;
                font-size: 0.7rem;
            }

            .search-input {
                font-size: 0.8rem;
                padding: 0.5rem;
                min-width: 150px;
            }

            .table th,
            .table td {
                padding: 0.5rem;
                font-size: 0.8rem;
            }

            .status-badge {
                font-size: 0.65rem;
                padding: 0.2rem 0.4rem;
            }

            .action-buttons {
                gap: 0.15rem;
            }

            .empty-state {
                padding: 1.5rem 0.5rem;
            }

            .alert {
                padding: 0.75rem;
                font-size: 0.85rem;
            }
        }

        /* Ultra Small Screens (below 360px) */
        @media (max-width: 359px) {
            .sidebar {
                width: 240px;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .navbar-title {
                display: none;
            }

            .datetime-display {
                display: none;
            }

            .page-header {
                text-align: left;
            }

            .search-input {
                min-width: 120px;
            }

            .table-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
                width: 100%;
            }

            .action-buttons .btn {
                width: 100%;
                font-size: 0.7rem;
            }
        }

        /* Touch device optimizations */
        @media (hover: none) and (pointer: coarse) {
            .btn {
                min-height: 44px;
                padding: 0.75rem 1rem;
            }
            
            .btn-sm {
                min-height: 36px;
                padding: 0.5rem 0.75rem;
            }
            
            .sidebar-toggle {
                min-height: 44px;
                min-width: 44px;
            }

            .search-input {
                min-height: 44px;
            }

            .tab-button {
                min-height: 48px;
            }
        }

        /* High DPI displays */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .table-container {
                border: 0.5px solid #e9ecef;
            }
            
            .status-badge {
                border: 0.5px solid rgba(0, 0, 0, 0.1);
            }
        }

        /* Landscape orientation on phones */
        @media (max-height: 500px) and (orientation: landscape) and (max-width: 900px) {
            .dashboard-grid {
                display: none;
            }
            
            .navbar-content {
                padding: 0.5rem;
                min-height: 45px;
            }
            
            .content-wrapper {
                padding: 0.5rem;
            }
            
            .page-header {
                margin-bottom: 1rem;
            }
        }

        /* Print styles */
        @media print {
            .sidebar,
            .navbar,
            .overlay {
                display: none;
            }
            
            .main-content,
            .content,
            .content-wrapper {
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            
            .dashboard-grid {
                display: none;
            }
            
            .btn {
                display: none;
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
                <a href="/camiones" class="active">🚛 Camiones</a>
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
                <a href="{{ route('combustible') }}">⛽ Combustible</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info" onclick="goToProfile()" title="Ir a Perfil">
                <div class="user-avatar">AD</div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">Sistema</div>
                </div>
                <div class="profile-arrow">›</div>
            </div>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Content -->
    <div class="main-content">
        <nav class="navbar">
            <div class="navbar-content">
                <div class="navbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle">☰</button>
                    <h1 class="navbar-title">Gestión de Camiones</h1>
                </div>
                <div class="navbar-links">
                    <div class="datetime-display" id="datetimeDisplay">
                        <div class="date-text" id="dateText"></div>
                        <div class="time-text" id="timeText"></div>
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
                        <h1 class="page-title">Gestión de Camiones</h1>
                        <p class="page-subtitle">Administra y supervisa toda tu flotilla vehicular</p>
                    </div>
                    <a href="{{ route('camiones.create') }}" class="btn btn-primary">
                        ➕ Nuevo Camión
                    </a>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <h3>Total Camiones</h3>
                        <div class="card-number">{{ $camiones->count() }}</div>
                        <div class="card-label">En la flotilla</div>
                    </div>
                    <div class="dashboard-card">
                        <h3>Activos</h3>
                        <div class="card-number">{{ $camiones->where('estado', 'activo')->count() }}</div>
                        <div class="card-label">Listos para viaje</div>
                    </div>
                    <div class="dashboard-card">
                        <h3>En Mantenimiento</h3>
                        <div class="card-number">{{ $camiones->where('estado', 'mantenimiento')->count() }}</div>
                        <div class="card-label">Fuera de servicio</div>
                    </div>
                    <div class="dashboard-card">
                        <h3>Inactivos</h3>
                        <div class="card-number">{{ $camiones->where('estado', 'inactivo')->count() }}</div>
                        <div class="card-label">Sin asignar</div>
                    </div>
                </div>

                <!-- Tabs Container -->
                <div class="tabs-container">
                    <div class="tabs-header">
                        <button class="tab-button active" data-tab="table">📊 Lista de Camiones</button>
                    </div>

                    <!-- Tab: Table View (Principal) -->
                    <div class="tab-content active" id="table">
                        <div class="table-header">
                            <h3 class="table-title">Lista Completa de Camiones</h3>
                            <div class="table-actions">
                                <input type="text" class="search-input" placeholder="Buscar camión..." id="searchTable">
                                <a href="{{ route('camiones.create') }}" class="btn btn-primary">
                                    ➕ Nuevo Camión
                                </a>
                            </div>
                        </div>

                        @if($camiones->count() > 0)
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Placa</th>
                                            <th>Modelo</th>
                                            <th>Año</th>
                                            <th>Capacidad</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trucksTableBody">
                                        @foreach($camiones as $camion)
                                            <tr>
                                                <td><strong>{{ $camion->placa }}</strong></td>
                                                <td>{{ $camion->modelo }}</td>
                                                <td>{{ $camion->anio }}</td>
                                                <td>{{ $camion->capacidad_carga }} Ton</td>
                                                <td>
                                                    <span class="status-badge status-{{ $camion->estado }}">
                                                        {{ ucfirst($camion->estado) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="{{ route('camiones.show', $camion->id) }}"
                                                            class="btn btn-secondary btn-sm" title="Ver detalles">👁️</a>
                                                        <a href="{{ route('camiones.edit', $camion->id) }}"
                                                            class="btn btn-secondary btn-sm" title="Editar">✏️</a>
                                                        <form action="{{ route('camiones.destroy', $camion->id) }}"
                                                            method="POST" style="display: inline;"
                                                            onsubmit="return confirm('¿Está seguro de que desea eliminar este camión?')">
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
                            </div>
                        @else
                            <div class="empty-state">
                                <div style="font-size: 4rem; margin-bottom: 1rem;">🚛</div>
                                <h3>No hay camiones registrados</h3>
                                <p>Comienza agregando tu primer camión a la flotilla</p>
                                <a href="{{ route('camiones.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                    ➕ Registrar Primer Camión
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Variables globales
        let currentTrucksData = [];

        // Inicialización
        document.addEventListener('DOMContentLoaded', function () {
            setupEventListeners();
            updateDateTime();
            setInterval(updateDateTime, 1000); // Actualizar cada segundo
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

            // Cerrar sidebar al hacer clic en un enlace (móvil)
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 767) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    }
                });
            });

            // Search functionality
            if (document.getElementById('searchTable')) {
                document.getElementById('searchTable').addEventListener('input', function () {
                    filtrarTabla(this.value);
                });
            }

            // Prevenir zoom accidental en iOS
            if (isMobile()) {
                document.addEventListener('touchmove', function(e) {
                    if (e.touches.length > 1) {
                        e.preventDefault();
                    }
                }, { passive: false });

                let lastTouchEnd = 0;
                document.addEventListener('touchend', function(e) {
                    const now = (new Date()).getTime();
                    if (now - lastTouchEnd <= 300) {
                        e.preventDefault();
                    }
                    lastTouchEnd = now;
                }, false);
            }
        }

        // Función para actualizar fecha y hora
        function updateDateTime() {
            const now = new Date();
            
            // Configurar opciones de formato para México
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                timeZone: 'America/Mexico_City'
            };
            
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true,
                timeZone: 'America/Mexico_City'
            };
            
            // Formatear fecha y hora
            const dateStr = now.toLocaleDateString('es-MX', dateOptions);
            const timeStr = now.toLocaleTimeString('es-MX', timeOptions);
            
            // Actualizar elementos del DOM
            const dateElement = document.getElementById('dateText');
            const timeElement = document.getElementById('timeText');
            
            if (dateElement && timeElement) {
                dateElement.textContent = dateStr.charAt(0).toUpperCase() + dateStr.slice(1);
                timeElement.textContent = timeStr;
            }
        }

        // Detectar dispositivo móvil
        function isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

        // Función para filtrar tabla
        function filtrarTabla(termino) {
            const rows = document.querySelectorAll('#trucksTableBody tr');
            let visibleRows = 0;

            rows.forEach(row => {
                const texto = row.textContent.toLowerCase();
                if (texto.includes(termino.toLowerCase())) {
                    row.style.display = '';
                    visibleRows++;
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Función para ir al perfil
        function goToProfile() {
            // Agregar efecto visual
            const userInfo = document.querySelector('.user-info');
            userInfo.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                userInfo.style.transform = '';
                // Navegar al perfil
                window.location.href = '/profile';
            }, 150);
        }

        // Función para eliminar camión
        function deleteTruck(id) {
            if (confirm('¿Está seguro de que desea eliminar este camión?')) {
                // El formulario ya maneja la eliminación con Laravel
                return true;
            }
            return false;
        }

        // Función para mostrar alertas (mantenida para compatibilidad)
        function showAlert(type, message) {
            // Esta función se mantiene para compatibilidad, pero las alertas 
            // ahora se manejan desde el servidor con session flash messages
            console.log(`${type}: ${message}`);
        }

        // Función para cerrar sesión
        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                // Crear form para logout con método POST
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/logout';
                
                // Agregar token CSRF
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken.getAttribute('content');
                    form.appendChild(csrfInput);
                }
                
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Manejo de orientación y redimensionamiento
        function handleOrientationChange() {
            setTimeout(() => {
                // Reajustar elementos si es necesario
                const content = document.querySelector('.content');
                if (content) {
                    content.scrollTop = 0;
                }
            }, 100);
        }

        // Event listeners para orientación y redimensionamiento
        window.addEventListener('orientationchange', handleOrientationChange);
        window.addEventListener('resize', debounce(handleOrientationChange, 250));

        // Función debounce para optimizar rendimiento
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

        // Simulación de datos dinámicos (eliminada - ahora se usa datos reales del servidor)
        // La función updateStats() se eliminó porque las estadísticas 
        // ahora se calculan dinámicamente desde el controlador Laravel

        // Actualizar estadísticas al cargar (comentado - no necesario)
        // setTimeout(updateStats, 100);
    </script>
</body>

</html>