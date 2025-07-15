<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siscamino - Editar Cliente</title>
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

        /* Cliente Info Header */
        .cliente-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cliente-details h3 {
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .cliente-meta {
            display: flex;
            gap: 2rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .cliente-id {
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

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
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
        .form-group textarea:focus {
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

        /* Character counter */
        .char-counter {
            font-size: 0.8rem;
            color: #666;
            text-align: right;
            margin-top: 0.25rem;
        }

        .char-counter.warning {
            color: #dc3545;
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

            .cliente-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .cliente-meta {
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
                <a href="/clientes" class="active">👤 Clientes</a>
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
                    <h1 class="navbar-title">Editar Cliente</h1>
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
                    <a href="{{ route('clientes.index') }}">Clientes</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Editar Cliente</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Editar Cliente</h1>
                        <p class="page-subtitle">Modifica la información del cliente registrado</p>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-secondary">
                            👁️ Ver Detalles
                        </a>
                        <a href="{{ route('clientes.index') }}" class="btn btn-outline">
                            ← Volver a Lista
                        </a>
                    </div>
                </div>

                <!-- Información del Cliente -->
                <div class="cliente-info">
                    <div class="cliente-details">
                        <h3>{{ $cliente->nombre }}</h3>
                        <div class="cliente-meta">
                            <span>📞 {{ $cliente->contacto }}</span>
                            <span>📅 Registrado: {{ $cliente->created_at->format('d/m/Y') }}</span>
                            @if($cliente->updated_at != $cliente->created_at)
                                <span>🔄 Actualizado: {{ $cliente->updated_at->format('d/m/Y') }}</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <span class="cliente-id">
                            👤 Cliente #{{ str_pad($cliente->id, 3, '0', STR_PAD_LEFT) }}
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
                        <h2 class="form-title">Modificar Información del Cliente</h2>
                        <p class="form-description">Actualiza los campos necesarios para el cliente</p>
                    </div>
                    
                    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" id="formEditarCliente">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nombre">Nombre/Razón Social <span class="required-indicator">*</span></label>
                                <input 
                                    type="text" 
                                    id="nombre" 
                                    name="nombre" 
                                    value="{{ old('nombre', $cliente->nombre) }}"
                                    required 
                                    placeholder="Ej: Juan Pérez García / Empresa S.A. de C.V."
                                    class="@error('nombre') border-danger @enderror"
                                >
                                @error('nombre')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="contacto">Información de Contacto <span class="required-indicator">*</span></label>
                                <input 
                                    type="text" 
                                    id="contacto" 
                                    name="contacto" 
                                    value="{{ old('contacto', $cliente->contacto) }}"
                                    required 
                                    placeholder="Ej: +52 271 123 4567 / contacto@empresa.com"
                                    class="@error('contacto') border-danger @enderror"
                                >
                                @error('contacto')
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
                                    class="@error('contrato') border-danger @enderror"
                                >{{ old('contrato', $cliente->contrato) }}</textarea>
                                @error('contrato')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <div class="char-counter" id="contrato-counter">
                                    {{ strlen($cliente->contrato ?? '') }} / 1000 caracteres
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">❌ Cancelar</a>
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
            nombre: '{{ $cliente->nombre }}',
            contacto: '{{ $cliente->contacto }}',
            contrato: `{{ $cliente->contrato }}`
        };

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            monitorearCambios();
            actualizarContadorCaracteres();
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

            // Contador de caracteres para el textarea
            const contratoTextarea = document.getElementById('contrato');
            contratoTextarea.addEventListener('input', function() {
                actualizarContadorCaracteres();
            });
        }

        function monitorearCambios() {
            const form = document.getElementById('formEditarCliente');
            const inputs = form.querySelectorAll('input, textarea');
            
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
            const form = document.getElementById('formEditarCliente');
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
                actualizarContadorCaracteres();
                mostrarNotificacion('Formulario restaurado a valores originales', 'info');
            }
        }

        function actualizarContadorCaracteres() {
            const contratoTextarea = document.getElementById('contrato');
            const counter = document.getElementById('contrato-counter');
            const maxLength = 1000;
            const currentLength = contratoTextarea.value.length;
            
            counter.textContent = `${currentLength} / ${maxLength} caracteres`;
            
            if (currentLength > maxLength * 0.9) {
                counter.classList.add('warning');
            } else {
                counter.classList.remove('warning');
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

        function crearViaje() {
            // Redirigir al formulario de crear viaje con el cliente preseleccionado
            window.location.href = `/viajes/create?cliente_id={{ $cliente->id }}`;
        }

        function verHistorialViajes() {
            // Redirigir a la lista de viajes filtrada por cliente
            window.location.href = `/viajes?cliente={{ $cliente->id }}`;
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }

        // Validaciones adicionales antes del envío
        document.getElementById('formEditarCliente').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value.trim();
            const contacto = document.getElementById('contacto').value.trim();
            const contrato = document.getElementById('contrato').value.trim();
            
            if (!nombre) {
                e.preventDefault();
                alert('El nombre es obligatorio');
                return false;
            }
            
            if (!contacto) {
                e.preventDefault();
                alert('La información de contacto es obligatoria');
                return false;
            }
            
            if (!contrato) {
                e.preventDefault();
                alert('La información del contrato es obligatoria');
                return false;
            }

            if (contrato.length > 1000) {
                e.preventDefault();
                alert('La información del contrato no puede exceder 1000 caracteres');
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

        // Auto-guardar en localStorage para prevenir pérdida de datos
        const form = document.getElementById('formEditarCliente');
        const inputs = form.querySelectorAll('input, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                localStorage.setItem('cliente_edit_' + this.name, this.value);
            });

            // Restaurar datos guardados si existen
            const savedValue = localStorage.getItem('cliente_edit_' + input.name);
            if (savedValue && !input.value) {
                input.value = savedValue;
            }
        });

        // Limpiar localStorage al enviar exitosamente
        form.addEventListener('submit', function() {
            inputs.forEach(input => {
                localStorage.removeItem('cliente_edit_' + input.name);
            });
        });

        // Formatear contacto automáticamente si parece un teléfono
        document.getElementById('contacto').addEventListener('input', function() {
            let valor = this.value;
            
            // Solo formatear si parece un número de teléfono (contiene solo números, espacios, + y -)
            if (/^[\d\s\+\-\(\)]+$/.test(valor)) {
                valor = valor.replace(/\D/g, ''); // Solo números
                
                // Formatear como +52 XXX XXX XXXX si es un teléfono mexicano
                if (valor.length >= 10) {
                    if (valor.startsWith('52')) {
                        valor = '+52 ' + valor.substring(2, 5) + ' ' + valor.substring(5, 8) + ' ' + valor.substring(8, 12);
                    } else {
                        valor = '+52 ' + valor.substring(0, 3) + ' ' + valor.substring(3, 6) + ' ' + valor.substring(6, 10);
                    }
                    this.value = valor;
                }
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