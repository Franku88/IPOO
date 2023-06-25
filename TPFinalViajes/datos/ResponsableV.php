<?php 
    class ResponsableV {

        private $rnumeroempleado;
        private $rnumerolicencia;
        private $rnombre;
        private $rapellido;
        private $mensajeDeOperacion;

        /**
         * Constructor de la clase ResponsableV
         * @param $nom
         * @param $ape
         * @param $numEmpleado
         * @param $numlicencia
         */
        public function __construct($numEmpleado = null, $numLicencia = null, $nom = null, $ape = null) {
            $this->rnombre = $nom;
            $this->rapellido = $ape;
            $this->rnumeroempleado = $numEmpleado;
            $this->rnumerolicencia = $numLicencia;
        }

        //Getters
        public function getRnombre() {
            return $this->rnombre;
        }

        public function getRapellido() {
            return $this->rapellido;
        }

        public function getRnumeroempleado() {
            return $this->rnumeroempleado;
        }
        
        public function getRnumerolicencia() {
            return $this->rnumerolicencia;
        }
        
        public function getMensajeDeOperacion() {
            return $this->mensajeDeOperacion;
        }
        
        //Setters
        public function setRnombre($nom) {
            $this->rnombre = $nom;
        }

        public function setRapellido($ape) {
            $this->rapellido = $ape;
        }

        public function setRnumeroempleado($numEmpleado) {
            $this->rnumeroempleado = $numEmpleado;
        }
        
        public function setRnumerolicencia($numLicencia) {
            $this->rnumerolicencia = $numLicencia;
        }

        public function setMensajeDeOperacion($mensaje) {
            $this->mensajeDeOperacion = $mensaje;
        }
    
        //Otras funciones
        /**
         * Asigna todas las variables de un responsable
         * @param $nom
         * @param $ape
         * @param $numL
         * @param $numE
         */
        public function cargarDatos($numE, $numL, $nom, $ape) {
            $this->setRnumeroempleado($numE);
            $this->setRnumerolicencia($numL);
            $this->setRnombre($nom);
            $this->setRapellido($ape);
        }
        
        /**
         * Recupera datos de un responsable segun su id
         * @param $numE
         * @return boolean en caso de encontrarlo
         */
        public function buscarDatos($numE) {
            $bD = new BaseDatos();
            $resultado = false;
            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM responsable WHERE rnumeroempleado = '$numE'";
                if ($bD->Ejecutar($consulta)) {
                    if ($row = $bD->Registro()) {
                        $this->cargarDatos($numE, $row['rnumerolicencia'], $row['rnombre'], $row['rapellido']);
                        $resultado = true;
                    }
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $resultado;
        }

        /**
         * Retorna una coleccion de responsables donde se cumpla $condicion
         * @param $condicion
         * @return array responsables que cumplieron la $condicion
         */
        public function listar($condicion = "") {
            $coleccion = [];
            $bD = new BaseDatos();
            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM responsable ";
                if ($condicion != "") {
                    $consulta = $consulta.' WHERE '.$condicion;
                }
                $consulta .= " order by rnumeroempleado ";
                if ($bD->Ejecutar($consulta)) {
                    while ($row = $bD->Registro()) {
                        $responsable = new ResponsableV();
                        $responsable->cargarDatos($row['rnumeroempleado'], $row['rnumerolicencia'], $row['rnombre'], $row['rapellido']);
                        array_push($coleccion, $responsable);
                    }
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $coleccion;
        }

        /**
         * Inserta los datos del responsable actual a la bd
         * @return boolean
         */
        public function insertar() {
            $resultado = false;
            $bD = new BaseDatos();
            if ($bD->Iniciar()) {
                $consulta = "INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) 
                VALUES ('".$this->getRnumerolicencia()."','".$this->getRnombre()."','".$this->getRapellido()."')";
                if ($rnumeroempleado = $bD->devuelveIDInsercion($consulta)) {
                    $this->setRnumeroempleado($rnumeroempleado);
                    $resultado = true;
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $resultado;
        }

        /**
         * Modifica los datos en la bd con los que tiene el objeto actual
         * @return boolean
         */
        public function modificar() {
            $resultado = false;
            $bD = new BaseDatos();    
            if ($bD->Iniciar()) {
                $consulta = "UPDATE responsable 
                SET rnombre = '".$this->getRnombre()."', rapellido = '".$this->getRapellido()."', rnumerolicencia = '".$this->getRnumerolicencia()."' 
                WHERE rnumeroempleado = ".$this->getRnumeroempleado();
                if ($bD->Ejecutar($consulta)) {
                    $resultado =  true;
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $resultado;
        }

        /**
         * Elimina los datos del responsable actual de la bd
         * @return boolean 
         */
        public function eliminar() {
            $bD = new BaseDatos();
            $resultado = false;
            if ($bD->Iniciar()) {
                $consulta = "DELETE FROM responsable WHERE rnumeroempleado = ".$this->getRnumeroempleado();
                if ($bD->Ejecutar($consulta)) {
                    $resultado =  true;
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $resultado;
        }

        /**
         * Retorna una lista con los viajes asociados al responsable actual
         */
        public function obtenerViajes() {
            $viaje = new Viaje;
            $viajes = $viaje->listar("rnumeroempleado = ".$this->getRnumeroempleado());
            return $viajes;
        }

        /**
         * Retorna string con datos del responsable
         * @return String
         */
        public function __toString() {
            return ("Numero de empleado: ".$this->getRnumeroempleado().
                "\nNumero de licencia: ".$this->getRnumerolicencia().
                "\nNombre: ".$this->getRnombre().
                "\nApellido: ".$this->getRapellido()."\n");
        }
    }
?>