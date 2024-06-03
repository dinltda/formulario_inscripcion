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
    <title>CONFIRMA PAGO INSCRIPCION SAI</title>
    <!-- Aquí puedes incluir etiquetas meta, enlaces a archivos CSS, etc. -->
    <link rel="stylesheet" href="estilos.css">


</head>
<body>

    <div class="form">
      <?php
    
        // Verificar si se ha enviado el formulario
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            
        $fpago = $_POST['fpago'];
        $NComprob = $_POST['NComprob'];
        $cedula = $_POST['cedula'];
        $archivo = $_FILES['archivo'];
        $codigo = $_FILES['codigo'];
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {

            // Verificar si se subió correctamente el archivo
            if ($archivo['error'] === UPLOAD_ERR_OK) {
                $tamanioMaximo = 500 * 1024; // 500KB en bytes

                // Verificar el tamaño del archivo
                if ($archivo['size'] <= $tamanioMaximo) {
                    $nombreArchivo = $archivo['name'];
                    $rutaDestino = 'archivosoportes/' . $nombreArchivo;

                    // Mover el archivo a la carpeta de destino
                    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                        echo "El archivo se ha subido correctamente.";
                        ?>
                            <br><br>
                            <input type="button" class="form__boton" value="Continuar >>>" onclick="window.location.href='ingresodatosatleta.php?cedula=<?php echo $cedula ?>&fpago=<?php echo $fpago ?>&NComprob=<?php echo $NComprob ?>&nombreArchivo=<?php echo $nombreArchivo ?>&codigo=<?php echo $codigo ?>'">
                        <?php
                        
                    } else {
                        echo "Error al mover el archivo a la carpeta de destino. llamar al 3002106752 para recibir soporte";
                        ?>
                            <br><br>
                            <input type="button" class="form__boton" value="Continuar >>>" onclick="window.location.href='inscriindividual.php'">
                        <?php
                    }
                } else {
                    echo "El tamaño del archivo supera el límite permitido (500KB), por favor reduzca el tamaño.";
                    ?>
                         <br><br>
                         <input type="button" class="form__boton" value="Continuar >>>" onclick="window.location.href='inscriindividual.php'">
                    <?php
                }
            } else {
                echo "Error al subir el archivo. Intentelo más tarde";
                ?>
                            <br>
                            <input type="button" class="form__boton" value="Continuar >>>" onclick="window.location.href='inscriindividual.php'">
                <?php
            }
        }
      ?>
    </div>

</body>
</html>
