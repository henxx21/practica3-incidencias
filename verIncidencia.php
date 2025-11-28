<?php
session_start();
if (!isset($_SESSION['tecnico']))
    header("Location: login.php");

require_once("modelo.php");

$id = $_REQUEST['id'] ?? null;

if ($id == null) {
    header("Location: dashboard.php");
}

$incidencia = obtenerIncidencia($id);
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <title>Detalle Incidencia</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="icon" href="./img/icono.png" sizes="32x32" type="image/png">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <div class="container">

        <!-- CABECERA -->
        <header class="p-3 mb-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Detalle de incidencia</h4>
                <a href="dashboard.php" class="btn btn-secondary btn-sm">Volver</a>
            </div>
        </header>

        <main>

            <?php if ($incidencia != null) { ?>

                <div class="card" style="width: 24rem; margin: 0 auto;">

<form action="controlador.php" method="POST" id="formEstado">

    <div class="card-body">
        <h5 class="card-title"><?= $incidencia['titulo']; ?></h5>
        <p class="card-text"><?= $incidencia['descripcion']; ?></p>
    </div>

    <ul class="list-group list-group-flush">

        <li class="list-group-item">
            <strong>Tipo:</strong> <?= $incidencia['tipo']; ?>
        </li>

        <li class="list-group-item">
            <strong>Estado:</strong>
            <select name="estado" class="form-select form-select-sm mt-2">
                <option <?= $incidencia['estado'] == "Pendiente" ? "selected" : "" ?>>Pendiente</option>
                <option <?= $incidencia['estado'] == "En proceso" ? "selected" : "" ?>>En proceso</option>
                <option <?= $incidencia['estado'] == "Resuelta" ? "selected" : "" ?>>Resuelta</option>
                <option <?= $incidencia['estado'] == "Cerrada" ? "selected" : "" ?>>Cerrada</option>
            </select>
        </li>

        <li class="list-group-item">
            <strong>Prioridad:</strong>
            <select name="prioridad" class="form-select form-select-sm mt-2">
                <option <?= $incidencia['prioridad'] == "Baja" ? "selected" : "" ?>>Baja</option>
                <option <?= $incidencia['prioridad'] == "Media" ? "selected" : "" ?>>Media</option>
                <option <?= $incidencia['prioridad'] == "Alta" ? "selected" : "" ?>>Alta</option>
                <option <?= $incidencia['prioridad'] == "Crítica" ? "selected" : "" ?>>Crítica</option>
            </select>
        </li>

        <li class="list-group-item">
            <strong>Fecha creación:</strong> <?= $incidencia['fecha_creacion']; ?>
        </li>

        <li class="list-group-item">
            <strong>Última actualización:</strong> <?= $incidencia['fecha_actualizacion']; ?>
        </li>

    </ul>

    <div class="card-body text-center">
        <input type="hidden" name="accion" value="actualizar">
        <input type="hidden" name="id" value="<?= $incidencia['id_incidencia']; ?>">
        <button type="submit" class="btn btn-primary btn-sm">Guardar cambios</button>
    </div>

</form>

</div>


            <?php } else { ?>

                <p class="text-danger text-center">Incidencia no encontrada</p>

            <?php } ?>

        </main>

    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>
