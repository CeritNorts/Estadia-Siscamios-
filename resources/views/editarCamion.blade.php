<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Camión - Siscamino</title>
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

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: #666;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Form Styles */
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .form-header h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            opacity: 0.9;
        }

        .form-body {
            padding: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group .required {
            color: #dc3545;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-weight: 500;
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
            background: #f8f9fa;
            color: #333;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #e9ecef;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e9ecef;
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

        /* Current Info Card */
        .current-info {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .current-info h4 {
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 0.875rem;
            color: #666;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 500;
            color: #333;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-activo {
            background: #d4edda;
            color: #155724;
        }

        .status-mantenimiento {
            background: #f8d7da;
            color: #721c24;
        }

        .status-inactivo {
            background: #f8f9fa;
            color: #6c757d;
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

            .form-actions {
                flex-direction: column;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
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
                <a href="#" class="active">🚛 Camiones</a>
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
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">Admin User</div>
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
                    <h1 class="navbar-title">Editar Camión</h1>
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
                    <a href="/dashboard">🏠 Inicio</a>
                    <span>›</span>
                    <a href="/camiones">🚛 Camiones</a>
                    <span>›</span>
                    <span>✏️ Editar</span>
                </div>

                <!-- Success/Error Messages -->
                <div id="alertContainer"></div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Editar Camión</h1>
                        <p class="page-subtitle">Modifica la información del vehículo seleccionado</p>
                    </div>
                </div>

                <!-- Current Info -->
                <div class="current-info">
                    <h4>📋 Información Actual del Camión</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Placa</span>
                            <span class="info-value" id="currentPlaca">ABC-123</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Modelo</span>
                            <span class="info-value" id="currentModelo">FH 440</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Año</span>
                            <span class="info-value" id="currentAnio">2020</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Estado</span>
                            <span class="status-badge status-activo" id="currentEstado">Activo</span>
                        </div>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2>✏️ Formulario de Edición</h2>
                        <p>Actualiza los datos del camión según sea necesario</p>
                    </div>

                    <div class="form-body">
                        <form id="editTruckForm" method="POST" action="{{ route('camiones.update', $camion->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-grid">
                                <!-- Información Básica -->
                                <div>
                                    <h3 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #667eea; padding-bottom: 0.5rem;">
                                        🚛 Información Básica
                                    </h3>

                                    <div class="form-group">
                                        <label for="placa">Placa del Vehículo <span class="required">*</span></label>
                                        <input type="text" 
                                               id="placa" 
                                               name="placa" 
                                               class="form-control" 
                                               value="ABC-123"
                                               placeholder="Ej: ABC-123" 
                                               required>
                                        <div class="error-message" id="placa-error"></div>
                                    </div>



                                    <div class="form-group">
                                        <label for="modelo">Modelo <span class="required">*</span></label>
                                        <input type="text" 
                                               id="modelo" 
                                               name="modelo" 
                                               class="form-control" 
                                               value="FH 440"
                                               placeholder="Ej: FH 440, Actros 2642" 
                                               required>
                                        <div class="error-message" id="modelo-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="anio">Año <span class="required">*</span></label>
                                        <input type="number" 
                                               id="anio" 
                                               name="anio" 
                                               class="form-control" 
                                               value="2020"
                                               min="1990" 
                                               max="2025" 
                                               required>
                                        <div class="error-message" id="anio-error"></div>
                                    </div>
                                </div>

                                <!-- Especificaciones Técnicas -->
                                <div>
                                    <h3 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #667eea; padding-bottom: 0.5rem;">
                                        ⚙️ Especificaciones Técnicas
                                    </h3>

                                    <div class="form-group">
                                        <label for="capacidad_carga">Capacidad de Carga (Toneladas) <span class="required">*</span></label>
                                        <input type="number" 
                                               id="capacidad_carga" 
                                               name="capacidad_carga" 
                                               class="form-control" 
                                               value="25"
                                               min="1" 
                                               max="100" 
                                               step="0.5" 
                                               required>
                                        <div class="error-message" id="capacidad_carga-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">Estado del Vehículo <span class="required">*</span></label>
                                        <select id="estado" name="estado" class="form-control" required>
                                            <option value="activo" selected>🟢 Activo</option>
                                            <option value="mantenimiento">🔴 En Mantenimiento</option>
                                            <option value="inactivo">⚪ Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Observaciones -->
                            <div class="form-group" style="margin-top: 2rem;">
                                <label for="observaciones">Observaciones Adicionales</label>
                                <textarea id="observaciones" 
                                          name="observaciones" 
                                          class="form-control" 
                                          rows="4" 
                                          placeholder="Ingrese cualquier observación adicional sobre el camión...">Camión en excelente estado, mantenimiento al día.</textarea>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="/camiones" class="btn btn-secondary">
                                    ↩️ Cancelar
                                </a>
                                <button type="button" onclick="resetForm()" class="btn btn-secondary">
                                    🔄 Restablecer
                                </button>
                                <button type="submit" class="btn btn-success">
                                    💾 Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inicialización
        document.addEventListener('DOMContentLoaded', function () {
            setupEventListeners();
            loadTruckData();
        });

        function setupEventListeners() {
            // Sidebar toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', function () {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Form submission
            document.getElementById('editTruckForm').addEventListener('submit', function (e) {
                e.preventDefault();
                handleFormSubmit();
            });

            // Real-time validation
            const formInputs = document.querySelectorAll('.form-control');
            formInputs.forEach(input => {
                input.addEventListener('blur', function () {
                    validateField(this);
                });
            });
        }

        function loadTruckData() {
            // En una aplicación real, esto vendría del servidor
            // Aquí simulamos la carga de datos
            const truckData = {
                placa: 'ABC-123',
                modelo: 'FH 440',
                anio: 2020,
                capacidad_carga: 25,
                estado: 'activo',
                observaciones: 'Camión en excelente estado, mantenimiento al día.'
            };

            // Actualizar información actual
            document.getElementById('currentPlaca').textContent = truckData.placa;
            document.getElementById('currentModelo').textContent = truckData.modelo;
            document.getElementById('currentAnio').textContent = truckData.anio;
            
            const estadoBadge = document.getElementById('currentEstado');
            estadoBadge.textContent = truckData.estado.charAt(0).toUpperCase() + truckData.estado.slice(1);
            estadoBadge.className = `status-badge status-${truckData.estado}`;

            // Llenar formulario
            Object.keys(truckData).forEach(key => {
                const element = document.getElementById(key);
                if (element) {
                    element.value = truckData[key];
                }
            });
        }

        function validateField(field) {
            const errorElement = document.getElementById(field.name + '-error');
            let isValid = true;
            let errorMessage = '';

            // Limpiar estilos previos
            field.classList.remove('error');
            if (errorElement) {
                errorElement.textContent = '';
            }

            // Validaciones específicas
            switch (field.name) {
                case 'placa':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = 'La placa es obligatoria';
                    } else if (!/^[A-Z]{3}-\d{3}$/.test(field.value.trim())) {
                        isValid = false;
                        errorMessage = 'Formato de placa inválido (Ej: ABC-123)';
                    }
                    break;

                case 'marca':
                case 'modelo':
                    if (!field.value.trim()) {
                        isValid = false;
                        errorMessage = `${field.name.charAt(0).toUpperCase() + field.name.slice(1)} es obligatorio`;
                    }
                    break;

                case 'anio':
                    const year = parseInt(field.value);
                    const currentYear = new Date().getFullYear();
                    if (!year || year < 2000 || year > currentYear) {
                        isValid = false;
                        errorMessage = `Año debe estar entre 2000 y ${currentYear}`;
                    }
                    break;

                case 'capacidad_carga':
                    const capacity = parseFloat(field.value);
                    if (!capacity || capacity <= 0 || capacity > 100) {
                        isValid = false;
                        errorMessage = 'Capacidad debe estar entre 1 y 100 toneladas';
                    }
                    break;
            }

            // Aplicar estilos de error
            if (!isValid) {
                field.classList.add('error');
                if (errorElement) {
                    errorElement.textContent = errorMessage;
                }
            }

            return isValid;
        }

        function validateForm() {
            const formInputs = document.querySelectorAll('.form-control[required]');
            let isFormValid = true;

            formInputs.forEach(input => {
                if (!validateField(input)) {
                    isFormValid = false;
                }
            });

            return isFormValid;
        }

        function handleFormSubmit() {
            if (!validateForm()) {
                showAlert('Por favor corrija los errores en el formulario', 'error');
                return;
            }

            // Mostrar loading
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '⏳ Guardando...';
            submitBtn.disabled = true;

            // Enviar formulario real al servidor
            document.getElementById('editTruckForm').submit();
        }

        function updateCurrentInfo() {
            const formData = new FormData(document.getElementById('editTruckForm'));
            
            document.getElementById('currentPlaca').textContent = formData.get('placa');
            document.getElementById('currentModelo').textContent = `${formData.get('marca')} ${formData.get('modelo')}`;
            document.getElementById('currentAnio').textContent = formData.get('anio');
            
            const estadoBadge = document.getElementById('currentEstado');
            const estado = formData.get('estado');
            estadoBadge.textContent = estado.charAt(0).toUpperCase() + estado.slice(1);
            estadoBadge.className = `status-badge status-${estado}`;