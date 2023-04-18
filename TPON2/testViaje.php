<?php
    include("Viaje.php");
    include("Pasajero.php");
    include("ResponsableV.php");
    main();

    /**
     * Algoritmo principal
     * @var Pasajero[] $pasajeros
     * @var Viaje $viaje1
     */
    function main() {
        //Carga un arreglo con datos de pasajeros predefinida para test y un responsable de viaje
        $pasajeros = cargarPasajeros();
        $responsable = new ResponsableV("Gabriela","Luna","000","111");
        //Crea un viaje con datos predefinidos
        $viaje1 = new Viaje(0, "Bariloche", count($pasajeros), $pasajeros, $responsable);

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
                    do {
                        echo("Numero de DNI: ");
                        $dni = (int)fgets(STDIN);
                        echo("Nombre: ");
                        $nom = trim(fgets(STDIN));
                        echo("Apellido: ");
                        $ape = trim(fgets(STDIN));
                        echo("Telefono: ");
                        $tel = trim(fgets(STDIN));
                        $pasajero = new Pasajero($nom, $ape, $dni, $tel);
                        $sigue = $viaje1->estaEnViaje($pasajero);
                        if ($sigue) {
                            echo("<El pasajero ingresado ya se encuentra en el viaje>\n");
                        }
                    } while($sigue);    
                    $viaje1->setPasajero($pos, $pasajero);
                    echo("<Carga exitosa>");
                    break;
                case 5: //Modificar lista de pasajeros
                    //Carga un arreglo con cantidad maxima del $viaje1 pasajeros
                    //Carga tantos pasajeros como se le indique con $viaje1->getCantidadMaxPasajeros
                    $i = 0;
                    while ($i < $viaje1->getCantidadMaxPasajeros()) {
                        echo("Ingreso de datos del pasajero #".$i."\n");
                        echo("Nombre: ");
                        $nom = trim(fgets(STDIN));
                        echo("Apellido: ");
                        $ape = trim(fgets(STDIN));
                        echo("Numero de DNI: ");
                        $dni = (int)(fgets(STDIN));
                        echo("Telefono: ");
                        $tel = trim(fgets(STDIN));
                        $pasajero = new Pasajero($nom, $ape, $dni, $tel);
                        
                        if ($viaje1->estaEnViaje($pasajero)) {
                            echo("<El pasajero ingresado ya se encuentra en el viaje>\n");
                        } else {
                            $viaje1->setPasajero($i, $pasajero);
                            $i++;
                        }
                    }
                    break;
                case 6: //Modificar responsable
                        echo("Ingreso de datos del responsable\n");
                        echo("Nombre: ");
                        $nom = trim(fgets(STDIN));
                        echo("Apellido: ");
                        $ape = trim(fgets(STDIN));
                        echo("Numero de empleado: ");
                        $numEmpleado = trim(fgets(STDIN));
                        echo("Numero de licencia: ");
                        $numLicencia = trim(fgets(STDIN));
                        $responsable = new ResponsableV($nom, $ape, $numEmpleado,$numLicencia);
                        $viaje1->setResponsable($responsable);
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
     * @return Pasajero[] $pasajeros
     */
    function cargarPasajeros() {
        //Carga y retorna un arreglo de 10 pasajeros predefinidos
        $pasajeros[0] = new Pasajero("Franco","Benitez","00000000","0");
        $pasajeros[1] = new Pasajero("Guillermo","Diaz","00000001","0");
        $pasajeros[2] = new Pasajero("Cristopher","Ovaillos","00000002","0");
        $pasajeros[3] = new Pasajero("Sebastian","Iovaldi","00000003","0");
        $pasajeros[4] = new Pasajero("Leonel","Llancaqueo","00000004","0");
        $pasajeros[5] = new Pasajero("Leonard","Fernandez","00000005","0");
        $pasajeros[6] = new Pasajero("Jamiro","Zuñiga","00000006","0");
        $pasajeros[7] = new Pasajero("Joaquin","Medel","00000007","0");
        $pasajeros[8] = new Pasajero("Julian","Maruca","00000008","0");
        $pasajeros[9] = new Pasajero("Bruno","Bassi","00000009","0");
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
        6) Modificar responsable del viaje.
        7) Salir
        --------------------------------------------\n
        END;
        //Solicita una opcion hasta que se ingresa una valida
        do {
            echo "Ingrese una opcion: "; 

            //Solicita opcion
            $opcion = fgets(STDIN); 

            /*Verifica si es una opcion valida, 
            si se agregan opciones debe modificarse la siguiente comparacion*/
            $valida = (0 < $opcion) && ($opcion < 8);

            //si $flag == false, solicita otro valor
            if (!$valida) {
                echo "Por favor, ingrese una opcion valida.\n";
            }

        } while (!$valida);
        return $opcion; 
    }
?>