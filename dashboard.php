<?php
session_start();
if (!isset($_SESSION['tecnico']))
    header("Location: login.php");

require_once("modelo.php");

// Si hay búsqueda la aplicamos
$busqueda = $_SESSION['busqueda'] ?? "";
$id_tecnico = $_SESSION['tecnico']['id_tecnico'];

if ($busqueda != "") {
    $incidencias = buscarIncidencias($id_tecnico, $busqueda);
} else {
    $incidencias = obtenerIncidenciasPorTecnico($id_tecnico);
}
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <title>Incidencias</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="icon" href="./img/icono.png" sizes="32x32" type="image/png">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <div class="container">

        <!-- CABECERA-->
        <header class="p-3 mb-3 border-bottom">
            <div class="d-flex flex-wrap justify-content-between align-items-center">

                <h4 class="mb-0">Incidencias de <?= $_SESSION['tecnico']['nombre'] ?></h4>

                <div>
                    <a href="controlador.php?accion=logout" class="btn btn-secondary btn-sm">Cerrar sesión</a>
                </div>
            </div>
        </header>

        <main>

            <!-- BOTONES -->
            <div class="mb-3">

                <!-- Buscar -->
                <form action="controlador.php" method="POST" class="row g-2 mb-3">
                    <input type="hidden" name="accion" value="buscar">

                    <div class="col-md-4">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar..." 
                               value="<?= htmlspecialchars($busqueda) ?>">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Buscar</button>
                    </div>

                    <div class="col-md-2">
                        <a class="btn btn-outline-secondary w-100" href="controlador.php?accion=listar">Limpiar</a>
                    </div>

                    <div class="col-md-4 text-end">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevaIncidencia">
                            Nueva
                        </button>
                    </div>
                </form>
            </div>

            <!-- TABLA -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Prioridad</th>
                        <th>Fecha creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (count($incidencias) == 0) {
                        echo "<tr><td colspan='6' class='text-center text-muted'>No hay incidencias</td></tr>";
                    }

                    foreach ($incidencias as $i) {

                        echo "<tr>";
                        echo "<td>" . $i['titulo'] . "</td>";
                        echo "<td>" . $i['tipo'] . "</td>";
                        echo "<td>" . $i['estado'] . "</td>";
                        echo "<td>" . $i['prioridad'] . "</td>";
                        echo "<td>" . $i['fecha_creacion'] . "</td>";

                        echo "<td>";
                        echo "<a class='btn btn-primary btn-sm me-2' href='controlador.php?accion=obtener&id=" . $i['id_incidencia'] . "'>Ver</a>";
                        echo "<a class='btn btn-danger btn-sm' href='controlador.php?accion=eliminar&id=" . $i['id_incidencia'] . "' onclick=\"return confirm('¿Eliminar?');\">Eliminar</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </main>
    </div>


    <!-- MODAL NUEVA INCIDENCIA -->
    <div class="modal fade" id="nuevaIncidencia" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="controlador.php" method="POST">
                    <input type="hidden" name="accion" value="crear">

                    <div class="modal-header">
                        <h5 class="modal-title">Nueva incidencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <input type="text" name="titulo" class="form-control" required>
                            <label>Título</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="descripcion" class="form-control" required>
                            <label>Descripción</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select name="tipo" class="form-select">
                                <option>Hardware</option>
                                <option>Software</option>
                                <option>Red</option>
                                <option>Otros</option>
                            </select>
                            <label>Tipo</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select name="prioridad" class="form-select">
                                <option>Baja</option>
                                <option>Media</option>
                                <option>Alta</option>
                                <option>Crítica</option>
                            </select>
                            <label>Prioridad</label>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <script src="./js/bootstrap.bundle.min.js"></script>

</body>
</html>
