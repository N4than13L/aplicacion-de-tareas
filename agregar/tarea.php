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

            <button onclick=" borrar( ' . $row['id'] . ' )" class="btn btn-danger">
            
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 
                .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 
                .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 
                2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 
                1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 
                1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
                
                </button>
        </td>
    </tr>';
}

echo '</tbody>
</table>';