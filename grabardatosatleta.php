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
    <title>GRABAR DATOS</title>
    <!-- Aquí puedes incluir etiquetas meta, enlaces a archivos CSS, etc. -->
    <link rel="stylesheet" href="estilos.css">


</head>
<body>
    <?php
        //************** colocar div form  para que todos los textos queden dentro de la caja contenedora 
        //zona de funciones
        function enviocorreo($correo, $mensaje,$Nombre) {
            
            ini_set('SMTP', 'smtp.gmail.com');
            ini_set('smtp_port', 465);
            ini_set('username', 'clubolimpus@clubol.org');
            ini_set('password', 'salitreplaza05%%1');

            
                // Configurar los datos del correo
                $destinatario = $correo;
                $asunto = "Confirmación de Inscripción";
                $cuerpo = "Hola $Nombre,\n\nGracias por inscribirse, por favor revise los datos que ingresó, si tiene algun dato para corregir llamar al 3108145549 o enviar
                un correo a clubolimpus@clubol.org,. Aquí está la confirmación de tu mensaje:\n\n$mensaje\n\nSaludos,\nClub Olimpus";
            
                // Configurar el correo de origen
                $remitente = "clubolimpus@clubol.org";
                $cabeceras = "De: $remitente";
            
                // Enviar el correo
                if (mail($destinatario, $asunto, $cuerpo, $cabeceras)) {
                    echo "Correo enviado exitosamente a $correo";
                } else {
                    echo "Error al enviar el correo";
                }
           

        }            
   
        
        //Zona de codigo ppal de php

        $atletanoestaendatosatleta = $_POST['atletanoestaendatosatleta'];
        $documento = $_POST['documento'];
        $cedula = $_POST['cedula'];
        $Fpago = $_POST['Fpago'];//Esta variable va en entregakits
        $codigo=$_POST['codigo'];//Esta variable va en entregakits
        $NComprob= $_POST['NComprob'];//Esta variable va en entregakits
        $archivo= $_POST['nombreArchivo'];//Esta variable va en entregakits
        $Nombre = $_POST['Nombre'];
        $Apellido = $_POST['Apellido'];
        $Cel = $_POST['Cel'];
        $email = $_POST['email'];
        $FechaIns = $_POST['fechaInscripcion'];//Esta variable va en entregakits
        $Sexo = $_POST['sexo'];
        $Fnacimiento = $_POST['fnacimiento'];
        $Sangre = $_POST['sangre'];
        $Direccion = $_POST['direccion'];
        $Ciudad = $_POST['ciudad']; //Revisar como reescribir en la base de datos si la ciudad o direccion y email cambian
        $Pais = $_POST['pais'];
        $Aerolinea = $_POST['aerolinea'];//Esta variable va en entregakits
        $FechaIda = $_POST['fechaida'];//Esta variable va en entregakits
        $FechaReg = $_POST['fecharegreso'];//Esta variable va en entregakits
        $Distancia = $_POST['distancia'];//Esta variable va en entregakits
        $Talla = $_POST['talla'];//Esta variable va en entregakits
        $Autoriza = $_POST['autoriza'];//Esta variable va en entregakits
        $Club = $_POST['club'];//Esta variable va en entregakits
        $ContactoEmer = $_POST['contactoemergencia'];//Esta variable va en entregakits
        $Observ = $_POST['observaciones'];//Esta variable va en entregakits
        $Exonera = $_POST['acepto'];//Esta variable va en entregakits
    
        // Conexión a la base de datos 
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

        // Consultar si la cédula existe en la tabla de entregakits
        $sql = "SELECT * FROM entregakits WHERE Identificacion = '$cedula'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           // Cédula encontrada, muestra los datos y verificar si hubo algun cambio de datos personales para actualizarlos
           
           //echo "Usted ya esta inscrito si desea hacer algún cambio comunicarse al Cel 3108145549 o enviar un correo a clubolimpus@clubol.org " 
           ?> 
                <div class="form">
                    <p> Usted ya esta inscrito si desea hacer algún cambio, comunicarse al Cel 3108145549 o enviar un correo a clubolimpus@clubol.org </p>
                    <br><br>
                    <input type="button" class="form__boton" value="Regresar >>>" onclick="window.location.href='http://www.sanandres32k.co'"> 
                </div>    
           <?php
           
        } else {
            // Cédula no encontrada, realizar registro en la tabla de entregakits de datos de carrera de esa cedula
            $insertSql = "INSERT INTO entregakits (FechaIns,Identificacion, Aerolinea, FechaIda, FechaReg, Fpago, NComprob, codigo, archivo, Distancia, Talla, Autoriza, ContactoEmer, Club, Observ, Exonera) VALUES ('$FechaIns','$cedula', '$Aerolinea', '$FechaIda', '$FechaReg', '$Fpago', '$NComprob', '$codigo', '$archivo', '$Distancia', '$Talla', '$Autoriza', '$ContactoEmer', '$Club', '$Observ', '$Exonera')";

            if ($conn->query($insertSql) === TRUE) {
                ?><div class="form">
                        <h2>Registro exitoso</h2>
                    
                    
                        <?php  
                            // Muestra los datos ingresados en pantalla para que los verifique el lector
                         
                            echo "<p>Estos son los datos ingresados, si requiere algún cambio, llamar al 3108145549 o enviar email a clubolimpus@clubol.org</p>";
                            echo "\n";
                            echo "<p>Fecha Inscripción: $FechaIns </p>";
                            echo "<p>Documento: $documento </p>";
                            echo "<p>No. Identificacion: $cedula</p>";
                            echo "<p>Nombres: $Nombre</p>";
                            echo "<p>Apellidos: $Apellido</p>";
                            echo "<p>Fecha de Nacimiento: $Fnacimiento</p>";
                            echo "<p>Genero: $Sexo</p>";
                            echo "<p>Sangre: $Sangre</p>";
                            echo "<p>Direcciín: $Direccion</p>";
                            echo "<p>Celular: $Cel</p>";
                            echo "<p>email: $email</p>";
                            echo "<p>Ciudad: $Ciudad</p>";
                            echo "<p>Pais: $Pais</p>";
                            echo "<p>Talla: $Talla</p>";
                            echo "<p>Distancia: $Distancia</p>";
                            echo "<p>Club: $Club</p>";
                            echo "<p>Autoriza Publicación: $Autoriza</p>";
                            echo "<p>Acepta Exoneración de Responsabilidades: $Exonera</p>";
                            echo "<p>Contacto de Emergencia: $ContactoEmer</p>";
                            echo "<p>Forma de Pago: $Fpago</p>";
                            echo "<p>No. de Comprobante de pago: $NComprob</p>";
                            echo "<p>Aerolinea: $Aerolinea</p>";
                            echo "<p>Fecha de viaje de Ida a SAI: $FechaIda</p>";
                            echo "<p>Fecha de Regreso : $FechaReg</p>";
                            echo "<p>Observaciones: $Observ</p>";
                            
                            ?>
                                
                                <br>
                                <P>Gracias</P>
                                <br><br>
                                <input type="button" class="form__boton" value="Regresar >>>" onclick="window.location.href='https://clubol.org/wp/san-andres-32k/'">
                                <br><br>
                                 
                            <?php  

                            // ********** OJO OJO programa para realizar************************************+++
                            //Enviar correo a JM y a atleta;
                            $mensaje="fecha de Inscripcion: $FechaIns\n\n
                                \nÉsta es la información que ingresó:
                                \nTipo de documento: $documento
                                \nCédula: $cedula 
                                \nNombres: $Nombre 
                                \nApellidos:  $Apellido 
                                \nFecha de Nacimiento:  $Fnacimiento 
                                \nGénero:  $Sexo 
                                \nTipo de Sangre:  $Sangre 
                                \nDirección: $Direccion
                                \nCelular o Teléfono: $Cel
                                \nCorreo eléctrónico: $email 
                                \nCiudad:  $Ciudad 
                                \nPais: $Pais 
                                \nTalla camiseta: $Talla
                                \nPrueba a la que se inscribió: $Distancia 
                                \nClub : $Club
                                \nAutoriza publicación : $Autoriza
                                \nAcepta exoneracion responsabilidades: $Exonera
                                \nContacto de Emergencia: $ContactoEmer
                                \nForma de pago: $Fpago    
                                \nNumero de Comprobante: $NComprob    
                                \nAerolinea: $Aerolinea 
                                \nFecha de ida: $FechaIda 
                                \nFecha de regreso: $FechaReg   
                                \nObservaciones: $Observ 
                                \n\nSi requiere realizar algún cambio, por favor envíe un correo electrónico a clubolimpus@clubol.org.
                                \n\nSe recuerda que al haberse inscrito, usted acepta los acuerdos, instrucciones, adevertencias y demás documentos publicados en la pagina web del evento.
                                \n\nSe anexan en archivos adjuntos La Declaración de Liberación de Responsabilidades - Terminos de Participación, para que lo descargue lo firme y lo reenvie a clubolimpus@clubol.ogr,
                                y para su lectura se anexa el Reglamento de carrera y las Condiciones. " ;
                                    
                            //enviocorreo($email, $mensaje,$Nombre );
                            //enviocorreo("dinltda@gmail.com", $mensaje,$Nombre);

                        ?>
                    </div>
                
                
                <?php
                
            } else {
                echo "Error al registrar el prospecto: " . $conn->error;
            }
        }

        $conn->close();
    
