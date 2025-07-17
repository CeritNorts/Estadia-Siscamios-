<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Siscamino - Registrar Mantenimiento</title>
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
            min-height: 120px;
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

        .error-list {
            margin: 0;
            padding-left: 1.5rem;
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
                <a href="/viajes">
                    📋 Viajes
                </a>
            </li>
            <li>
                <a href="/mantenimiento" class="active">
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
                    <h1 class="navbar-title">Registrar Mantenimiento</h1>
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
                    <a href="{{ route('mantenimiento') }}">Mantenimiento</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Registrar Mantenimiento</span>
                </div>

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

                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Registrar Mantenimiento</h1>
                        <p class="page-subtitle">Complete la información del servicio de mantenimiento</p>
                    </div>
                    <a href="{{ route('mantenimiento') }}" class="btn btn-outline">
                        ← Volver a Mantenimiento
                    </a>
                </div>

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Información del Mantenimiento</h2>
                        <p class="form-description">Complete todos los campos obligatorios (*) para registrar el mantenimiento</p>
                    </div>
                    
                    <!-- ✅ FORMULARIO CORREGIDO CON LARAVEL -->
                    <form method="POST" action="{{ route('mantenimientos.store') }}" id="formRegistrarMantenimiento">
                        @csrf
                        
                        <!-- Sección 1: Información Básica -->
                        <div class="form-section">
                            <h3 class="section-title">🔧 Información Básica del Mantenimiento</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="camion_id">Camión <span class="required-indicator">*</span></label>
                                    <select id="camion_id" name="camion_id" required class="@error('camion_id') border-danger @enderror">
                                        <option value="">Seleccionar camión</option>
                                        @foreach($camiones as $camion)
                                            <option value="{{ $camion->id }}" {{ old('camion_id') == $camion->id ? 'selected' : '' }}>
                                                {{ $camion->numero_interno ?? $camion->placa }} - {{ $camion->marca }} {{ $camion->modelo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('camion_id')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="tipo">Tipo de Mantenimiento <span class="required-indicator">*</span></label>
                                    <select id="tipo" name="tipo" required class="@error('tipo') border-danger @enderror">
                                        <option value="">Seleccionar tipo</option>
                                        <option value="preventivo" {{ old('tipo') == 'preventivo' ? 'selected' : '' }}>Preventivo</option>
                                        <option value="correctivo" {{ old('tipo') == 'correctivo' ? 'selected' : '' }}>Correctivo</option>
                                        <option value="emergencia" {{ old('tipo') == 'emergencia' ? 'selected' : '' }}>Emergencia</option>
                                        <option value="revision" {{ old('tipo') == 'revision' ? 'selected' : '' }}>Revisión General</option>
                                    </select>
                                    @error('tipo')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="fecha">Fecha del Mantenimiento <span class="required-indicator">*</span></label>
                                    <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" required class="@error('fecha') border-danger @enderror">
                                    @error('fecha')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="estado">Estado <span class="required-indicator">*</span></label>
                                    <select id="estado" name="estado" required class="@error('estado') border-danger @enderror">
                                        <option value="">Seleccionar estado</option>
                                        <option value="programado" {{ old('estado') == 'programado' ? 'selected' : '' }}>Programado</option>
                                        <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                        <option value="completado" {{ old('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                                        <option value="urgente" {{ old('estado') == 'urgente' ? 'selected' : '' }}>Urgente</option>
                                    </select>
                                    @error('estado')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Detalles del Servicio -->
                        <div class="form-section">
                            <h3 class="section-title">📋 Detalles del Servicio</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="costo">Costo del Mantenimiento</label>
                                    <input type="number" id="costo" name="costo" step="0.01" min="0" value="{{ old('costo') }}" placeholder="2500.00" class="@error('costo') border-danger @enderror">
                                    @error('costo')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="proveedor">Proveedor/Taller</label>
                                    <input type="text" id="proveedor" name="proveedor" value="{{ old('proveedor') }}" placeholder="Nombre del taller o proveedor" class="@error('proveedor') border-danger @enderror">
                                    @error('proveedor')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="kilometraje">Kilometraje Actual</label>
                                    <input type="number" id="kilometraje" name="kilometraje" min="0" value="{{ old('kilometraje') }}" placeholder="125000" class="@error('kilometraje') border-danger @enderror">
                                    @error('kilometraje')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección 3: Programación -->
                        <div class="form-section">
                            <h3 class="section-title">📅 Programación</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de Inicio</label>
                                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" class="@error('fecha_inicio') border-danger @enderror">
                                    @error('fecha_inicio')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="fecha_fin">Fecha de Finalización</label>
                                    <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" class="@error('fecha_fin') border-danger @enderror">
                                    @error('fecha_fin')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcion">Descripción del Mantenimiento <span class="required-indicator">*</span></label>
                            <textarea id="descripcion" name="descripcion" required placeholder="Describa detalladamente el tipo de mantenimiento realizado, piezas cambiadas, problemas encontrados, etc..." class="@error('descripcion') border-danger @enderror">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" placeholder="Observaciones adicionales..." class="@error('observaciones') border-danger @enderror">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">🗑️ Limpiar</button>
                            <button type="submit" class="btn btn-primary">🔧 Registrar Mantenimiento</button>
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
            setDefaultDate();
            setupFormValidation();
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

            // Sincronizar fechas
            const fechaInicio = document.getElementById('fecha_inicio');
            const fechaFin = document.getElementById('fecha_fin');
            const fechaMantenimiento = document.getElementById('fecha');
            
            fechaInicio.addEventListener('change', function() {
                if (this.value && !fechaFin.value) {
                    fechaFin.value = this.value;
                }
                fechaFin.min = this.value;
            });

            fechaMantenimiento.addEventListener('change', function() {
                if (this.value && !fechaInicio.value) {
                    fechaInicio.value = this.value;
                }
                fechaInicio.min = this.value;
                fechaFin.min = this.value;
            });

            // Prevent form submission on Enter in input fields (except submit button)
            document.getElementById('formRegistrarMantenimiento').addEventListener('keydown', function(e) {
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

        function setDefaultDate() {
            const fechaInput = document.getElementById('fecha');
            if (!fechaInput.value) {
                const today = new Date().toISOString().split('T')[0];
                fechaInput.value = today;
            }
        }

        function setupFormValidation() {
            const form = document.getElementById('formRegistrarMantenimiento');
            const inputs = form.querySelectorAll('input, select, textarea');

            // Real-time validation
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });

                input.addEventListener('input', function() {
                    clearError(this);
                });
            });

            // Form submission validation
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    if (!validateField(field)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    scrollToFirstError();
                }
            });
        }

        function validateField(field) {
            const value = field.value.trim();
            const fieldName = field.name;
            let isValid = true;
            let errorMessage = '';

            // Reset error state
            clearError(field);

            // Required field validation
            if (field.required && !value) {
                errorMessage = 'Este campo es obligatorio';
                isValid = false;
            } else {
                // Specific field validations
                switch (fieldName) {
                    case 'fecha':
                    case 'fecha_inicio':
                    case 'fecha_fin':
                        if (value) {
                            const inputDate = new Date(value);
                            const today = new Date();
                            today.setHours(0, 0, 0, 0);
                            
                            if (inputDate < today && fieldName === 'fecha') {
                                errorMessage = 'La fecha no puede ser anterior a hoy';
                                isValid = false;
                            }
                        }
                        break;
                    case 'costo':
                        if (value && parseFloat(value) < 0) {
                            errorMessage = 'El costo no puede ser negativo';
                            isValid = false;
                        }
                        break;
                    case 'kilometraje':
                        if (value && parseInt(value) < 0) {
                            errorMessage = 'El kilometraje no puede ser negativo';
                            isValid = false;
                        }
                        break;
                }
            }

            if (!isValid) {
                showError(field, errorMessage);
            }

            return isValid;
        }

        function showError(field, message) {
            const errorElement = document.createElement('div');
            errorElement.className = 'error-message';
            errorElement.textContent = message;
            errorElement.style.color = '#dc3545';
            errorElement.style.fontSize = '0.875rem';
            errorElement.style.marginTop = '0.25rem';
            
            // Remove existing error message
            const existingError = field.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
            
            field.parentNode.appendChild(errorElement);
            field.style.borderColor = '#dc3545';
        }

        function clearError(field) {
            const errorElement = field.parentNode.querySelector('.error-message');
            if (errorElement) {
                errorElement.remove();
            }
            field.style.borderColor = '#ddd';
        }

        function scrollToFirstError() {
            const firstError = document.querySelector('.error-message');
            if (firstError) {
                firstError.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
            }
        }

        function limpiarFormulario() {
            if (confirm('¿Está seguro de que desea limpiar el formulario?')) {
                const form = document.getElementById('formRegistrarMantenimiento');
                form.reset();
                
                // Clear all error messages
                const errorMessages = form.querySelectorAll('.error-message');
                errorMessages.forEach(error => {
                    error.remove();
                });
                
                // Reset field borders
                const inputs = form.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.style.borderColor = '#ddd';
                });
                
                setDefaultDate();
                showAlert('success', 'Formulario limpiado correctamente');
            }
        }

        function showAlert(type, message) {
            const alertElement = document.createElement('div');
            alertElement.className = `alert alert-${type}`;
            alertElement.innerHTML = `${type === 'success' ? '✅' : '❌'} ${message}`;
            
            const contentWrapper = document.querySelector('.content-wrapper');
            contentWrapper.insertBefore(alertElement, contentWrapper.firstChild);
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                alertElement.style.opacity = '0';
                setTimeout(() => {
                    if (alertElement.parentNode) {
                        alertElement.parentNode.removeChild(alertElement);
                    }
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
                if (submitButton) {
                    submitButton.click();
                }
            }
        });

        // Auto-save form data to prevent data loss
        const formInputs = document.querySelectorAll('#formRegistrarMantenimiento input, #formRegistrarMantenimiento select, #formRegistrarMantenimiento textarea');
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                localStorage.setItem('mantenimiento_form_' + this.name, this.value);
            });

            // Restore saved data
            const savedValue = localStorage.getItem('mantenimiento_form_' + input.name);
            if (savedValue && !input.value) {
                input.value = savedValue;
            }
        });

        // Clear saved data on successful form submission
        document.getElementById('formRegistrarMantenimiento').addEventListener('submit', function() {
            formInputs.forEach(input => {
                localStorage.removeItem('mantenimiento_form_' + input.name);
            });
        });

        // Dynamic cost formatting
        document.getElementById('costo').addEventListener('input', function() {
            let value = this.value;
            if (value && !isNaN(value)) {
                // Add thousand separators for display (optional)
                const numValue = parseFloat(value);
                if (numValue >= 1000) {
                    this.title = `${numValue.toLocaleString('es-ES', {minimumFractionDigits: 2})}`;
                }
            }
        });

        // Initialize form state
        window.addEventListener('load', function() {
            setDefaultDate();
        });
    </script>
</body>
</html>