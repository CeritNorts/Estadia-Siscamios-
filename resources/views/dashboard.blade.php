<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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

    @media (max-width: 768px) {
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
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('profile') }}">Perfil</a>
                <a href="{{ route('login') }}">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
</body>
</html>
