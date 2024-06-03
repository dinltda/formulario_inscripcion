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
    <title>PROCESO INSCRIPCION INDIVIDUAL</title>
    <!-- Aquí puedes incluir etiquetas meta, enlaces a archivos CSS, etc. -->
    <link rel="stylesheet" href="estilos.css">


</head>
<body>
    <?php
        $cedula = $_GET['cedula'];
    ?>
    <form action="confirmapago.php" class="form" method="POST" enctype="multipart/form-data">     
        <div >
            
            <div class ="form__ratio">
                
                <label for="Nequi" class="form__label">Forma de Pago</label><br><br>
                <input type="radio"  id="Nequi" name="fpago" value="Nequi" required>
                <label for="Nqui" class="form__label">Nequi</label><br>

                <input type="radio" id="Daviplata" name="fpago" value="Daviplata" required>
                <label for="Daviplata" class="form__label">Daviplata</label><br>

                <input type="radio" id="Efecty" name="fpago" value="Efecty" required>
                <label for="Efecty" class="form__label">Efecty</label><br>

                <input type="radio" id="bcolombia" name="fpago" value="Bancolombia" required>
                <label for="bcolombia" class="form__label">Bancolombia</label><br>

                <input type="radio" id="cajasocial" name="fpago" value="Caja Social" required>
                <label for="cajasocial" class="form__label">Caja Social</label><br>
                 
                <input type="radio" id="efectivo" name="fpago" value="efectivo" required>
                <label for="efectivo" class="form__label">Efectivo</label><br>

                <input type="radio" id="cortesia" name="fpago" value="Cortesia" required>
                <label for="cortesia" class="form__label">Especial</label><br><br>
                
                <!-- pasa la cedula del que se está inscribiendo -->
                <input type="hidden" name="cedula" value="<?php echo $cedula; ?>">
            </div>

            <div class="">
                
                <label for="NComprob" class="form__label">Ingrese:  # DE COMPROBANTE (# que da el medio de pago: Referencia o # de autorizacion. si es efectivo colocar el No. de formulario o Numero asignado).</label>
                <br>
                <label for="NComprob" class="form__label">No. de Comprobante</label>
                <input type="text" id="NComprob" class="form__input" placeholder=" " required name="NComprob">
                <span class="form__line"></span>
            
                
                <br><br>
                <label for="codigo" class="form__label">Ingrese Código</label>
                <input type="text" id="codigo" class="form__input" placeholder=" " required name="codigo">
                <span class="form__line"></span>


                <BR><BR>
                <label for="archivo" class="form__label">Seleccione imagen del soporte (máx. 500KB):</label>
                <br>
                <input type="file" class="form__select id="archivo" name="archivo" accept=".pdf,.doc,.docx" required>
                <input type="submit" value="Subir archivo" >
                <span class="form__line"></span>
            </div>
            
    </form>
</body>
</html>
