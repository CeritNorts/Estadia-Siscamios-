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
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Map Container */
        .map-container {
            flex: 1;
            position: relative;
            margin: 1rem;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        #map {
            height: 100%;
            width: 100%;
        }

        /* Map Controls */
        .map-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .control-panel {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            min-width: 200px;
        }

        .control-panel h4 {
            margin-bottom: 10px;
            color: #333;
            font-size: 14px;
        }

        .filter-group {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 10px;
        }

        .filter-btn {
            padding: 5px 10px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .filter-btn:hover {
            background: #f0f0f0;
        }

        .filter-btn.active:hover {
            background: #5a6fd8;
        }

        /* Dashboard Stats */
        .dashboard-stats {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            flex-wrap: wrap;
        }

        .stat-card {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 150px;
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Custom Leaflet Popup */
        .custom-popup {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .popup-header {
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        .popup-info {
            font-size: 13px;
            line-height: 1.4;
        }

        .popup-info div {
            margin: 3px 0;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-disponible { background: #d4edda; color: #155724; }
        .status-ruta { background: #cce5ff; color: #0056b3; }
        .status-transito { background: #fff3cd; color: #856404; }
        .status-mantenimiento { background: #f8d7da; color: #721c24; }

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

            .dashboard-stats {
                flex-direction: column;
            }

            .control-panel {
                position: static;
                margin: 10px;
                margin-bottom: 0;
            }

            .map-controls {
                position: static;
                margin: 1rem;
                margin-bottom: 0;
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
                    <h1 class="navbar-title">Panel administrativo</h1>
                </div>
                <div class="navbar-links">
                    <a href="/profile">Perfil</a>
                    <a href="#">Notificaciones</a>
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

            <!-- Map Controls -->
            <div class="map-controls">
                <div class="control-panel">
                    <h4>🚛 Filtros de Unidades</h4>
                    <div class="filter-group">
                        <button class="filter-btn active" data-filter="todos">Todos</button>
                        <button class="filter-btn" data-filter="disponible">Disponibles</button>
                        <button class="filter-btn" data-filter="ruta">En Ruta</button>
                        <button class="filter-btn" data-filter="transito">En Tránsito</button>
                        <button class="filter-btn" data-filter="mantenimiento">Mantenimiento</button>
                    </div>
                    <button class="filter-btn" onclick="centerMap()" style="width: 100%; margin-top: 10px;">📍 Centrar Mapa</button>
                </div>
            </div>

            <!-- Map Container -->
            <div class="map-container">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Variables globales
        let map;
        let truckMarkers = [];
        let routeLayer;

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

        // Inicializar mapa
        function initMap() {
            // Coordenadas de Córdoba, Veracruz
            map = L.map('map').setView([18.8614, -96.9194], 13);

            // Agregar capa de mapa
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                
            }).addTo(map);

            // Cargar marcadores de camiones
            loadTruckMarkers();
        }

        

        // Obtener icono según el estatus
        function getTruckIcon(status) {
            const colors = {
                'disponible': '#28a745',
                'ruta': '#007bff',
                'transito': '#ffc107',
                'mantenimiento': '#dc3545'
            };

            return L.divIcon({
                html: `<div style="background-color: ${colors[status]}; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.3);"></div>`,
                className: 'custom-truck-icon',
                iconSize: [26, 26],
                iconAnchor: [13, 13]
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

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar mapa
            initMap();
            updateStats();
            simulateRealTimeUpdates();

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