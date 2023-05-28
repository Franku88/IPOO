<?php
    include("Cliente.php");
    include("Moto.php");
    include("Venta.php");
    include("Empresa.php");
    
    main();

    function main() {
        $col = cargarColeccion();
        print_r($col);
    }

    function cargarColeccion() {
        $col = [1,2,3,4,5];
        return $col;
    }

?>