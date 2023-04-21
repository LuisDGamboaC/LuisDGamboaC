<?php

require '../../includes/app.php';

estaAutenticado();
use App\Vendedor;

use Intervention\Image\ImageManagerStatic as Image;

// Verificar el id
$id =  $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id) {
    header('Location: /admin');
}

// Obtener la vendedor
$vendedor = Vendedor::find($id);

// Validar 
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Asignar los atributos
    $args = $_POST['vendedor'];
    // $args['titulo'] = $_POST['titulo'] ?? null;

    $vendedor->sincronizar($args);

    // Validacion
    $errores = $vendedor->validar();

    // genera nombre unico
    $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

    //subida de archivos
    if($_FILES['vendedor']['tmp_name']['imagen']){

        $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
        $vendedor->setImagen($nombreImagen);

    }
    // El array de errores esta vacio
    if (empty($errores)) {
        // Almacenar la imagen
        if($_FILES['vendedor']['tmp_name']['imagen']) {

        $image->save(CARPETA_IMAGENES . $nombreImagen);
        }

       $vendedor->guardar();

    }
}

incluirTemplate('header');
?>

<h1 class="fw-300 centrar-texto">Administración - Editar Vendedor</h1>

<main class="contenedor seccion contenido-centrado">
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">

    </form>

</main>


<?php

incluirTemplate('footer');

mysqli_close($db); ?>

</html>