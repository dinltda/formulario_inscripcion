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
    <title>PROCESO INGRESO DATOS ATLETA </title>
    <!-- Aquí puedes incluir etiquetas meta, enlaces a archivos CSS, etc. -->
    <link rel="stylesheet" href="estilos.css">


</head>
<body>
    <?php
        $cedula = $_GET['cedula'];
        $fpago = $_GET['fpago'];
        $NComprob = $_GET['NComprob'];
        $nombreArchivo = $_GET['nombreArchivo'];
        $codigo=$_GET['codigo'];

        // En esta parte del archivo se abre la base de datos de datosatletas y se verifica que la ceudla de prospecto este en datostletas si es asi se saca las variables para luego ser puestas en el formulario
        // si la cedula del prospecto no esta ne datos atletas, se debe ademas guardar los datos del atleta en datos atelta    
         // Conexión a la base de datos (reemplaza los valores con los tuyos)
         $servername = "localhost";
         $username = "edgar";
         $password = "salitreplaza05%%";
         $database = "inscripcionsai";
 
        // $server="localhost:3306"; para la nube
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
             $Nombres = $row['nombres'];
             $Apellidos = $row['apellidos'];
             $Cel = $row['celular'];
             $email = $row['email'];
         }
          else {
             // Cédula no encontrada, esto no debe pasar en este paso, pero por si acaso se pone la advertencia
             echo "Debe iniciar desde cero el proceso de inscripción";
             // *******en el programa de la nuve se debe cambiar la url
             echo "<div align='center'><a href='prospecto.php' target='_blank'>Regresar</a></div>";
           }
         
 
         $conn->close();
  
       // aqui se abre la base de datos de datosatletas para que con la cedula que se trae, se saque los datos del atleta si esa cedual no es encontrada, en el 
       //gravardatos, quedará registran en los datos de atleta.
       
        // Conexión a la base de datos (reemplaza los valores con los tuyos)
        $servername = "localhost";
        $username = "edgar";
        $password = "salitreplaza05%%";
        $database = "inscripcionsai";

        //aqui estaban las variables en "" cero
        $Sexo="";
        $Sangre="";
        $Direccion="";
        $Ciudad="";
        $Pais="Colombia";
        $ContactoEmer="";


       // $server="localhost:3306";
       
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión a la base de datos
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Consultar si la cédula existe en la tabla de prospectos
        $sql3 = "SELECT * FROM datosatletas WHERE identificacion = '$cedula'";
        $result3 = $conn->query($sql3);

        if ($result3->num_rows > 0) {
            // Cédula encontrada, se extracta cada dato para ponerlo en prellenado de casilla
            $row = $result3->fetch_assoc();
            $documento = $row['TDocumento'];
            $Nombres = $row['Nombre'];
            $Apellidos = $row['Apellido'];
            $Sexo = $row['Sexo'];
            $Fnacimiento = $row['Fnacimiento'];
            $Fnacimiento = date('Y-m-d', strtotime($Fnacimiento));
            $Sangre = $row['Sangre'];
            $email = $row['email'];
            $Cel = $row['Cel'];
            $Direccion = $row['Direccion'];
            $Ciudad = $row['Ciudad'];
            $Pais = $row['Pais'];
            $ContactoEmer = $row['ContactoEmer'];
            $Toxico = $row['Toxico'];
            $atletanoestaendatosatleta=0;
            
        } else {
           $atletanoestaendatosatleta=1; 
          
        }

        $conn->close();
       

    ?>

    <form action="grabardatosatleta.php" class="form" method="POST" enctype="multipart/form-data">     
        <input type="hidden" name="atletanoestaendatosatleta" value="<?php echo $atletanoestaendatosatleta; ?>">
        <input type="hidden" name="cedula" value="<?php echo $cedula; ?>"><!-- Sale de prospectos -->
        <input type="hidden" name="Fpago" value="<?php echo $fpago; ?>"><!-- Sale de formulario actual -->
        <input type="hidden" name="NComprob" value="<?php echo $NComprob; ?>"><!-- Sale de formulario actual -->
        <input type="hidden" name="NComprob" value="<?php echo $NComprob; ?>"><!-- Sale de formulario actual -->
        <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"><!-- Sale de formulario actual -->
        <input type="hidden" name="documento" value="<?php echo $documento; ?>"><!-- Sale de prospectos o datos atletas -->
        <input type="hidden" name="Nombre" value="<?php echo $Nombres; ?>"><!-- Sale de prospectos o datos atletas-->
        <input type="hidden" name="Apellido" value="<?php echo $Apellidos; ?>"><!-- Sale de prospectos o datos atletas -->     
        <input type="hidden" name="Cel" value="<?php echo $Cel; ?>"><!-- Sale de prospectos o datos atleta -->     
        <input type="hidden" name="email" value="<?php echo $email; ?>"><!-- Sale de prospectos o datos atletas -->     
        
        <div class="form__container">
            
            <div class="form__group">
                <h2>Módulo de Ingreso de datos del atleta y prueba a la que se inscribe</h2>
                <br>
                
                <!-- OBSERVACIONE
                    // Se debe consultar la base de datos para ver si ya se tiene los datos del atleta y si se los tiene se los importa de la BD 
                /y se los inscrusta en el formulario
                tambien tener en cuenta la hora en que se inscribe el atleta, eso debe hacerse cuando el atleta entre a ese seccion de ingreso datos atleta
                -->
                
                
                
                <label for="sexo" class="form__label">Género</label><br>
                <select name="sexo" id="sexo" required class="form__select" >
                    <option value="<?php echo $Sexo; ?>" required class="form__input"><?php echo $Sexo; ?></option>
                    <option value="Masculino" required class="form__input">Masculino</option>
                    <option value="Femenino" required class="form__input">Femenino</option>
                </select>
                <span class="form__line"></span>
            </div>
            
            <br>
                       
            <div class="form__group">
                <label for="fnacimiento" >Fecha de nacimiento</label>
                <!-- <input type="date" id="fnacimiento" class="form__input" placeholder="" required name="fnacimiento" value="<?php echo date('Y-m-d'); ?>"> -->
                <input type="date" id="fnacimiento" class="form__input" placeholder="" required name="fnacimiento" value="<?php echo $Fnacimiento; ?>">
                <span class="form__line"></span>
            </div>
            
            <br>
            
            <div class="form__group">
                <label for="sangre" class="form__label">Sangre</label><br>
                <select name="sangre" id="sangre" required class="form__select" >
                    <option value="<?php echo $Sangre?>" required class="form__input"><?php echo $Sangre?></option>
                    <option value="A+" required class="form__input">A+</option>
                    <option value="A+" required class="form__input">A-</option>
                    <option value="A+" required class="form__input">B+</option>
                    <option value="A+" required class="form__input">B-</option>
                    <option value="A+" required class="form__input">AB+</option>
                    <option value="A+" required class="form__input">AB-</option>
                    <option value="A+" required class="form__input">O+</option>
                    <option value="A+" required class="form__input">O-</option>
                </select>
                <span class="form__line"></span>
            </div>

            <br>

            <div class="form__group">
                <label for="direccion" class="form__label">Direccion</label>
                <input type="text" id="direccion" class="form__input" placeholder="" required name="direccion" value="<?php echo $Direccion; ?>">
                <span class="form__line"></span>
            </div>
            <br> 
            <div class="form__group">
                <label for="email" class="form__label">Correo Electrónico</label>
                <input type="text" id="email" class="form__input" placeholder="" required name="email" value="<?php echo $email; ?>">
                <span class="form__line"></span>
            </div>
            <br>
            
            <div class="form__group">
                <label for="ciudad" class="form__label">Ciudad</label><br>
                <select name="ciudad" id="ciudad" required class="form__select" >
                    
                    <option value="<?php echo $Ciudad?>" required class="form__input"><?php echo $Ciudad?></option>
                    <option value="Armenia" required class="form__input">Armenia</option>
                    <option value="Barranquilla" required class="form__input">Barranquilla</option>
                    <option value="Bogota" required class="form__input">Bogotá</option>
                    <option value="Bucaramanga" required class="form__input">Bucaramanga</option>
                    <option value="Cali" required class="form__input">Cali</option>
                    <option value="Cartagena" required class="form__input">Cartagena</option>
                    <option value="Cucuta" required class="form__input">Cúcuta</option>
                    <option value="Florencia" required class="form__input">Florencia</option>
                    <option value="Ibague" required class="form__input">Ibagué</option>
                    <option value="Leticia" required class="form__input">Leticia</option>
                    <option value="Manizales" required class="form__input">Manizales</option>
                    <option value="Medellin" required class="form__input">Medellín</option>
                    <option value="Mitú" required class="form__input">Mitú</option>
                    <option value="Mocoa" required class="form__input">Mocoa</option>
                    <option value="Monteria" required class="form__input">Montería</option>
                    <option value="Neiva" required class="form__input">Neiva</option>
                    <option value="Palmira" required class="form__input">Yopal</option>
                    <option value="Pasto" required class="form__input">Pasto</option>
                    <option value="Pereira" required class="form__input">Pereira</option>
                    <option value="Popayan" required class="form__input">Popayán</option>
                    <option value="Puerto Carreno" required class="form__input">Puerto Carreño</option>
                    <option value="Quibdo" required class="form__input">Quibdó</option>
                    <option value="Riohacha" required class="form__input">Riohacha</option>
                    <option value="San Andres" required class="form__input">San Andrés</option>
                    <option value="San Jose del Guaviare" required class="form__input">San José del Guaviare</option>
                    <option value="Santa Marta" required class="form__input">Santa Marta</option>
                    <option value="Sincelejo" required class="form__input">Sincelejo</option>
                    <option value="Tunja" required class="form__input">Tunja</option>
                    <option value="Valledupar" required class="form__input">Valledupar</option>
                    <option value="Villavicencio" required class="form__input">Villavicencio</option>
                    <option value="Yopal" required class="form__input">Yopal</option>
                    <option value="Otra ciudad" required class="form__input">Otra ciudad</option>

                </select>
                <br>
                <div id="otraCiudad" style="display: none;">
                    <label for="otraCiudadInput" class="form__label">Ingrese el nombre de la ciudad:</label>
                    <input type="text" id="otraCiudadInput" class="form__input" placeholder="Ingrese el nombre de la ciudad" name="otraCiudad">
                </div>

                <script>
                    const selectCiudad = document.getElementById('ciudad');
                    const divOtraCiudad = document.getElementById('otraCiudad');

                    selectCiudad.addEventListener('change', function() {
                        if (selectCiudad.value === 'Otra ciudad') {
                            divOtraCiudad.style.display = 'block';
                            // Establecer el nombre del select como el nombre de la ciudad ingresada manualmente
                            selectCiudad.name = 'otraCiudad';
                        } else {
                            divOtraCiudad.style.display = 'none';
                            // Restaurar el nombre original del select
                            selectCiudad.name = 'ciudad';
                        }
                    });
                </script>

                <br><br>  
                
                <label for="pais" class="form__label">País</label><br>
                <select name="pais" id="pais" required class="form__select" >
                    <option value="<?php echo $Pais ?>" required class="form__input"><?php echo $Pais ?></option>
                    <option value="Colombia" required class="form__input">Colombia</option>
                    <option value="Argentina" required class="form__input">Argentina</option>
                    <option value="Brasil" required class="form__input">Brasil</option>
                    <option value="Chile" required class="form__input">Chile</option>
                    <option value="Ecuador" required class="form__input">Ecuador</option>
                    <option value="Perú" required class="form__input">Perú</option>
                    <option value="Uruguay" required class="form__input">Uruguay</option>
                    <option value="Paraguay" required class="form__input">Paraguay</option>
                    <option value="Bolivia" required class="form__input">Bolivia</option>
                    <option value="Venezuela" required class="form__input">Venezuela</option>
                    <option value="México" required class="form__input">México</option>
                    <option value="Estados Unidos" required class="form__input">Estados Unidos</option>
                    <option value="Canadá" required class="form__input">Canadá</option>
                    <option value="España" required class="form__input">España</option>
                    <option value="Francia" required class="form__input">Francia</option>
                    <option value="Alemania" required class="form__input">Alemania</option>
                    <option value="Italia" required class="form__input">Italia</option>
                    <option value="Inglaterra" required class="form__input">Inglaterra</option>
                    <option value="China" required class="form__input">China</option>
                    <option value="Japón" required class="form__input">Japón</option>
                    <option value="India" required class="form__input">India</option>
                    <option value="Australia" required class="form__input">Australia</option>
                    <option value="Nueva Zelanda" required class="form__input">Nueva Zelanda</option>
                    <option value="Sudáfrica" required class="form__input">Sudáfrica</option>
                    <option value="Rusia" required class="form__input">Rusia</option>
                    <option value="Alemania" required class="form__input">Alemania</option>
                    <option value="Austria" required class="form__input">Austria</option>
                    <option value="Bélgica" required class="form__input">Bélgica</option>
                    <option value="Corea del Sur" required class="form__input">Corea del Sur</option>
                    <option value="Costa Rica" required class="form__input">Costa Rica</option>
                    <option value="Dinamarca" required class="form__input">Dinamarca</option>
                    <option value="El Salvador" required class="form__input">El Salvador</option>
                    <option value="Finlandia" required class="form__input">Finlandia</option>
                    <option value="Guatemala" required class="form__input">Guatemala</option>
                    <option value="Honduras" required class="form__input">Honduras</option>
                    <option value="Hungría" required class="form__input">Hungría</option>
                    <option value="India" required class="form__input">India</option>
                    <option value="Irlanda" required class="form__input">Irlanda</option>
                    <option value="Islandia" required class="form__input">Islandia</option>
                    <option value="Israel" required class="form__input">Israel</option>
                    <option value="Jamaica" required class="form__input">Jamaica</option>
                    <option value="Mónaco" required class="form__input">Mónaco</option>
                    <option value="Nicaragua" required class="form__input">Nicaragua</option>
                    <option value="Nigeria" required class="form__input">Nigeria</option>
                    <option value="Noruega" required class="form__input">Noruega</option>
                    <option value="Nueva Zelanda" required class="form__input">Nueva Zelanda</option>
                    <option value="Países Bajos" required class="form__input">Países Bajos</option>
                    <option value="Panamá" required class="form__input">Panamá</option>
                    <option value="Polonia" required class="form__input">Polonia</option>
                    <option value="Portugal" required class="form__input">Portugal</option>
                    <option value="República Checa" required class="form__input">República Checa</option>
                    <option value="República Dominicana" required class="form__input">República Dominicana</option>
                    <option value="Singapur" required class="form__input">Singapur</option>
                    <option value="Sudáfrica" required class="form__input">Sudáfrica</option>
                    <option value="Suecia" required class="form__input">Suecia</option>
                    <option value="Suiza" required class="form__input">Suiza</option>
                    <option value="Tailandia" required class="form__input">Tailandia</option>
                    <option value="Taiwán" required class="form__input">Taiwán</option>
                    <option value="Trinidad y Tobago" required class="form__input">Trinidad y Tobago</option>
                    <option value="Túnez" required class="form__input">Túnez</option>
                    <option value="Turquía" required class="form__input">Turquía</option>
                    <option value="Ucrania" required class="form__input">Ucrania</option>
                    
            </select>
                    <br><br>
                               
            </div> 
 
            <div class="form__group">
                    <label for="aerolinea" class="form__label">Ingrese la Aerolínea (si aún no la tiene, dejar la casilla en blanco)</label>
                    <!-- La parte final de la siguiente linea hace que el texto ingresado lo pase todo a  en mayusculas -->
                    <input type="text" id="aerolinea" class="form__input" placeholder="" name="aerolinea" oninput="this.value = this.value.toUpperCase()">
                    <span class="form__line"></span>
            </div>

            <br><br>

            <div class="form__group">
                <label for="fechaida" >Fecha de Ida (si no tiene el pasaje comprado, deje la casilla en blanco)</label>
                <input type="date" id="fechaida" class="form__input" placeholder="" name="fechaida" >
                <span class="form__line"></span>
            </div>

            <br><br>

            <div class="form__group">
                <label for="fecharegreso" >Fecha de Regreso (si no tiene el pasaje comprado, deje la casilla en blanco)</label>
                <input type="date" id="fecharegreso" class="form__input" placeholder="" name="fecharegreso">
                <span class="form__line"></span>
            </div>

            <br><br>

            <div class="form__group">
                <label for="distancia" class="form__label">Elije tu RETO (prueba) a Correr:</label><br>
                <select name="distancia" id="distancia" required class="form__select" >
                    <option value="5K Categría Única" required class="form__input">5K Categría Única</option>
                    <option value="Vuelta a la Isla 32,5K" required class="form__input">Vuelta a la Isla 32,5K</option>
                    <option value="21K Categría Única" required class="form__input">21K Categría Única</option>
                    <option value="10K Categría Única" required class="form__input">10K Categría Única</option>
                    
                </select>
                <span class="form__line"></span>
            </div>

            <br><br>

            <div class="form__group">
                <label for="talla" class="form__label">Talla Camiseta (no se proveera de tallas diferentes a las indicadas):</label><br>
                <select name="talla" id="talla" required class="form__select" >
                    
                    <option value="S" required class="form__input">S</option>
                    <option value="M" required class="form__input">M</option>
                    <option value="L" required class="form__input">L</option>
                    <option value="XL" required class="form__input">XL</option>
                </select>
                <span class="form__line"></span>
            </div>

            <br><br>

            <div class="form__group">
                <label for="autoriza" class="form__label">¿Autoriza que su nombre, club al que pertenece, ciudad y país se publiquen en los resultados ?:</label><br>
                <select name="autoriza" id="autoriza" required class="form__select" >
                    <option value="Autoriza" required class="form__input">Si Autorizo</option>
                    <option value="No Autoriza" required class="form__input">No Autorizo</option>
                </select>
                <span class="form__line"></span>
            </div>

            <br><br>

            <div class="form__group">
                <label for="club" class="form__label">Club</label>
                <input type="text" id="club" class="form__input" placeholder=""  name="club">
                <span class="form__line"></span>
            </div>

            <br><br>
 
            <div class="form__group">
                <label for="contactoemergencia" class="form__label">Ingrese Nombre y Celular de un contacto para casos de emergencia Ejemplo: Gonzálo González    313890111</label>
                <input type="text" id="contactoemergencia" class="form__input" placeholder=""  name="contactoemergencia" value="<?php echo $ContactoEmer ?>">
                <span class="form__line"></span>
            </div>

            <br><br>

            <div class="form__group">
                <label for="observaciones" class="form__label">Observaciones</label>
                <input type="text" id="observaciones" class="form__input" placeholder=""  name="observaciones">
                <span class="form__line"></span>
            </div>

            <br><br>

            <div class="form__group">
                    
                <label for="declaracion" class="form__label"> DECLARACIÓN DE LIBERACION O EXONERACIÓN DE RESPONSABILIDADES, TÉRMINOS DE PARTICIPACIÓN EN LA CARRERA, Y AUTORIZACIÓN</label>
                <br><br>
                <div style="height: 200px;  overflow-y: scroll; ; border: 1px solid black;">
                    Quien suscribe con el diligenciamiento de los datos de inscripción, por mi mismo o por interpuesta persona y/o con la firma
                    y/o con la aceptación y/o con el porte del número de competencia y/o con el porte de la camiseta de competencia y/o por la 
                    presencia activa en el evento, declaro conocidos, leídos, entendidos y aceptados todos y cada uno de los términos e indicaciones
                    de participación en la XV VUELTA A LA ISLA DE SAN ANDRÉS a celebrarse el 28 de abril de 2024. Así mismo, dejo expresa constancia
                    de lo siguiente: Que conozco a la Asociación de Atletismo Master Club Olimpus (en adelante “Club Olimpus”), en desarrollo de su
                    objeto social, se encuentra organizando el evento “XV VUELTA A LA ISLA DE SAN ANDRÉS”, en conjunto con la Liga de Atletismo de 
                    Bogotá, en la cual he decidido participar de manera libre, voluntaria, expresa y con total conocimiento de lo que ello implica 
                    (en adelante la “Carrera”). Que en virtud del presente documento, declaro conocidos, entendidos y aceptados para mí todos los
                    términos acá dispuestos y todos los riesgos que pudieren derivarse de mi participación en la carrera. Declaro que cumpliré a 
                    cabalidad con lo dispuesto en el reglamento de carrera- que me ha sido puesta en conocimiento previamente en www.clubol.org  
                    www.sanandres32k.co. Declaro que reconozco que este evento deportivo es una actividad potencialmente peligrosa y que mi participación
                    es estrictamente voluntaria y libre de cualquier vicio. Por lo anterior, me acojo y respetaré estrictamente el reglamento de 
                    participación al igual que las medidas de seguridad para el desarrollo del evento; todo lo cual me ha sido previamente informado
                    en la página www.clubol.org o www.sanandres32k.co. En consecuencia, me comprometo a observar todas las reglas y avisos de la Carrera,
                    a seguir cualquier directriz o recomendación dada por ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS o por su personal, o por la Liga
                    de Atletismo o por la Gobernación de San Andrés,  para el desarrollo de la carrera y a respetar cualquier decisión que el personal
                    de la organización tomen respecto de mi participación en la Carrera o en los entrenamientos. Así mismo, manifiesto entender que en
                    la Carrera deberé tener un comportamiento apropiado a la moral y buenas costumbres, incluyendo el respeto por otras personas,
                    indumentaria y equipo, instalaciones o propiedad ajena. En este sentido, y en el evento en que el personal de ASOCIACIÓN DE ATLETISMO
                    MASTER CLUB OLIMPUS considere que debo suspender mi participación en la Carrera o en el entrenamiento, lo haré inmediatamente
                    sin que haya lugar a reembolso a mi favor de cualquier suma pagada o invertida en la Carrera o entrenamiento. Manifiesto que al
                    inscribirme al evento y/o el diligenciamiento y firma del documento “ Confirmación de Términos de Participación en la Carrera, 
                    Declaración de Responsabilidades y Autorización”, entiendo y acepto todos y cada uno de los términos e indicaciones para mi 
                    correcta participación en la Carrera, los cuales me fueron suministrados previamente y entiendo que el costo de la inscripción no es
                    reembolsable bajo ninguna circunstancia y/o evento que no permita mi participación en la Carrera, (como es el caso de lesión del
                    atleta, calamidad doméstica, fallecimiento de un familiar, enfermedad, pandemias, quiebra de aerolíneas, entre otros), salvo aquellos
                    eventos de culpa atribuible a ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS. En todo caso entiendo que ASOCIACIÓN DE ATLETISMO 
                    MASTER CLUB OLIMPUS se reservará el derecho a cancelar el Entrenamiento o la Carrera por cualquier circunstancia. Declaro y reconozco
                    de antemano que la Carrera puede llegar a ser una actividad potencialmente peligrosa para mi salud e integridad  física, e incluso
                    puede conllevar riesgo de muerte y, que no obstante esta situación y de haber sido advertida (o) específicamente de ello, deseo
                    participar de manera voluntaria en la misma, en sus entrenamientos, ferias y eventos asociados y, por lo tanto, manifiesto de manera
                    expresa que no sufro de ninguna enfermedad o padezco de afección física o psicológica alguna, que me impida llevar a cabo mi
                    participación en el Entrenamiento / Carrera de manera sana y sin perjuicios para mi integridad física o moral. Declaro que me
                    encuentro en perfectas condiciones de salud y capacitada para participar en la Carrera / entrenamiento, y en la actualidad me
                    encuentro afiliada (o) y cotizando al Sistema General de Salud en la EPS referenciada en el encabezado de este documento y/o en
                    el documento de inscripción respectivo. Entiendo y acepto que mi participación en la Carrera / Entrenamiento, así como el
                    desplazamiento al y por el lugar en el que se va a realizar, implica la realización de actividades que pueden conllevar 
                    riesgos para mi salud e integridad física, pues se trata de actividades que generan mi exposición a posibles daños, 
                    accidentes, pérdidas de elementos personales, enfermedades y lesiones físicas de diversa índole y gravedad tales como, 
                    pero sin limitarse, a fallas repentinas de mi sistema cardiovascular, accidentes simples o fatales que puedan ocurrir 
                    mientras me encuentre en las locaciones de la Carrera, así como toda clase de accidentes, caídas y enfermedades generadas 
                    por contacto con otros asistentes, consecuencias del clima incluyendo temperatura y/o humedad, tránsito vehicular, 
                    condiciones topográficas del recorrido propio de la Carrera y, en general, todos los riesgos que existen naturalmente 
                    como consecuencia de mi participación en la Carrera, los cuales declaro que conozco y los he valorado y, por lo tanto, 
                    desde ahora libero y eximo consciente y expresamente a ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS, así como a sus 
                    aliadas, contratistas, administradores, dependientes, empleados, voluntarios y representantes, a la Gobernación de 
                    San Andrés, a la Secretaria y/o Instituto del Deporte de San Andrés, a patrocinadores, sus representantes y sucesores 
                    de toda responsabilidad por cualquier tipo de lesión, enfermedad, daño, extravío, robo, hurto o perjuicio, cualquiera 
                    que sea su gravedad y aun en caso de mi fallecimiento, incluidos los ocurridos por caso fortuito o fuerza mayor, que 
                    sufra con ocasión de mi participación en la Carrera, todo lo anterior de conformidad con la Ley. En particular, 
                    reconozco expresamente que ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS me informó expresamente que sus programas 
                    de entrenamiento y la participación en la Carrera no se encuentran diseñados para individuos con afecciones, 
                    insuficiencias o problemas cardiacos. Declaro que entiendo, he valorado y acepto los riesgos que pueden llegar 
                    a presentarse por ser la Carrera una aglomeración de público y por contar con la presencia de numerosas personas 
                    en movimiento, caso en el cual pueden generarse demoras en los traslados y llegadas de las ambulancias, así como 
                    en la prestación de asistencia, motivo por el cual para los efectos excluyo de toda responsabilidad a ASOCIACIÓN 
                    DE ATLETISMO MASTER CLUB OLIMPUS como organizador del evento. Por medio del presente documento, doy mi consentimiento 
                    para que en caso de ser ello necesario, me den tratamiento médico y/o de primeros auxilios el personal capacitado 
                    dispuesto para el efecto y me transporten a las instalaciones sanitarias u hospitalarias requeridas. En consecuencia, 
                    entiendo expresamente que es posible que en algunos puntos no existan puntos de tratamiento médico y/o primeros 
                    auxilios a disposición de las (los ) corredoras (es ) en la Carrera, no obstante en caso de haberlo, asumiré todos los 
                    gastos y costos médicos en los que se incurran como consecuencia de mi participación en la Carrera, incluyendo pero 
                    sin limitarse a ello, transporte de ambulancia, hospitalización, atención médica, medicamentos y productos farmacéuticos. 
                    En cualquier evento, manifiesto expresamente conocer que las obligaciones de ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS 
                    / EVENTO, en relación con la atención de primeros auxilios, médica y el servicio ambulancia, consiste en coordinar para 
                    que terceros especialistas en estos temas estén disponibles para prestar dichos servicios en la Carrera o Entrenamiento, 
                    sin que en ningún momento ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS, así como de sus aliadas, vinculadas, 
                    patrocinadoras y cualquier persona natural y/o jurídica vinculadas con la Carrera o entrenamiento, sean responsables 
                    por el resultado final de la prestación de dichos servicios. Así mismo, declaro expresamente que autorizo a ASOCIACIÓN 
                    DE ATLETISMO MASTER CLUB OLIMPUS, para que esta entidad o la persona que ésta indique, utilicen los videos y las 
                    fotografías en las que aparece mi imagen y mi voz, como consecuencia de mi participación en la Carrera, para que éstos 
                    sean reproducidos, puestos a disposición y comunicados tanto en la página web y redes sociales de ASOCIACIÓN DE ATLETISMO 
                    MASTER CLUB OLIMPUS así como por cualquier forma de comunicación al público por cualquier medio conocido, por cualquier 
                    forma, procedimiento y tecnología por un término indefinido y en cualquier territorio, para los fines de promocionar las 
                    actividades que desarrolla ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS. De igual forma, autorizo expresamente a ASOCIACIÓN 
                    DE ATLETISMO MASTER CLUB OLIMPUS a utilizar dichas fotografías y videos en conexión con sus marcas. Por otra parte, 
                    reconozco que tanto ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS, como el tercero que esta autorice, podrá utilizar mis 
                    datos personales tanto para fines institucionales y publicitarios así como para difundirlos en los medios digitales, 
                    redes sociales o cualquier otro medio que consideren pertinente. Autorizo, libre y expresamente a ASOCIACIÓN DE ATLETISMO 
                    MASTER CLUB OLIMPUS para que como Encargado y Responsable del Tratamiento de mis datos personales, los utilice, 
                    transfiera, y transmita, por cualquier medio, lapso de tiempo y en cualquier territorio; datos personales que incluyen 
                    datos de contacto, familiares, historial médico, imágenes, grabaciones y fotografías. Así mismo, de antemano autorizo 
                    expresamente para que dicha información personal sea utilizada por ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS para 
                    poder recibir información y comunicaciones vía mensajes SMS referentes a la Carrera, sus entrenamientos y actividades 
                    promocionales y comerciales. Declaro expresamente conocer y entender que mi inscripción en la Carrera es personal e 
                    intransferible, lo cual incluye el número que me sea asignado así como cualquier elemento de participación, incluyendo 
                    pero sin limitarse a chips, y camisetas. En consecuencia, gestionaré personalmente la recogida de estos materiales. 
                    Así mismo en caso de no poder participar en la Carrera manifiesto expresamente que no podré ceder mi inscripción ni mi 
                    número bajo ninguna circunstancia y que ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS no será responsable en modo alguno 
                    por cualquier circunstancia, acto o efecto que pueda surgir de la transferencia de mi inscripción y/o materiales de 
                    participación.  Así mismo, e independientemente del caso, declaro que excluyo de toda responsabilidad al organizador del 
                    evento y a sus patrocinadores si: he mentido u ocultado dolosamente información sobre mi estado de salud; si participo 
                    aun a pesar de ignorar que padezco alguna enfermedad, dolencia, estado mental o físico que sea contra indicado para 
                    practicar deporte; si participo aun habiendo consumido alcohol, drogas, medicamentos o llevado a cabo conductas que 
                    puedan alterar la tolerancia del cuerpo al esfuerzo físico.  Por virtud de este documento declaro que tengo el derecho 
                    de otorgar la presente autorización y exención de responsabilidad y no tengo vínculos contractuales que me lo impidan. 
                    En todo caso responderé por cualquier reclamo relacionado con los derechos objeto de esta autorización, exonerando de 
                    cualquier responsabilidad a ASOCIACIÓN DE ATLETISMO MASTER CLUB OLIMPUS, o cualquiera de sus representantes o empleados 
                    y en general mantendré solidariamente indemne a los anteriores por cualquier reclamación o demanda que le presente un 
                    tercero por los mismos. Así mismo, soy consciente de que la Carrera tiene un tiempo restringido de uso de las vías públicas 
                    y escenarios de desarrollo. En consecuencia, entiendo que las carreteras en las que se correrá estarán abiertas al tránsito 
                    vehicular una vez se agote ese tiempo y no habrán más instalaciones de soporte (médicas, comunicaciones, primeros auxilios) 
                    dispuestas a favor de los participantes en la Carrera, luego de dicha hora. Por tanto, acepto de antemano que a partir de 
                    esa hora me retiraré de la competencia, abandonaré el recorrido y me ubicaré en zonas peatonales seguras. Por último, 
                    declaro conocer y entender que tanto el presente documento como mi participación en la Carrera y/o en cualquiera 
                    de sus entrenamientos se encuentran sometidos a la ley y jurisdicción Colombiana, independientemente de mi nacionalidad 
                    y/o del lugar en el que realice mi inscripción.

                </div>
                    <br>
                    <input type="radio" id="acepto" name="acepto" value="Acepto" required>
                    <label for="acepto" class="form__label">Acepto</label><br>
                </div>

                <br>
        
            </div>
    
        <?php            
           //Este codigo creo que no funciona ya que en el input se colocó el valor 
           $fechaInscripcion = date("Y-m-d H:i" ); // Asigna la fecha actual en formato Año-Mes-Día y hora min seg
           echo  "Su inscripcion quedará registrada con la siguiente fecha: ".$fechaInscripcion;   
           echo  "<br><br>"

            // Puedes usar otras opciones de formato según tus necesidades, por ejemplo:
            // $fechaActual = date("d/m/Y"); // Formato Día/Mes/Año
            // $fechaActual = date("H:i:s"); // Formato Hora:Minutos:Segundos
        ?>
        <input type="hidden" name="fechaInscripcion" value="<?php echo date("Y-m-d H:i"); ?>">
            
        <input type="submit" class="form__submit" value="Enviar">
        <br><br><br><br>
       
    </form>
    
    <!-- Seccion de envio de correo 
       La configuración del servidor de alojamiento web para enviar correos electrónicos puede variar dependiendo del proveedor
       de hosting que estés utilizando. Aquí te proporcionaré una guía general sobre cómo configurar el servidor de alojamiento
        web para enviar correos utilizando la función mail de PHP.
       Obtén los datos de configuración del servidor de correo: Necesitarás los siguientes datos del servidor de correo saliente (SMTP):
        Host SMTP: Especifica la dirección del servidor SMTP. Por ejemplo, para Gmail, el host SMTP es smtp.gmail.com.
        Puerto SMTP: Indica el puerto que se utilizará para establecer la conexión con el servidor SMTP. Por ejemplo, para Gmail, el puerto 
        SMTP seguro es 465.
        Nombre de usuario SMTP: Proporciona el nombre de usuario de la cuenta de correo desde la cual deseas enviar los mensajes.
        Contraseña SMTP: Ingresa la contraseña de la cuenta de correo.
        Configura los datos en tu script PHP: Antes de enviar un correo, deberás configurar los datos del servidor SMTP en tu 
        script PHP. Esto se hace utilizando la función ini_set() de PHP para establecer las opciones SMTP, smtp_port, username y password.
    -->
    <?php
        // Configurar los datos del servidor SMTP
        ini_set('SMTP', 'smtp.gmail.com');
        ini_set('smtp_port', 465);
        ini_set('username', 'clubolimpus@clubol.org');
        ini_set('password', 'salitreplaza05%%1');

        // Resto del código para enviar el correo
        // ...
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $mensaje = $_POST['mensaje'];
        
            // Configurar los datos del correo
            $destinatario = $correo;
            $asunto = "Confirmación de formulario";
            $cuerpo = "Hola $nombre,\n\nGracias por completar el formulario. Aquí está la confirmación de tu mensaje:\n\n$mensaje\n\nSaludos,\nClub Olimpus";
        
            // Configurar el correo de origen
            $remitente = "clubolimpus@clubol.org";
            $cabeceras = "From: $remitente";
        
            // Enviar el correo
            if (mail($destinatario, $asunto, $cuerpo, $cabeceras)) {
                echo "Correo enviado exitosamente a $correo";
            } else {
                echo "Error al enviar el correo";
            }
        }
    ?>





</body>
</html>
