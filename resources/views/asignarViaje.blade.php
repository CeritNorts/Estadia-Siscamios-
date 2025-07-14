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
                    <h1 class="navbar-title">Asignar Viaje</h1>
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

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                alert('Cerrando sesión...');
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
    </script>
</body>
</html>