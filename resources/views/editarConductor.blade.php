<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Editar Conductor</title>
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

        /* Conductor Info Header */
        .conductor-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .conductor-details h3 {
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .conductor-meta {
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

        .status-activo { background: rgba(40,167,69,0.3); color: white; }
        .status-inactivo { background: rgba(108,117,125,0.3); color: white; }
        .status-suspendido { background: rgba(220,53,69,0.3); color: white; }

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
        .form-group select {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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

        /* License expiry warning */
        .license-warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 0.75rem;
            border-radius: 5px;
            margin-top: 0.5rem;
            font-size: 0.875rem;
        }

        .license-expired {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
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

            .conductor-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .conductor-meta {
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
                <a href="/conductores" class="active">
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
                    <h1 class="navbar-title">Editar Conductor</h1>
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
                    <a href="{{ route('conductores.index') }}">Conductores</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Editar Conductor</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Editar Conductor</h1>
                        <p class="page-subtitle">Modifica la información del conductor registrado</p>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <a href="{{ route('choferes.show', $chofer->id) }}" class="btn btn-secondary">
                            👁️ Ver Detalles
                        </a>
                        <a href="{{ route('conductores.index') }}" class="btn btn-outline">
                            ← Volver a Lista
                        </a>
                    </div>
                </div>

                <!-- Información del Conductor -->
                <div class="conductor-info">
                    <div class="conductor-details">
                        <h3>{{ $chofer->nombre }}</h3>
                        <div class="conductor-meta">
                            <span>📞 {{ $chofer->telefono }}</span>
                            <span>🆔 Licencia: {{ $chofer->licencia }}</span>
                            @if($chofer->tipo_licencia)
                                <span>📋 Tipo: {{ $chofer->tipo_licencia }}</span>
                            @endif
                            @if($chofer->vencimiento_licencia)
                                <span>📅 Vence: {{ \Carbon\Carbon::parse($chofer->vencimiento_licencia)->format('d/m/Y') }}</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <span class="status-badge status-{{ $chofer->estado }}">
                            @switch($chofer->estado)
                                @case('activo')
                                    ✅ Activo
                                    @break
                                @case('inactivo')
                                    ⏸️ Inactivo
                                    @break
                                @case('suspendido')
                                    ⚠️ Suspendido
                                    @break
                                @default
                                    {{ ucfirst($chofer->estado) }}
                            @endswitch
                        </span>
                    </div>
                </div>

                <!-- Mostrar mensajes de éxito -->
                @if(session('success'))
                    <div class="alert alert-success">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <!-- Mostrar errores generales -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin: 0; padding-left: 1rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Modificar Información del Conductor</h2>
                        <p class="form-description">Actualiza los campos necesarios para el conductor</p>
                    </div>
                    
                    <form action="{{ route('choferes.update', $chofer->id) }}" method="POST" id="formEditarConductor">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nombre">Nombre Completo <span class="required-indicator">*</span></label>
                                <input 
                                    type="text" 
                                    id="nombre" 
                                    name="nombre" 
                                    value="{{ old('nombre', $chofer->nombre) }}"
                                    required 
                                    placeholder="Ej: Juan Pérez García"
                                    class="@error('nombre') border-danger @enderror"
                                >
                                @error('nombre')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="telefono">Teléfono <span class="required-indicator">*</span></label>
                                <input 
                                    type="tel" 
                                    id="telefono" 
                                    name="telefono" 
                                    value="{{ old('telefono', $chofer->telefono) }}"
                                    required 
                                    placeholder="Ej: +52 271 123 4567"
                                    class="@error('telefono') border-danger @enderror"
                                >
                                @error('telefono')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="licencia">Número de Licencia <span class="required-indicator">*</span></label>
                                <input 
                                    type="text" 
                                    id="licencia" 
                                    name="licencia" 
                                    value="{{ old('licencia', $chofer->licencia) }}"
                                    required 
                                    placeholder="Ej: LIC-2024-001"
                                    class="@error('licencia') border-danger @enderror"
                                >
                                @error('licencia')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="tipoLicencia">Tipo de Licencia</label>
                                <select id="tipoLicencia" name="tipoLicencia" class="@error('tipoLicencia') border-danger @enderror">
                                    <option value="">Seleccionar tipo</option>
                                    <option value="A" {{ (old('tipoLicencia', $chofer->tipo_licencia) == 'A') ? 'selected' : '' }}>Tipo A - Transporte de Carga</option>
                                    <option value="B" {{ (old('tipoLicencia', $chofer->tipo_licencia) == 'B') ? 'selected' : '' }}>Tipo B - Transporte de Pasajeros</option>
                                    <option value="C" {{ (old('tipoLicencia', $chofer->tipo_licencia) == 'C') ? 'selected' : '' }}>Tipo C - Automovilista</option>
                                </select>
                                @error('tipoLicencia')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="vencimientoLicencia">Fecha de Vencimiento</label>
                                <input 
                                    type="date" 
                                    id="vencimientoLicencia" 
                                    name="vencimientoLicencia"
                                    value="{{ old('vencimientoLicencia', $chofer->vencimiento_licencia ? \Carbon\Carbon::parse($chofer->vencimiento_licencia)->format('Y-m-d') : '') }}"
                                    class="@error('vencimientoLicencia') border-danger @enderror"
                                >
                                @error('vencimientoLicencia')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                
                                <!-- Verificación de vencimiento de licencia -->
                                @if($chofer->vencimiento_licencia)
                                    @php
                                        $vencimiento = \Carbon\Carbon::parse($chofer->vencimiento_licencia);
                                        $hoy = \Carbon\Carbon::now();
                                        $diasParaVencer = $hoy->diffInDays($vencimiento, false);
                                    @endphp
                                    
                                    @if($diasParaVencer < 0)
                                        <div class="license-warning license-expired">
                                            ⚠️ Licencia vencida hace {{ abs($diasParaVencer) }} día(s)
                                        </div>
                                    @elseif($diasParaVencer <= 30)
                                        <div class="license-warning">
                                            ⚠️ Licencia vence en {{ $diasParaVencer }} día(s)
                                        </div>
                                    @endif
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="estado">Estado del Conductor</label>
                                <select id="estado" name="estado" class="@error('estado') border-danger @enderror">
                                    <option value="activo" {{ (old('estado', $chofer->estado) == 'activo') ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ (old('estado', $chofer->estado) == 'inactivo') ? 'selected' : '' }}>Inactivo</option>
                                    <option value="suspendido" {{ (old('estado', $chofer->estado) == 'suspendido') ? 'selected' : '' }}>Suspendido</option>
                                </select>
                                @error('estado')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <a href="{{ route('conductores.index') }}" class="btn btn-secondary">❌ Cancelar</a>
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
            nombre: '{{ $chofer->nombre }}',
            telefono: '{{ $chofer->telefono }}',
            licencia: '{{ $chofer->licencia }}',
            tipoLicencia: '{{ $chofer->tipo_licencia }}',
            vencimientoLicencia: '{{ $chofer->vencimiento_licencia ? \Carbon\Carbon::parse($chofer->vencimiento_licencia)->format('Y-m-d') : '' }}',
            estado: '{{ $chofer->estado }}'
        };

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            monitorearCambios();
            verificarVencimientoLicencia();
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

            // Monitorear cambios en fecha de vencimiento
            document.getElementById('vencimientoLicencia').addEventListener('change', function() {
                verificarVencimientoLicencia();
            });
        }

        function monitorearCambios() {
            const form = document.getElementById('formEditarConductor');
            const inputs = form.querySelectorAll('input, select');