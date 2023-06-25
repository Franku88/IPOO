<?php
    include_once "./TPFinalViajes/datos/BaseDatos.php";
    include_once "./TPFinalViajes/datos/Empresa.php";
    include_once "./TPFinalViajes/datos/Viaje.php";
    include_once "./TPFinalViajes/datos/ResponsableV.php";
    include_once "./TPFinalViajes/datos/Pasajero.php";

    //include_once "../datos/BaseDatos.php";
    //include_once "../datos/Empresa.php";
    //include_once "../datos/Viaje.php";
    //include_once "../datos/ResponsableV.php";
    //include_once "../datos/Pasajero.php";

    echo(<<<END
                                      --- Trabajo practico final: Viajes ---
                                                ⣀⣠⣤⣶⣶⣾⣿⣿⠛⠛⠿⢶⣦⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                                    ⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣾⢛⣉⣉⡩⠤⣤⠄⠚⢃⣀⣴⢶⣦⡉⠻⢷⣤⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                                    ⠀⠀⣠⣤⣶⣶⣤⣤⣾⣯⠥⠴⠒⠒⠋⠉⠉⠉⠉⠉⢹⡏⠸⣟⡿⡶⠦⢌⡛⢷⣤⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                                    ⢀⡾⠋⣼⠿⢿⣶⠞⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣸⠁⢰⣟⢀⣰⠀⠀⠈⠙⣿⣿⣶⣄⠀⠀⠀⠀⠀⠀⠀
                                    ⣾⠇⢰⡏⠀⣼⡏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠸⠤⣞⡇⠀⢸⠀⠀⠀⠀⡟⡆⠹⡿⣿⣦⣀⠀⠀⠀⠀
                                    ⢹⣦⣾⠁⢰⡿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣇⠇⠀⢸⠀⠀⠀⠀⡇⡇⠀⡇⠀⢹⠻⣷⣤⡀⠀
                                    ⠀⠉⠁⠀⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⢼⠀⠀⢸⠀⠀⠀⣰⢃⡗⠢⢥⡀⠀⡇⠘⡝⣿⠀
                                    ⠀⠀⠀⢸⡿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣸⠸⠀⠀⢸⣀⠤⠚⠁⢸⡁⠀⠀⠈⠷⠗⠤⣇⣻⡇
                                    ⠀⠀⠀⣼⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⠃⢠⡠⠔⢻⠁⢀⣀⠤⠴⡧⣀⣀⢀⠀⡆⠀⠀⢹⡇
                                    ⠀⠀⠀⣿⠳⠤⠤⢤⣀⠀⠀⠀⢀⣠⠤⠤⠤⠤⠔⠚⠁⠀⣠⡠⢤⣾⡯⠅⠒⠒⠒⡗⠒⠒⠼⠿⡷⠶⠶⢾⡇
                                    ⠀⠀⠀⣿⣦⣄⠀⠀⠈⠉⠉⠉⠉⠀⠀⠀⠀⣀⣠⣤⡶⠿⣷⠊⠁⢀⠃⠀⢠⠟⣦⡇⠀⠀⠀⠀⠃⡶⡄⢸⡇
                                    ⠀⠀⢸⣯⣈⣳⣭⣒⣤⣄⣀⣀⣤⣤⣶⣾⣽⣛⣉⣀⣀⡴⢻⠀⠀⠸⠀⠀⣿⡆⣹⡇⠀⠀⠀⡀⣆⡷⣧⣼⠇
                                    ⠀⠀⠈⣷⠆⢠⠇⠀⢨⡟⠿⠯⢭⠀⠀⠈⢆⠀⠀⢠⡄⠀⢸⠀⠀⠀⠆⠀⡿⡀⢿⣧⣤⣴⡶⠿⣯⣴⠏⠁⠀
                                    ⠀⠀⠀⠻⣶⣼⣦⣤⣤⣭⣭⣭⣭⣄⣀⣀⣈⣆⣀⣀⣀⣀⣼⣤⣤⡾⣶⡚⠁⢁⡿⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀
                                    ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠉⠉⠉⠉⠉⠉⠁⠀⠀⠀⠈⠙⠛⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        END);
    main();
    echo("--- ¡Vuelva pronto! ---\n");
    

    /**
     * Funcion principal
     */
    function main() {
        $sigue = true;
        while ($sigue) {
            opciones();
            echo("\n--- Ingrese una opcion: ");
            $caso = trim(fgets(STDIN));
            switch ($caso) {
                case 1:
                    insertarEmpresa();
                    break;
                case 2:
                    insertarResponsable();
                    break;
                case 3:
                    insertarViaje();
                    break;
                case 4:
                    insertarPasajero();
                    break;
                case 5:
                    modificarEmpresa();
                    break;
                case 6:
                    modificarResponsable();
                    break;
                case 7:
                    modificarViaje();
                    break;
                case 8:
                    modificarPasajero();
                    break;
                case 9:
                    eliminarEmpresa();
                    break;
                case 10:
                    eliminarResponsable();
                    break;    
                case 11:
                    eliminarViaje();
                    break;
                case 12:
                    eliminarPasajero();
                    break;
                case 13:
                    verEmpresas();
                    break;
                case 14:
                    verResponsables();
                    break;    
                case 15:
                    verViajes();
                    break;
                case 16:
                    verPasajeros();
                    break;                   
                case 17:
                    $sigue = false;
                    break;
                default:
                    echo("--- Opcion invalida ---\n");
                    break;
            }
        }
    }

    /**
     * Muestra un string con las opciones disponibles
     */
    function opciones() {
        echo (<<<END

        |******************************************* Menu ********************************************|
        |------ Insertar -------+----- Modificar ------+------ Eliminar -------+------- Ver ----------|
        |                       |                      |                       |                      |
        |   (1) Empresa         |   (5) Empresa        |   (9) Empresa         |   (13) Empresas      |
        |   (2) Responsable     |   (6) Responsable    |   (10) Responsable    |   (14) Responsables  |
        |   (3) Viaje           |   (7) Viaje          |   (11) Viaje          |   (15) Viajes        |
        |   (4) Pasajero        |   (8) Pasajero       |   (12) Pasajero       |   (16) Pasajeros     |
        |                       |                      |                       |                      |  
        |-----------------------+----------------------+-----------------------+----------------------|
                                            |                     |
                                            |   (17) Finalizar    |
                                            |                     |
                                            -*********************-

        END);
    }

    /**
     * Inserta los datos de una empresa
     */
    function insertarEmpresa() {
        echo "\n------------------------- Solicitaremos datos de la empresa -------------------------\n";
        echo "--- Ingrese nombre: ";
        $enombre = trim(fgets(STDIN));
        echo "--- Ingrese direccion: ";
        $edireccion = trim(fgets(STDIN));
        //$idempresa, $enombre, $edireccion
        $empresa = new Empresa();
        $empresa->cargarDatos(null, $enombre, $edireccion);
        //Inserto empresa en la base de datos
        $empresa->insertar();
        echo "\n---------- La empresa con id ".$empresa->getIdempresa()." fue ingresada en la BD ----------\n";
    }
    
    /**
     * Modifica dato de una empresa segun su id
     */
    function modificarEmpresa() {
        if (verEmpresas()) {
            echo "--- Ingrese id de empresa a modificar: ";
            $idempresa = trim(fgets(STDIN));
            $empresa = new Empresa();
            //Busco empresa
            if ($empresa->buscarDatos($idempresa)) {
                $sigue = true;
                while ($sigue) {
                    echo "------------------------- Datos actuales -------------------------\n";
                    echo $empresa;
                    echo "*----------------------------------------------------------------*\n";
                    opcionesEmpresa();
                    echo "--- Ingrese una opcion: ";
                    $rta = trim(fgets(STDIN));
                    switch ($rta) {
                        case 0:
                            echo "\n------------------------- Modificacion cancelada -------------------------\n";
                            $sigue = false;
                            break;
                        case 1:
                            echo "--- Ingrese nuevo nombre: ";
                            $enombre = trim(fgets(STDIN));
                            $empresa->setEnombre($enombre);
                            break;
                        case 2:
                            echo "--- Ingrese nueva direccion: ";
                            $edireccion = trim(fgets(STDIN));
                            $empresa->setEdireccion($edireccion);
                            break;
                        case 3:
                            //Modifico en la bd
                            $empresa->modificar();
                            echo "\n------------------------- Empresa modificada con exito -------------------------\n";
                            $sigue = false;
                            break;
                        default:
                            echo "\n------------------------- Opcion invalida -------------------------\n";
                            break;
                    }
                }
            } else {
                echo "\n------------------------- No existe empresa con id ingresado -------------------------\n";
            }
        }
    }

    /**
     * Opciones que se visualizan en modificar empresa
     */
    function opcionesEmpresa() {
        echo <<<END

        |******** Empresa ********|
        |                         |
        |      (0) Cancelar       |
        |                         |
        |------ Modificar --------|
        |                         |
        |       (1) Nombre        |
        |      (2) Direccion      |
        |                         |
        |-------------------------|
        |                         |
        |   (3) Aplicar cambios   |
        |                         |
        -*************************-

        END;
    }

    /**
     * Elimina los datos de una empresa segun su id
     */
    function eliminarEmpresa() {
        if (verEmpresas()) {
            echo "--- Ingrese id de empresa a eliminar: ";
            $idempresa = trim(fgets(STDIN));
            $empresa = new Empresa();
            //Verifica que exista dicha empresa
            if ($empresa->buscarDatos($idempresa)) {
                echo "\n------------------------- Empresa seleccionada -------------------------\n";
                echo $empresa;
                echo "*----------------------------------------------------------------------*\n";
                $viajes = $empresa->obtenerViajes();
                //Verifica si tiene viajes/personas asociadas
                if (count($viajes) > 0) {
                    echo "\n------- La empresa a encontrada tiene viajes y/o pasajeros asociados -------\n";
                    echo "--- ¿Desea eliminar todo? (SI/NO): ";
                    $rta = strtoupper(trim(fgets(STDIN)));
                    if ($rta == "SI") {
                        $rta = null;
                        echo "--- ¿Esta seguro? (SI/NO): ";
                        $rta = strtoupper(trim(fgets(STDIN)));
                        if ($rta == "SI") {
                            //Elimina cada viaje
                            foreach($viajes as $viaje) {
                                $pasajeros = $viaje->obtenerPasajeros();
                                if (count($pasajeros) > 0) {
                                    //Elimina cada pasajero
                                    foreach ($pasajeros as $pasajero ) {
                                        $pasajero->eliminar();
                                    }
                                }
                                $viaje->eliminar();
                            }
                            $empresa->eliminar();
                            echo "\n------------- Empresa, viajes y pasajeros eliminados con exito -------------\n";
                        } else {
                            echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                        }
                    } else {
                        echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                    }
                } else {
                    echo "--- ¿Desea eliminarla? (SI/NO): ";
                    $rta = strtoupper(trim(fgets(STDIN)));
                    if ($rta == "SI") {
                        $rta = null;
                        echo "--- ¿Esta seguro? (SI/NO): ";
                        $rta = strtoupper(trim(fgets(STDIN)));
                        if ($rta == "SI") {
                            //Elimino de la bd
                            $empresa->eliminar();
                            echo "\n------------------------- Empresa eliminada con exito -------------------------\n";    
                        } else {
                            echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                        }
                    }  else {
                        echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                    }
                }
            } else {
                echo "\n------------------------- No existe empresa con id ingresado -------------------------\n";
            }
        }
    }

    /**
     * Muestra las empresas de la base de datos
     */
    function verEmpresas() {
        $empresa =  new Empresa();
        $colEmpresas = $empresa->listar();
        if (count($colEmpresas) > 0) {
            echo "---------------------- Empresas ----------------------\n";
            foreach ($colEmpresas as $cadaEmpresa){
                echo $cadaEmpresa;
                echo "*----------------------------------------------------*\n";
            }
            $flag = true;
        } else {
            echo "---------------------- No existen empresas ----------------------\n";
            $flag = false;
        }
        return $flag;
    }

    /**
     * Inserta los datos de un viaje
     */
    function insertarViaje() {
        echo "\n------------------------- Solicitaremos datos del viaje -------------------------\n";
        if (verEmpresas()) {
            echo "--- Ingrese id de la empresa: ";
            $idempresa = trim(fgets(STDIN));
            $empresa = new Empresa();
            //Verifica que existe dicha empresa
            if ($empresa->buscarDatos($idempresa)) {
                if (verResponsables()) {
                    echo "--- Ingrese numero de empleado: ";
                    $rnumeroempleado = trim(fgets(STDIN));
                    $responsable = new ResponsableV();
                    if ($responsable->buscarDatos($rnumeroempleado)) {
                        echo "--- Ingrese destino: ";
                        $destino = trim(fgets(STDIN));
                        echo "--- Ingrese cantidad maxima de pasajeros: ";
                        $cantMaxpasajeros = trim(fgets(STDIN));
                        if (intval($cantMaxpasajeros) && $cantMaxpasajeros > 0) {
                            echo "--- Ingrese el importe: ";
                            $vimporte = trim(fgets(STDIN));
                            if (doubleval($vimporte) && $vimporte > 0) {
                                //$idviaje, $empresa, $responsable, $destino, $cantMaxpasajeros, $vimporte
                                $viaje = new Viaje();
                                $viaje->cargarDatos(null, $empresa, $responsable, $destino, $cantMaxpasajeros, $vimporte);
                                //Inserto viaje en la base de datos
                                $viaje->insertar();
                                echo "\n------------- El viaje con id ".$viaje->getIdviaje()." fue ingresado en la BD -------------\n";
                            } else {
                                echo "\n------------------------- Valor ingresado debe ser numero positivo -------------------------\n";    
                            }
                        } else {
                            echo "\n------------------------- Valor ingresado debe ser numero entero positivo -------------------------\n";
                        }
                    } else {
                        echo "\n------------- No existe responsable con numero de empleado ingresado -------------\n";
                    }
                }
            } else {
                echo "\n------------------------- No existe empresa con id ingresado -------------------------\n";
            }
        }
    }

    /**
     * Modifica los datos de un viaje segun su id
     */
    function modificarViaje() {
        if (verViajes()) {
            echo "--- Ingrese id de viaje a modificar: ";
            $idviaje = trim(fgets(STDIN));
            $viaje = new Viaje();
            //Busco viaje
            if ($viaje->buscarDatos($idviaje)) {
                $sigue = true;
                while ($sigue) {
                    echo "------------------------- Datos actuales -------------------------\n";
                    echo $viaje;
                    echo "*----------------------------------------------------------------*\n";
                    opcionesViaje();
                    echo "--- Ingrese una opcion: ";
                    $rta = trim(fgets(STDIN));
                    switch ($rta) {
                        case 0:
                            echo "\n------------------------- Modificacion cancelada -------------------------\n";
                            $sigue = false;
                            break;
                        case 1:
                            if (verEmpresas()) {
                                echo "--- Ingrese nuevo id de empresa: ";
                                $idempresa = trim(fgets(STDIN));
                                $empresa = new Empresa();
                                if ($empresa->buscarDatos($idempresa)) {
                                    $viaje->setEmpresa($empresa);
                                } else { 
                                    echo "\n------------------------- No existe empresa con id ingresado -------------------------\n";
                                }
                            }
                            break;
                        case 2:
                            if (verResponsables()) {
                                echo "--- Ingrese nuevo numero de empleado: ";
                                $rnumeroempleado = trim(fgets(STDIN));
                                $responsable = new ResponsableV();
                                if ($responsable->buscarDatos($rnumeroempleado)) {
                                    $viaje->setResponsable($responsable);
                                } else { 
                                    echo "\n------------------------- No existe responsable con numero ingresado -------------------------\n";
                                }
                            }
                            break;
                        case 3:
                            echo "--- Ingrese nuevo destino: ";
                            $destino = trim(fgets(STDIN));
                            $viaje->setVdestino($destino);
                            break;
                        case 4:
                            echo "--- Ingrese nueva cantidad maxima de pasajeros: ";
                            $cantMaxpasajeros = trim(fgets(STDIN));
                            if (intval($cantMaxpasajeros)) {
                                $pasajeros = $viaje->obtenerPasajeros();
                                if (count($pasajeros) <= $cantMaxpasajeros) {
                                    $viaje->setVcantmaxpasajeros($cantMaxpasajeros);
                                } else {
                                    echo "\n------------ Valor ingresado debe ser mayor o igual a la cantidad actual de pasajeros ------------\n";
                                }
                            } else {
                                echo "\n---------------- Valor ingresado debe ser numero entero positivo ----------------\n";
                            }
                            break;
                        case 5:
                            echo "--- Ingrese nuevo importe: ";
                            $vimporte = trim(fgets(STDIN));
                            if (is_numeric($vimporte) && $vimporte > 0) {
                                $viaje->setVimporte($vimporte);
                            } else {
                                echo "\n---------------- Valor ingresado debe ser numero positivo ----------------\n";
                            }
                            break;
                        case 6:
                            //Modifico en la bd
                            $viaje->modificar();
                            echo "\n------------------------- Viaje modificado con exito -------------------------\n";
                            $sigue = false;
                            break;
                        default:
                            echo "\n------------------------- Opcion invalida -------------------------\n";
                        break;
                    }
                }
            } else {
                echo "\n------------------------- No existe viaje con id ingresado -------------------------\n";
            }
        }
    }

    /**
     * Opciones que se visualizan en modificar viaje
     */
    function opcionesViaje() {
        echo <<<END

            |************ Viaje ***********|
            |                              |
            |        (0) Cancelar          |
            |                              |
            |---------- Modificar ---------|
            |                              |
            |   (1) Id empresa             |
            |   (2) Numero de responsable  |
            |   (3) Destino                |
            |   (4) Pasajeros maximos      |
            |   (5) Importe                |
            |                              |
            |------------------------------|
            |                              |
            |     (6) Aplicar cambios      |
            |                              |
            -******************************-

            END;
    }

    /**
     * Elimina los datos de un viaje segun su id
     */
    function eliminarViaje() {
        if (verViajes()) {
            echo "--- Ingrese id de viaje a eliminar: ";
            $idviaje = trim(fgets(STDIN));
            $viaje = new Viaje();
            //Busca viaje con dicho id
            if ($viaje->buscarDatos($idviaje)) {
                $pasajeros = $viaje->obtenerPasajeros();
                echo "\n------------------------- Viaje seleccionado -------------------------\n";
                echo $viaje;
                echo "*--------------------------------------------------------------------*\n";
                //Verifica si tiene pasajeros asociados
                if (count($pasajeros) > 0) {
                    echo "\n------------- El viaje a eliminar tiene pasajeros asociados -------------\n";
                    echo "--- ¿Desea eliminarlos? (SI/NO): ";
                    $rta = strtoupper(trim(fgets(STDIN)));
                    if ($rta == "SI") {
                        $rta = null;
                        echo "--- ¿Esta seguro? (SI/NO): ";
                        $rta = strtoupper(trim(fgets(STDIN)));
                        if ($rta == "SI") {
                            //Elimina cada pasajero
                            foreach ($pasajeros as $pasajero) {
                                $pasajero->eliminar();
                            }
                            $viaje->eliminar();
                            echo "\n------------------------- Viaje y pasajeros eliminados con exito -------------------------\n";
                        } else {
                            echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                        }
                    } else {
                        echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                    }
                } else {
                    echo "--- ¿Desea eliminarlo? (SI/NO): ";
                    $rta = strtoupper(trim(fgets(STDIN)));
                    if ($rta == "SI") {
                        $rta = null;
                        echo "--- ¿Esta seguro? (SI/NO): ";
                        $rta = strtoupper(trim(fgets(STDIN)));
                        if ($rta == "SI") {
                            $viaje->eliminar();
                            echo "\n------------------------- Viaje eliminado con exito -------------------------\n";
                        } else {
                            echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                        }
                    } else {
                        echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                    }
                }
            } else {
                echo "\n------------------------- No existe viaje con id ingresado -------------------------\n";
            }
        }
    }

    /**
     * Muestra las viajes de la base de datos
     */
    function verViajes() {
        $viaje =  new Viaje();
        $colViajes = $viaje->listar();
        if (count($colViajes) > 0) {
            echo "---------------------- Viajes ----------------------\n";
            foreach ($colViajes as $cadaViaje){
                echo $cadaViaje;
                echo "*----------------------------------------------------*\n";
            }
            $flag = true;
        } else {
            echo "---------------------- No existen viajes ----------------------\n";
            $flag = false;
        }
        return $flag;
    }

    /**
     * Inserta los datos de un responsable
     */
    function insertarResponsable() {
        //Se crea y carga el responsable
        echo "\n------------------------- Solicitaremos datos del responsable -------------------------\n";
        echo "--- Ingrese numero de licencia: ";
        $numLicencia = trim(fgets(STDIN));
        if (intval($numLicencia)) {
            echo "--- Ingrese nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "--- Ingrese apellido: ";
            $apellido = trim(fgets(STDIN));
            //$numEmpleado, $numLicencia, $nombre, $apellido
            $responsable = new ResponsableV();
            $responsable->cargarDatos(null, $numLicencia, $nombre, $apellido);
            //Inserto responsable en la base de datos
            $responsable->insertar();
            echo "\n------------------------- El responsable con numero empleado ".$responsable->getRnumeroempleado()." fue ingresado en la BD -------------------------\n";
        } else {
            echo "\n------------------------- Valor ingresado debe ser numero entero positivo -------------------------\n";
        }
    }

    /**
     * Modifica los datos de un responsable segun su id
     */
    function modificarResponsable() {
        if (verResponsables()) {
            echo "--- Ingrese numero de empleado a modificar: ";
            $rnumeroempleado = trim(fgets(STDIN));
            $responsable = new ResponsableV();
            //Busco empleado con dicho numero
            if ($responsable->buscarDatos($rnumeroempleado)) {
                $sigue = true;
                while ($sigue) {
                    echo "------------------------- Datos actuales -------------------------\n";
                    echo $responsable;
                    echo "*----------------------------------------------------------------*\n";
                    opcionesResponsable();
                    echo "--- Ingrese una opcion: ";
                    $rta = trim(fgets(STDIN));
                    switch ($rta) {
                        case 0:    
                            echo "\n------------------------- Modificacion cancelada -------------------------\n";
                            $sigue = false;
                            break;
                        case 1:
                            echo "--- Ingrese nuevo numero de licencia: ";
                            $numLicencia = trim(fgets(STDIN));
                            if (intval($numLicencia)) {
                                $responsable->setRnumerolicencia($numLicencia);
                            } else {
                                echo "\n------------------------- Valor ingresado debe ser numero entero positivo -------------------------\n";
                            }
                            break;
                        case 2:
                            echo "--- Ingrese nuevo nombre: ";
                            $nombre = trim(fgets(STDIN));
                            $responsable->setRnombre($nombre);
                            break;
                        case 3:
                            echo "--- Ingrese nuevo apellido: ";
                            $apellido = trim(fgets(STDIN));
                            $responsable->setRapellido($apellido);
                            break;
                        case 4:
                            //Modifico en la bd
                            $responsable->modificar();
                            echo "\n------------------------- Responsable modificado con exito -------------------------\n";
                            $sigue = false;
                            break;
                        default:
                            echo "\n------------------------- Opcion invalida -------------------------\n";
                            break;
                    }
                }
            } else {
                echo "\n------------------------- No existe responsable con id ingresado -------------------------\n";
            }
        }
    }

    /**
     * Opciones que se visualizan en modificar responsable 
     */
    function opcionesResponsable() {
        echo <<<END

            |******* Responsable ********|
            |                            |
            |      (0) Cancelar          |
            |                            |
            |-------- Modificar ---------|
            |                            |
            |   (1) Numero de licencia   |
            |   (2) Nombre               |
            |   (3) Apellido             |
            |                            |
            |----------------------------|
            |                            |
            |    (4) Aplicar cambios     |
            |                            |
            -****************************-

            END;
    }

    /**
     * Elimina los datos de un responsable segun su id
     */
    function eliminarResponsable() {
        //Asigno id a eliminar
        if (verResponsables()) {
            echo "--- Ingrese numero de empleado a eliminar: ";
            $rnumeroempleado = trim(fgets(STDIN));
            $responsable = new ResponsableV();
            //Busco empleado con dicho numero
            if ($responsable->buscarDatos($rnumeroempleado)) {
                $viajes = $responsable->obtenerViajes();
                echo "\n------------------------ Responsable seleccionado ------------------------\n";
                echo $responsable;
                echo "*------------------------------------------------------------------------*\n";
                if (count($viajes) > 0) {
                    echo "\n------------- Existen viajes asociados al responsable seleccionado -------------\n";
                    echo "Ids de dichos viajes: - ";
                    foreach ($viajes as $viaje) {
                        echo $viaje->getIdviaje()." - ";
                    }
                    echo "\n------------- Por favor, elimine los viajes o modifique sus responsables -------------\n";
                } else {
                    echo "--- ¿Desea eliminarlo? (SI/NO): ";
                    $rta = strtoupper(trim(fgets(STDIN)));
                    if ($rta == "SI") {
                        $rta = null;
                        echo "--- ¿Esta seguro? (SI/NO): ";
                        $rta = strtoupper(trim(fgets(STDIN)));
                        if ($rta == "SI") {
                            //Elimino de la bd
                            $responsable->eliminar();
                            echo "\n------------------------- Responsable eliminado con exito -------------------------\n";
                        } else {
                            echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                        }
                    } else {
                        echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                    }
                }
            } else { 
                echo "\n------------------------- No existe responsable con id ingresado -------------------------\n";
            }
        }
    }

    /**
     * Muestra las responsables de la base de datos
     */
    function verResponsables() {
        $responsable =  new ResponsableV();
        $colResponsables = $responsable->listar();
        if (count($colResponsables) > 0) {
            echo "---------------------- Responsables ----------------------\n";
            foreach ($colResponsables as $cadaResponsable){
                echo $cadaResponsable;
                echo "*--------------------------------------------------------*\n";
            }
            $flag = true;
        } else {
            echo "---------------------- No existen responsables ----------------------\n";
            $flag = false;
        }
        return $flag;
    }

    /**
     * Inserta los datos de una pasajero
     */
    function insertarPasajero() {
        echo "\n------------------------- Solicitaremos datos del pasajero  -------------------------\n";
        echo "--- Ingrese numero de dni: ";
        $dni = trim(fgets(STDIN));
        if (intval($dni) && $dni > 0) {
            $pasajero = new Pasajero();
            //Verifico que no exista dicho dni en la bd
            if (!($pasajero->buscarDatos($dni))) {
                if (verViajes()) {
                    echo "--- Ingrese id del viaje: ";
                    $idviaje = trim(fgets(STDIN));
                    $viaje = new Viaje();
                    if ($viaje->buscarDatos($idviaje)) {
                        $pasajeros = $viaje->obtenerPasajeros();
                        if (count($pasajeros) < $viaje->getVcantmaxpasajeros()) {
                            echo "--- Ingrese nombre: ";
                            $nombre = trim(fgets(STDIN));
                            echo "--- Ingrese apellido: ";
                            $apellido = trim(fgets(STDIN));
                            echo "--- Ingrese numero de telefono: ";
                            $telefono = trim(fgets(STDIN));
                            if (intval($telefono) && $telefono > 0) {
                                //$dni, $nombre, $apellido, $telefono, $viaje
                                $pasajero->cargarDatos($dni, $nombre, $apellido, $telefono, $viaje);
                                //Inserto pasajero en la base de datos
                                $pasajero->insertar();
                                echo "\n------------- Pasajero con dni ".$pasajero->getPdocumento()." fue ingresado en la BD -------------\n";
                            } else {
                                echo "\n------------------------- Valor ingresado debe ser numero entero positivo -------------------------\n";        
                            }
                        } else {
                            echo "\n------------------------- Viaje lleno -------------------------\n";        
                        }
                    } else {
                        echo "\n------------------------- No existe viaje con id ingresado -------------------------\n";    
                    }
                }
            } else {
                echo "\n------------------------- Ya existe un pasajero con dni ingresado -------------------------\n";
            }
        } else {
            echo "\n------------------------- Valor ingresado debe ser entero positivo -------------------------\n";
        }
    }
    
    /**
     * Modifica los datos de una pasajero segun su id
     */
    function modificarPasajero() {
        //Busco pasajero existente
        $pasajero = new Pasajero();
        if (verPasajeros()) {
            echo "--- Ingrese numero de dni de pasajero a modificar: ";
            $dni = trim(fgets(STDIN));
            if ($pasajero->buscarDatos($dni)) {
                $sigue = true;
                while ($sigue) {
                    echo "------------------------- Datos actuales -------------------------\n";
                    echo $pasajero;
                    echo "*----------------------------------------------------------------*\n";
                    opcionesPasajero();
                    echo "--- Ingrese una opcion: ";
                    $rta = trim(fgets(STDIN));
                    switch ($rta) { 
                        case 0:
                            echo "\n------------------------- Modificacion cancelada -------------------------\n";
                            $sigue = false;
                            break;
                        case 1:
                            echo "--- Ingrese nuevo nombre: ";
                            $nombre = trim(fgets(STDIN));
                            $pasajero->setPnombre($nombre);
                            break;
                        case 2:
                            echo "--- Ingrese nuevo apellido: ";
                            $apellido = trim(fgets(STDIN));
                            $pasajero->setPapellido($apellido);
                            break;
                        case 3:
                            echo "--- Ingrese nuevo telefono: ";
                            $telefono = trim(fgets(STDIN));
                            if (intval($telefono) && $telefono > 0) {
                                $pasajero->setPtelefono($telefono);
                            } else {
                                echo "\n------------------------- Valor ingresado debe ser entero positivo -------------------------\n";
                            }
                            break;
                        case 4:
                            if (verViajes()) {
                                echo "--- Ingrese nuevo id de viaje: ";
                                $idviaje = trim(fgets(STDIN));
                                $viaje = new Viaje();
                                if ($viaje->buscarDatos($idviaje)) {
                                    $pasajeros = $viaje->obtenerPasajeros();
                                    if (count($pasajeros) < $viaje->getVcantmaxpasajeros()) {
                                        $pasajero->setViaje($viaje);
                                    } else {
                                        echo "\n------------------------- Viaje lleno -------------------------\n";    
                                    }
                                } else {
                                    echo "\n------------------------- No existe viaje con id ingresado -------------------------\n";    
                                }
                            }
                            break;
                        case 5:
                            //Modifico en la bd
                            $pasajero->modificar();
                            echo "\n------------------------- Pasajero modificado con exito -------------------------\n";
                            $sigue = false;
                            break;
                        default:
                            echo "\n------------------------- Opcion invalida -------------------------\n";
                            break;       
                    }
                }
            } else {
                echo "\n------------------------- No existe pasajero con dni ingresado -------------------------\n";
            }
        }       
    }

    /**
     * Opciones que se visualizan en modificar pasajero
     */
    function opcionesPasajero() {
        echo <<<END

            |******* Pasajero ********|
            |                         |
            |     (0) Cancelar        |
            |                         |
            |------- Modificar -------|
            |                         |
            |     (1) Nombre          |
            |     (2) Apellido        |
            |     (3) Telefono        |
            |     (4) Id de viaje     |
            |                         |
            |-------------------------|
            |                         |
            |   (5) Aplicar cambios   |
            |                         |
            -*************************-
            
            END;
    }

    /**
     * Elimina los datos de un pasajero segun su id
     */
    function eliminarPasajero() {
        //Asigno id a eliminar
        if (verPasajeros()){
            $pasajero = new Pasajero();
            echo "--- Ingrese numero de dni de pasajero a eliminar: ";
            $dni = trim(fgets(STDIN));
            if ($pasajero->buscarDatos($dni)) {
                echo "\n------------------------ Pasajero seleccionado ------------------------\n";
                echo $pasajero;
                echo "*---------------------------------------------------------------------*\n";
                echo "--- ¿Desea eliminarlo? (SI/NO): ";
                $rta = strtoupper(trim(fgets(STDIN)));
                if ($rta == "SI") {
                    $rta = null;
                    echo "--- ¿Esta seguro? (SI/NO): ";
                    $rta = strtoupper(trim(fgets(STDIN)));
                    if ($rta == "SI") {
                        //Elimino de la bd
                        $pasajero->eliminar();
                        echo "\n------------------------- Pasajero eliminado con exito -------------------------\n";
                    } else {
                        echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                    }
                } else {
                    echo "\n------------------------- Eliminacion cancelada -------------------------\n";
                }
            } else {
                echo "\n------------------------- No existe pasajero con dni ingresado -------------------------\n";
            }
        }
    }

    /**
     * Muestra las pasajeros de la base de datos
     */
    function verPasajeros() {
        $pasajero =  new Pasajero();
        $colPasajeros = $pasajero->listar();
        if (count($colPasajeros) > 0) {
            echo "---------------------- Pasajeros ----------------------\n";
            foreach ($colPasajeros as $cadaPasajero){
                echo $cadaPasajero;
                echo "*-----------------------------------------------------*\n";
            }
            $flag = true;
        } else {
            echo "---------------------- No existen pasajeros ----------------------\n";
            $flag = false;
        }
        return $flag;
    }
?>