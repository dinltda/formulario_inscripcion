<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="formulario de Inscripcion Vuelta Isla San Andres">
    <meta name="keywords" content="atletismo colombia, San Andrés, vuelta a la islas">
    <meta name="author" content="Edgar Guevara">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Otros metaetiquetas que desees incluir -->
    <title>INICIA PROCESO INSCRIPCION</title>
    <!-- Aquí puedes incluir etiquetas meta, enlaces a archivos CSS, etc. -->
    <link rel="stylesheet" href="estilos.css">


</head>
<body>
    <?php
// Verificar si se ha enviado el formulario
   // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $documento = $_POST['documento'];
        $cedula = $_POST['cedula'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];

        // Conexión a la base de datos (reemplaza los valores con los tuyos)
        $servername = "localhost";
        $username = "edgar";
        $password = "salitreplaza05%%";
        $database = "inscripcionsai";

       // $server="localhost:3306";
       // colocar esos datos a la BD se crea bd luego se entra por privilegios yluego agregar cuenta de usuario

        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión a la base de datos
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Consultar si la cédula existe en la tabla de prospectos
        $sql = "SELECT * FROM prospectos WHERE cedula = '$cedula'";
        $result = $conn->query($sql);

        $sqlYaInscritos = "SELECT * FROM entregakits WHERE Identificacion = '$cedula'";
        $result2 = $conn->query($sqlYaInscritos);

        if($result2->num_rows > 0) {
            ?>
                <div class="form">
                    <br>
                    <P>Usted ya se encuentra inscrito, si desea hacer algún cambio en su inscripción enviar mensaje a clubolimpus@clubo.org</P>
                    <br><br>
                    <input type="button" class="form__boton" value="Regresar >>>" onclick="window.location.href='https://clubol.org/wp/san-andres-32k/'">
                    <br><br>
                </div>    
            <?php
              
        }else{
            if ($result->num_rows > 0) {
                // Cédula encontrada, mostrar los datos
                $row = $result->fetch_assoc();
                $documento = $row['documento'];
                $cedula = $row['cedula'];
                $nombres = $row['nombres'];
                $apellidos = $row['apellidos'];
                $celular = $row['celular'];
                $email = $row['email'];
                $bandera="Usted ya habia ingresado antes";
                        
            //echo "<button type='submit' class='form__submit'>Enviar</button>";
            } else {
                // Cédula no encontrada, realizar registro en la tabla de prospectos
                $insertSql = "INSERT INTO prospectos (documento, cedula, nombres, apellidos, celular, email) VALUES ('$documento','$cedula', '$nombres', '$apellidos', '$celular', '$email')";

                if ($conn->query($insertSql) === TRUE) {
                    //echo "<h2>Registro exitoso</h2>";
                    //echo "<p>El prospecto ha sido registrado correctamente.</p>";
                    $bandera="";
                    
                } else {
                    echo "Error al registrar el prospecto: " . $conn->error;
                }
            }
            ?>
            <div class="form">
                <?php
        
                    echo "<h2 >Datos Ingresados</h2>";
                    echo"<br>";
                    echo $bandera;
                    echo "<p>Documento: $documento</p>";
                    echo "<p>Cedula: $cedula</p>";
                    echo "<p>Nombres: $nombres</p>";
                    echo "<p>Apellidos: $apellidos</p>";
                    echo "<p>Celular: $celular</p>";
                    echo "<p>Correo Electrónico: $email</p>";
                    echo"<br>";
                    echo "<h3 >Recuerde tener lista la foto del soporte de pago.</h3>";
                    //$url = "archivo_destino.php?nombre=" . urlencode($nombre) . "&edad=" . urlencode($edad);
                    //header("Location: " . $url);
                    //exit();
                ?>

                <br>
                <input type="button" class="form__boton" value="Inscripcion Individual >>>" onclick="window.location.href='inscriindividual.php?cedula=<?php echo $cedula ?>'">
                <br><br>
                <input type="button" class="form__boton" value="Inscripcion para miembros de Grupo >>>" onclick="window.location.href='inscripgrupo.php'">
                <br><br>
                <input type="button" class="form__boton" value="No he efectuado el pago (Regresar al inicio) >>>" onclick="window.location.href='prospecto.php'">
                <br><br> 
            </div>
            <?php
        }
   
        $conn->close();
    //}
    ?>



</body>
</html>
