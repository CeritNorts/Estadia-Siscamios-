<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino-Flotilla</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-height: 0;
        }

        /* Dashboard Stats */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0.75rem;
            padding: 0.75rem;
            flex-shrink: 0;
        }

        .stat-card {
            background: white;
            padding: 0.875rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            min-width: 0;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            line-height: 1;
        }

        .stat-label {
            color: #666;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        /* Map Container */
        .map-container {
            flex: 1;
            position: relative;
            margin: 0.75rem;
            margin-top: 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            min-height: 300px;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        /* Draggable Map Controls */
        .map-controls {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1000;
            cursor: move;
            user-select: none;
            max-width: calc(100% - 30px);
        }

        .control-panel {
            background: rgba(255, 255, 255, 0.95);
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            max-width: 280px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .control-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 1px solid #eee;
        }

        .control-panel-title {
            color: #333;
            font-size: 0.85rem;
            font-weight: 600;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1;
        }

        .control-header-actions {
            display: flex;
            gap: 4px;
            flex-shrink: 0;
        }

        .drag-handle {
            cursor: move;
            color: #999;
            font-size: 14px;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
            line-height: 1;
        }

        .drag-handle:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .minimize-btn {
            background: none;
            border: none;
            color: #999;
            font-size: 12px;
            cursor: pointer;
            padding: 4px 6px;
            border-radius: 4px;
            transition: all 0.2s ease;
            line-height: 1;
        }

        .minimize-btn:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .control-panel-content {
            transition: all 0.3s ease;
        }

        .control-panel.minimized .control-panel-content {
            display: none;
        }

        .control-panel.minimized {
            min-width: auto;
            width: auto;
        }

        .filter-group {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-bottom: 8px;
        }

        .filter-btn {
            padding: 6px 10px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 16px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .filter-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }

        .filter-btn:hover {
            background: #f8f9ff;
            border-color: #667eea;
        }

        .filter-btn.active:hover {
            background: #5a6fd8;
        }

        .center-btn {
            width: 100%;
            padding: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-top: 6px;
        }

        .center-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        /* Dragging state */
        .control-panel.dragging {
            transform: rotate(2deg);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            cursor: grabbing;
        }

        /* Custom Leaflet Popup */
        .custom-popup {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .popup-header {
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
            padding-bottom: 4px;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
        }

        .popup-info {
            font-size: 0.8rem;
            line-height: 1.4;
        }

        .popup-info div {
            margin: 2px 0;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-disponible { background: #d4edda; color: #155724; }
        .status-ruta { background: #cce5ff; color: #0056b3; }
        .status-transito { background: #fff3cd; color: #856404; }
        .status-mantenimiento { background: #f8d7da; color: #721c24; }

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
            
            .dashboard-stats {
                grid-template-columns: repeat(4, 1fr);
                padding: 1rem;
                gap: 1rem;
            }
            
            .stat-card {
                padding: 1.25rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .stat-label {
                font-size: 0.9rem;
                margin-top: 0.5rem;
            }
            
            .map-container {
                margin: 1rem;
                margin-top: 0;
            }
            
            .map-controls {
                top: 20px;
                right: 20px;
            }
            
            .control-panel {
                min-width: 220px;
                max-width: 300px;
                padding: 15px;
            }
            
            .control-panel-title {
                font-size: 0.95rem;
            }
            
            .filter-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
            }
            
            .center-btn {
                padding: 10px;
                font-size: 0.85rem;
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
            
            .dashboard-stats {
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
            
            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.5rem;
            }
            
            .stat-card {
                padding: 0.75rem;
            }
            
            .stat-number {
                font-size: 1.25rem;
            }
            
            .control-panel {
                max-width: 240px;
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

            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
                padding: 0.5rem;
                gap: 0.5rem;
            }
            
            .stat-card {
                padding: 0.6rem;
            }
            
            .stat-number {
                font-size: 1.1rem;
            }
            
            .stat-label {
                font-size: 0.7rem;
            }

            .map-container {
                margin: 0.5rem;
                margin-top: 0;
            }

            .map-controls {
                top: 10px;
                right: 10px;
                left: 10px;
                max-width: calc(100% - 20px);
            }

            .control-panel {
                min-width: 180px;
                max-width: 100%;
                padding: 10px;
            }
            
            .control-panel-title {
                font-size: 0.8rem;
            }
            
            .filter-group {
                gap: 3px;
            }
            
            .filter-btn {
                padding: 5px 8px;
                font-size: 0.7rem;
            }
            
            .center-btn {
                padding: 7px;
                font-size: 0.75rem;
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

            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
                padding: 0.25rem;
                gap: 0.25rem;
            }
            
            .stat-card {
                padding: 0.5rem;
            }
            
            .stat-number {
                font-size: 1rem;
            }
            
            .stat-label {
                font-size: 0.65rem;
            }

            .map-container {
                margin: 0.25rem;
                margin-top: 0;
                border-radius: 6px;
                min-height: 250px;
            }

            .map-controls {
                top: 5px;
                right: 5px;
                left: 5px;
                max-width: calc(100% - 10px);
            }

            .control-panel {
                min-width: 160px;
                max-width: 100%;
                padding: 8px;
                border-radius: 8px;
            }
            
            .control-panel-title {
                font-size: 0.75rem;
            }
            
            .control-header-actions {
                gap: 2px;
            }
            
            .drag-handle {
                font-size: 12px;
                padding: 2px;
            }
            
            .minimize-btn {
                font-size: 10px;
                padding: 2px 4px;
            }
            
            .filter-group {
                gap: 2px;
                margin-bottom: 6px;
            }
            
            .filter-btn {
                padding: 4px 6px;
                font-size: 0.65rem;
                border-radius: 12px;
            }
            
            .center-btn {
                padding: 6px;
                font-size: 0.7rem;
                margin-top: 4px;
            }
            
            .popup-header {
                font-size: 0.8rem;
            }
            
            .popup-info {
                font-size: 0.7rem;
            }
            
            .status-badge {
                font-size: 0.6rem;
                padding: 1px 4px;
            }
        }

        /* Ultra Small Screens (below 360px) */
        @media (max-width: 359px) {
            .sidebar {
                width: 240px;
            }
            
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
            
            .navbar-title {
                display: none;
            }

            .datetime-display {
                display: none;
            }
            
            .control-panel {
                min-width: 140px;
                padding: 6px;
            }
            
            .control-panel-title {
                font-size: 0.7rem;
            }
            
            .filter-btn {
                font-size: 0.6rem;
                padding: 3px 5px;
            }
            
            .center-btn {
                font-size: 0.65rem;
                padding: 5px;
            }
        }

        /* Touch device optimizations */
        @media (hover: none) and (pointer: coarse) {
            .filter-btn {
                min-height: 32px;
                min-width: 44px;
            }
            
            .center-btn {
                min-height: 36px;
            }
            
            .drag-handle,
            .minimize-btn {
                min-height: 28px;
                min-width: 28px;
            }
            
            .sidebar-toggle {
                min-height: 36px;
                min-width: 36px;
            }
        }

        /* High DPI displays */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .control-panel {
                border-width: 0.5px;
            }
            
            .status-badge {
                border: 0.5px solid rgba(0, 0, 0, 0.1);
            }
        }

        /* Landscape orientation on phones */
        @media (max-height: 500px) and (orientation: landscape) and (max-width: 900px) {
            .dashboard-stats {
                display: none;
            }
            
            .navbar-content {
                padding: 0.5rem;
                min-height: 45px;
            }
            
            .map-container {
                margin: 0.25rem;
                margin-top: 0;
            }
            
            .control-panel {
                max-width: 200px;
                padding: 8px;
            }
            
            .filter-group {
                flex-direction: column;
                gap: 2px;
            }
            
            .filter-btn {
                width: 100%;
                text-align: center;
            }
        }

        /* Print styles */
        @media print {
            .sidebar,
            .navbar,
            .dashboard-stats,
            .map-controls {
                display: none;
            }
            
            .main-content,
            .content,
            .map-container {
                margin: 0;
                padding: 0;
                border-radius: 0;
                box-shadow: none;
            }
            
            #map {
                height: 100vh;
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
                <a href="{{ route('combustible') }}">⛽ Combustible</a>
            </li>

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
                    <h1 class="navbar-title">Panel administrativo</h1>
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
            <!-- Dashboard Stats -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-number" id="disponibles">8</div>
                    <div class="stat-label">Disponibles</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="enRuta">5</div>
                    <div class="stat-label">En Ruta</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="enTransito">3</div>
                    <div class="stat-label">En Tránsito</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="enMantenimiento">2</div>
                    <div class="stat-label">Mantenimiento</div>
                </div>
            </div>

            <!-- Map Container -->
            <div class="map-container">
                <div id="map"></div>
                
                <!-- Draggable Map Controls -->
                <div class="map-controls" id="mapControls">
                    <div class="control-panel" id="controlPanel">
                        <div class="control-panel-header">
                            <h4 class="control-panel-title">🚛 Filtros de Unidades</h4>
                            <div class="control-header-actions">
                                <span class="drag-handle" title="Arrastra para mover">⋮⋮</span>
                                <button class="minimize-btn" id="minimizeBtn" title="Minimizar">−</button>
                            </div>
                        </div>
                        <div class="control-panel-content">
                            <div class="filter-group">
                                <button class="filter-btn active" data-filter="todos">Todos</button>
                                <button class="filter-btn" data-filter="disponible">Disponibles</button>
                                <button class="filter-btn" data-filter="ruta">En Ruta</button>
                                <button class="filter-btn" data-filter="transito">En Tránsito</button>
                                <button class="filter-btn" data-filter="mantenimiento">Mantenimiento</button>
                            </div>
                            <button class="center-btn" onclick="centerMap()">📍 Centrar Mapa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Variables globales
        let map;
        let truckMarkers = [];
        let routeLayer;

        // Variables para drag and drop
        let isDragging = false;
        let dragOffset = { x: 0, y: 0 };
        let touchStartPosition = { x: 0, y: 0 };

        // Datos simulados de camiones
        const trucksData = [
            {
                id: 'CAM-001',
                lat: 18.8614,
                lng: -96.9194,
                status: 'disponible',
                driver: 'Juan Pérez',
                fuel: 85,
                lastUpdate: '10:30 AM'
            },
            {
                id: 'CAM-002',
                lat: 18.8845,
                lng: -96.9003,
                status: 'ruta',
                driver: 'María González',
                fuel: 62,
                destination: 'México DF',
                lastUpdate: '10:25 AM'
            },
            {
                id: 'CAM-003',
                lat: 18.8394,
                lng: -96.9542,
                status: 'transito',
                driver: 'Carlos López',
                fuel: 78,
                destination: 'Puebla',
                lastUpdate: '10:15 AM'
            },
            {
                id: 'CAM-004',
                lat: 18.8712,
                lng: -96.9325,
                status: 'mantenimiento',
                driver: 'Ana Martínez',
                fuel: 45,
                lastUpdate: '09:45 AM'
            },
            {
                id: 'CAM-005',
                lat: 18.8456,
                lng: -96.9123,
                status: 'disponible',
                driver: 'Roberto Silva',
                fuel: 92,
                lastUpdate: '10:35 AM'
            }
        ];

        // Detectar tipo de dispositivo
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

        // Función para cargar marcadores de camiones
        function loadTruckMarkers() {
            // Limpiar marcadores existentes
            truckMarkers.forEach(marker => {
                map.removeLayer(marker);
            });
            truckMarkers = [];

            // Crear nuevos marcadores
            trucksData.forEach(truck => {
                const marker = L.marker([truck.lat, truck.lng], {
                    icon: getTruckIcon(truck.status)
                }).bindPopup(createPopupContent(truck));

                marker.truckData = truck;
                truckMarkers.push(marker);
                marker.addTo(map);
            });
        }

        // Inicializar mapa
        function initMap() {
            // Coordenadas de Córdoba, Veracruz
            map = L.map('map', {
                zoomControl: true,
                attributionControl: true,
                preferCanvas: true // Mejor rendimiento en móviles
            }).setView([18.8614, -96.9194], 13);

            // Agregar capa de mapa
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19,
                tileSize: 256,
                zoomOffset: 0
            }).addTo(map);

            // Cargar marcadores de camiones
            loadTruckMarkers();

            // Configuraciones específicas para móviles
            if (isMobile) {
                map.options.tap = true;
                map.options.tapTolerance = 15;
            }
        }

        // Obtener icono según el estatus
        function getTruckIcon(status) {
            const colors = {
                'disponible': '#28a745',
                'ruta': '#007bff',
                'transito': '#ffc107',
                'mantenimiento': '#dc3545'
            };

            const size = isMobile ? 16 : 20;
            const borderSize = isMobile ? 2 : 3;

            return L.divIcon({
                html: `<div style="background-color: ${colors[status]}; width: ${size}px; height: ${size}px; border-radius: 50%; border: ${borderSize}px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.3);"></div>`,
                className: 'custom-truck-icon',
                iconSize: [size + borderSize * 2, size + borderSize * 2],
                iconAnchor: [(size + borderSize * 2) / 2, (size + borderSize * 2) / 2]
            });
        }

        // Crear contenido del popup
        function createPopupContent(truck) {
            const statusLabels = {
                'disponible': 'Disponible',
                'ruta': 'En Ruta',
                'transito': 'En Tránsito',
                'mantenimiento': 'Mantenimiento'
            };

            return `
                <div class="custom-popup">
                    <div class="popup-header">🚛 ${truck.id}</div>
                    <div class="popup-info">
                        <div><strong>Conductor:</strong> ${truck.driver}</div>
                        <div><strong>Estado:</strong> <span class="status-badge status-${truck.status}">${statusLabels[truck.status]}</span></div>
                        <div><strong>Combustible:</strong> ${truck.fuel}%</div>
                        ${truck.destination ? `<div><strong>Destino:</strong> ${truck.destination}</div>` : ''}
                        <div><strong>Última actualización:</strong> ${truck.lastUpdate}</div>
                    </div>
                </div>
            `;
        }

        // Filtrar camiones por estatus
        function filterTrucks(status) {
            truckMarkers.forEach(marker => {
                if (status === 'todos' || marker.truckData.status === status) {
                    marker.addTo(map);
                } else {
                    map.removeLayer(marker);
                }
            });
        }

        // Centrar mapa
        function centerMap() {
            map.setView([18.8614, -96.9194], 13);
        }

        // Actualizar estadísticas
        function updateStats() {
            const stats = {
                disponible: 0,
                ruta: 0,
                transito: 0,
                mantenimiento: 0
            };

            trucksData.forEach(truck => {
                stats[truck.status]++;
            });

            document.getElementById('disponibles').textContent = stats.disponible;
            document.getElementById('enRuta').textContent = stats.ruta;
            document.getElementById('enTransito').textContent = stats.transito;
            document.getElementById('enMantenimiento').textContent = stats.mantenimiento;
        }

        // Inicializar funcionalidad de drag and drop
        function initDragAndDrop() {
            const controlPanel = document.getElementById('controlPanel');
            const mapControls = document.getElementById('mapControls');
            const dragHandle = controlPanel.querySelector('.drag-handle');
            const header = controlPanel.querySelector('.control-panel-header');

            // Funciones para mouse
            function startDragMouse(e) {
                if (e.target.closest('.minimize-btn')) return;
                
                isDragging = true;
                controlPanel.classList.add('dragging');
                
                const rect = mapControls.getBoundingClientRect();
                dragOffset.x = e.clientX - rect.left;
                dragOffset.y = e.clientY - rect.top;
                
                document.addEventListener('mousemove', dragMouse);
                document.addEventListener('mouseup', stopDragMouse);
                e.preventDefault();
            }

            function dragMouse(e) {
                if (!isDragging) return;
                movePanel(e.clientX, e.clientY);
            }

            function stopDragMouse() {
                isDragging = false;
                controlPanel.classList.remove('dragging');
                document.removeEventListener('mousemove', dragMouse);
                document.removeEventListener('mouseup', stopDragMouse);
            }

            // Funciones para touch
            function startDragTouch(e) {
                if (e.target.closest('.minimize-btn')) return;
                
                isDragging = true;
                controlPanel.classList.add('dragging');
                
                const touch = e.touches[0];
                const rect = mapControls.getBoundingClientRect();
                dragOffset.x = touch.clientX - rect.left;
                dragOffset.y = touch.clientY - rect.top;
                
                document.addEventListener('touchmove', dragTouch, { passive: false });
                document.addEventListener('touchend', stopDragTouch);
                e.preventDefault();
            }

            function dragTouch(e) {
                if (!isDragging) return;
                e.preventDefault();
                const touch = e.touches[0];
                movePanel(touch.clientX, touch.clientY);
            }

            function stopDragTouch() {
                isDragging = false;
                controlPanel.classList.remove('dragging');
                document.removeEventListener('touchmove', dragTouch);
                document.removeEventListener('touchend', stopDragTouch);
            }

            // Función común para mover el panel
            function movePanel(clientX, clientY) {
                const mapContainer = document.querySelector('.map-container');
                const mapRect = mapContainer.getBoundingClientRect();
                const panelRect = controlPanel.getBoundingClientRect();
                
                let newX = clientX - mapRect.left - dragOffset.x;
                let newY = clientY - mapRect.top - dragOffset.y;
                
                // Limitar el movimiento dentro del contenedor del mapa
                const margin = 10;
                newX = Math.max(margin, Math.min(newX, mapRect.width - panelRect.width - margin));
                newY = Math.max(margin, Math.min(newY, mapRect.height - panelRect.height - margin));
                
                mapControls.style.left = newX + 'px';
                mapControls.style.top = newY + 'px';
                mapControls.style.right = 'auto';
                mapControls.style.bottom = 'auto';
            }

            // Event listeners
            if (isTouchDevice) {
                dragHandle.addEventListener('touchstart', startDragTouch);
                header.addEventListener('touchstart', startDragTouch);
            } else {
                dragHandle.addEventListener('mousedown', startDragMouse);
                header.addEventListener('mousedown', startDragMouse);
            }
        }

        // Funcionalidad de minimizar
        function initMinimize() {
            const minimizeBtn = document.getElementById('minimizeBtn');
            const controlPanel = document.getElementById('controlPanel');
            let isMinimized = false;

            minimizeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                isMinimized = !isMinimized;
                controlPanel.classList.toggle('minimized', isMinimized);
                minimizeBtn.textContent = isMinimized ? '+' : '−';
                minimizeBtn.title = isMinimized ? 'Expandir' : 'Minimizar';
            });
        }

        // Simulación de actualización en tiempo real
        function simulateRealTimeUpdates() {
            setInterval(() => {
                // Simular cambios aleatorios en posición y combustible
                trucksData.forEach(truck => {
                    if (truck.status === 'ruta' || truck.status === 'transito') {
                        truck.lat += (Math.random() - 0.5) * 0.001;
                        truck.lng += (Math.random() - 0.5) * 0.001;
                        truck.fuel = Math.max(10, truck.fuel - Math.random() * 2);
                    }
                });

                // Recargar marcadores
                loadTruckMarkers();
                updateStats();
            }, 30000); // Actualizar cada 30 segundos
        }

        // Función para ajustar el layout en cambio de orientación
        function handleOrientationChange() {
            setTimeout(() => {
                if (map) {
                    map.invalidateSize();
                }
                
                // Reposicionar el panel de control si está fuera de los límites
                const mapControls = document.getElementById('mapControls');
                const mapContainer = document.querySelector('.map-container');
                const controlPanel = document.getElementById('controlPanel');
                
                if (mapControls && mapContainer && controlPanel) {
                    const mapRect = mapContainer.getBoundingClientRect();
                    const panelRect = controlPanel.getBoundingClientRect();
                    const currentStyle = mapControls.style;
                    
                    if (currentStyle.left && currentStyle.top) {
                        const currentX = parseInt(currentStyle.left);
                        const currentY = parseInt(currentStyle.top);
                        
                        const margin = 10;
                        const maxX = mapRect.width - panelRect.width - margin;
                        const maxY = mapRect.height - panelRect.height - margin;
                        
                        if (currentX > maxX || currentY > maxY) {
                            const newX = Math.min(currentX, maxX);
                            const newY = Math.min(currentY, maxY);
                            
                            mapControls.style.left = Math.max(margin, newX) + 'px';
                            mapControls.style.top = Math.max(margin, newY) + 'px';
                        }
                    }
                }
            }, 100);
        }

        // Event listeners principales
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar componentes
            initMap();
            updateStats();
            simulateRealTimeUpdates();
            initDragAndDrop();
            initMinimize();
            
            // Inicializar fecha y hora
            updateDateTime();
            setInterval(updateDateTime, 1000); // Actualizar cada segundo

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

            // Cerrar sidebar al hacer clic en un enlace (móvil)
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 767) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    }
                });
            });

            // Filtros
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remover clase active de todos los botones
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    // Agregar clase active al botón clickeado
                    this.classList.add('active');
                    
                    const filter = this.getAttribute('data-filter');
                    if (filter) {
                        filterTrucks(filter);
                    }
                });
            });
        });

        // Event listeners para orientación y redimensionamiento
        window.addEventListener('orientationchange', handleOrientationChange);
        window.addEventListener('resize', handleOrientationChange);

        // Prevenir zoom accidental en iOS
        if (isMobile) {
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

        // Función para ir al perfil
        function goToProfile() {
            // Agregar efecto visual
            const userInfo = document.querySelector('.user-info');
            userInfo.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                userInfo.style.transform = '';
                // Aquí iría la navegación real al perfil
                alert('Navegando al perfil...');
                // window.location.href = '/profile';
            }, 150);
        }

        // Optimización de rendimiento
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

        // Aplicar debounce a funciones que se ejecutan frecuentemente
        const debouncedHandleOrientationChange = debounce(handleOrientationChange, 250);
        window.removeEventListener('resize', handleOrientationChange);
        window.addEventListener('resize', debouncedHandleOrientationChange);

        // Función para cerrar sesión
        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                alert('Cerrando sesión...');
                // Aquí iría la lógica de logout real
            }
        }
    </script>
</body>
</html>