<?php

include '../model/usuario.php';

$id = $_GET["id"];
$usuario = new Usuario();
$usuarioActual = "";

if($id == null) {
    $usuarioActual = $usuario->getUsuarios();
} else {
    $usuarioActual = $usuario->getUsuario($id);
}

$html = "<table class='table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Licencia</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Tipo</th>
                    <th>Horas Acumuladas</th>
                </tr>
            </thead>
            <tbody>";

foreach ($usuarioActual as $row) {
    $html .="<tr>";
    $html .="<td>" . $row["idUsuario"] . "</td>";
    $html .="<td>" . $row["cedula"] . "</td>";
    $html .="<td>" . $row["nombre"] . "</td>";
    $html .="<td>" . $row["licencia"] . "</td>";
    $html .="<td>" . $row["telefono"] . "</td>";
    $html .="<td>" . $row["direccion"] . "</td>";
    $html .="<td>" . $row["tipo"] . "</td>";
    $html .="<td>" . $row["horasAcumuladas"] . "</td>";
    $html .="</tr>";
}

$html .= "</tbody>
        </table>";

echo $html;

?>
