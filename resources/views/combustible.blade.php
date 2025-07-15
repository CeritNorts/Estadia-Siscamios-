<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Combustible - Siscamino</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            max-width: 1400px;
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

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fuel-title {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .fuel-icon {
            font-size: 3rem;
        }

        .fuel-info h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .fuel-info p {
            color: #666;
            font-size: 1.1rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Metrics Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .metric-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-2px);
        }

        .metric-card .metric-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .metric-card .metric-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.25rem;
        }

        .metric-card .metric-label {
            font-size: 0.875rem;
            color: #666;
        }

        .metric-card .metric-trend {
            font-size: 0.8rem;
            margin-top: 0.5rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
        }

        .trend-up {
            background: #d4edda;
            color: #155724;
        }

        .trend-down {
            background: #f8d7da;
            color: #721c24;
        }

        /* Main Content Grid */
        .fuel-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
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

        /* Filters */
        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-size: 0.875rem;
            color: #666;
            font-weight: 500;
        }

        .filter-group select,
        .filter-group input {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
        }

        .fuel-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .fuel-table th,
        .fuel-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .fuel-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .fuel-table tr:hover {
            background: #f8f9fa;
        }

        /* Status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-completo {
            background: #d4edda;
            color: #155724;
        }

        .status-pendiente {
            background: #fff3cd;
            color: #856404;
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-size: 0.875rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
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

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Chart Container */
        .chart-container {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 8px;
            margin-top: 1rem;
            flex-direction: column;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1rem;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 5px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
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

            .fuel-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .action-buttons {
                justify-content: center;
            }

            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filters {
                flex-direction: column;
            }

            .form-grid {
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
                    <div style="color: #ffffff; font-weight: 500;">Administrador</div>
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
                    <h1 class="navbar-title">Gestión de Combustible</h1>
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
                    <span>⛽ Combustible</span>
                </div>

                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
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

                <!-- Page Header -->
                <div class="page-header">
                    <div class="fuel-title">
                        <div class="fuel-icon">⛽</div>
                        <div class="fuel-info">
                            <h1>Gestión de Combustible</h1>
                            <p>Control y seguimiento del consumo de combustible por viaje</p>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-primary" onclick="openFuelModal()">
                            ➕ Registrar Carga
                        </button>
                        <a href="{{ route('combustibles.export') }}" class="btn btn-secondary">
                            📊 Exportar Reporte
                        </a>
                    </div>
                </div>

                <!-- Metrics Grid -->
                <div class="metrics-grid">
                    <div class="metric-card">
                        <div class="metric-icon">⛽</div>
                        <div class="metric-value">{{ number_format($totalLitrosMes ?? 0) }}</div>
                        <div class="metric-label">Litros Este Mes</div>
                        <div class="metric-trend trend-up">+5.2% vs mes anterior</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-icon">💰</div>
                        <div class="metric-value">${{ number_format($costoTotalMes ?? 0) }}</div>
                        <div class="metric-label">Costo Total Mes</div>
                        <div class="metric-trend trend-up">+8.1% vs mes anterior</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-icon">📊</div>
                        <div class="metric-value">{{ $eficienciaPromedio ?? '0.0' }}</div>
                        <div class="metric-label">Promedio Litros/Viaje</div>
                        <div class="metric-trend trend-down">-0.3% vs mes anterior</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-icon">🚛</div>
                        <div class="metric-value">{{ $viajes->count() ?? 0 }}</div>
                        <div class="metric-label">Viajes Registrados</div>
                        <div class="metric-trend trend-up">+2 viajes</div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="fuel-grid">
                    <!-- Left Column: Fuel Records -->
                    <div>
                        <!-- Filters -->
                        <div class="card">
                            <h3>🔍 Filtros</h3>
                            <form method="GET" action="{{ route('combustibles.index') }}">
                                <div class="filters">
                                    <div class="filter-group">
                                        <label>Viaje</label>
                                        <select name="viaje_id" id="filterViaje">
                                            <option value="">Todos los viajes</option>
                                            @foreach($viajes ?? [] as $viaje)
                                                <option value="{{ $viaje->id }}" {{ request('viaje_id') == $viaje->id ? 'selected' : '' }}>
                                                    Viaje #{{ $viaje->id }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="filter-group">
                                        <label>Fecha Desde</label>
                                        <input type="date" name="fecha_desde" id="filterDateFrom"
                                            value="{{ request('fecha_desde', date('Y-m-01')) }}">
                                    </div>
                                    <div class="filter-group">
                                        <label>Fecha Hasta</label>
                                        <input type="date" name="fecha_hasta" id="filterDateTo"
                                            value="{{ request('fecha_hasta', date('Y-m-d')) }}">
                                    </div>
                                    <div class="filter-group" style="justify-content: end; align-items: end;">
                                        <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Fuel Records Table -->
                        <div class="card">
                            <h3>📋 Registros de Combustible</h3>
                            <div class="table-container">
                                <table class="fuel-table" id="fuelTable">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Viaje</th>
                                            <th>Cantidad (L)</th>
                                            <th>Costo</th>
                                            <th>Costo/Litro</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($registrosCombustible ?? [] as $registro)
                                            <tr>
                                                <td>{{ $registro->fecha ? \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') : '-' }}
                                                </td>
                                                <td><strong>Viaje #{{ $registro->viaje_id ?? '-' }}</strong></td>
                                                <td>{{ number_format($registro->cantidad_litros ?? 0, 2) }} L</td>
                                                <td><strong>${{ number_format($registro->costo ?? 0, 2) }}</strong></td>
                                                <td>${{ $registro->cantidad_litros > 0 ? number_format(($registro->costo / $registro->cantidad_litros), 2) : '0.00' }}
                                                </td>
                                                <td>
                                                    <button
                                                        onclick="mostrarDetalles('combustible', {{ $registro->id }}, {{ json_encode($registro->load('viaje')) }})"
                                                        class="btn btn-secondary btn-sm">👁️</button>
                                                    <button class="btn btn-sm btn-warning"
                                                        onclick="editFuelRecord({{ $registro->id }})">✏️</button>
                                                    <form method="POST"
                                                        action="{{ route('combustibles.destroy', $registro->id) }}"
                                                        style="display: inline;"
                                                        onsubmit="return confirm('¿Está seguro de eliminar este registro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center" style="padding: 2rem; color: #666;">
                                                    No hay registros de combustible disponibles
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if(isset($registrosCombustible) && method_exists($registrosCombustible, 'links'))
                                <div style="margin-top: 1rem;">
                                    {{ $registrosCombustible->links() }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right Column: Analytics -->
                    <div>
                        <!-- Stats Analysis -->
                        <div class="card">
                            <h3>📈 Análisis de Consumo</h3>
                            <div class="chart-container">
                                <p style="color: #666; margin-bottom: 0.5rem;">Gráfico de consumo por período</p>
                                <small style="color: #999;">(Gráfico se implementaría con Chart.js)</small>
                            </div>
                        </div>

                        <!-- Top Efficiency -->
                        <div class="card">
                            <h3>🏆 Mejores Eficiencias</h3>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                @forelse($mejoresEficiencias ?? [] as $eficiencia)
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
                                        <div>
                                            <strong>Viaje #{{ $eficiencia->viaje->id ?? '-' }}</strong>
                                            <div style="font-size: 0.875rem; color: #666;">Eficiencia calculada</div>
                                        </div>
                                        <div style="text-align: right;">
                                            <div style="font-size: 1.25rem; font-weight: bold; color: #28a745;">
                                                {{ $eficiencia->eficiencia_promedio ?? 0 }} L/viaje</div>
                                            <div style="font-size: 0.75rem; color: #666;">Promedio</div>
                                        </div>
                                    </div>
                                @empty
                                    <div style="text-align: center; color: #666; padding: 1rem;">
                                        No hay datos de eficiencia disponibles
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Alerts -->
                        <div class="card">
                            <h3>⚠️ Alertas</h3>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                @forelse($alertas ?? [] as $alerta)
                                    <div
                                        style="padding: 1rem; background: {{ $alerta->tipo == 'warning' ? '#fff3cd' : ($alerta->tipo == 'danger' ? '#f8d7da' : '#d1ecf1') }}; border-left: 4px solid {{ $alerta->tipo == 'warning' ? '#ffc107' : ($alerta->tipo == 'danger' ? '#dc3545' : '#0c5460') }}; border-radius: 5px;">
                                        <div
                                            style="font-weight: bold; color: {{ $alerta->tipo == 'warning' ? '#856404' : ($alerta->tipo == 'danger' ? '#721c24' : '#0c5460') }};">
                                            {{ $alerta->titulo }}</div>
                                        <div
                                            style="font-size: 0.875rem; color: {{ $alerta->tipo == 'warning' ? '#856404' : ($alerta->tipo == 'danger' ? '#721c24' : '#0c5460') }};">
                                            {{ $alerta->descripcion }}</div>
                                    </div>
                                @empty
                                    <div style="text-align: center; color: #666; padding: 1rem;">
                                        No hay alertas activas
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="card">
                            <h3>📊 Estadísticas Rápidas</h3>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <div
                                    style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e9ecef;">
                                    <span>Total registros:</span>
                                    <strong>{{ isset($registrosCombustible) ? $registrosCombustible->total() : 0 }}</strong>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e9ecef;">
                                    <span>Promedio costo/litro:</span>
                                    <strong>${{ isset($registrosCombustible) && $registrosCombustible->count() > 0 ? number_format($registrosCombustible->where('cantidad_litros', '>', 0)->avg(function ($item) {
    return $item->costo / $item->cantidad_litros; }), 2) : '0.00' }}</strong>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e9ecef;">
                                    <span>Viajes con combustible:</span>
                                    <strong>{{ isset($registrosCombustible) ? $registrosCombustible->pluck('viaje_id')->unique()->count() : 0 }}</strong>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0;">
                                    <span>Último registro:</span>
                                    <strong>{{ isset($registrosCombustible) && $registrosCombustible->count() > 0 ? \Carbon\Carbon::parse($registrosCombustible->first()->fecha)->format('d/m/Y') : 'N/A' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Fuel Registration -->
    <div id="fuelModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>⛽ Registrar Carga de Combustible</h3>
                <span class="close" onclick="closeFuelModal()">&times;</span>
            </div>
            <form id="fuelForm" action="{{ route('combustibles.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="viaje_id">Viaje *</label>
                        <select name="viaje_id" id="viaje_id" required>
                            <option value="">Seleccionar viaje</option>
                            @foreach($viajes ?? [] as $viaje)
                                <option value="{{ $viaje->id }}">Viaje #{{ $viaje->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha *</label>
                        <input type="date" name="fecha" id="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_litros">Cantidad (Litros) *</label>
                        <input type="number" name="cantidad_litros" id="cantidad_litros" step="0.01" placeholder="0.00"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="costo">Costo Total *</label>
                        <input type="number" name="costo" id="costo" step="0.01" placeholder="0.00" required>
                    </div>
                    <div class="form-group">
                        <label for="precio_por_litro">Precio por Litro</label>
                        <input type="number" id="precio_por_litro" step="0.01" placeholder="0.00" readonly>
                    </div>
                </div>
                <div style="display: flex; gap: 1rem; justify-content: end; margin-top: 2rem;">
                    <button type="button" class="btn btn-secondary" onclick="closeFuelModal()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">💾 Guardar Registro</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Setup CSRF token for AJAX requests
        document.addEventListener('DOMContentLoaded', function () {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Add token to all AJAX requests
            if (window.fetch) {
                const originalFetch = window.fetch;
                window.fetch = function (url, options = {}) {
                    if (options.method && options.method.toUpperCase() !== 'GET') {
                        options.headers = options.headers || {};
                        options.headers['X-CSRF-TOKEN'] = token;
                    }
                    return originalFetch(url, options);
                };
            }

            setupEventListeners();
            setCurrentDate();
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

            // Form calculations
            document.getElementById('cantidad_litros').addEventListener('input', calculatePricePerLiter);
            document.getElementById('costo').addEventListener('input', calculatePricePerLiter);
            document.getElementById('viaje_id').addEventListener('change', loadViajeData);
        }

        function setCurrentDate() {
            const now = new Date();
            const formatted = now.toISOString().slice(0, 10);
            document.getElementById('fecha').value = formatted;
        }

        function calculatePricePerLiter() {
            const liters = parseFloat(document.getElementById('cantidad_litros').value) || 0;
            const totalCost = parseFloat(document.getElementById('costo').value) || 0;

            if (liters > 0) {
                const pricePerLiter = totalCost / liters;
                document.getElementById('precio_por_litro').value = pricePerLiter.toFixed(2);
            } else {
                document.getElementById('precio_por_litro').value = '0.00';
            }
        }

        function loadViajeData() {
            const viajeId = document.getElementById('viaje_id').value;
            if (viajeId) {
                // Aquí podrías hacer una petición AJAX para obtener datos del viaje
                fetch(`/api/viajes/${viajeId}/data`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Datos del viaje cargados:', data.viaje);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        function openFuelModal() {
            document.getElementById('fuelModal').style.display = 'block';
        }

        function closeFuelModal() {
            document.getElementById('fuelModal').style.display = 'none';
            document.getElementById('fuelForm').reset();
            setCurrentDate();
        }

        function viewFuelRecord(id) {
            window.location.href = `/combustibles/${id}`;
        }

        function editFuelRecord(id) {
            window.location.href = `/combustibles/${id}/edit`;
        }

        function logout() {
            if (confirm('¿Está seguro de que desea cerrar sesión?')) {
                window.location.href = '/logout';
            }
        }

        // Cerrar modal al hacer clic fuera
        window.onclick = function (event) {
            const modal = document.getElementById('fuelModal');
            if (event.target == modal) {
                closeFuelModal();
            }
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });
        });
    </script>

    @include('components.modal-detalles')

</body>

</html>