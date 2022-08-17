<?php
require("./conexion/conexion.php");

$mysqli = call_mysqli();

$sql = "SELECT * FROM tarea";
$rePress = $mysqli->query($sql);
$rowPerfile = $rePress->fetch_assoc();

?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tareas Cortas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    
  <div class="container"><h1>Tareas</h1></div>

    <form action="<?php $_SERVER["PHP_SELF"]; ?>" class="container" method="post" name="fileinfo">
        <div class="form-group">
            <label for="codigo">Codigo</label>
            <input type="text" readonly 
            name="txtCodigo" />
        </div>
        <br/>

        <div class="form-group">
            <label for="titulo">Titulo</label>
            <input type="text" placeholder="agrega la tarea" 
            name="txtTareaTitulo" id="txtTareaTitulo" />
        </div>
        <br/>
        
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <br/>
            <textarea name="taDescripcion" id="taDescripcion"
             cols="30" rows="10"></textarea>
        </div>
        <br/>

        <input type="button" onclick="guardar()" class="btn btn-success" name="btnEnviar" 
        value="Guardar tarea" />

        <script>
            
        function guardar() {
        let data = new FormData(document.forms.namedItem("fileinfo"));
            fetch('./agregar/tarea.php', {
                        method: 'POST',
                        body: data
                    })
                    .then(function(response) {
                        if (response.ok) {
                            return response.text();
                        } else {
                            throw "Error en la llamada";
                        }
                    })
                    .then(function(texto) {
                        if (texto == "redirect") {
                            window.location.href = "?p=inicio";
                        } else {
                            document.getElementById("contenido").innerHTML = texto;
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

    </script>

        <div id='contenido'>
            <?php
            $sql = "SELECT * FROM tarea";
            $result = $mysqli->query($sql) or trigger_error($mysqli->error . " [$sql]");
            $i = 0;
            echo '
      <table>
          <thead>
              <tr>
                  <th>Orden</th>
                  <th>Tareas</th>
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
      
                  ' . $row["nombre_tarea"] . '
      
              </td>

              <td>
      
                  ' . $row["descripcion_tarea"] . '
      
              </td>
              <td>
      
                  <input type="button" onclick="" value="Eliminar" />
      
              </td>
          </tr>';
            }

            echo '</tbody>
      </table>';

            ?>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>