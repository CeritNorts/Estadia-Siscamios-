<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Registrar Cliente</title>
    <style>
        /* Tu CSS proporcionado (sin cambios aquí) */
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

        /* Breadcrumb */
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

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
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

        /* Character Counter */
        .character-counter {
            font-size: 0.8rem;
            color: #666;
            text-align: right;
            margin-top: 0.25rem;
        }

        .character-counter.warning {
            color: #dc3545;
        }

        /* Field validation styles */
        .field-valid {
            border-color: #28a745 !important;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1) !important;
        }

        .field-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
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

            .page-title {
                font-size: 1.75rem;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                justify-content: center;
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

            .form-header {
                padding-bottom: 0.75rem;
                margin-bottom: 1.5rem;
            }

            .form-title {
                font-size: 1.25rem;
            }

            .form-grid {
                gap: 1rem;
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
                font-size: 1rem;
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
    <!-- Sidebar (contenido de tu sidebar, sin cambios relevantes para este problema) -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">Siscamino</a>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="/dashboard">📊 Panel Administrativo</a></li>
            <li><a href="/camiones">🚛 Camiones</a></li>
            <li><a href="/viajes">📋 Viajes</a></li>
            <li><a href="/mantenimiento">🔧 Mantenimiento</a></li>
            <li><a href="/conductores">👥 Conductores</a></li>
            <li><a href="/clientes" class="active">👤 Clientes</a></li>
            <li><a href="/combustible">⛽ Combustible</a></li>
            @if(Auth::check() && Auth::user()->hasRole('Administrador'))
                <li><a href="{{ route('admin.users.index') }}">⚙️ Gestión de Usuarios</a></li>
            @endif
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
                    <h1 class="navbar-title">Registrar Cliente</h1>
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
                    <a href="/clientes">Clientes</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Registrar Cliente</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Registrar Cliente</h1>
                        <p class="page-subtitle">Complete la información del nuevo cliente</p>
                    </div>
                    <a href="/clientes" class="btn btn-outline">
                        ← Volver a Clientes
                    </a>
                </div>

                <!-- Success/Error Messages -->
                {{-- Aquí Laravel inyectará los mensajes de sesión (success/error) --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Información del Cliente</h2>
                        <p class="form-description">Complete todos los campos obligatorios (*) para registrar el cliente</p>
                    </div>
                    
                    {{-- ¡CAMBIO CLAVE AQUÍ! El formulario ahora se envía directamente a Laravel --}}
                    <form action="{{ route('clientes.store') }}" method="POST">
                        @csrf {{-- ¡Token CSRF es OBLIGATORIO para Laravel! --}}
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nombre">Nombre/Razón Social <span class="required-indicator">*</span></label>
                                <input 
                                    type="text" 
                                    id="nombre" 
                                    name="nombre" 
                                    required 
                                    placeholder="Ej: Juan Pérez García / Empresa S.A. de C.V."
                                    value="{{ old('nombre') }}" {{-- Para mantener el valor si hay error de validación --}}
                                >
                                @error('nombre')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="tipo">Tipo de Cliente <span class="required-indicator">*</span></label>
                                <select id="tipo" name="tipo" required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="empresa">Empresa</option>
                                    <option value="particular">Particular</option>
                                </select>
                                <div class="error-message" id="error-tipo"></div>
                                <label for="tipo">Tipo de Cliente</label>
                                <select id="tipo" name="tipo" class="form-input">
                                    <option value="empresa" {{ old('tipo') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                                    <option value="particular" {{ old('tipo') == 'particular' ? 'selected' : '' }}>Particular</option>
                                </select>
                                @error('tipo')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="contacto">Información de Contacto <span class="required-indicator">*</span></label>
                                <input 
                                    type="text" 
                                    id="contacto" 
                                    name="contacto" 
                                    required 
                                    placeholder="Ej: +52 271 123 4567 / contacto@empresa.com"
                                    value="{{ old('contacto') }}"
                                >
                                @error('contacto')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado <span class="required-indicator">*</span></label>
                                <select id="estado" name="estado" required>
                                    <option value="">Seleccionar estado</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                                <div class="error-message" id="error-estado"></div>
                                <label for="estado">Estado</label>
                                <select id="estado" name="estado" class="form-input">
                                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="contrato">Información del Contrato <span class="required-indicator">*</span></label>
                                <textarea 
                                    id="contrato" 
                                    name="contrato" 
                                    required 
                                    placeholder="Detalles del contrato: servicios requeridos, frecuencia de viajes, rutas principales, términos especiales, etc."
                                >{{ old('contrato') }}</textarea>
                                <div class="character-counter" id="contrato-counter">0 / 1000 caracteres</div>
                                @error('contrato')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">
                                🗑️ Limpiar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                👤 Registrar Cliente
                            </button>
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
            // Inicializar contador de caracteres al cargar la página si ya hay contenido
            const contratoTextarea = document.getElementById('contrato');
            if (contratoTextarea) {
                updateCharacterCounter(contratoTextarea);
            }
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

            // Contador de caracteres para el textarea
            const contratoTextarea = document.getElementById('contrato');
            contratoTextarea.addEventListener('input', function() {
                const maxLength = 1000;
                const currentLength = this.value.length;
                const counter = document.getElementById('contrato-counter');
                
                counter.textContent = `${currentLength} / ${maxLength} caracteres`;
                
                if (currentLength > maxLength * 0.9) {
                    counter.classList.add('warning');
                } else {
                    counter.classList.remove('warning');
                }
            });
            if (contratoTextarea) {
                contratoTextarea.addEventListener('input', function() {
                    updateCharacterCounter(this);
                });
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

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Escape key to close sidebar
                if (e.key === 'Escape') {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        }

        function setupFormValidation() {
            const form = document.getElementById('formRegistrarCliente');
            const inputs = form.querySelectorAll('input, select, textarea');

            // Real-time validation
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });

                input.addEventListener('input', function() {
                    clearFieldStyles(this);
                    
                    // Validación específica para nombre/razón social
                    if (this.name === 'nombre') {
                        formatNombreField(this);
                        validateField(this);
                    }
                    
                    // Validación en tiempo real para otros campos
                    if (this.value.trim()) {
                        validateField(this);
                    }
                });
            });

            // Form submission validation
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                validateAndSubmitForm();
            });
        }

        function validateField(field) {
            const value = field.value.trim();
            const fieldName = field.name;
            let isValid = true;
            let errorMessage = '';

            // Limpiar error previo
            clearError(field);

            // Validación de campos requeridos
            if (!value) {
                errorMessage = `El campo ${getFieldDisplayName(fieldName)} es obligatorio`;
                isValid = false;
            } else {
                // Validaciones específicas
                switch (fieldName) {
                    case 'nombre':
                        if (value.length < 2) {
                            errorMessage = 'El nombre debe tener al menos 2 caracteres';
                            isValid = false;
                        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.]+$/.test(value)) {
                            errorMessage = 'El nombre solo puede contener letras, espacios y puntos';
                            isValid = false;
                        }
                        break;
                    case 'contacto':
                        if (value.length < 5) {
                            errorMessage = 'La información de contacto debe tener al menos 5 caracteres';
                            isValid = false;
                        }
                        break;
                    case 'contrato':
                        if (value.length < 10) {
                            errorMessage = 'La información del contrato debe tener al menos 10 caracteres';
                            isValid = false;
                        } else if (value.length > 1000) {
                            errorMessage = 'La información del contrato no puede exceder 1000 caracteres';
                            isValid = false;
                        }
                        break;
                }
            }

            // Aplicar estilos visuales
            if (isValid) {
                field.classList.remove('field-invalid');
                field.classList.add('field-valid');
            } else {
                field.classList.remove('field-valid');
                field.classList.add('field-invalid');
                showError(field, errorMessage);
            }

            return isValid;
        }

        function formatNombreField(input) {
            let value = input.value;
            
            // Remover caracteres no permitidos (números y símbolos excepto puntos)
            value = value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.]/g, '');
            
            // Capitalizar la primera letra de cada palabra
            value = value.replace(/\b\w/g, l => l.toUpperCase());
            
            input.value = value;
        }

        function clearFieldStyles(field) {
            field.classList.remove('field-valid', 'field-invalid');
        }

        function clearError(field) {
            const errorElement = document.getElementById(`error-${field.name}`);
            if (errorElement) {
                errorElement.textContent = '';
            }
        }

        function showError(field, message) {
            const errorElement = document.getElementById(`error-${field.name}`);
            if (errorElement) {
                errorElement.textContent = message;
            }
        }

        function getFieldDisplayName(fieldName) {
            const names = {
                'nombre': 'Nombre/Razón Social',
                'tipo': 'Tipo de Cliente',
                'contacto': 'Información de Contacto',
                'estado': 'Estado',
                'contrato': 'Información del Contrato'
            };
            return names[fieldName] || fieldName;
        }

        function validateAndSubmitForm() {
            const form = document.getElementById('formRegistrarCliente');
            const inputs = form.querySelectorAll('input, select, textarea');
            let isFormValid = true;
            let errors = [];

            // Validar todos los campos
            inputs.forEach(input => {
                const isValid = validateField(input);
                if (!isValid) {
                    isFormValid = false;
                    const fieldName = getFieldDisplayName(input.name);
                    const errorElement = document.getElementById(`error-${input.name}`);
                    if (errorElement && errorElement.textContent) {
                        errors.push(errorElement.textContent);
                    }
                }
            });

            if (isFormValid) {
                showAlert('✅ Cliente registrado exitosamente', 'success');
                
                // Simular delay de envío
                setTimeout(() => {
                    limpiarFormulario();
                }, 2000);
            } else {
                const uniqueErrors = [...new Set(errors)];
                showAlert('❌ Por favor, corrija los errores en el formulario', 'danger');
                
                // Scroll al primer campo con error
                const firstInvalidField = form.querySelector('.field-invalid');
                if (firstInvalidField) {
                    firstInvalidField.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                    firstInvalidField.focus();
                }
            }
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

        function limpiarFormulario() {
            if (confirm('¿Está seguro de que desea limpiar el formulario?')) {
                const form = document.getElementById('formRegistrarCliente');
                form.reset();
                document.querySelector('form').reset(); // Selecciona el primer formulario
                
                // Limpiar contador de caracteres
                const counter = document.getElementById('contrato-counter');
                if (counter) {
                    counter.textContent = '0 / 1000 caracteres';
                    counter.classList.remove('warning');
                }

                // Limpiar mensajes de error
                document.querySelectorAll('.error-message').forEach(error => {
                    error.textContent = '';
                });

                // Limpiar estilos de validación
                const inputs = form.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.classList.remove('field-valid', 'field-invalid');
                });

                showAlert('✅ Formulario limpiado correctamente', 'success');
            }
        }

        // Función para actualizar el contador de caracteres
        function updateCharacterCounter(textareaElement) {
            const maxLength = 1000;
            const currentLength = textareaElement.value.length;
            const counter = document.getElementById('contrato-counter');
            
            if (counter) { // Asegurarse de que el contador existe
                counter.textContent = `${currentLength} / ${maxLength} caracteres`;
                
                if (currentLength > maxLength * 0.9) {
                    counter.classList.add('warning');
                } else {
                    counter.classList.remove('warning');
                }
            }
        }

        // Función para mostrar alertas (similar a como lo tenías en otras vistas)
        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            if (alertContainer) {
                alertContainer.innerHTML = `
                    <div class="alert alert-${type}">
                        ${type === 'success' ? '✅' : '❌'} ${message}
                    </div>
                `;
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.remove();
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

        // Auto-save form data to prevent data loss
        const formInputs = document.querySelectorAll('#formRegistrarCliente input, #formRegistrarCliente select, #formRegistrarCliente textarea');
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                localStorage.setItem('cliente_form_' + this.name, this.value);
            });

            // Restore saved data on page load
            document.addEventListener('DOMContentLoaded', function() {
                const savedValue = localStorage.getItem('cliente_form_' + input.name);
                if (savedValue && !input.value) {
                    input.value = savedValue;
                }
            });
        });

        // Clear saved data on successful form submission
        function clearAutoSaveData() {
            formInputs.forEach(input => {
                localStorage.removeItem('cliente_form_' + input.name);
            });
        }
                    alertContainer.innerHTML = '';
                }, 5000); // Ocultar alerta después de 5 segundos
            }
        }

        
    </script>
</body>
