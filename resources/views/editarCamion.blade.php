<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Camión - Siscamino</title>
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
            max-width: 800px;
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

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: #666;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Form Styles */
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .form-header h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            opacity: 0.9;
        }

        .form-body {
            padding: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group .required {
            color: #dc3545;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
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

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e9ecef;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
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

        /* Current Info Card */
        .current-info {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .current-info h4 {
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 0.875rem;
            color: #666;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 500;
            color: #333;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
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

        /* Mobile Responsive */
        @media (max-width: 1200px) {
            .content {
                padding: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 260px;
            }

            .navbar-content {
                padding: 1rem 1.5rem;
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .btn {
                justify-content: center;
            }

            .datetime-display {
                order: -1;
                width: auto;
                align-items: flex-start;
                margin-bottom: 0;
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

            .page-title {
                font-size: 1.5rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
            }

            .form-container {
                border-radius: 8px;
            }

            .form-header,
            .form-body {
                padding: 1.5rem;
            }

            .navbar-title {
                font-size: 1rem;
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
                font-size: 0.9rem;
            }

            .form-header,
            .form-body {
                padding: 1rem;
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
            .navbar {
                display: none;
            }

            .main-content {
                width: 100%;
            }

            .content {
                padding: 0;
            }

            .form-container {
                box-shadow: none;
                border: 1px solid #ddd;
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
                    <h1 class="navbar-title">Editar Camión</h1>
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

                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="/dashboard">🏠 Inicio</a>
                    <span>›</span>
                    <a href="/camiones">🚛 Camiones</a>
                    <span>›</span>
                    <span>✏️ Editar</span>
                </div>

                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin: 0; padding-left: 1rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Editar Camión</h1>
                        <p class="page-subtitle">Modifica la información del vehículo seleccionado</p>
                    </div>
                </div>

                <!-- Current Info -->
                <div class="current-info">
                    <h4>📋 Información Actual del Camión</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Placa</span>
                            <span class="info-value">{{ $camion->placa ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Modelo</span>
                            <span class="info-value">{{ $camion->modelo ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Año</span>
                            <span class="info-value">{{ $camion->anio ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Estado</span>
                            <span class="status-badge status-{{ $camion->estado ?? 'activo' }}">
                                {{ ucfirst($camion->estado ?? 'activo') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2>✏️ Formulario de Edición</h2>
                        <p>Actualiza los datos del camión según sea necesario</p>
                    </div>

                    <div class="form-body">
                        <form id="editTruckForm" method="POST" action="{{ route('camiones.update', $camion->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-grid">
                                <!-- Información Básica -->
                                <div>
                                    <h3 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #667eea; padding-bottom: 0.5rem;">
                                        🚛 Información Básica
                                    </h3>

                                    <div class="form-group">
                                        <label for="placa">Placa del Vehículo <span class="required">*</span></label>
                                        <input type="text" 
                                               id="placa" 
                                               name="placa" 
                                               class="form-control @error('placa') error @enderror" 
                                               value="{{ old('placa', $camion->placa ?? '') }}"
                                               placeholder="Ej: ABC-123" 
                                               required>
                                        @error('placa')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="modelo">Modelo <span class="required">*</span></label>
                                        <input type="text" 
                                               id="modelo" 
                                               name="modelo" 
                                               class="form-control @error('modelo') error @enderror" 
                                               value="{{ old('modelo', $camion->modelo ?? '') }}"
                                               placeholder="Ej: FH 440, Actros 2642" 
                                               required>
                                        @error('modelo')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="anio">Año <span class="required">*</span></label>
                                        <input type="number" 
                                               id="anio" 
                                               name="anio" 
                                               class="form-control @error('anio') error @enderror" 
                                               value="{{ old('anio', $camion->anio ?? '') }}"
                                               min="1990" 
                                               max="2025" 
                                               required>
                                        @error('anio')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Especificaciones Técnicas -->
                                <div>
                                    <h3 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #667eea; padding-bottom: 0.5rem;">
                                        ⚙️ Especificaciones Técnicas
                                    </h3>

                                    <div class="form-group">
                                        <label for="capacidad_carga">Capacidad de Carga (Toneladas) <span class="required">*</span></label>
                                        <input type="number" 
                                               id="capacidad_carga" 
                                               name="capacidad_carga" 
                                               class="form-control @error('capacidad_carga') error @enderror" 
                                               value="{{ old('capacidad_carga', $camion->capacidad_carga ?? '') }}"
                                               min="1" 
                                               max="100" 
                                               step="0.5" 
                                               required>
                                        @error('capacidad_carga')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Estado del Vehículo <span class="required">*</span></label>
                                        <select id="estado" name="estado" class="form-control @error('estado') error @enderror" required>
                                            <option value="activo" {{ old('estado', $camion->estado ?? 'activo') == 'activo' ? 'selected' : '' }}>
                                                🟢 Activo
                                            </option>
                                            <option value="mantenimiento" {{ old('estado', $camion->estado ?? '') == 'mantenimiento' ? 'selected' : '' }}>
                                                🔴 En Mantenimiento
                                            </option>
                                            <option value="inactivo" {{ old('estado', $camion->estado ?? '') == 'inactivo' ? 'selected' : '' }}>
                                                ⚪ Inactivo
                                            </option>
                                        </select>
                                        @error('estado')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Observaciones -->
                            <div class="form-group" style="margin-top: 2rem;">
                                <label for="observaciones">Observaciones Adicionales</label>
                                <textarea id="observaciones" 
                                          name="observaciones" 
                                          class="form-control @error('observaciones') error @enderror" 
                                          rows="4" 
                                          placeholder="Ingrese cualquier observación adicional sobre el camión...">{{ old('observaciones', $camion->observaciones ?? '') }}</textarea>
                                @error('observaciones')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="{{ route('camiones.index') }}" class="btn btn-secondary">
                                    ↩️ Cancelar
                                </a>
                                <button type="button" onclick="resetForm()" class="btn btn-secondary">
                                    🔄 Restablecer
                                </button>
                                <button type="submit" class="btn btn-success">
                                    💾 Guardar Cambios
                                </button>
                            </div>
                        </form>
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

            // Form submission
            document.getElementById('editTruckForm').addEventListener('submit', function (e) {
                // Permitir el envío normal del formulario a Laravel
                showLoadingState();
            });

            // Real-time validation
            const formInputs = document.querySelectorAll('.form-control');
            formInputs.forEach(input => {
                input.addEventListener('blur', function () {
                    validateField(this);
                });
            });

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

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Escape key to close sidebar
                if (e.key === 'Escape') {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });

            // Auto-hide alerts after 5 seconds
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

        function validateField(field) {
            const fieldName = field.name;
            let isValid = true;
            let errorMessage = '';

            // Limpiar estilos previos
            field.classList.remove('error');

            // Validaciones específicas
            switch (fieldName) {
                case 'placa':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = 'La placa es obligatoria';
                    } else if (!/^[A-Z]{3}-\d{3}$/.test(field.value.trim())) {
                        isValid = false;
                        errorMessage = 'Formato de placa inválido (Ej: ABC-123)';
                    }
                    break;

                case 'modelo':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = 'El modelo es obligatorio';
                    }
                    break;

                case 'anio':
                    const year = parseInt(field.value);
                    const currentYear = new Date().getFullYear();
                    if (!year || year < 1990 || year > currentYear) {
                        isValid = false;
                        errorMessage = `Año debe estar entre 1990 y ${currentYear}`;
                    }
                    break;

                case 'capacidad_carga':
                    const capacity = parseFloat(field.value);
                    if (!capacity || capacity <= 0 || capacity > 100) {
                        isValid = false;
                        errorMessage = 'Capacidad debe estar entre 1 y 100 toneladas';
                    }
                    break;
            }

            // Aplicar estilos de error
            if (!isValid) {
                field.classList.add('error');
                // Mostrar mensaje de error si existe un elemento para ello
                const errorElement = field.parentNode.querySelector('.error-message');
                if (errorElement) {
                    errorElement.textContent = errorMessage;
                }
            }

            return isValid;
        }

        function showLoadingState() {
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '⏳ Guardando...';
            submitBtn.disabled = true;

            // Restaurar estado si hay error (en caso de que la página no se recargue)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 10000);
        }

        function resetForm() {
            if (confirm('¿Está seguro de que desea restablecer el formulario a sus valores originales?')) {
                // Obtener los valores originales del camión
                const originalValues = {
                    placa: '{{ $camion->placa ?? "" }}',
                    modelo: '{{ $camion->modelo ?? "" }}',
                    anio: '{{ $camion->anio ?? "" }}',
                    capacidad_carga: '{{ $camion->capacidad_carga ?? "" }}',
                    estado: '{{ $camion->estado ?? "activo" }}',
                    observaciones: '{{ $camion->observaciones ?? "" }}'
                };

                // Restablecer cada campo
                Object.keys(originalValues).forEach(key => {
                    const element = document.getElementById(key);
                    if (element) {
                        element.value = originalValues[key];
                        element.classList.remove('error');
                    }
                });

                // Limpiar mensajes de error
                document.querySelectorAll('.error-message').forEach(error => {
                    error.textContent = '';
                });

                showAlert('Formulario restablecido a valores originales', 'success');
            }
        }

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            alertDiv.textContent = message;
            
            const container = document.querySelector('.content-wrapper');
            container.insertBefore(alertDiv, container.firstChild);
            
            // Auto-hide alert after 5 seconds
            setTimeout(() => {
                alertDiv.style.opacity = '0';
                setTimeout(() => {
                    alertDiv.remove();
                }, 300);
            }, 5000);
        }

        function goToProfile() {
            window.location.href = '/profile';
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }
    </script>

</body>

</html>