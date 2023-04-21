<?php
require '../includes/app.php';
// Proteger esta ruta.
estaAutenticado();

use App\Propiedad;
use App\Vendedor;


$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

$resultado = $_GET['resultado'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Tiene que ser el mismo que en el input eliminar,  name="id"; o no funciona
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {

        $tipo = $_POST['tipo'];

        if(validarTipoContenido($tipo)) {
            // Compara lo que vamos a eliminar

            if($tipo === 'vendedor') {

                $vendedor = Vendedor::find($id);
            
                $vendedor->eliminar();

            } else if ($tipo === 'propiedad'){

                $propiedad = Propiedad::find($id);

                $propiedad->eliminar();

            }
        }

        
    }
}

// Importar el Template

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1 class="fw-300 centrar-texto">Administración</h1>
    <?php 
    $mensaje = mostrarNotificacion(intval($resultado)); 
    if($mensaje){ ?>
        <p class="alerta exito"><?php echo s($mensaje) ?> </p>

   <?php }?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nueva Vendedor</a>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($propiedades as $propiedad): ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td>
                    <img src="/imagenes/<?php echo $propiedad->imagen; ?>"" width="100" class="imagen-tabla">
                </td>
                <td>$ <?php echo $propiedad->precio; ?></td>
                <td>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                    <input type="hidden" name="tipo" value="propiedad">  
                    <input type="submit" class="boton boton-rojo" value="Borrar">
                    <!-- href="/admin/propiedades/borrar.php"  -->
                </form>
                    
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton boton-verde">Actualizar</a>
                </td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
    
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td>
                    <img src="/imagenes/<?php echo $vendedor->imagen; ?>"" width="100" class="imagen-tabla">
                </td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>"> 
                    <input type="hidden" name="tipo" value="vendedor">  
                    <input type="submit" class="boton boton-rojo" value="Borrar">
                    <!-- href="/admin/propiedades/borrar.php"  -->
                </form>
                    
                    <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton boton-verde">Actualizar</a>
                </td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<?php 
    incluirTemplate('footer');
?>