<?php
    include("Viaje.php");
    
    main();

    /**
     * Algoritmo principal
     * @var mixed[] $pasajeros
     * @var Viaje $viaje1
     */
    function main() {
        //Carga un arreglo con datos de pasajeros predefinida para test
        $pasajeros = cargarPasajeros();
        
        //Crea un viaje con datos predefinidos
        $viaje1 = new Viaje(0, "Bariloche", count($pasajeros), $pasajeros);

        $seguir = true;
        while ($seguir) {
            $valor = menuOpciones();
            switch ($valor) {
                case 1: //Mostrar datos del viaje
                    echo("<Datos del viaje #".$viaje1->getCodigo().">\n");
                    echo($viaje1->toString());
                    break;
                case 2: //Mostrar datos de pasajeros
                    echo("<Pasajeros del viaje #".$viaje1->getCodigo().">\n");
                    print_r($viaje1->getPasajeros());
                    break;
                case 3: //Modificar datos del viaje
                    echo("<Modificando datos de viaje #".$viaje1->getCodigo().">\n");
                    echo("Ingrese el nuevo destino: ");
                    $nuevoDestino = trim(fgets(STDIN));
                    echo("Ingrese la cantidad maxima de pasajeros: ");
                    $nuevaCantidadMax = (int)fgets(STDIN);
                    
                    //Asigna modificaciones
                    $viaje1->setDestino($nuevoDestino);
                    $viaje1->setCantidadMaxPasajeros($nuevaCantidadMax);
                    $sinPasajeros = [];
                    $viaje1->setPasajeros($sinPasajeros);
                    echo("<Cambios realizados con exito>\n");
                    echo("<Realice la carga de pasajeros con las opciones 4 o 5>");
                    
                    break;
                case 4: //Modificar datos de un pasajero
                    $posMax = $viaje1->getCantidadMaxPasajeros() - 1;
                    //Solicita una posicion hasta que sea valida
                    do {
                        echo("Ingrese numero de pasajero que desea modificar (0-".$posMax.") :");
                        $pos = (int)(fgets(STDIN));
                        $sigue = ($pos < 0 || $posMax < $pos);
                        if ($sigue) {
                            echo("Posicion #".$pos." no encontrada.\n");
                        }
                    } while ($sigue);
                    echo("Ingreso de datos del pasajero #".$pos."\n");
                    echo("Nombre: ");
                    $nom = trim(fgets(STDIN));
                    echo("Apellido: ");
                    $ape = trim(fgets(STDIN));
                    echo("Numero de DNI: ");
                    $dni = (int)fgets(STDIN);
                    $viaje1->setPasajero($pos, $nom, $ape, $dni);
                    echo("<Carga exitosa>");
                    break;
                case 5: //Modificar lista de pasajeros
                    //Carga un arreglo con cantidad maxima del $viaje1 pasajeros
                    //Carga tantos pasajeros como se le indique con $viaje1->getCantidadMaxPasajeros
                    for ($i = 0; $i < $viaje1->getCantidadMaxPasajeros(); $i++) {
                        echo("Ingreso de datos del pasajero #".$i."\n");
                        echo("Nombre: ");
                        $nom = trim(fgets(STDIN));
                        echo("Apellido: ");
                        $ape = trim(fgets(STDIN));
                        echo("Numero de DNI: ");
                        $dni = (int)(fgets(STDIN));
                        $viaje1->setPasajero($i, $nom, $ape, $dni);
                    }
                        break;
                default: //Salir 
                    //Puesto en default por si se agregan otras opciones
                    echo("¡Hasta luego!");
                    $seguir = false;
                    break;
            }
        }
    }

    /**
     * Carga de arreglo de pasajeros
     * @return mixed[] $pasajeros
     */
    function cargarPasajeros() {
        //Carga y retorna un arreglo de 10 pasajeros predefinidos
        $pasajeros[0] = ["Nombre"=>"Franco", "Apellido" => "Benitez", "Numero de DNI" => "00000000"];
        $pasajeros[1] = ["Nombre"=>"Guillermo", "Apellido" => "Diaz", "Numero de DNI" => "00000001"];
        $pasajeros[2] = ["Nombre"=>"Cristopher", "Apellido" => "Ovaillos", "Numero de DNI" => "00000002"];
        $pasajeros[3] = ["Nombre"=>"Sebastian", "Apellido" => "Iovaldi", "Numero de DNI" => "00000003"];
        $pasajeros[4] = ["Nombre"=>"Leonel", "Apellido" => "Llancaqueo", "Numero de DNI" => "00000004"];
        $pasajeros[5] = ["Nombre"=>"Leonard", "Apellido" => "Fernandez", "Numero de DNI" => "00000005"];
        $pasajeros[6] = ["Nombre"=>"Jamiro", "Apellido" => "Zuñiga", "Numero de DNI" => "00000006"];
        $pasajeros[7] = ["Nombre"=>"Joaquin", "Apellido" => "Medel", "Numero de DNI" => "00000007"];
        $pasajeros[8] = ["Nombre"=>"Julian", "Apellido" => "Maruca", "Numero de DNI" => "00000008"];
        $pasajeros[9] = ["Nombre"=>"Bruno", "Apellido" => "Bassi", "Numero de DNI" => "00000009"];
        return $pasajeros;
    }

    /**
     * Imprime un menu de opciones y retorna la eleccion del usuario
     * @var int $opcion
     * @var boolean $valida
     * @return int
     */
    function menuOpciones() {
        //Imprime opciones
        echo <<<END
        \n------------------- Menu -------------------
        1) Mostrar datos del viaje.
        2) Mostrar datos de pasajeros.
        3) Modificar datos del viaje.
        4) Modificar datos de un pasajero.
        5) Modificar lista completa de pasajeros.
        6) Salir
        --------------------------------------------\n
        END;
        //Solicita una opcion hasta que se ingresa una valida
        do {
            echo "Ingrese una opcion: "; 

            //Solicita opcion
            $opcion = fgets(STDIN); 

            /*Verifica si es una opcion valida, 
            si se agregan opciones debe modificarse la siguiente comparacion*/
            $valida = (0 < $opcion) && ($opcion < 7);

            //si $flag == false, solicita otro valor
            if (!$valida) {
                echo "Por favor, ingrese una opcion valida.\n";
            }

        } while (!$valida);
        return $opcion; 
    }
?>