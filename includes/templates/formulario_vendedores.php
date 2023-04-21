<fieldset>
    <legend>Información General</legend>

        <label for="nombre">Nombre:</label>
        <input name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre del vendedor" value="<?php echo s( $vendedor->nombre); ?>">

        <label for="apellido">Apellido:</label>
        <input name="vendedor[apellido]" type="text" id="apellido" placeholder="Apellido del vendedor" value="<?php echo s( $vendedor->apellido); ?>">


</fieldset>

<fieldset>
    <legend>Información Extra</legend>
    
    <label for="telefono">Teléfono:</label>
    <input name="vendedor[telefono]" type="number" id="telefono" placeholder="Teléfono del vendedor" value="<?php echo s( $vendedor->telefono); ?>">

    <label for="imagen">Imagen: </label>
        <input name="vendedor[imagen]" type="file" id="imagen" accept="image/jpeg, image/png">
    <?php if($vendedor->imagen): ?>
        <img src="/imagenes/<?php echo $vendedor->imagen ?>" class="imagen-small">
    <?php endif; ?>

</fieldset>
