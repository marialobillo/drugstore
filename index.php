<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado Homeopatia</title>
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
  -->
  <link rel="stylesheet" href="bootstrap.css">
  <script src="jquery.js"></script>
  <script src="bootstrap.js"></script>
  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
    <style type="text/css">
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Listado</h2>
                        <a href="create.php" class="btn btn-success pull-right">Añade Nuevo Registro</a>
                    </div>

                    <div class="row">
                      <div class="col-md-10">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por nombre...">

                      </div>
                    </div>
                    <br>
                    <?php
                    // Include config file
                    require_once 'config.php';

                    // Attempt select query execution
                    $sql = "SELECT * FROM homeo";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped' id='myTable'>";
                                echo "<thead>";
                                    echo "<tr>";
                                //        echo "<th>#</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Potencia</th>";
                                        echo "<th>Cantidad</th>";
                                        echo "<th>Opciones</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                    //    echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['composition'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='Ver Registro' data-toggle='tooltip' class='btn btn-info'>Ver</a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Editar' data-toggle='tooltip' class='btn btn-success'>Editar</a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Borrar Registro' data-toggle='tooltip' class='btn btn-danger'>Borrar</a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>No se han encontrado registros.</em></p>";
                        }
                    } else{
                        echo "ERROR: No hemos podidos ejecutar $sql. " . $mysqli->error;
                    }

                    // Close connection
                    $mysqli->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
