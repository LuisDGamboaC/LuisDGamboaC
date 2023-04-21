<?php
include '../../includes/app.php';
// Proteger esta ruta.
estaAutenticado();

use App\Vendedor;

use Intervention\Image\ImageManagerStatic as Image;

$vendedor = new Vendedor;

$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Crear una nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);

    $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

   // Setear la imagen
    // Realiza un resize a la imagen con intervention
    if($_FILES['vendedor']['tmp_name']['imagen']){

     $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
     $vendedor->setImagen($nombreImagen);
     }


    // Validar que no haya campos vacios
    $errores = $vendedor->validar(); // $errores = por que tiene un return self::$errores; en validar de vendedor

    // No hay errores
    if(empty($errores)){

        if(!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
        
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        
        $vendedor->guardar();
    }

    
}


incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">

    <h1 class="fw-300 centrar-texto">Registrar Vendedor</h1>

    <a href="/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data" action="/admin/vendedores/crear.php"> 
        <!-- El enctype sirve para subir imagenes junto a las propieadas esta ves con los vendedores -->
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">

    </form>

</main>


<?php

incluirTemplate('footer');

mysqli_close($db); ?>