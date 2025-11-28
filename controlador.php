<?php
session_start();

require_once "modelo.php";

// Acciones recibidas de form
$accion = $_REQUEST['accion'] ?? '';

switch ($accion) {

    /* Inicio de sesion*/
    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];

        $tecnico = validarTecnico($email, $password);

        if ($tecnico == null) {
            header("Location: login.php?error=Credenciales incorrectas");
        } else {
            $_SESSION['tecnico'] = $tecnico;
            header("Location: dashboard.php");
        }
        break;


    /* cerrar sesion */
    case 'logout':
        session_destroy();
        header("Location: login.php");
        break;


    /* crear incidencia*/
    case 'crear':
        if (!isset($_SESSION['tecnico'])) {
            header("Location: login.php");
            break;
        }

        $datos = array(
            "titulo"      => $_POST['titulo'],
            "descripcion" => $_POST['descripcion'],
            "tipo"        => $_POST['tipo'],
            "estado"      => "Pendiente",
            "prioridad"   => $_POST['prioridad'],
            "id_tecnico"  => $_SESSION['tecnico']['id_tecnico']
        );

        crearIncidencia($datos);
        header("Location: dashboard.php");
        break;


    /* obteber una incidencia*/
    case 'obtener':
        $id = $_GET['id'];
        header("Location: verIncidencia.php?id=" . $id);
        break;


    /* actualizar una incidencia*/
    case 'actualizar':
        $id = $_POST['id'];
    
        $datos = array(
            "estado" => $_POST['estado'],
            "prioridad" => $_POST['prioridad']
        );
    
        actualizarIncidencia($id, $datos);
        header("Location: verIncidencia.php?id=" . $id);
        break;  

    /* quitar una incidencia*/
    case 'eliminar':
        $id = $_GET['id'];
        eliminarIncidencia($id);
        header("Location: dashboard.php");
        break;


    /* buscar*/
    case 'buscar':
        $texto = $_POST['buscar'];
        $_SESSION['busqueda'] = $texto;
        header("Location: dashboard.php");
        break;


    /* listar */
    case 'listar':
        unset($_SESSION['busqueda']);
        header("Location: dashboard.php");
        break;


    /* el por defecto si no se le pasa nada */
    default:
        header("Location: login.php");
        break;
}
