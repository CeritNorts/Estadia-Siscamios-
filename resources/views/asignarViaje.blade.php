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
                <a href="/dashboard">📊 Panel Administrativo</a>
            </li>
            <li>
                <a href="/camiones">🚛 Camiones</a>
            </li>
            <li>
                <a href="/viajes" class="active">📋 Viajes</a>
            </li>
            <li>
                <a href="/mantenimiento">🔧 Mantenimiento</a>
            </li>
            <li>
                <a href="/conductores">👥 Conductores</a>
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
                    <a href="/viajes">Viajes</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Asignar Viaje</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Asignar Nuevo Viaje</h1>
                        <p class="page-subtitle">Complete la información para asignar un viaje a la flotilla</p>
                    </div>
                    <a href="/viajes" class="btn btn-outline">
                        ← Volver a Viajes
                    </a>
                </div>

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Información del Viaje</h2>
                        <p class="form-description">Complete todos los campos obligatorios (*) para asignar el viaje</p>
                    </div>
                    
                    <form id="formAsignarViaje">
                        <!-- Sección 1: Información Básica -->
                        <div class="form-section">
                            <h3 class="section-title">📋 Información Básica del Viaje</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="idCamion">ID del Camión <span class="required-indicator">*</span></label>
                                    <select id="idCamion" name="idCamion" required>
                                        <option value="">Seleccionar camión</option>
                                        <option value="CAM-001">CAM-001 - Freightliner Cascadia</option>
                                        <option value="CAM-002">CAM-002 - Kenworth T680</option>
                                        <option value="CAM-003">CAM-003 - Volvo VNL</option>
                                        <option value="CAM-004">CAM-004 - Peterbilt 579</option>
                                        <option value="CAM-005">CAM-005 - Mack Anthem</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="idChofer">ID del Chofer <span class="required-indicator">*</span></label>
                                    <select id="idChofer" name="idChofer" required>
                                        <option value="">Seleccionar chofer</option>
                                        <option value="CH-001">CH-001 - Juan Pérez</option>
                                        <option value="CH-002">CH-002 - María González</option>
                                        <option value="CH-003">CH-003 - Carlos López</option>
                                        <option value="CH-004">CH-004 - Ana Martínez</option>
                                        <option value="CH-005">CH-005 - Roberto Silva</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="idCliente">ID del Cliente <span class="required-indicator">*</span></label>
                                    <select id="idCliente" name="idCliente" required>
                                        <option value="">Seleccionar cliente</option>
                                        <option value="CL-001">CL-001 - Transportes ABC</option>
                                        <option value="CL-002">CL-002 - Logística XYZ</option>
                                        <option value="CL-003">CL-003 - Carga Segura SA</option>
                                        <option value="CL-004">CL-004 - Express Maya</option>
                                        <option value="CL-005">CL-005 - Distribuidora Nacional</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="estado">Estado del Viaje <span class="required-indicator">*</span></label>
                                    <select id="estado" name="estado" required>
                                        <option value="">Seleccionar estado</option>
                                        <option value="programado">Programado</option>
                                        <option value="transito">En Tránsito</option>
                                        <option value="espera">En Espera</option>
                                        <option value="entregado">Entregado</option>
                                        <option value="retrasado">Retrasado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Ruta y Fechas -->
                        <div class="form-section">
                            <h3 class="section-title">📍 Ruta y Programación</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="origen">Origen <span class="required-indicator">*</span></label>
                                    <input type="text" id="origen" name="origen" required placeholder="Ej: Córdoba, Veracruz">
                                </div>
                                
                                <div class="form-group">
                                    <label for="destino">Destino <span class="required-indicator">*</span></label>
                                    <input type="text" id="destino" name="destino" required placeholder="Ej: México, DF">
                                </div>
                                
                                <div class="form-group">
                                    <label for="fechaSalida">Fecha de Salida <span class="required-indicator">*</span></label>
                                    <input type="datetime-local" id="fechaSalida" name="fechaSalida" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="fechaLlegada">Fecha de Llegada <span class="required-indicator">*</span></label>
                                    <input type="datetime-local" id="fechaLlegada" name="fechaLlegada" required>
                                </div>
                            </div>
                        </div>

                        <!-- Observaciones -->
                        <div class="form-group">
                            <label for="observaciones">Observaciones del Viaje</label>
                            <textarea id="observaciones" name="observaciones" placeholder="Instrucciones especiales, notas de entrega, etc..."></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary">🗑️ Limpiar</button>
                            <button type="submit" class="btn btn-primary">📋 Asignar Viaje</button>
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
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                alert('Cerrando sesión...');
            }
        }
    </script>
</body>
</html>