<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Asignar Viaje</title>
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
            max-width: 1000px;
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

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb-separator {
            color: #999;
        }

        /* Form Container */
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .form-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-title {
            color: #333;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-description {
            color: #666;
            font-size: 1rem;
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .required-indicator {
            color: #dc3545;
            margin-left: 2px;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }

        /* Error Messages */
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
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

        .btn-outline {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        /* Form Sections */
        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .section-title {
            color: #333;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #667eea;
        }

        /* Estado indicators */
        .status-indicator {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            border-radius: 3px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .status-activo {
            background-color: #d4edda;
            color: #155724;
        }

        .status-mantenimiento {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-inactivo {
            background-color: #f8d7da;
            color: #721c24;
        }

        .camion-unavailable {
            color: #6c757d;
            font-style: italic;
        }

        .info-text {
            background-color: #e3f2fd;
            border: 1px solid #bbdefb;
            color: #1565c0;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        /* Mobile Responsive */
        @media (max-width: 1200px) {
            .content {
                padding: 1.5rem;
            }
            
            .form-container {
                padding: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 260px;
            }
            
            .form-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
                gap: 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .page-title {
                font-size: 1.75rem;
            }

            .form-actions {
                flex-direction: column-reverse;
                gap: 0.75rem;
            }

            .btn {
                padding: 0.875rem 1.25rem;
                justify-content: center;
            }

            .form-container {
                padding: 1.25rem;
            }

            .form-header {
                margin-bottom: 1.5rem;
            }

            .form-title {
                font-size: 1.25rem;
            }

            .sidebar-menu a {
                padding: 0.875rem 1.25rem;
                font-size: 0.95rem;
            }

            .user-info {
                padding: 0.75rem;
            }

            .form-section {
                padding: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .section-title {
                font-size: 1.1rem;
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
                padding: 1rem;
                border-radius: 8px;
            }

            .form-header {
                margin-bottom: 1rem;
            }

            .form-title {
                font-size: 1.1rem;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 0.875rem;
                font-size: 16px; /* Prevents zoom on iOS */
            }

            .btn {
                padding: 1rem;
                font-size: 0.95rem;
            }

            .breadcrumb {
                font-size: 0.8rem;
            }

            .datetime-display {
                order: -1;
                width: auto;
                align-items: flex-start;
                margin-bottom: 0;
            }

            .form-section {
                padding: 1rem;
            }

            .section-title {
                font-size: 1rem;
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

            .form-container {
                padding: 0.75rem;
            }

            .form-grid {
                gap: 0.75rem;
            }

            .form-section {
                padding: 0.75rem;
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

            .form-section {
                margin-bottom: 1rem;
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
            .btn {
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
                    <h1 class="navbar-title">Asignar Viaje</h1>
                </div>
                <div class="navbar-links">
                    <div class="datetime-display">
                        <div class="current-date" id="currentDate"></div>
                        <div class="current-time" id="currentTime"></div>
                    </div>
                    <a href="login" onclick="logout()">Cerrar Sesión</a>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="content-wrapper fade-in">
                
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('viajes.index') }}">Viajes</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Asignar Viaje</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Asignar Nuevo Viaje</h1>
                        <p class="page-subtitle">Complete la información para asignar un viaje a la flotilla</p>
                    </div>
                    <a href="{{ route('viajes.index') }}" class="btn btn-outline">
                        ← Volver a Viajes
                    </a>
                </div>


                <!-- Mostrar mensajes de éxito -->
                @if(session('success'))
                    <div class="alert alert-success">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <!-- Mostrar errores generales -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin: 0; padding-left: 1rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Verificar si hay camiones disponibles -->
                @if($camiones->isEmpty())
                    <div class="alert alert-warning">
                        ⚠️ <strong>No hay camiones disponibles</strong><br>
                        Actualmente no hay camiones con estado "Activo" para asignar viajes. 
                        <a href="/camiones">Revisar estado de los camiones</a>
                    </div>
                @endif

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Información del Viaje</h2>
                        <p class="form-description">Complete todos los campos obligatorios (*) para asignar el viaje</p>
                    </div>
                    
                    <form action="{{ route('viajes.store') }}" method="POST" id="formAsignarViaje">
                        @csrf
                        
                        <!-- Sección 1: Información Básica -->
                        <div class="form-section">
                            <h3 class="section-title">📋 Información Básica del Viaje</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="camion_id">Camión Disponible <span class="required-indicator">*</span></label>
                                    <select id="camion_id" name="camion_id" required class="@error('camion_id') border-danger @enderror" {{ $camiones->isEmpty() ? 'disabled' : '' }}>
                                        <option value="">{{ $camiones->isEmpty() ? 'No hay camiones disponibles' : 'Seleccionar camión activo' }}</option>
                                        @foreach($camiones as $camion)
                                            <option value="{{ $camion->id }}" {{ old('camion_id') == $camion->id ? 'selected' : '' }}>
                                                {{ $camion->placa ?? $camion->modelo ?? 'CAM-' . str_pad($camion->id, 3, '0', STR_PAD_LEFT) }}
                                                {{ $camion->marca ? ' - ' . $camion->marca : '' }}
                                                <span class="status-indicator status-activo">✓ Activo</span>
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('camion_id')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    @if($camiones->isNotEmpty())
                                        <small style="color: #666; margin-top: 0.5rem; font-size: 0.875rem;">
                                            {{ $camiones->count() }} camión(es) activo(s) disponible(s)
                                        </small>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="chofer_id">Chofer/Conductor <span class="required-indicator">*</span></label>
                                    <select id="chofer_id" name="chofer_id" required class="@error('chofer_id') border-danger @enderror">
                                        <option value="">Seleccionar chofer</option>
                                        @foreach($choferes as $chofer)
                                            <option value="{{ $chofer->id }}" {{ old('chofer_id') == $chofer->id ? 'selected' : '' }}>
                                                {{ $chofer->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('chofer_id')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="cliente_id">Cliente <span class="required-indicator">*</span></label>
                                    <select id="cliente_id" name="cliente_id" required class="@error('cliente_id') border-danger @enderror">
                                        <option value="">Seleccionar cliente</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('cliente_id')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="estado">Estado del Viaje <span class="required-indicator">*</span></label>
                                    <select id="estado" name="estado" required class="@error('estado') border-danger @enderror">
                                        <option value="">Seleccionar estado</option>
                                        <option value="programado" {{ old('estado') == 'programado' ? 'selected' : '' }}>Programado</option>
                                        <option value="transito" {{ old('estado') == 'transito' ? 'selected' : '' }}>En Tránsito</option>
                                        <option value="espera" {{ old('estado') == 'espera' ? 'selected' : '' }}>En Espera</option>
                                        <option value="entregado" {{ old('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                                        <option value="retrasado" {{ old('estado') == 'retrasado' ? 'selected' : '' }}>Retrasado</option>
                                    </select>
                                    @error('estado')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Ruta y Fechas -->
                        <div class="form-section">
                            <h3 class="section-title">📍 Ruta y Programación</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="ruta">Ruta del Viaje <span class="required-indicator">*</span></label>
                                    <input 
                                        type="text" 
                                        id="ruta" 
                                        name="ruta" 
                                        value="{{ old('ruta') }}"
                                        required 
                                        placeholder="Ej: Córdoba, Veracruz → México, DF"
                                        class="@error('ruta') border-danger @enderror"
                                    >
                                    @error('ruta')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="fecha_salida">Fecha y Hora de Salida <span class="required-indicator">*</span></label>
                                    <input 
                                        type="datetime-local" 
                                        id="fecha_salida" 
                                        name="fecha_salida" 
                                        value="{{ old('fecha_salida') }}"
                                        required
                                        class="@error('fecha_salida') border-danger @enderror"
                                    >
                                    @error('fecha_salida')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="fecha_llegada">Fecha y Hora de Llegada <span class="required-indicator">*</span></label>
                                    <input 
                                        type="datetime-local" 
                                        id="fecha_llegada" 
                                        name="fecha_llegada" 
                                        value="{{ old('fecha_llegada') }}"
                                        required
                                        class="@error('fecha_llegada') border-danger @enderror"
                                    >
                                    @error('fecha_llegada')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Observaciones -->
                        <div class="form-group">
                            <label for="observaciones">Observaciones del Viaje</label>
                            <textarea 
                                id="observaciones" 
                                name="observaciones" 
                                placeholder="Instrucciones especiales, notas de entrega, carga especial, etc..."
                                class="@error('observaciones') border-danger @enderror"
                            >{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">🗑️ Limpiar</button>
                            <button type="submit" class="btn btn-primary" {{ $camiones->isEmpty() ? 'disabled' : '' }}>📋 Asignar Viaje</button>
                        </div>
                    </form>
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
            setMinDateTime();
            checkCamionesDisponibles();
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

            // Validación de fechas
            const fechaSalida = document.getElementById('fecha_salida');
            const fechaLlegada = document.getElementById('fecha_llegada');

            fechaSalida.addEventListener('change', function() {
                fechaLlegada.min = this.value;
                if (fechaLlegada.value && fechaLlegada.value < this.value) {
                    fechaLlegada.value = '';
                    alert('La fecha de llegada debe ser posterior a la fecha de salida');
                }
            });

            // Validación en tiempo real del formulario
            const camionSelect = document.getElementById('camion_id');
            const submitBtn = document.querySelector('button[type="submit"]');
            
            camionSelect.addEventListener('change', function() {
                if (this.value === '') {
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.6';
                } else {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                }
            });

            // Prevent form submission on Enter in input fields (except submit button)
            document.getElementById('formAsignarViaje').addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.type !== 'submit' && e.target.tagName !== 'BUTTON') {
                    e.preventDefault();
                }
            });
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

        function setMinDateTime() {
            const now = new Date();
            const formattedNow = now.toISOString().slice(0, 16);
            document.getElementById('fecha_salida').min = formattedNow;
            document.getElementById('fecha_llegada').min = formattedNow;
        }

        function checkCamionesDisponibles() {
            const camionSelect = document.getElementById('camion_id');
            const submitBtn = document.querySelector('button[type="submit"]');
            
            if (camionSelect.options.length <= 1) { // Solo tiene la opción "Seleccionar..."
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
                submitBtn.innerHTML = '❌ Sin Camiones Disponibles';
            }
        }

        function limpiarFormulario() {
            if (confirm('¿Está seguro de que desea limpiar el formulario?')) {
                document.getElementById('formAsignarViaje').reset();
                setMinDateTime();
                checkCamionesDisponibles();
            }
        }

        function goToProfile() {
            window.location.href = '/profile';
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }

        // Mostrar información adicional del camión seleccionado
        document.getElementById('camion_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                console.log('Camión seleccionado:', selectedOption.text);
                // Aquí podrías hacer una petición AJAX para obtener más detalles del camión
                // y mostrarlos en la interfaz si es necesario
            }
        });

        // Validaciones adicionales antes del envío
        document.getElementById('formAsignarViaje').addEventListener('submit', function(e) {
            const camionId = document.getElementById('camion_id').value;
            const choferId = document.getElementById('chofer_id').value;
            const clienteId = document.getElementById('cliente_id').value;
            
            if (!camionId) {
                e.preventDefault();
                alert('Debe seleccionar un camión activo para el viaje');
                return false;
            }
            
            if (!choferId) {
                e.preventDefault();
                alert('Debe seleccionar un chofer para el viaje');
                return false;
            }
            
            if (!clienteId) {
                e.preventDefault();
                alert('Debe seleccionar un cliente para el viaje');
                return false;
            }
            
            // Validar fechas
            const fechaSalida = new Date(document.getElementById('fecha_salida').value);
            const fechaLlegada = new Date(document.getElementById('fecha_llegada').value);
            
            if (fechaLlegada <= fechaSalida) {
                e.preventDefault();
                alert('La fecha de llegada debe ser posterior a la fecha de salida');
                return false;
            }
            
            return true;
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
            
            // Ctrl+S to save form
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                const submitButton = document.querySelector('.btn-primary');
                if (submitButton && !submitButton.disabled) {
                    submitButton.click();
                }
            }
        });

        // Auto-format ruta input with arrow
        document.getElementById('ruta').addEventListener('blur', function() {
            let value = this.value.trim();
            if (value && !value.includes('→') && !value.includes('-')) {
                // Try to detect two locations and format with arrow
                const parts = value.split(/[,;]/);
                if (parts.length >= 2) {
                    this.value = parts[0].trim() + ' → ' + parts.slice(1).join(', ').trim();
                }
            }
        });

        // Form auto-save to prevent data loss
        const formInputs = document.querySelectorAll('#formAsignarViaje input, #formAsignarViaje select, #formAsignarViaje textarea');
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                localStorage.setItem('viaje_form_' + this.name, this.value);
            });

            // Restore saved data
            const savedValue = localStorage.getItem('viaje_form_' + input.name);
            if (savedValue && !input.value) {
                input.value = savedValue;
            }
        });

        // Clear saved data on successful form submission
        document.getElementById('formAsignarViaje').addEventListener('submit', function() {
            formInputs.forEach(input => {
                localStorage.removeItem('viaje_form_' + input.name);
            });
        });

        // Initialize form state
        window.addEventListener('load', function() {
            checkCamionesDisponibles();
            setMinDateTime();
        });
    </script>
</body>
</html>