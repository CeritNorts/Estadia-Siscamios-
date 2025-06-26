<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Siscamino</title>
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
            padding: 0.75rem;
            border-radius: 8px;
            transition: background 0.3s ease;
            text-decoration: none;
            color: inherit;
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

        /* Profile Header */
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            color: white;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: bold;
            border: 4px solid rgba(255, 255, 255, 0.3);
        }

        .profile-info h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .profile-info p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .profile-stats {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Content Grid */
        .profile-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card h3 {
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            border-bottom: 2px solid #667eea;
            padding-bottom: 0.5rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control:disabled {
            background: #f8f9fa;
            color: #6c757d;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Activity Feed */
        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: background 0.3s ease;
        }

        .activity-item:hover {
            background: #f8f9fa;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .activity-icon.login {
            background: #e3f2fd;
            color: #1976d2;
        }

        .activity-icon.action {
            background: #e8f5e8;
            color: #4caf50;
        }

        .activity-icon.system {
            background: #fff3e0;
            color: #ff9800;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .activity-description {
            color: #666;
            font-size: 0.9rem;
        }

        .activity-time {
            color: #999;
            font-size: 0.875rem;
            margin-left: auto;
        }

        /* Quick Stats */
        .quick-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .stat-card {
            text-align: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .stat-card .label {
            color: #666;
            font-size: 0.9rem;
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

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-color: #bee5eb;
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

            .profile-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .profile-stats {
                justify-content: center;
            }

            .profile-grid {
                grid-template-columns: 1fr;
            }

            .quick-stats {
                grid-template-columns: 1fr;
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
                <a href="{{ route('combustible') }}" class="active">⛽ Combustible</a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <a href="/profile" class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="color: #ffffff; font-weight: 500;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.75rem;">Sistema</div>
                </div>
            </a>
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
                    <h1 class="navbar-title">Mi Perfil</h1>
                </div>
                <div class="navbar-links">
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
                    <span>👤 Mi Perfil</span>
                </div>

                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="profile-avatar" id="profileAvatar">AD</div>
                    <div class="profile-info">
                        <h1 id="profileName">Admin User</h1>
                        <p id="profileEmail">admin@siscamino.com</p>
                        <p id="profileRole">Administrador del Sistema</p>
                        <div class="profile-stats">
                            <div class="stat-item">
                                <span class="stat-number">15</span>
                                <span class="stat-label">Días activo</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">42</span>
                                <span class="stat-label">Acciones realizadas</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">8</span>
                                <span class="stat-label">Horas promedio</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Success/Error Messages -->
                <div id="alertContainer"></div>

                <!-- Profile Grid -->
                <div class="profile-grid">
                    <!-- Left Column: Personal Information -->
                    <div>
                        <!-- Personal Info Card -->
                        <div class="card">
                            <h3>👤 Información Personal</h3>
                            <form id="personalInfoForm">
                                <div class="form-group">
                                    <label for="name">Nombre Completo</label>
                                    <input type="text" id="name" name="name" class="form-control" value="Admin User">
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" id="email" name="email" class="form-control" value="admin@siscamino.com">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Teléfono</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" value="+52 55 1234 5678">
                                </div>
                                <div class="form-group">
                                    <label for="position">Cargo/Posición</label>
                                    <input type="text" id="position" name="position" class="form-control" value="Administrador del Sistema">
                                </div>
                                <div style="display: flex; gap: 1rem;">
                                    <button type="submit" class="btn btn-primary">
                                        💾 Guardar Cambios
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="resetPersonalForm()">
                                        🔄 Restablecer
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Security Settings -->
                        <div class="card">
                            <h3>🔒 Configuración de Seguridad</h3>
                            <form id="securityForm">
                                <div class="form-group">
                                    <label for="currentPassword">Contraseña Actual</label>
                                    <input type="password" id="currentPassword" name="current_password" class="form-control" placeholder="Ingrese su contraseña actual">
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">Nueva Contraseña</label>
                                    <input type="password" id="newPassword" name="new_password" class="form-control" placeholder="Ingrese nueva contraseña">
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirmar Nueva Contraseña</label>
                                    <input type="password" id="confirmPassword" name="confirm_password" class="form-control" placeholder="Confirme la nueva contraseña">
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    🔐 Cambiar Contraseña
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Right Column: Activity & Stats -->
                    <div>
                        <!-- Quick Stats -->
                        <div class="card">
                            <h3>📊 Estadísticas Rápidas</h3>
                            <div class="quick-stats">
                                <div class="stat-card">
                                    <div class="number">124</div>
                                    <div class="label">Camiones Gestionados</div>
                                </div>
                                <div class="stat-card">
                                    <div class="number">89</div>
                                    <div class="label">Viajes Supervisados</div>
                                </div>
                                <div class="stat-card">
                                    <div class="number">15</div>
                                    <div class="label">Mantenimientos</div>
                                </div>
                                <div class="stat-card">
                                    <div class="number">32</div>
                                    <div class="label">Conductores Activos</div>
                                </div>
                            </div>
                        </div>

                        <!-- Account Settings -->
                        <div class="card">
                            <h3>⚙️ Configuración de Cuenta</h3>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; border: 1px solid #e9ecef; border-radius: 8px;">
                                    <div>
                                        <strong>Notificaciones por Email</strong>
                                        <p style="font-size: 0.9rem; color: #666; margin: 0;">Recibir alertas importantes</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; border: 1px solid #e9ecef; border-radius: 8px;">
                                    <div>
                                        <strong>Notificaciones Push</strong>
                                        <p style="font-size: 0.9rem; color: #666; margin: 0;">Alertas en tiempo real</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <button class="btn btn-secondary">
                                    🔔 Configurar Notificaciones
                                </button>
                                <button class="btn btn-secondary">
                                    📱 Vincular Dispositivos
                                </button>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="card">
                            <h3>📈 Actividad Reciente</h3>
                            <div id="recentActivity">
                                <div class="activity-item">
                                    <div class="activity-icon login">🔐</div>
                                    <div class="activity-content">
                                        <div class="activity-title">Inicio de sesión</div>
                                        <div class="activity-description">Acceso desde IP: 192.168.1.100</div>
                                    </div>
                                    <div class="activity-time">Hace 2 horas</div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon action">✏️</div>
                                    <div class="activity-content">
                                        <div class="activity-title">Camión editado</div>
                                        <div class="activity-description">Actualizó información del camión ABC-123</div>
                                    </div>
                                    <div class="activity-time">Ayer</div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon system">⚙️</div>
                                    <div class="activity-content">
                                        <div class="activity-title">Configuración actualizada</div>
                                        <div class="activity-description">Cambió configuración de notificaciones</div>
                                    </div>
                                    <div class="activity-time">Hace 3 días</div>
                                </div>
                            </div>
                            <div style="text-align: center; margin-top: 1rem;">
                                <a href="#" class="btn btn-secondary btn-sm">Ver Historial Completo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Toggle Switch Styles */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #667eea;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }
    </style>

    <script>
        // Inicialización
        document.addEventListener('DOMContentLoaded', function () {
            setupEventListeners();
            loadUserData();
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

            // Form submissions
            document.getElementById('personalInfoForm').addEventListener('submit', function (e) {
                e.preventDefault();
                savePersonalInfo();
            });

            document.getElementById('securityForm').addEventListener('submit', function (e) {
                e.preventDefault();
                changePassword();
            });
        }

        function loadUserData() {
            // En una aplicación real, esto vendría del servidor
            const userData = {
                name: 'Admin User',
                email: 'admin@siscamino.com',
                phone: '+52 55 1234 5678',
                position: 'Administrador del Sistema'
            };

            // Actualizar elementos de la página
            document.getElementById('profileName').textContent = userData.name;
            document.getElementById('profileEmail').textContent = userData.email;
            document.getElementById('profileRole').textContent = userData.position;
            
            // Generar iniciales para el avatar
            const initials = userData.name.split(' ').map(word => word[0]).join('').substring(0, 2);
            document.getElementById('profileAvatar').textContent = initials;

            // Llenar formulario
            document.getElementById('name').value = userData.name;
            document.getElementById('email').value = userData.email;
            document.getElementById('phone').value = userData.phone;
            document.getElementById('position').value = userData.position;
        }

        function savePersonalInfo() {
            // Mostrar loading
            const submitBtn = document.querySelector('#personalInfoForm button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '⏳ Guardando...';
            submitBtn.disabled = true;

            // Simular guardado
            setTimeout(() => {
                showAlert('✅ Información personal actualizada correctamente', 'success');
                
                // Actualizar datos en la cabecera
                const name = document.getElementById('name').value;
                document.getElementById('profileName').textContent = name;
                
                // Restaurar botón
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 1500);
        }

        function changePassword() {
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Validaciones básicas
            if (!currentPassword || !newPassword || !confirmPassword) {
                showAlert('❌ Todos los campos de contraseña son obligatorios', 'error');
                return;
            }

            if (newPassword !== confirmPassword) {
                showAlert('❌ Las contraseñas nuevas no coinciden', 'error');
                return;
            }

            if (newPassword.length < 6) {
                showAlert('❌ La nueva contraseña debe tener al menos 6 caracteres', 'error');
                return;
            }

            // Mostrar loading
            const submitBtn = document.querySelector('#securityForm button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '⏳ Cambiando...';
            submitBtn.disabled = true;

            // Simular cambio de contraseña
            setTimeout(() => {
                showAlert('✅ Contraseña cambiada exitosamente', 'success');
                
                // Limpiar formulario
                document.getElementById('securityForm').reset();
                
                // Restaurar botón
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        }

        function resetPersonalForm() {
            if (confirm('¿Está seguro de que desea restablecer los cambios?')) {
                loadUserData();
                showAlert('📝 Formulario restablecido', 'info');
            }
        }

        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            let alertClass = 'alert-info';
            
            if (type === 'success') alertClass = 'alert-success';
            if (type === 'error') alertClass = 'alert-danger';
            
            const alertHTML = `
                <div class="alert ${alertClass}" style="animation: slideDown 0.3s ease-out;">
                    ${message}
                </div>
            `;
            
            alertContainer.innerHTML = alertHTML;
            
            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) {
                    alert.style.animation = 'slideUp 0.3s ease-out';
                    setTimeout(() => {
                        alertContainer.innerHTML = '';
                    }, 300);
                }
            }, 5000);
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }

        // Animaciones adicionales
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slideUp {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateY(-20px);
                }
            }

            .alert-danger {
                background: #f8d7da;
                color: #721c24;
                border-color: #f5c6cb;
            }

            /* Hover effects mejorados */
            .card:hover {
                box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
            }

            .stat-card:hover {
                transform: translateY(-2px);
                transition: transform 0.3s ease;
            }

            /* Mejoras visuales en los formularios */
            .form-control:hover {
                border-color: #bbb;
            }

            .btn:disabled {
                opacity: 0.6;
                cursor: not-allowed;
                transform: none !important;
            }

            /* Mejoras en el header del perfil */
            .profile-header:hover {
                transform: translateY(-2px);
                transition: transform 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>