//****************************** ojo ojo *****************************************++
// hacer programa para calcular edad y categorias


        //Revision de los datos que provienen del formulario con los que estan en tabla datosatletas, para actualizar cambios si los hay//Hacer codigo en prospectos, de tal forma que busque con la cedula en entregakits, si esa cedula esta, mostrarle el mensaje siguiete: 
              
        // Conexión a la base de datos (reemplaza los valores con los tuyos)
        $servername = "localhost";
        $username = "edgar";
        $password = "salitreplaza05%%";
        $database = "inscripcionsai";

        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión a la base de datos
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Consultar si la cédula existe en la tabla de prospectos
        $sql = "SELECT * FROM datosatletas WHERE Identificacion = '$cedula'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            //consulta de datos del atleta en tabla datosateltas
            $row = $result->fetch_assoc();
            $documentoBD = $row['TDocumento'];
            $cedulaBD = $row['Identificacion'];
            $NombreBD=$row['Nombre'];
            $ApellidoBD=$row['Apellido'];
            $SexoBD=$row['Sexo'];
            $FnacimientoBD=$row['Fnacimiento'];
            $SangreBD=$row['Sangre'];
            $emailBD = $row['email'];
            $CelBD = $row['Cel'];
            $DireccionBD = $row['Direccion'];
            $CiudadBD = $row['Ciudad'];
            $PaisBD = $row['Pais'];
            $ContactoEmerBD = $row['ContactoEmer'];

            //  compara los datos de la base de datos atletas con los del formato para ver si cambiaron alguno y si cambiaron aupdate en datos atletas
            // Comparar variables una por una
            if ($documentoBD !== $documento || $cedulaBD !== $cedula ||$NombreBD !== $Nombre || $ApellidoBD !== $Apellido || $SexoBD !== $Sexo || 
                $FnacimientoBD !== $Fnacimiento || $Sangre !== $Sangre || $emailBD !== $email || $CelBD !== $Cel || $DireccionBD !== $Direccion || 
                $CiudadBD !== $Ciudad || $PaisBD !== $Pais || $ContactoEmerBD !== $ContactoEmer) {
                // Si al menos una variable es diferente, realizar la inserción o actualización en la tabla

                $sqlActualizar = "UPDATE datosatletas SET Identificacion = '$cedula', Nombre='$Nombre', Apellido='$Apellido', Sexo='$Sexo', Fnacimiento ='$Fnacimiento',
                Sangre='$Sangre', email = '$email', Cel = '$Cel', Direccion = '$Direccion', 
                Ciudad = '$Ciudad', Pais = '$Pais', ContactoEmer = '$ContactoEmer' 
                WHERE Identificacion = '$cedula'";

                if ($conn->query($sqlActualizar) === TRUE) {
                       // echo "Los datos han sido actualizados correctamente.";
                } else {
                        echo "Error al actualizar los datos: " . $conn->error;
                }
 
            } else {
                // Si, todas las variables son iguales, no es necesario hacer nada
                //echo "No hay cambios que realizar.";
            }
        }
        
        $conn->close();
       
        if ( $atletanoestaendatosatleta="1") {
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

            // Consultar si la cédula existe en la tabla de entregakits
            $sqlInser2 = "SELECT * FROM datosatletas WHERE Identificacion = '$cedula'";
            $result = $conn->query($sqlInser2);

            if ($result->num_rows > 0) {
            // Cédula encontrada, no hay cambios que realizar
            
            } else {
                $insertSql2 = "INSERT INTO datosatletas (TDocumento,Identificacion, Nombre, Apellido, Sexo, Fnacimiento, Sangre, email, Cel, Direccion, Ciudad, Pais, ContactoEmer) VALUES ('$documento','$cedula','$Nombre', '$Apellido', '$Sexo', '$Fnacimiento', '$Sangre', '$email', '$Cel', '$Direccion', '$Ciudad', '$Pais', '$ContactoEmer')";

                if ($conn->query($insertSql2) === TRUE) {
                     // echo"  Registro exitoso no hace nada";
                    
                } else {
                    echo "Error al actualizar los datos: " . $conn->error;
                }
            } 

        }else {
            // Cédula encontrada, no hay cambios que realizar
        }


    ?>
 
 
<!--//zona de scrip    -->
</body>
</html>