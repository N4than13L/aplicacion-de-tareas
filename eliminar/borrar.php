<?php
require("../conexion/conexion.php");
$mysqli = call_mysqli();

if (!empty($_POST)) {
}

$idActualizar = $_POST["codigo"];

if ($idActualizar > 0) {
    $sql = "DELETE FROM tarea WHERE id = '$idActualizar'";
    $mysqli->query($sql) or trigger_error($mysqli->error . " [$sql]");
}


$sql = "SELECT * FROM tarea";
$result = $mysqli->query($sql) or trigger_error($mysqli->error . " [$sql]");
$i = 0;
echo '
<table>
    <thead>
        <tr>
            <th>Orden</th>
            <th>Nombre</th>
            <th>Descripcion</th>
        </tr>
    </thead>
    <tbody>';
while ($row = $result->fetch_assoc()) {
    $i++;
    echo '
    <tr>
        <td>
            ' . $i . '
        </td>
        <td>
        <a href=index?id=' . $row['id'] . ' >                    
        ' . $row["nombre_tarea"] . ' 
         </a>
        </td>
        <td>
             <button onclick=" borrar( ' . $row['id'] . ' )" class="btn btn-danger">
        </td>
    </tr>';
}

echo '</tbody>
</table>';
