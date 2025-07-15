<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Editar Viaje</title>
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

        /* Viaje Info Header */
        .viaje-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .viaje-details h3 {
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .viaje-meta {
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
        .status-transito { background: rgba(255,193,7,0.3); color: white; }
        .status-entregado { background: rgba(40,167,69,0.3); color: white; }
        .status-retrasado { background: rgba(220,53,69,0.3); color: white; }
        .status-espera { background: rgba(123,31,162,0.3); color: white; }

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

        .alert-info {
            background-color: #e3f2fd;
            border: 1px solid #bbdefb;
            color: #1565c0;
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

            .navbar-content {
                padding: 1rem;
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

            .viaje-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .viaje-meta {
                flex-direction: column;
                gap: 0.5rem;
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
            <div class="user-info">
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
                    <h1 class="navbar-title">Editar Viaje</h1>
                </div>
                <div class="navbar-links">
                    <a href="/profile">Perfil</a>
                    <a href="#">Notificaciones</a>
                    <a href="#" onclick="logout()">Cerrar Sesión</a>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="content-wrapper fade-in">
                
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{ route('viajes.index') }}">Viajes</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Editar Viaje VJ-{{ str_pad($viaje->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Editar Viaje VJ-{{ str_pad($viaje->id, 3, '0', STR_PAD_LEFT) }}</h1>
                        <p class="page-subtitle">Modifica la información del viaje asignado</p>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <a href="{{ route('viajes.show', $viaje->id) }}" class="btn btn-secondary">
                            👁️ Ver Detalles
                        </a>
                        <a href="{{ route('viajes.index') }}" class="btn btn-outline">
                            ← Volver a Lista
                        </a>
                    </div>
                </div>

                <!-- Información del Viaje -->
                <div class="viaje-info">
                    <div class="viaje-details">
                        <h3>{{ $viaje->ruta }}</h3>
                        <div class="viaje-meta">
                            <span>📅 Creado: {{ $viaje->created_at->format('d/m/Y H:i') }}</span>
                            <span>🔄 Actualizado: {{ $viaje->updated_at->format('d/m/Y H:i') }}</span>
                            @if($viaje->camion)
                                <span>🚛 {{ $viaje->camion->placa ?? $viaje->camion->modelo }}</span>
                            @endif
                        </div>
                    </div>
                    <div>
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
                </div>

                <!-- Mostrar mensajes -->
                @if(session('success'))
                    <div class="alert alert-success">
                        ✅ {{ session('success') }}
                    </div>
                @endif

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

                <!-- Información importante -->
                <div class="info-text">
                    ℹ️ <strong>Nota:</strong> Al cambiar el camión asignado, solo se mostrarán camiones con estado "Activo". Los cambios en fechas pueden actualizar automáticamente el estado del viaje.
                </div>

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Modificar Información del Viaje</h2>
                        <p class="form-description">Actualiza los campos necesarios para el viaje VJ-{{ str_pad($viaje->id, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    
                    <form action="{{ route('viajes.update', $viaje->id) }}" method="POST" id="formEditarViaje">
                        @csrf
                        @method('PUT')
                        
                        <!-- Sección 1: Información Básica -->
                        <div class="form-section">
                            <h3 class="section-title">📋 Información Básica del Viaje</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="camion_id">Camión Asignado <span class="required-indicator">*</span></label>
                                    <select id="camion_id" name="camion_id" required class="@error('camion_id') border-danger @enderror">
                                        <option value="">Seleccionar camión</option>
                                        @foreach($camiones as $camion)
                                            <option value="{{ $camion->id }}" 
                                                {{ (old('camion_id', $viaje->camion_id) == $camion->id) ? 'selected' : '' }}
                                                @if($camion->estado !== 'activo' && $camion->id !== $viaje->camion_id) disabled @endif>
                                                {{ $camion->placa ?? $camion->modelo ?? 'CAM-' . str_pad($camion->id, 3, '0', STR_PAD_LEFT) }}
                                                {{ $camion->marca ? ' - ' . $camion->marca : '' }}
                                                @if($camion->estado === 'activo')
                                                    <span class="status-indicator status-activo">✓ Activo</span>
                                                @elseif($camion->id === $viaje->camion_id)
                                                    <span class="status-indicator status-{{ $camion->estado }}">{{ ucfirst($camion->estado) }} (Actual)</span>
                                                @else
                                                    <span class="status-indicator status-{{ $camion->estado }}">{{ ucfirst($camion->estado) }}</span>
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('camion_id')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <small style="color: #666; margin-top: 0.5rem; font-size: 0.875rem;">
                                        Solo se pueden asignar camiones activos (excepto el actual)
                                    </small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="chofer_id">Chofer/Conductor <span class="required-indicator">*</span></label>
                                    <select id="chofer_id" name="chofer_id" required class="@error('chofer_id') border-danger @enderror">
                                        <option value="">Seleccionar chofer</option>
                                        @foreach($choferes as $chofer)
                                            <option value="{{ $chofer->id }}" {{ (old('chofer_id', $viaje->chofer_id) == $chofer->id) ? 'selected' : '' }}>
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
                                            <option value="{{ $cliente->id }}" {{ (old('cliente_id', $viaje->cliente_id) == $cliente->id) ? 'selected' : '' }}>
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
                                        <option value="programado" {{ (old('estado', $viaje->estado) == 'programado') ? 'selected' : '' }}>Programado</option>
                                        <option value="transito" {{ (old('estado', $viaje->estado) == 'transito') ? 'selected' : '' }}>En Tránsito</option>
                                        <option value="espera" {{ (old('estado', $viaje->estado) == 'espera') ? 'selected' : '' }}>En Espera</option>
                                        <option value="entregado" {{ (old('estado', $viaje->estado) == 'entregado') ? 'selected' : '' }}>Entregado</option>
                                        <option value="retrasado" {{ (old('estado', $viaje->estado) == 'retrasado') ? 'selected' : '' }}>Retrasado</option>
                                    </select>
                                    @error('estado')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <small style="color: #666; margin-top: 0.5rem; font-size: 0.875rem;">
                                        El estado puede actualizarse automáticamente según las fechas programadas
                                    </small>
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
                                        value="{{ old('ruta', $viaje->ruta) }}"
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
                                        value="{{ old('fecha_salida', \Carbon\Carbon::parse($viaje->fecha_salida)->format('Y-m-d\TH:i')) }}"
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
                                        value="{{ old('fecha_llegada', \Carbon\Carbon::parse($viaje->fecha_llegada)->format('Y-m-d\TH:i')) }}"
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
                            >{{ old('observaciones', $viaje->observaciones ?? '') }}</textarea>
                            @error('observaciones')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-actions">
                            <a href="{{ route('viajes.index') }}" class="btn btn-secondary">❌ Cancelar</a>
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
            camion_id: '{{ $viaje->camion_id }}',
            chofer_id: '{{ $viaje->chofer_id }}',
            cliente_id: '{{ $viaje->cliente_id }}',
            estado: '{{ $viaje->estado }}',
            ruta: '{{ $viaje->ruta }}',
            fecha_salida: '{{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('Y-m-d\TH:i') }}',
            fecha_llegada: '{{ \Carbon\Carbon::parse($viaje->fecha_llegada)->format('Y-m-d\TH:i') }}',
            observaciones: '{{ $viaje->observaciones ?? '' }}'
        };

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            setMinDateTime();
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

            // Validación del camión seleccionado
            document.getElementById('camion_id').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.disabled && selectedOption.value !== '') {
                    alert('No se puede asignar un camión que no esté activo');
                    this.value = valoresOriginales.camion_id;
                }
            });
        }

        function setMinDateTime() {
            // Para edición, no establecemos fecha mínima ya que puede ser un viaje pasado
            // const now = new Date();
            // const formattedNow = now.toISOString().slice(0, 16);
            // document.getElementById('fecha_salida').min = formattedNow;
            // document.getElementById('fecha_llegada').min = formattedNow;
        }

        function monitorearCambios() {
            const form = document.getElementById('formEditarViaje');
            const inputs = form.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    verificarCambios();
                });
            });
        }

        function verificarCambios() {
            const form = document.getElementById('formEditarViaje');
            const formData = new FormData(form);
            let hayCambios = false;

            for (let [key, value] of formData.entries()) {
                if (valoresOriginales[key] !== undefined && valoresOriginales[key] !== value) {
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

        async function actualizarEstadoViaje() {
            try {
                const response = await fetch('/viajes/actualizar-estados', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    mostrarNotificacion('Estado actualizado correctamente', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    mostrarNotificacion('Error al actualizar estado', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                mostrarNotificacion('Error de conexión', 'error');
            }
        }

        function mostrarNotificacion(mensaje, tipo = 'info') {
            // Crear elemento de notificación
            const notificacion = document.createElement('div');
            notificacion.className = `alert alert-${tipo === 'success' ? 'success' : tipo === 'error' ? 'danger' : 'info'}`;
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

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }

        // Validaciones adicionales antes del envío
        document.getElementById('formEditarViaje').addEventListener('submit', function(e) {
            const camionId = document.getElementById('camion_id').value;
            const choferId = document.getElementById('chofer_id').value;
            const clienteId = document.getElementById('cliente_id').value;
            
            if (!camionId) {
                e.preventDefault();
                alert('Debe seleccionar un camión para el viaje');
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

        // Agregar meta tag para CSRF si no existe
        if (!document.querySelector('meta[name="csrf-token"]')) {
            const metaTag = document.createElement('meta');
            metaTag.name = 'csrf-token';
            metaTag.content = '{{ csrf_token() }}';
            document.head.appendChild(metaTag);
        }
    </script>
</body>
</html>