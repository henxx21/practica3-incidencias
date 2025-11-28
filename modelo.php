<?php

// CONEXIÓN BASE DE DATOS IMPORTANTE PUERTO INTERNO 3306 - ES EN PODMAN NO EN LOCAL
function conexionDB()
{
    try {
        $dsn = "mysql:host=mariadb:3306;dbname=gestion_incidencias";
        $conexion = new PDO($dsn, "usuario", "usuario");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $conexion;
}


/* CONSULTAS PREPARADAS VALIDADR ACCESO TECNICO */
function validarTecnico($email, $password)
{
    $conexion = conexionDB();

    $stmt = $conexion->prepare("SELECT * FROM tecnico WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $tecnico = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tecnico == false) {
        return null;
    }

    if (password_verify($password, $tecnico['password'])) {
        return $tecnico;
    } else {
        return null;
    }
}


/* CONSULTAR SUS INCIDENCIAS POR ID_TECNICO */
function obtenerIncidenciasPorTecnico($id_tecnico)
{
    $conexion = conexionDB();

    $stmt = $conexion->prepare("SELECT * FROM incidencia WHERE id_tecnico = :id");
    $stmt->bindParam(":id", $id_tecnico);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
/* OBTENER INCIDENCIA POR SU ID */
function obtenerIncidencia($id)
{
    $conexion = conexionDB();

    $stmt = $conexion->prepare("SELECT * FROM incidencia WHERE id_incidencia = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row : null;
}
/* CREAR NUEVA INCIDENCIA EN BBDD */
function crearIncidencia($datos)
{
    $conexion = conexionDB();

    $stmt = $conexion->prepare("INSERT INTO incidencia (titulo, descripcion, tipo, estado, prioridad, id_tecnico) 
        VALUES (:titulo, :descripcion, :tipo, :estado, :prioridad, :id_tecnico)");

    $stmt->bindParam(":titulo", $datos['titulo']);
    $stmt->bindParam(":descripcion", $datos['descripcion']);
    $stmt->bindParam(":tipo", $datos['tipo']);
    $stmt->bindParam(":estado", $datos['estado']);
    $stmt->bindParam(":prioridad", $datos['prioridad']);
    $stmt->bindParam(":id_tecnico", $datos['id_tecnico']);

    $stmt->execute();
}
/* MODIFICAR INCIDENCIA DE BBDD*/
function actualizarIncidencia($id, $datos)
{
    $conexion = conexionDB();

    $stmt = $conexion->prepare("
        UPDATE incidencia 
        SET estado = :estado,
            prioridad = :prioridad,
            fecha_actualizacion = CURRENT_TIMESTAMP
        WHERE id_incidencia = :id
    ");

    $stmt->bindParam(":estado", $datos['estado']);
    $stmt->bindParam(":prioridad", $datos['prioridad']);
    $stmt->bindParam(":id", $id);

    $stmt->execute();
}
/* ELIMINAR INCIDENCIA POR SU ID */
function eliminarIncidencia($id)
{
    $conexion = conexionDB();

    $stmt = $conexion->prepare("DELETE FROM incidencia WHERE id_incidencia = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
}
/* BUSCAR INCIDENCIAS EN BBDD */
function buscarIncidencias($id_tecnico, $texto)
{
    $conexion = conexionDB();

    $like = "%" . $texto . "%";

    $stmt = $conexion->prepare("SELECT * FROM incidencia 
        WHERE id_tecnico = :id
        AND (titulo LIKE :txt OR descripcion LIKE :txt)");

    $stmt->bindParam(":id", $id_tecnico);
    $stmt->bindParam(":txt", $like);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
