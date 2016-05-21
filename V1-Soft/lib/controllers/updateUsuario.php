<?php

include "../model/usuario.php";

$idUsuario = $_POST["actualizar-idUsuario"];
$nombre = $_POST["actualizar-nombre"];
$licencia = $_POST["actualizar-licencia"];
$telefono = $_POST["actualizar-telefono"];
$direccion = $_POST["actualizar-direccion"];
$tipo = $_POST["actualizar-tipo"];
$horasAcumuladas = $_POST["actualizar-horas"];

$usuario = new Usuario($idUsuario, 0, $nombre, $licencia, $telefono, $direccion, $telefono, $horasAcumuladas);
$respuesta = $usuario->updateUsuario($idUsuario);

if ($respuesta == "exito") {
    echo "El usuario se ha actualizado con exito";
} else {
    echo "Error al actualizar el usuario";
}

?>
