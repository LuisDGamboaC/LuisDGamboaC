<?php


function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', '55957517', 'bienesraices_crud');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}
