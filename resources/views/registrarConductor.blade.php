<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Registrar Conductor</title>
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

        /* Input helpers */
        .input-helper {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.25rem;
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
            .form-group select {
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
                    <h1 class="navbar-title">Registrar Conductor</h1>
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
                    <a href="{{ route('conductores.index') }}">Conductores</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Registrar Conductor</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Registrar Conductor</h1>
                        <p class="page-subtitle">Complete la información del nuevo conductor</p>
                    </div>
                    <a href="{{ route('conductores.index') }}" class="btn btn-outline">
                        ← Volver a Conductores
                    </a>
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
                        <strong>Por favor corrige los siguientes errores:</strong>
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
                        <h2 class="form-title">Información del Conductor</h2>
                        <p class="form-description">Complete todos los campos obligatorios (*) para registrar el conductor</p>
                    </div>
                    
                    <form action="{{ route('choferes.store') }}" method="POST" id="formRegistrarConductor">
                        @csrf
                        
                        <!-- Sección 1: Datos Personales -->
                        <div class="form-section">
                            <h3 class="section-title">👤 Datos Personales</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nombre">Nombre Completo <span class="required-indicator">*</span></label>
                                    <input 
                                        type="text" 
                                        id="nombre" 
                                        name="nombre" 
                                        value="{{ old('nombre') }}"
                                        required 
                                        placeholder="Ej: Juan Pérez García"
                                        class="@error('nombre') border-danger @enderror"
                                    >
                                    @error('nombre')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <div class="input-helper">Nombre completo como aparece en documentos oficiales</div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="telefono">Teléfono <span class="required-indicator">*</span></label>
                                    <input 
                                        type="tel" 
                                        id="telefono" 
                                        name="telefono" 
                                        value="{{ old('telefono') }}"
                                        required 
                                        placeholder="Ej: +52 271 123 4567"
                                        class="@error('telefono') border-danger @enderror"
                                    >
                                    @error('telefono')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <div class="input-helper">Incluir código de país y área</div>
                                </div>

                                <div class="form-group">
                                    <label for="estado">Estado del Conductor</label>
                                    <select id="estado" name="estado" class="@error('estado') border-danger @enderror">
                                        <option value="activo" {{ old('estado', 'activo') == 'activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        <option value="suspendido" {{ old('estado') == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                                    </select>
                                    @error('estado')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Información de Licencia -->
                        <div class="form-section">
                            <h3 class="section-title">🆔 Información de Licencia</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="licencia">Número de Licencia <span class="required-indicator">*</span></label>
                                    <input 
                                        type="text" 
                                        id="licencia" 
                                        name="licencia" 
                                        value="{{ old('licencia') }}"
                                        required 
                                        placeholder="Ej: LIC-2024-001"
                                        class="@error('licencia') border-danger @enderror"
                                    >
                                    @error('licencia')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <div class="input-helper">Número único de la licencia de conducir</div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="tipoLicencia">Tipo de Licencia</label>
                                    <select id="tipoLicencia" name="tipoLicencia" class="@error('tipoLicencia') border-danger @enderror">
                                        <option value="">Seleccionar tipo</option>
                                        <option value="A" {{ old('tipoLicencia') == 'A' ? 'selected' : '' }}>Tipo A - Transporte de Carga</option>
                                        <option value="B" {{ old('tipoLicencia') == 'B' ? 'selected' : '' }}>Tipo B - Transporte de Pasajeros</option>
                                        <option value="C" {{ old('tipoLicencia') == 'C' ? 'selected' : '' }}>Tipo C - Automovilista</option>
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
                                        value="{{ old('vencimientoLicencia') }}"
                                        class="@error('vencimientoLicencia') border-danger @enderror"
                                    >
                                    @error('vencimientoLicencia')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <div class="input-helper">Fecha en que expira la licencia</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">🗑️ Limpiar</button>
                            <button type="submit" class="btn btn-primary">👥 Registrar Conductor</button>
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
            setupFormValidation();
            setMinDateForLicense();
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

            // Prevent form submission on Enter in input fields (except submit button)
            document.getElementById('formRegistrarConductor').addEventListener('keydown', function(e) {
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

        function setupFormValidation() {
            const form = document.getElementById('formRegistrarConductor');
            const inputs = form.querySelectorAll('input, select');

            // Real-time validation
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });

                input.addEventListener('input', function() {
                    clearError(this);
                    
                    // Special formatting for phone number
                    if (this.name === 'telefono') {
                        formatPhoneNumber(this);
                    }
                    
                    // Special formatting for license number
                    if (this.name === 'licencia') {
                        formatLicenseNumber(this);
                    }
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
                    showAlert('error', 'Por favor, corrige los errores antes de continuar');
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
                    case 'nombre':
                        if (value && value.length < 2) {
                            errorMessage = 'El nombre debe tener al menos 2 caracteres';
                            isValid = false;
                        } else if (value && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value)) {
                            errorMessage = 'El nombre solo puede contener letras y espacios';
                            isValid = false;
                        }
                        break;
                    case 'telefono':
                        if (value && !/^[\+]?[0-9\s\-\(\)]{10,}$/.test(value)) {
                            errorMessage = 'Formato de teléfono inválido';
                            isValid = false;
                        }
                        break;
                    case 'licencia':
                        if (value && value.length < 3) {
                            errorMessage = 'El número de licencia debe tener al menos 3 caracteres';
                            isValid = false;
                        }
                        break;
                    case 'vencimientoLicencia':
                        if (value) {
                            const inputDate = new Date(value);
                            const today = new Date();
                            today.setHours(0, 0, 0, 0);
                            
                            if (inputDate <= today) {
                                errorMessage = 'La fecha de vencimiento debe ser futura';
                                isValid = false;
                            }
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

        function formatPhoneNumber(input) {
            let value = input.value.replace(/\D/g, '');
            
            if (value.length >= 10) {
                if (value.startsWith('52')) {
                    // Mexican number with country code
                    value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})/, '+$1 $2 $3 $4');
                } else if (value.length === 10) {
                    // Local Mexican number
                    value = value.replace(/(\d{3})(\d{3})(\d{4})/, '$1 $2 $3');
                }
            }
            
            input.value = value;
        }

        function formatLicenseNumber(input) {
            let value = input.value.toUpperCase();
            // Remove invalid characters
            value = value.replace(/[^A-Z0-9-]/g, '');
            input.value = value;
        }

        function setMinDateForLicense() {
            const vencimientoInput = document.getElementById('vencimientoLicencia');
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            vencimientoInput.min = tomorrow.toISOString().split('T')[0];
        }

        function limpiarFormulario() {
            if (confirm('¿Está seguro de que desea limpiar el formulario?')) {
                const form = document.getElementById('formRegistrarConductor');
                form.reset();
                
                // Clear all error messages
                const errorMessages = form.querySelectorAll('.error-message');
                errorMessages.forEach(error => {
                    error.remove();
                });
                
                // Reset field borders
                const inputs = form.querySelectorAll('input, select');
                inputs.forEach(input => {
                    input.style.borderColor = '#ddd';
                });
                
                setMinDateForLicense();
                showAlert('success', 'Formulario limpiado correctamente');
            }
        }

        function showAlert(type, message) {
            const alertElement = document.createElement('div');
            alertElement.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
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
        const formInputs = document.querySelectorAll('#formRegistrarConductor input, #formRegistrarConductor select');
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                localStorage.setItem('conductor_form_' + this.name, this.value);
            });

            // Restore saved data
            const savedValue = localStorage.getItem('conductor_form_' + input.name);
            if (savedValue && !input.value) {
                input.value = savedValue;
            }
        });

        // Clear saved data on successful form submission
        document.getElementById('formRegistrarConductor').addEventListener('submit', function() {
            formInputs.forEach(input => {
                localStorage.removeItem('conductor_form_' + input.name);
            });
        });

        // License expiration warning
        document.getElementById('vencimientoLicencia').addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            const diffTime = selectedDate - today;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays < 30) {
                showAlert('error', `⚠️ La licencia vencerá en ${diffDays} días. Considere renovarla pronto.`);
            } else if (diffDays < 90) {
                showAlert('warning', `⚠️ La licencia vencerá en ${diffDays} días.`);
            }
        });

        // Form field suggestions and helpers
        const nombreInput = document.getElementById('nombre');
        nombreInput.addEventListener('input', function() {
            // Auto-capitalize names
            let words = this.value.split(' ');
            words = words.map(word => {
                if (word.length > 0) {
                    return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                }
                return word;
            });
            this.value = words.join(' ');
        });

        // Initialize form state
        window.addEventListener('load', function() {
            setMinDateForLicense();
            
            // Focus first input for better UX
            const firstInput = document.querySelector('input[required]');
            if (firstInput) {
                firstInput.focus();
            }
        });
    </script>
</body>
</html>