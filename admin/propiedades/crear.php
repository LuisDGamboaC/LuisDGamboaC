<?php

include '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;

use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

// Consulta para opbtener todos los vendedores

$vendedores = Vendedor::all();

// Validar 

$errores = Propiedad::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propiedad = new Propiedad($_POST['propiedad']);
     
     // genera nombre unico
    $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

   // Setear la imagen
    // Realiza un resize a la imagen con intervention
    if($_FILES['propiedad']['tmp_name']['imagen']){

     $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
     $propiedad->setImagen($nombreImagen);
     }

        //validar
     $errores = $propiedad->validar();

    // El array de errores esta vacio
    if (empty($errores)) {
        
        if(!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
        
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        $propiedad->crear();

    }

}

?>

<?php
$nombrePagina = 'Crear Propiedad';

incluirTemplate('header');
?>



<main class="contenedor seccion contenido-centrado">
    <h1 class="fw-300 centrar-texto">Administración - Nueva Propiedad</h1>
    <a href="/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data" action="/admin/propiedades/crear.php">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>

</main>


<?php

incluirTemplate('footer');

mysqli_close($db); ?>

</html>