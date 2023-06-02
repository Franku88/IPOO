<?php
    include('Cliente.php');
    include('Empresa.php');
    include('Moto.php');
    include('MotoNacional.php');
    include('MotoImportada.php');
    include('Venta.php');
    
    main();

    function main() {
        //1. Creo clientes y coleccion de clientes
        $objCliente1 = new Cliente('Bruno', 'Bassi', false, 'DNI', '000000001');
        $objCliente2 = new Cliente('Julian', 'Maruca', false, 'DNI', '000000002');
        $colClientes = [$objCliente1, $objCliente2];

        //2. Creo motos y coleccion de motos
        $objMoto1 = new MotoNacional('11', 2230000, 2022, 'Benelli Imperiale 400', 85, true, 10);
        $objMoto2 = new MotoNacional('12', 584000, 2021, 'Zanella Zr 150 Ohc', 70, true, 10);
        $objMoto3 = new MotoNacional('13', 999900, 2023, 'Zanella Patagonian Eagle 250', 55, false);
        $objMoto4 = new MotoImportada('14', 12499900, 2020, 'Pitbike Enduro Motocross Apollo Aiii 190cc Plr', 100, true, 'Francia', 6244400);
        $colMotos = [$objMoto1, $objMoto2, $objMoto3, $objMoto4];

        //3. Creo empresa
        $objEmpresa = new Empresa('Alta Gama','Av Argentina 123', $colClientes, $colMotos, []);


        /*4. Invocar al método registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa donde el $objCliente es una
        referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la colección de códigos
        de motos es la siguiente [11,12,13,14]. Visualizar el resultado obtenido*/
        $venta1Resultado = $objEmpresa->registrarVenta([11,12,13,14], $objCliente2);
        echo("Venta 1 realizada al cliente: \n ".$objCliente2->__toString()." \n Monto total de venta: ".$venta1Resultado."\n");
        echo("\n");

        /*5. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el $objCliente es
        una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la colección de
        códigos de motos es la siguiente [13,14]. Visualizar el resultado obtenido*/
        $venta2Resultado = $objEmpresa->registrarVenta([13,14], $objCliente2);
        echo("Venta 2 realizada al cliente: \n ".$objCliente2->__toString()." \n Monto total de venta: ".$venta2Resultado."\n");
        echo("\n");

        /*6. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el $objCliente es
        una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la colección de
        códigos de motos es la siguiente [14,2]. Visualizar el resultado obtenido*/
        $venta3Resultado = $objEmpresa->registrarVenta([14, 2], $objCliente2);
        echo("Venta 3 realizada al cliente: \n ".$objCliente2->__toString()." \n Monto total de venta: ".$venta3Resultado."\n");
        echo("\n");

        //7. Invocar al método informarVentasImportadas(). Visualizar el resultado obtenido
        $ventasImportadas = $objEmpresa->informarVentasImportadas();
        echo("Ventas importadas: \n");
        foreach ($ventasImportadas as $venta) {
            echo($venta->__toString()."\n");
        }
        echo("\n");

        //8. Invocar al método informarSumaVentasNacionales(). Visualizar el resultado obtenido
        $ventasNacionales = $objEmpresa->informarSumaVentasNacionales();
        echo("Importe total en ventas nacionales: $".$ventasNacionales."\n");
        echo("\n");

        //9. Realizar un echo de la variable Empresa creada en 2
        echo("Datos de la empresa: \n".$objEmpresa."\n");
        echo("\n");
    }
?>