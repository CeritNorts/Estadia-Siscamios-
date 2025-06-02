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

        /* Success Message */
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            border: 1px solid #c3e6cb;
            display: none;
        }

        .success-message.show {
            display: block;
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
                <a href="/camiones" class="active">🚛 Camiones</a>
            </li>
            <li>
                <a href="/viajes">📋 Viajes</a>
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
                    <h1 class="navbar-title">Registro de Camiones</h1>
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
                    <a href="/camiones">Camiones</a>
                    <span class="breadcrumb-separator">›</span>
                    <span>Registro de Unidades</span>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Registro de Camiones</h1>
                        <p class="page-subtitle">Agregar nueva unidad a la flotilla</p>
                    </div>
                    <a href="/camiones" class="btn btn-outline">
                        ← Volver a Lista
                    </a>
                </div>
                
                <!-- Success Message -->
                <div class="success-message" id="successMessage">
                    ✅ Camión registrado exitosamente
                </div>

                <!-- Form Container -->
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Información del Vehículo</h2>
                        <p class="form-description">Complete todos los campos obligatorios (*) para registrar el camión en el sistema</p>
                    </div>
                    
                    <form id="formRegistroCamion">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="placa">Placa del Vehículo <span class="required-indicator">*</span></label>
                                <input type="text" id="placa" name="placa" required placeholder="Ej: ABC-1234">
                            </div>
                            
                            <div class="form-group">
                                <label for="modelo">Modelo <span class="required-indicator">*</span></label>
                                <input type="text" id="modelo" name="modelo" required placeholder="Ej: Freightliner Cascadia">
                            </div>
                            
                            <div class="form-group">
                                <label for="año">Año <span class="required-indicator">*</span></label>
                                <input type="number" id="año" name="año" required min="1990" max="2024" placeholder="2020">
                            </div>
                            
                            <div class="form-group">
                                <label for="marca">Marca <span class="required-indicator">*</span></label>
                                <select id="marca" name="marca" required>
                                    <option value="">Seleccionar marca</option>
                                    <option value="freightliner">Freightliner</option>
                                    <option value="kenworth">Kenworth</option>
                                    <option value="peterbilt">Peterbilt</option>
                                    <option value="volvo">Volvo</option>
                                    <option value="mack">Mack</option>
                                    <option value="international">International</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="capacidadCarga">Capacidad de Carga (Toneladas) <span class="required-indicator">*</span></label>
                                <input type="number" id="capacidadCarga" name="capacidadCarga" required step="0.5" placeholder="25.5">
                            </div>
                            
                            <div class="form-group">
                                <label for="estado">Estado Actual <span class="required-indicator">*</span></label>
                                <select id="estado" name="estado" required>
                                    <option value="">Seleccionar estado</option>
                                    <option value="activo">Activo</option>
                                    <option value="mantenimiento">En Mantenimiento</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="numeroEconomico">Número Económico</label>
                                <input type="text" id="numeroEconomico" name="numeroEconomico" placeholder="ECO-001">
                            </div>
                            
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" id="color" name="color" placeholder="Blanco">
                            </div>
                            
                            <div class="form-group">
                                <label for="numeroSerie">Número de Serie</label>
                                <input type="text" id="numeroSerie" name="numeroSerie" placeholder="1FUJGLDR50LM12345">
                            </div>
                            
                            <div class="form-group">
                                <label for="tipoCombustible">Tipo de Combustible</label>
                                <select id="tipoCombustible" name="tipoCombustible">
                                    <option value="">Seleccionar combustible</option>
                                    <option value="diesel">Diésel</option>
                                    <option value="gasolina">Gasolina</option>
                                    <option value="gas">Gas Natural</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="kilometraje">Kilometraje Actual</label>
                                <input type="number" id="kilometraje" name="kilometraje" placeholder="150000">
                            </div>
                            
                            <div class="form-group">
                                <label for="fechaCompra">Fecha de Compra</label>
                                <input type="date" id="fechaCompra" name="fechaCompra">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" placeholder="Notas adicionales sobre el vehículo..."></textarea>
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

            // Form submission
            document.getElementById('formRegistroCamion').addEventListener('submit', function(e) {
                e.preventDefault();
                guardarCamion();
            });
        }

        function guardarCamion() {
            const formData = new FormData(document.getElementById('formRegistroCamion'));
            
            // Validar campos obligatorios
            const camposObligatorios = ['placa', 'modelo', 'año', 'marca', 'capacidadCarga', 'estado'];
            let formularioValido = true;
            
            camposObligatorios.forEach(campo => {
                const valor = formData.get(campo);
                if (!valor || valor.trim() === '') {
                    formularioValido = false;
                    document.getElementById(campo).style.borderColor = '#dc3545';
                } else {
                    document.getElementById(campo).style.borderColor = '#ddd';
                }
            });

            if (!formularioValido) {
                mostrarNotificacion('Por favor complete todos los campos obligatorios', 'error');
                return;
            }

            // Simular guardado
            const nuevoCamion = {
                placa: formData.get('placa'),
                modelo: formData.get('modelo'),
                año: parseInt(formData.get('año')),
                marca: formData.get('marca'),
                capacidadCarga: parseFloat(formData.get('capacidadCarga')),
                estado: formData.get('estado'),
                numeroEconomico: formData.get('numeroEconomico') || generarNumeroEconomico(),
                color: formData.get('color') || 'No especificado',
                numeroSerie: formData.get('numeroSerie') || '',
                tipoCombustible: formData.get('tipoCombustible') || 'diesel',
                kilometraje: parseInt(formData.get('kilometraje')) || 0,
                fechaCompra: formData.get('fechaCompra') || '',
                observaciones: formData.get('observaciones') || ''
            };

            console.log('Camión a guardar:', nuevoCamion);

            // Mostrar mensaje de éxito
            document.getElementById('successMessage').classList.add('show');
            
            // Simular redirección después de guardar
            setTimeout(() => {
                if (confirm('Camión registrado exitosamente. ¿Desea agregar otro camión?')) {
                    limpiarFormulario();
                    document.getElementById('successMessage').classList.remove('show');
                } else {
                    // En la aplicación real: window.location.href = '/camiones';
                    mostrarNotificacion('Redirigiendo a la lista de camiones...', 'success');
                }
            }, 1000);
        }

        function limpiarFormulario() {
            document.getElementById('formRegistroCamion').reset();
            document.getElementById('successMessage').classList.remove('show');
            
            // Resetear colores de bordes
            document.querySelectorAll('input, select, textarea').forEach(field => {
                field.style.borderColor = '#ddd';
            });
        }

        function generarNumeroEconomico() {
            const numero = Math.floor(Math.random() * 999) + 1;
            return `ECO-${String(numero).padStart(3, '0')}`;
        }

        function mostrarNotificacion(mensaje, tipo) {
            // Crear elemento de notificación
            const notificacion = document.createElement('div');
            notificacion.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 1rem 1.5rem;
                background: ${tipo === 'success' ? '#28a745' : '#dc3545'};
                color: white;
                border-radius: 5px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                z-index: 9999;
                font-weight: 500;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notificacion.textContent = mensaje;
            
            document.body.appendChild(notificacion);
            
            // Animar entrada
            setTimeout(() => {
                notificacion.style.transform = 'translateX(0)';
            }, 100);
            
            // Remover después de 3 segundos
            setTimeout(() => {
                notificacion.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (document.body.contains(notificacion)) {
                        document.body.removeChild(notificacion);
                    }
                }, 300);
            }, 3000);
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                mostrarNotificacion('Cerrando sesión...', 'success');
                setTimeout(() => {
                    // Aquí iría la lógica de logout real
                    window.location.href = '/login';
                }, 1000);
            }
        }
    </script>
</body>
</html>