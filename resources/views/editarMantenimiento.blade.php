<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Siscamino - Editar Mantenimiento</title>
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

        /* Mantenimiento Info Header */
        .mantenimiento-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mantenimiento-details h3 {
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .mantenimiento-meta {
            display: flex;
            gap: 2rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

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

        .status-programado { background: rgba(255,255,255,0.2); color: white; }
        .status-en_proceso { background: rgba(255,193,7,0.3); color: white; }
        .status-completado { background: rgba(40,167,69,0.3); color: white; }
        .status-urgente { background: rgba(220,53,69,0.3); color: white; }

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

        .alert-info {
            background: #e3f2fd;
            color: #1565c0;
            border-color: #bbdefb;
        }

        .error-list {
            margin: 0;
            padding-left: 1.5rem;
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .mantenimiento-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .mantenimiento-meta {
                flex-direction: column;
                gap: 0.5rem;
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
                padding: 1.5rem;
                border-radius: 8px;
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

            .form-container {
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
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
                        {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
                    @endauth
                </div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">
                        @auth
                            {{ auth()->user()->name }}
                        @else
                            {{ Auth::user()->name ?? 'Administrador' }}
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
                    <h1 class="navbar-title">Editar Mantenimiento</h1>
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
                    <span>Editar Mantenimiento #{{ $mantenimiento->id }}</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Editar Mantenimiento #{{ $mantenimiento->id }}</h1>
                        <p class="page-subtitle">Modifica la información del mantenimiento registrado</p>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <a href="{{ route('mantenimiento') }}" class="btn btn-outline">
                            ← Volver a Lista
                        </a>
                    </div>
                </div>

                <!-- Información del Mantenimiento -->
                <div class="mantenimiento-info">
                    <div class="mantenimiento-details">
                        <h3>{{ $mantenimiento->tipo ? ucfirst($mantenimiento->tipo) : 'Mantenimiento' }} - {{ $mantenimiento->camion->placa ?? $mantenimiento->camion->modelo ?? 'Camión #' . $mantenimiento->camion_id }}</h3>
                        <div class="mantenimiento-meta">
                            <span>📅 Registrado: {{ $mantenimiento->created_at->format('d/m/Y H:i') }}</span>
                            <span>🔄 Actualizado: {{ $mantenimiento->updated_at->format('d/m/Y H:i') }}</span>
                            <span>📍 Fecha: {{ \Carbon\Carbon::parse($mantenimiento->fecha)->format('d/m/Y') }}</span>
                            @if($mantenimiento->costo)
                                <span>💰 Costo: ${{ number_format($mantenimiento->costo, 2) }}</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <span class="status-badge status-{{ $mantenimiento->estado }}">
                            @switch($mantenimiento->estado)
                                @case('programado')
                                    📅 Programado
                                    @break
                                @case('en_proceso')
                                    ⚙️ En Proceso
                                    @break
                                @case('completado')
                                    ✅ Completado
                                    @break
                                @case('urgente')
                                    🚨 Urgente
                                    @break
                                @default
                                    {{ ucfirst($mantenimiento->estado) }}
                            @endswitch
                        </span>
                    </div>
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

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Modificar Información del Mantenimiento</h2>
                        <p class="form-description">Actualiza los campos necesarios para el mantenimiento #{{ $mantenimiento->id }}</p>
                    </div>
                    
                    <form method="POST" action="{{ route('mantenimientos.update', $mantenimiento->id) }}" id="formEditarMantenimiento">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="camion_id">Camión <span class="required-indicator">*</span></label>
                                <select id="camion_id" name="camion_id" required>
                                    <option value="">Seleccionar camión</option>
                                    @foreach($camiones as $camion)
                                        <option value="{{ $camion->id }}" {{ (old('camion_id', $mantenimiento->camion_id) == $camion->id) ? 'selected' : '' }}>
                                            {{ $camion->numero_interno ?? $camion->placa }} - {{ $camion->marca }} {{ $camion->modelo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="tipo">Tipo de Mantenimiento <span class="required-indicator">*</span></label>
                                <select id="tipo" name="tipo" required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="preventivo" {{ (old('tipo', $mantenimiento->tipo) == 'preventivo') ? 'selected' : '' }}>Preventivo</option>
                                    <option value="correctivo" {{ (old('tipo', $mantenimiento->tipo) == 'correctivo') ? 'selected' : '' }}>Correctivo</option>
                                    <option value="emergencia" {{ (old('tipo', $mantenimiento->tipo) == 'emergencia') ? 'selected' : '' }}>Emergencia</option>
                                    <option value="revision" {{ (old('tipo', $mantenimiento->tipo) == 'revision') ? 'selected' : '' }}>Revisión General</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="fecha">Fecha del Mantenimiento <span class="required-indicator">*</span></label>
                                <input type="date" id="fecha" name="fecha" value="{{ old('fecha', \Carbon\Carbon::parse($mantenimiento->fecha)->format('Y-m-d')) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado <span class="required-indicator">*</span></label>
                                <select id="estado" name="estado" required>
                                    <option value="">Seleccionar estado</option>
                                    <option value="programado" {{ (old('estado', $mantenimiento->estado) == 'programado') ? 'selected' : '' }}>Programado</option>
                                    <option value="en_proceso" {{ (old('estado', $mantenimiento->estado) == 'en_proceso') ? 'selected' : '' }}>En Proceso</option>
                                    <option value="completado" {{ (old('estado', $mantenimiento->estado) == 'completado') ? 'selected' : '' }}>Completado</option>
                                    <option value="urgente" {{ (old('estado', $mantenimiento->estado) == 'urgente') ? 'selected' : '' }}>Urgente</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="costo">Costo del Mantenimiento</label>
                                <input type="number" id="costo" name="costo" step="0.01" min="0" value="{{ old('costo', $mantenimiento->costo) }}" placeholder="2500.00">
                            </div>
                            
                            <div class="form-group">
                                <label for="proveedor">Proveedor/Taller</label>
                                <input type="text" id="proveedor" name="proveedor" value="{{ old('proveedor', $mantenimiento->proveedor) }}" placeholder="Nombre del taller o proveedor">
                            </div>
                            
                            <div class="form-group">
                                <label for="kilometraje">Kilometraje Actual</label>
                                <input type="number" id="kilometraje" name="kilometraje" min="0" value="{{ old('kilometraje', $mantenimiento->kilometraje) }}" placeholder="125000">
                            </div>

                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio</label>
                                <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $mantenimiento->fecha_inicio ? \Carbon\Carbon::parse($mantenimiento->fecha_inicio)->format('Y-m-d') : '') }}">
                            </div>

                            <div class="form-group">
                                <label for="fecha_fin">Fecha de Finalización</label>
                                <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $mantenimiento->fecha_fin ? \Carbon\Carbon::parse($mantenimiento->fecha_fin)->format('Y-m-d') : '') }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcion">Descripción del Mantenimiento <span class="required-indicator">*</span></label>
                            <textarea id="descripcion" name="descripcion" required placeholder="Describa detalladamente el tipo de mantenimiento realizado, piezas cambiadas, problemas encontrados, etc...">{{ old('descripcion', $mantenimiento->descripcion) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" placeholder="Observaciones adicionales...">{{ old('observaciones', $mantenimiento->observaciones) }}</textarea>
                        </div>
                        
                        <div class="form-actions">
                            <a href="{{ route('mantenimiento') }}" class="btn btn-secondary">❌ Cancelar</a>
                            <button type="button" class="btn btn-warning" onclick="resetearFormulario()">🔄 Restaurar</button>
                            <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Variables para almacenar valores originales
        const valoresOriginales = {
            camion_id: '{{ $mantenimiento->camion_id }}',
            tipo: '{{ $mantenimiento->tipo }}',
            fecha: '{{ \Carbon\Carbon::parse($mantenimiento->fecha)->format('Y-m-d') }}',
            estado: '{{ $mantenimiento->estado }}',
            costo: '{{ $mantenimiento->costo }}',
            proveedor: '{{ $mantenimiento->proveedor }}',
            kilometraje: '{{ $mantenimiento->kilometraje }}',
            fecha_inicio: '{{ $mantenimiento->fecha_inicio ? \Carbon\Carbon::parse($mantenimiento->fecha_inicio)->format('Y-m-d') : '' }}',
            fecha_fin: '{{ $mantenimiento->fecha_fin ? \Carbon\Carbon::parse($mantenimiento->fecha_fin)->format('Y-m-d') : '' }}',
            descripcion: `{{ $mantenimiento->descripcion }}`,
            observaciones: `{{ $mantenimiento->observaciones ?? '' }}`
        };

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            updateDateTime();
            setInterval(updateDateTime, 1000);
            monitorearCambios();
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
            
            fechaInicio.addEventListener('change', function() {
                if (this.value && !fechaFin.value) {
                    fechaFin.value = this.value;
                }
                fechaFin.min = this.value;
            });

            fechaFin.addEventListener('change', function() {
                if (this.value && fechaInicio.value && this.value < fechaInicio.value) {
                    alert('La fecha de finalización debe ser posterior a la fecha de inicio');
                    this.value = '';
                }
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

        function monitorearCambios() {
            const form = document.getElementById('formEditarMantenimiento');
            const inputs = form.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    verificarCambios();
                });
                input.addEventListener('input', function() {
                    verificarCambios();
                });
            });
        }

        function verificarCambios() {
            const form = document.getElementById('formEditarMantenimiento');
            const formData = new FormData(form);
            let hayCambios = false;

            for (let [key, value] of formData.entries()) {
                if (valoresOriginales[key] !== undefined && valoresOriginales[key] != value) {
                    hayCambios = true;
                    break;
                }
            }

            // Cambiar estilo del botón de guardar si hay cambios
            const btnGuardar = document.querySelector('button[type="submit"]');
            if (hayCambios) {
                btnGuardar.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
                btnGuardar.innerHTML = '💾 Guardar Cambios';
            } else {
                btnGuardar.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                btnGuardar.innerHTML = '💾 Sin Cambios';
            }
        }

        function resetearFormulario() {
            if (confirm('¿Está seguro de que desea restaurar todos los valores originales?')) {
                // Restaurar valores originales
                Object.keys(valoresOriginales).forEach(key => {
                    const elemento = document.getElementById(key) || document.querySelector(`[name="${key}"]`);
                    if (elemento) {
                        elemento.value = valoresOriginales[key];
                    }
                });
                
                verificarCambios();
                mostrarNotificacion('Formulario restaurado a valores originales', 'info');
            }
        }

        function mostrarNotificacion(mensaje, tipo = 'info') {
            // Crear elemento de notificación
            const notificacion = document.createElement('div');
            notificacion.className = `alert alert-${tipo === 'success' ? 'success' : tipo === 'error' ? 'error' : 'info'}`;
            notificacion.innerHTML = mensaje;
            notificacion.style.position = 'fixed';
            notificacion.style.top = '20px';
            notificacion.style.right = '20px';
            notificacion.style.zIndex = '9999';
            notificacion.style.minWidth = '300px';
            notificacion.style.animation = 'slideInRight 0.5s ease';
            
            document.body.appendChild(notificacion);
            
            // Remover después de 4 segundos
            setTimeout(() => {
                notificacion.style.animation = 'slideOutRight 0.5s ease';
                setTimeout(() => {
                    if (notificacion.parentNode) {
                        notificacion.parentNode.removeChild(notificacion);
                    }
                }, 500);
            }, 4000);
        }

        function goToProfile() {
            window.location.href = '/profile';
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }

        // Validaciones adicionales antes del envío
        document.getElementById('formEditarMantenimiento').addEventListener('submit', function(e) {
            const camionId = document.getElementById('camion_id').value;
            const tipo = document.getElementById('tipo').value;
            const fecha = document.getElementById('fecha').value;
            const estado = document.getElementById('estado').value;
            const descripcion = document.getElementById('descripcion').value;
            
            if (!camionId) {
                e.preventDefault();
                alert('Debe seleccionar un camión');
                return false;
            }
            
            if (!tipo) {
                e.preventDefault();
                alert('Debe seleccionar un tipo de mantenimiento');
                return false;
            }
            
            if (!fecha) {
                e.preventDefault();
                alert('Debe seleccionar una fecha para el mantenimiento');
                return false;
            }

            if (!estado) {
                e.preventDefault();
                alert('Debe seleccionar un estado');
                return false;
            }

            if (!descripcion.trim()) {
                e.preventDefault();
                alert('Debe proporcionar una descripción del mantenimiento');
                return false;
            }
            
            // Validar fechas de inicio y fin
            const fechaInicio = document.getElementById('fecha_inicio').value;
            const fechaFin = document.getElementById('fecha_fin').value;
            
            if (fechaInicio && fechaFin && fechaFin < fechaInicio) {
                e.preventDefault();
                alert('La fecha de finalización debe ser posterior a la fecha de inicio');
                return false;
            }
            
            return true;
        });

        // Advertencia antes de salir si hay cambios sin guardar
        window.addEventListener('beforeunload', function(e) {
            verificarCambios();
            const btnGuardar = document.querySelector('button[type="submit"]');
            if (btnGuardar.innerHTML.includes('Guardar Cambios')) {
                e.preventDefault();
                e.returnValue = '¿Está seguro de que desea salir? Hay cambios sin guardar.';
                return e.returnValue;
            }
        });

        // Estilos adicionales para las animaciones
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>