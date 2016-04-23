<?php

include "../model/usuario.php";

$idUsuario = $_POST["crear-idUsuario"];
$cedula = $_POST["crear-cedula"];
$nombre = $_POST["crear-nombre"];
$licencia = $_POST["crear-licencia"];
$telefono = $_POST["crear-telefono"];
$direccion = $_POST["crear-direccion"];
$tipo = $_POST["crear-tipo"];
$horasAcumuladas = 0;

$usuario = new Usuario($idUsuario, $cedula, $nombre, $licencia, $telefono, $direccion, $telefono, $horasAcumuladas);
$respuesta = $usuario->createUsuario();

if ($respuesta == "exito") {
    echo "El usuario se ha registrado con exito";
} else {
    echo "Error al registrar el usuario";
}

?>
