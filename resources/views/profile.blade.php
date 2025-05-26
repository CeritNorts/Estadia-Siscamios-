<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #081028;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .profile-header {
            background-color: #0B1739;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 2rem;
            text-align: center;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 3rem;
            color: white;
            font-weight: bold;
        }

        .profile-name {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .profile-email {
            color: #94a3b8;
            font-size: 1.1rem;
        }

        .profile-sections {
            display: grid;
            gap: 2rem;
            grid-template-columns: 1fr;
        }

        .profile-section {
            background-color: #0B1739;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section-title {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #e2e8f0;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-secondary {
            background-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-1px);
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #94a3b8;
            font-weight: 500;
        }

        .info-value {
            color: #ffffff;
            font-weight: 600;
        }

        .navbar {
            background-color: #0B1739;
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-content {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
        }

        .navbar-brand {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 600;
            text-decoration: none;
        }

        .navbar-links {
            display: flex;
            gap: 1rem;
        }

        .navbar-links a {
            color: #94a3b8;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .navbar-links a:hover,
        .navbar-links a.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .success-message {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
            padding: 0.75rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .error-message {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 0.75rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .profile-container {
                padding: 0 0.5rem;
            }
            
            .profile-header,
            .profile-section {
                padding: 1.5rem;
            }
            
            .navbar-content {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
                            <a href="#" class="navbar-brand">Mi App</a>
            <div class="navbar-links">
                <a href="#">Dashboard</a>
                <a href="{{ route('profile') }}" class="active">Perfil</a>
                <a href="{{ route('login') }}">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        <!-- Header del Perfil -->
        <div class="profile-header">
            <div class="profile-avatar">
                {{ substr('Juan Pérez', 0, 1) }}
            </div>
            <h1 class="profile-name">Juan Pérez</h1>
            <p class="profile-email">juan.perez@ejemplo.com</p>
        </div>

        <div class="profile-sections">
            <!-- Información Personal -->
            <div class="profile-section">
                <h2 class="section-title">Información Personal</h2>
                
                @if (session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="error-message">
                        <ul style="list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="#" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-input" 
                            value="Juan Pérez"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input" 
                            value="juan.perez@ejemplo.com"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            class="form-input" 
                            placeholder="+1 234 567 8900"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Actualizar Información
                    </button>
                </form>
            </div>

            <!-- Cambiar Contraseña -->
            <div class="profile-section">
                <h2 class="section-title">Cambiar Contraseña</h2>
                
                <form action="#" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input 
                            type="password" 
                            id="current_password" 
                            name="current_password" 
                            class="form-input" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="new_password" class="form-label">Nueva Contraseña</label>
                        <input 
                            type="password" 
                            id="new_password" 
                            name="new_password" 
                            class="form-input" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                        <input 
                            type="password" 
                            id="new_password_confirmation" 
                            name="new_password_confirmation" 
                            class="form-input" 
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Cambiar Contraseña
                    </button>
                </form>
            </div>

            <!-- Información de la Cuenta -->
            <div class="profile-section">
                <h2 class="section-title">Información de la Cuenta</h2>
                
                <div class="info-item">
                    <span class="info-label">Fecha de registro:</span>
                    <span class="info-value">15 de Enero, 2024</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Última conexión:</span>
                    <span class="info-value">Hace 2 horas</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Estado de la cuenta:</span>
                    <span class="info-value" style="color: #10b981;">Activa</span>
                </div>
            </div>

            <!-- Acciones de la Cuenta -->
            <div class="profile-section">
                <h2 class="section-title">Acciones de la Cuenta</h2>
                
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <button type="button" class="btn btn-secondary">
                        Descargar Datos
                    </button>
                    
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                        Eliminar Cuenta
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.')) {
                // Aquí iría la lógica para eliminar la cuenta
                alert('Funcionalidad de eliminación pendiente de implementar');
            }
        }
    </script>
</body>
</html>