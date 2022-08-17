<?php 

require("../conexion/conexion.php");
$mysqli = call_mysqli();
if (!empty($_POST)) {
}

$idActualizar = $_POST["txtCodigo"];

$nombreTarea = $_POST["txtTareaTitulo"];
$descTarea = $_POST["taDescripcion"];

if ($idActualizar > 0) {
    $sql = "UPDATE tarea SET nombre_tarea = '$nombreTarea', descripcion_tarea = '$descTarea' 
    WHERE id = '$idActualizar'";
} else {
    $sql = "INSERT INTO tarea (nombre_tarea, descripcion_tarea) 
    VALUE('$nombreTarea', '$descTarea')";
}

$mysqli->query($sql) or trigger_error($mysqli->error . " [$sql]");

$sql = "SELECT * FROM tarea";
$result = $mysqli->query($sql) or trigger_error($mysqli->error . " [$sql]");
$i = 0;
echo '
<table>
    <thead>
        <tr>
            <th>Orden</th>
            <th>Tareas</th>
            <th>Descripcion </th>
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
        <a href=index?id=' . $row['id'] . ' >  
            '   . $row["descripcion_tarea"] . ' 
         </a>
        </td>
        <td>
            <input type="button" onclick="" value="Eliminar" />
        </td>
    </tr>';
}

echo '</tbody>
</table>';