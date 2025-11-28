<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/signin.css">
    <link rel="stylesheet" href="./css/login-modern.css">

</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-signin w-100 m-auto">
        <?php
        // Mensaje de error si viene por GET
        if (isset($_GET['error'])) {
            echo "<p class='text-danger'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>

        <!-- FORMULARIO -->
        <form action="controlador.php" method="POST">
            <img class="mb-4" src="./img/imagenlog.png" alt="" width="150" height="150">

            <h1 class="h3 mb-3 fw-normal">Login</h1>

            <!-- Acción para el switch del controlador -->
            <input type="hidden" name="accion" value="login">

            <div class="form-floating">
                <input type="email" class="form-control" name="email" placeholder="email@example.com" required>
                <label>Email</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <label>Password</label>
            </div>

            <input type="submit" value="Entrar" class="btn btn-primary w-100 py-2 mt-3">

            <p class="mt-5 mb-3 text-body-secondary">&copy; 2025–2026</p>
        </form>

    </main>

    <script src="./js/bootstrap.min.js"></script>

</body>
</html>
