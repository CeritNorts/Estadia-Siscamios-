<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Editar Registro de Combustible</title>
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

        /* Combustible Info Header */
        .combustible-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .combustible-details h3 {
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .combustible-meta {
            display: flex;
            gap: 2rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .combustible-id {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            background: rgba(255,255,255,0.2);
            color: white;
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

        .alert-info {
            background: #e3f2fd;
            color: #1565c0;
            border-color: #bbdefb;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Calculation displays */
        .calculation-display {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 0.75rem;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: #495057;
        }

        .calculation-highlight {
            font-weight: 600;
            color: #28a745;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
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

            .form-actions {
                flex-direction: column-reverse;
                gap: 0.75rem;
            }

            .combustible-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .combustible-meta {
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
                <a href="/conductores">
                    👥 Conductores
                </a>
            </li>
            <li>
                <a href="/clientes">👤 Clientes</a>
            </li>
            <li>
                <a href="/combustible" class="active">⛽ Combustible</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
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
                    <h1 class="navbar-title">Editar Combustible</h1>
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
                    <a href="{{ route('combustible') }}">Combustible</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Editar Registro #{{ $combustible->id }}</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Editar Registro de Combustible</h1>
                        <p class="page-subtitle">Modifica la información del registro de combustible</p>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <a href="{{ route('combustibles.show', $combustible->id) }}" class="btn btn-secondary">
                            👁️ Ver Detalles
                        </a>
                        <a href="{{ route('combustible') }}" class="btn btn-outline">
                            ← Volver a Lista
                        </a>
                    </div>
                </div>

                <!-- Información del Registro -->
                <div class="combustible-info">
                    <div class="combustible-details">
                        <h3>Registro de Combustible - Viaje: {{ $combustible->viaje ? $combustible->viaje->ruta : 'Sin viaje asignado' }}</h3>
                        <div class="combustible-meta">
                            <span>⛽ {{ number_format($combustible->cantidad_litros, 2) }} L</span>
                            <span>💰 ${{ number_format($combustible->costo, 2) }}</span>
                            <span>📅 {{ \Carbon\Carbon::parse($combustible->fecha)->format('d/m/Y') }}</span>
                            <span>📈 ${{ number_format($combustible->costo / $combustible->cantidad_litros, 2) }}/L</span>
                        </div>
                    </div>
                    <div>
                        <span class="combustible-id">
                            ⛽ Registro #{{ str_pad($combustible->id, 3, '0', STR_PAD_LEFT) }}
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

                @if($errors->any())
                    <div class="alert alert-error">
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
                        <h2 class="form-title">Modificar Información del Registro</h2>
                        <p class="form-description">Actualiza los campos necesarios para el registro de combustible</p>
                    </div>
                    
                    <form action="{{ route('combustibles.update', $combustible->id) }}" method="POST" id="formEditarCombustible">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="viaje_id">Viaje Asociado <span class="required-indicator">*</span></label>
                                <select id="viaje_id" 
                                        name="viaje_id" 
                                        required
                                        class="@error('viaje_id') is-invalid @enderror">
                                    <option value="">Seleccionar viaje</option>
                                    @foreach($viajes as $viaje)
                                        <option value="{{ $viaje->id }}" 
                                                {{ (old('viaje_id', $combustible->viaje_id) == $viaje->id) ? 'selected' : '' }}>
                                            VJ-{{ str_pad($viaje->id, 3, '0', STR_PAD_LEFT) }} - {{ $viaje->ruta }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('viaje_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="cantidad_litros">Cantidad de Combustible (Litros) <span class="required-indicator">*</span></label>
                                <input type="number" 
                                       id="cantidad_litros" 
                                       name="cantidad_litros" 
                                       value="{{ old('cantidad_litros', $combustible->cantidad_litros) }}"
                                       required 
                                       step="0.01" 
                                       min="0"
                                       placeholder="150.50"
                                       class="@error('cantidad_litros') is-invalid @enderror">
                                @error('cantidad_litros')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="costo">Costo Total (MXN) <span class="required-indicator">*</span></label>
                                <input type="number" 
                                       id="costo" 
                                       name="costo" 
                                       value="{{ old('costo', $combustible->costo) }}"
                                       required 
                                       step="0.01" 
                                       min="0"
                                       placeholder="3000.00"
                                       class="@error('costo') is-invalid @enderror">
                                @error('costo')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <div class="calculation-display" id="precioPorLitro">
                                    Precio por litro: <span class="calculation-highlight">$0.00</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="fecha">Fecha del Registro <span class="required-indicator">*</span></label>
                                <input type="date" 
                                       id="fecha" 
                                       name="fecha" 
                                       value="{{ old('fecha', \Carbon\Carbon::parse($combustible->fecha)->format('Y-m-d')) }}"
                                       required
                                       class="@error('fecha') is-invalid @enderror">
                                @error('fecha')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <a href="{{ route('combustible') }}" class="btn btn-secondary">❌ Cancelar</a>
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
            viaje_id: '{{ $combustible->viaje_id }}',
            cantidad_litros: '{{ $combustible->cantidad_litros }}',
            costo: '{{ $combustible->costo }}',
            fecha: '{{ \Carbon\Carbon::parse($combustible->fecha)->format('Y-m-d') }}'
        };

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            updateDateTime();
            setInterval(updateDateTime, 1000);
            monitorearCambios();
            calcularPrecioPorLitro();
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

            // Cálculo automático del precio por litro
            document.getElementById('cantidad_litros').addEventListener('input', calcularPrecioPorLitro);
            document.getElementById('costo').addEventListener('input', calcularPrecioPorLitro);
        }

        function monitorearCambios() {
            const form = document.getElementById('formEditarCombustible');
            const inputs = form.querySelectorAll('input, select');
            
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
            const form = document.getElementById('formEditarCombustible');
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
                calcularPrecioPorLitro();
                mostrarNotificacion('Formulario restaurado a valores originales', 'info');
            }
        }

        function calcularPrecioPorLitro() {
            const litros = parseFloat(document.getElementById('cantidad_litros').value) || 0;
            const costo = parseFloat(document.getElementById('costo').value) || 0;
            const precioPorLitro = litros > 0 ? (costo / litros) : 0;
            
            document.querySelector('#precioPorLitro .calculation-highlight').textContent = 
                `$${precioPorLitro.toFixed(2)}`;
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

        function verViajeAsociado() {
            const viajeId = document.getElementById('viaje_id').value;
            if (viajeId) {
                window.location.href = `/viajes/${viajeId}`;
            } else {
                alert('No hay viaje asociado seleccionado');
            }
        }

        function crearRegistroSimilar() {
            const litros = document.getElementById('cantidad_litros').value;
            const costo = document.getElementById('costo').value;
            const viajeId = document.getElementById('viaje_id').value;
            
            const params = new URLSearchParams({
                cantidad_litros: litros,
                costo: costo,
                viaje_id: viajeId
            });
            
            window.location.href = `/combustibles/create?${params.toString()}`;
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }

        // Validaciones adicionales antes del envío
        document.getElementById('formEditarCombustible').addEventListener('submit', function(e) {
            const viajeId = document.getElementById('viaje_id').value;
            const litros = parseFloat(document.getElementById('cantidad_litros').value);
            const costo = parseFloat(document.getElementById('costo').value);
            const fecha = document.getElementById('fecha').value;
            
            if (!viajeId) {
                e.preventDefault();
                alert('Debe seleccionar un viaje');
                return false;
            }
            
            if (!litros || litros <= 0) {
                e.preventDefault();
                alert('La cantidad de litros debe ser mayor a 0');
                return false;
            }
            
            if (!costo || costo <= 0) {
                e.preventDefault();
                alert('El costo debe ser mayor a 0');
                return false;
            }

            if (!fecha) {
                e.preventDefault();
                alert('Debe seleccionar una fecha');
                return false;
            }

            // Validar precio por litro razonable
            const precioPorLitro = costo / litros;
            if (precioPorLitro > 50) {
                if (!confirm(`El precio por litro es de ${precioPorLitro.toFixed(2)}, lo cual parece elevado. ¿Desea continuar?`)) {
                    return false;
                }
            }

            if (precioPorLitro < 10) {
                if (!confirm(`El precio por litro es de ${precioPorLitro.toFixed(2)}, lo cual parece muy bajo. ¿Desea continuar?`)) {
                    return false;
                }
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

        // Auto-guardar en localStorage para prevenir pérdida de datos
        const form = document.getElementById('formEditarCombustible');
        const inputs = form.querySelectorAll('input, select');
        
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                localStorage.setItem('combustible_edit_' + this.name, this.value);
            });

            // Restaurar datos guardados si existen
            const savedValue = localStorage.getItem('combustible_edit_' + input.name);
            if (savedValue && !input.value) {
                input.value = savedValue;
            }
        });

        // Limpiar localStorage al enviar exitosamente
        form.addEventListener('submit', function() {
            inputs.forEach(input => {
                localStorage.removeItem('combustible_edit_' + input.name);
            });
        });

        // Formatear números automáticamente
        document.getElementById('costo').addEventListener('input', function() {
            let valor = this.value.replace(/[^\d.]/g, ''); // Solo números y punto
            this.value = valor;
        });

        document.getElementById('cantidad_litros').addEventListener('input', function() {
            let valor = this.value.replace(/[^\d.]/g, ''); // Solo números y punto
            this.value = valor;
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