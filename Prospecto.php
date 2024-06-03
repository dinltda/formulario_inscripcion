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
    <title>PROSPECTO</title>
    <!-- Aquí puedes incluir etiquetas meta, enlaces a archivos CSS, etc. -->
    <link rel="stylesheet" href="estilos.css">


</head>
<body>
    <?php
    // Verificar si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $documento = $_POST['documento'];
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombres'];
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

        if ($result->num_rows > 0) {
            // Cédula encontrada, mostrar los datos
            $row = $result->fetch_assoc();
            $documento = $row['documento'];
            $cedula = $row['cedula'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
            $celular = $row['celular'];
            $email = $row['email'];

            //nunca entra a esta parte
            echo "<h2>Datos Ingresados</h2>";
            echo "<h2>Usted ya habia ingresado antes</h2>";
            echo "<p>Nombre: $nombres</p>";
            echo "<p>Apellidos: $apellidos</p>";
            echo "<p>Celular: $celular</p>";
            echo "<p>Correo Electrónico: $email</p>";
            echo "<p>Recuerde tener lista la foto del soporte de pago.</p>";
            
            //echo "<button type='submit' class='form__submit'>Enviar</button>";
        } else {
            // Cédula no encontrada, realizar registro en la tabla de prospectos
            $insertSql = "INSERT INTO prospectos (documento, cedula, nombres, apellidos, celular, email) VALUES ('$documento','$cedula', '$nombre', '$apellidos', '$celular', '$email')";

            if ($conn->query($insertSql) === TRUE) {
                //echo "<h2>Registro exitoso</h2>";
                //echo "<p>El prospecto ha sido registrado correctamente.</p>";
            
            } else {
                echo "Error al registrar el prospecto: " . $conn->error;
            }
        }

        $conn->close();
    }
    ?>

    <form action="iniciainscripcion.php" class="form" method="POST"> 
       <!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form" method="POST"> -->
        <h2 class="form__title">Inicia Inscripción</h2>
        <p class="form__paragraph">
            Recuerde que antes de llenar este formulario, debe haber efectuado el pago del valor de la inscripción que es de XXXXX por los siguientes medios<br>
            Nequi o Daviplata a los siguientes números 3108145549, 3152022311.<br>
            EFECTY a nombre de Juan Manuel Moreno C.C. 19.380.008<br>
            Cuenta de Ahorros BANCOLOMBIA No 17133816208 a nombre de Juan Manuel Moreno Rodriguez CC 19380008<br>
            Cuenta de Ahorros Banco CAJA SOCIAL No. 24106149049 a nombre de Asociación de Atletismo Master Club Olimpus NIT. 900068849-3.<br>
            Si Daviplata o Nequi se copan, favor usar los otros medios de pago.<br>
            Tomar el pantallazo o foto del soporte de pago, ya que se le pedirá más adelante en este formulario.
            Se recuerda que para quedar oficialmente inscrito debe llegar hasta el ultimo paso que es donde se muestra los datos ingresados
            
        </p>
        <div class="form__container">
            
            <div class="form__group" >
                <div class="form_ratio"> 
                    <div class="form__ratio2">  
                        <p>Tipo de documento:</p><br>
                        <input type="radio"  id="cedula" name="documento" value="cedula de ciudadania" required>
                        <label for="cedula" class="form__label">Cédula de Ciudadanía</label><br>

                        <input type="radio" id="extranjeria" name="documento" value="cedula extranjeria" required>
                        <label for="extranjeria" class="form__label">Cédula de Extranjeria</label><br>

                        <input type="radio" id="pasaporte" name="documento" value="pasaporte" required>
                        <label for="pasaporte" class="form__label">Pasaporte</label><br>

                        <input type="radio" id="tidentidad" name="documento" value="tarjeta de identidad" required>
                        <label for="tidentidad" class="form__label">Tarjeta de Identidad</label><br><br>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <label for="cedula" class="form__label" >Cédula</label>
                <input type="text" id="cedula" class="form__input" placeholder="Ingrese su Identificación" required name="cedula" onkeypress="validarInput(event)">
                <span class="form__line"></span>
            </div>
           
            <br>
                       
            <div class="form__group">
                <label for="nombres" class="form__label">Nombres</label>
                <input type="text" id="nombres" class="form__input" placeholder="" required name="nombres" onkeypress="validarInput(event)">
                <span class="form__line"></span>
            </div>
            
            <br>
            
            <div class="form__group">
                <label for="apellidos" class="form__label">Apellidos</label>
                <input type="text" id="apellidos" class="form__input" placeholder="" required name="apellidos" onkeypress="validarInput(event)">
                <span class="form__line"></span>
            </div>
            
            <br>
            
            <div class="form__group">
                <label for="celular" class="form__label">Celular</label>
                <input type="text" id="celular" class="form__input" placeholder="" required name="celular">
                <span class="form__line"></span>
            </div>
            
            <br>
            
            <div class="form__group">
                <label for="email" class="form__label">Correo electrónico</label>
                <input type="email" id="email" class="form__input" placeholder="" required name="email">
                <span class="form__line"></span>
            </div>
        </div>
    
        <br>
        <br>
            
        <input type="submit" class="form__submit" value="Enviar">
       
    </form>

 
<!--//zona de scrip    -->
<div class="center">  
    <script>
         function validarInput(event) {
            var tecla = event.key;
            var caracteresProhibidos = ["ñ", "Ñ", "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú"];

            if (caracteresProhibidos.includes(tecla)) {
                event.preventDefault();
                alert('No se aceptan ñ ni tildes. replace la ñ pon n y no use tildes.');
             }
         }
    </script>
</div>   
</body>
</html>
