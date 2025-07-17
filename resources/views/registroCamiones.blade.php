<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Registro de Camiones</title>
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

        .form-group input.is-invalid,
        .form-group select.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }

        .form-group input.is-valid,
        .form-group select.is-valid {
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
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

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .success-message {
            color: #28a745;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Validation indicators */
        .validation-info {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.25rem;
        }

        /* Logout button in navbar */
        .logout-btn {
            background: transparent;
            color: #dc3545;
            border: 1px solid #dc3545;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .logout-btn:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }

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

            .form-container {
                padding: 1rem;
                border-radius: 8px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
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

            .breadcrumb {
                font-size: 0.8rem;
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

            .form-container {
                padding: 0.75rem;
            }

            .form-grid {
                gap: 0.75rem;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .navbar-title {
                font-size: 1rem;
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

            .logout-btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
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
                <a href="/camiones/create" class="active">📝 Registro de Camiones</a>
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
                <div class="user-avatar">AD</div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">Administrador</div>
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
                    <h1 class="navbar-title">Registro de Camiones</h1>
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
                    <a href="{{ route('camiones.index') }}">Camiones</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Registro de Unidades</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Registro de Camiones</h1>
                        <p class="page-subtitle">Agregar nueva unidad a la flotilla</p>
                    </div>
                    <a href="{{ route('camiones.index') }}" class="btn btn-outline">
                        ← Volver a Lista
                    </a>
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

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Información del Vehículo</h2>
                        <p class="form-description">Complete todos los campos obligatorios (*) para registrar el camión en el sistema</p>
                    </div>
                    
                    <form action="{{ route('camiones.store') }}" method="POST" id="formRegistroCamion">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="placa">Placa del Vehículo <span class="required-indicator">*</span></label>
                                <input type="text" 
                                       id="placa" 
                                       name="placa" 
                                       value="{{ old('placa') }}"
                                       required 
                                       placeholder="ABC-12345"
                                       class="@error('placa') is-invalid @enderror">
                                @error('placa')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <div class="validation-info">Formato: XXX-1234 (3 letras, guión, 4 números)</div>
                            </div>
                            
                            <div class="form-group">
                                <label for="modelo">Modelo <span class="required-indicator">*</span></label>
                                <input type="text" 
                                       id="modelo" 
                                       name="modelo" 
                                       value="{{ old('modelo') }}"
                                       required 
                                       placeholder="Freightliner Cascadia"
                                       class="@error('modelo') is-invalid @enderror">
                                @error('modelo')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <div class="validation-info">Permite letras, espacios, números y guión (máximo 6 números consecutivos)</div>
                            </div>
                            
                            <div class="form-group">
                                <label for="anio">Año <span class="required-indicator">*</span></label>
                                <input type="number" 
                                       id="anio" 
                                       name="anio" 
                                       value="{{ old('anio') }}"
                                       required 
                                       min="1900" 
                                       max="{{ date('Y') }}" 
                                       placeholder="{{ date('Y') }}"
                                       class="@error('anio') is-invalid @enderror">
                                @error('anio')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <div class="validation-info">Año entre 1900 y {{ date('Y') }}</div>
                            </div>
                            
                            <div class="form-group">
                                <label for="capacidad_carga">Capacidad de Carga (Toneladas) <span class="required-indicator">*</span></label>
                                <input type="number" 
                                       id="capacidad_carga" 
                                       name="capacidad_carga" 
                                       value="{{ old('capacidad_carga') }}"
                                       required 
                                       step="0.1" 
                                       min="0.1"
                                       max="100"
                                       placeholder="25.5"
                                       class="@error('capacidad_carga') is-invalid @enderror">
                                @error('capacidad_carga')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <div class="validation-info">Solo números positivos (0.1 - 100 toneladas)</div>
                            </div>
                            
                            <div class="form-group">
                                <label for="estado">Estado Actual <span class="required-indicator">*</span></label>
                                <select id="estado" 
                                        name="estado" 
                                        required
                                        class="@error('estado') is-invalid @enderror">
                                    <option value="">Seleccionar estado</option>
                                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="mantenimiento" {{ old('estado') == 'mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
                                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">🗑️ Limpiar</button>
                            <button type="submit" class="btn btn-primary">💾 Guardar Camión</button>
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
            setupValidations();
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
            document.getElementById('formRegistroCamion').addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.type !== 'submit') {
                    e.preventDefault();
                }
            });
        }

        function setupValidations() {
            const anioInput = document.getElementById('anio');
            const modeloInput = document.getElementById('modelo');
            const capacidadInput = document.getElementById('capacidad_carga');
            const placaInput = document.getElementById('placa');

            // Validación para el año
            anioInput.addEventListener('input', function() {
                const currentYear = new Date().getFullYear();
                let value = this.value;
                
                // Remover números negativos y limitarlo a 4 dígitos
                value = value.replace(/[^0-9]/g, '');
                if (value.length > 4) {
                    value = value.slice(0, 4);
                }
                
                this.value = value;
                
                // Validar rango
                const year = parseInt(value);
                if (value && (year < 1900 || year > currentYear)) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                    showFieldError(this, `El año debe estar entre 1900 y ${currentYear}`);
                } else if (value && year >= 1900 && year <= currentYear) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                    hideFieldError(this);
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                    hideFieldError(this);
                }
            });

            // Validación para el modelo (letras, espacios, números - máximo 6 números consecutivos)
            modeloInput.addEventListener('input', function() {
                let value = this.value;
                
                // Permitir letras, espacios, números y algunos caracteres especiales comunes en modelos
                value = value.replace(/[^a-zA-ZÀ-ÿ\s0-9\-]/g, '');
                
                // Verificar que no haya más de 6 números consecutivos
                const consecutiveNumbers = value.match(/\d{7,}/g);
                if (consecutiveNumbers) {
                    // Si hay más de 6 números consecutivos, cortarlos a 6
                    consecutiveNumbers.forEach(match => {
                        const replacement = match.substring(0, 6);
                        value = value.replace(match, replacement);
                    });
                }
                
                this.value = value;
                
                // Validar formato
                const hasMoreThan6ConsecutiveNumbers = /\d{7,}/.test(value);
                
                if (hasMoreThan6ConsecutiveNumbers) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                    showFieldError(this, 'No se permiten más de 6 números consecutivos');
                } else if (value.trim().length > 0) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                    hideFieldError(this);
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                    hideFieldError(this);
                }
            });

            // Validación para capacidad de carga (solo números positivos)
            capacidadInput.addEventListener('input', function() {
                let value = this.value;
                
                // Remover letras y caracteres especiales, mantener solo números y punto decimal
                value = value.replace(/[^0-9.]/g, '');
                
                // Evitar múltiples puntos decimales
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                
                this.value = value;
                
                const numValue = parseFloat(value);
                if (value && (numValue <= 0 || numValue > 100)) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                    showFieldError(this, 'La capacidad debe ser mayor a 0 y menor o igual a 100 toneladas');
                } else if (value && numValue > 0 && numValue <= 100) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                    hideFieldError(this);
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                    hideFieldError(this);
                }
            });

            // Prevenir entrada de valores negativos con teclado
            anioInput.addEventListener('keydown', function(e) {
                // Prevenir el signo negativo
                if (e.key === '-' || e.key === 'e' || e.key === 'E') {
                    e.preventDefault();
                }
            });

            capacidadInput.addEventListener('keydown', function(e) {
                // Prevenir el signo negativo
                if (e.key === '-' || e.key === 'e' || e.key === 'E') {
                    e.preventDefault();
                }
            });

            // Validación para placa (formato XXX-1234)
            placaInput.addEventListener('input', function() {
                let value = this.value.replace(/[^a-zA-Z0-9-]/g, '').toUpperCase();
                
                // Formato automático XXX-1234
                if (value.length > 3 && value.charAt(3) !== '-') {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                }
                
                // Limitar longitud
                if (value.length > 8) {
                    value = value.slice(0, 8);
                }
                
                this.value = value;
                
                // Validar formato
                const placaRegex = /^[A-Z]{3}-[0-9]{4}$/;
                if (value && !placaRegex.test(value)) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                    showFieldError(this, 'Formato inválido. Use XXX-1234 (3 letras, guión, 4 números)');
                } else if (value && placaRegex.test(value)) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                    hideFieldError(this);
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                    hideFieldError(this);
                }
            });

            // Validación en tiempo real para estado
            document.getElementById('estado').addEventListener('change', function() {
                if (this.value) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                    hideFieldError(this);
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                    hideFieldError(this);
                }
            });
        }

        function showFieldError(field, message) {
            // Remover mensaje de error anterior
            hideFieldError(field);
            
            // Crear nuevo mensaje de error
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message validation-error';
            errorDiv.textContent = message;
            
            // Insertar después del campo
            field.parentNode.insertBefore(errorDiv, field.nextSibling);
        }

        function hideFieldError(field) {
            const errorMessage = field.parentNode.querySelector('.validation-error');
            if (errorMessage) {
                errorMessage.remove();
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

        function goToProfile() {
            window.location.href = '/profile';
        }

        function limpiarFormulario() {
            if (confirm('¿Estás seguro de que deseas limpiar todos los campos?')) {
                document.getElementById('formRegistroCamion').reset();
                
                // Limpiar clases de validación
                const inputs = document.querySelectorAll('.form-group input, .form-group select');
                inputs.forEach(input => {
                    input.classList.remove('is-valid', 'is-invalid');
                    hideFieldError(input);
                });
                
                // Limpiar localStorage
                const formInputs = document.querySelectorAll('#formRegistroCamion input, #formRegistroCamion select');
                formInputs.forEach(input => {
                    localStorage.removeItem('form_' + input.name);
                });
            }
        }

        function logout() {
            if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }

        // Validación final antes del envío
        document.getElementById('formRegistroCamion').addEventListener('submit', function(e) {
            const isValid = validateForm();
            if (!isValid) {
                e.preventDefault();
                alert('Por favor, corrija los errores en el formulario antes de continuar.');
            }
        });

        function validateForm() {
            let isValid = true;
            const currentYear = new Date().getFullYear();
            
            // Validar placa
            const placa = document.getElementById('placa').value;
            const placaRegex = /^[A-Z]{3}-[0-9]{4}$/;
            if (!placa || !placaRegex.test(placa)) {
                showFieldError(document.getElementById('placa'), 'Formato de placa inválido');
                document.getElementById('placa').classList.add('is-invalid');
                isValid = false;
            }
            
            // Validar modelo
            const modelo = document.getElementById('modelo').value;
            const hasMoreThan6ConsecutiveNumbers = /\d{7,}/.test(modelo);
            if (!modelo || modelo.trim().length === 0) {
                showFieldError(document.getElementById('modelo'), 'El modelo es obligatorio');
                document.getElementById('modelo').classList.add('is-invalid');
                isValid = false;
            } else if (hasMoreThan6ConsecutiveNumbers) {
                showFieldError(document.getElementById('modelo'), 'No se permiten más de 6 números consecutivos');
                document.getElementById('modelo').classList.add('is-invalid');
                isValid = false;
            }
            
            // Validar año
            const anio = parseInt(document.getElementById('anio').value);
            if (!anio || anio < 1900 || anio > currentYear) {
                showFieldError(document.getElementById('anio'), `El año debe estar entre 1900 y ${currentYear}`);
                document.getElementById('anio').classList.add('is-invalid');
                isValid = false;
            }
            
            // Validar capacidad de carga
            const capacidad = parseFloat(document.getElementById('capacidad_carga').value);
            if (!capacidad || capacidad <= 0 || capacidad > 100) {
                showFieldError(document.getElementById('capacidad_carga'), 'La capacidad debe ser mayor a 0 y menor o igual a 100 toneladas');
                document.getElementById('capacidad_carga').classList.add('is-invalid');
                isValid = false;
            }
            
            // Validar estado
            const estado = document.getElementById('estado').value;
            if (!estado) {
                showFieldError(document.getElementById('estado'), 'Debe seleccionar un estado');
                document.getElementById('estado').classList.add('is-invalid');
                isValid = false;
            }
            
            return isValid;
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

        // Auto-save form data to prevent data loss
        const formInputs = document.querySelectorAll('#formRegistroCamion input, #formRegistroCamion select');
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                localStorage.setItem('form_' + this.name, this.value);
            });

            // Restore saved data
            const savedValue = localStorage.getItem('form_' + input.name);
            if (savedValue && !input.value) {
                input.value = savedValue;
            }
        });

        // Clear saved data on successful form submission
        document.getElementById('formRegistroCamion').addEventListener('submit', function() {
            formInputs.forEach(input => {
                localStorage.removeItem('form_' + input.name);
            });
        });
    </script>
</body>
</html>