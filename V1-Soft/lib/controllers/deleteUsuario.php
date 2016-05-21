<?php

include "../model/usuario.php";

$idUsuario = $_POST["eliminar-idUsuario"];;

$usuario = new Usuario();
$respuesta = $usuario->deleteUsuario($idUsuario);

if ($respuesta == "exito") {
    echo "El usuario se ha eliminado con exito";
} else {
    echo "Error al eliminar el usuario";
}

?>
