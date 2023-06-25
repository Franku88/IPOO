<?php 
    class Pasajero {

        private $pdocumento;
        private $pnombre;
        private $papellido;
        private $ptelefono;
        private $viaje;
        private $mensajeDeOperacion;

        /**
         * Constructor de la clase Pasajero
         * @param $dni
         * @param $nom
         * @param $ape
         * @param $tel
         * @param $via
         */
        public function __construct($dni = null, $nom = null, $ape = null, $tel = null, $via = null) {
            $this->pdocumento = $dni;
            $this->pnombre = $nom;
            $this->papellido = $ape;
            $this->ptelefono = $tel;
            $this->viaje = $via;
        }

        //Getters
        public function getPdocumento() {
            return $this->pdocumento;
        }
        
        public function getPnombre() {
            return $this->pnombre;
        }

        public function getPapellido() {
            return $this->papellido;
        }

        public function getPtelefono() {
            return $this->ptelefono;
        }

        public function getViaje() {
            return $this->viaje;
        }
        
        public function getMensajeDeOperacion() {
            return $this->mensajeDeOperacion;
        }

        //Setters
        public function setPdocumento($dni) {
            $this->pdocumento = $dni;
        }
        
        public function setPnombre($nom) {
            $this->pnombre = $nom;
        }

        public function setPapellido($ape) {
            $this->papellido = $ape;
        }

        public function setPtelefono($tel) {
            $this->ptelefono = $tel;
        }

        public function setViaje($via) {
            $this->viaje = $via;
        }
        
        public function setMensajeDeOperacion($mensaje) {
            $this->mensajeDeOperacion = $mensaje;
        }
        
        //Otras funciones
        /**
         * Asigna todas las variables de un pasajero
         * @param $dni
         * @param $nom
         * @param $ape
         * @param $tel
         * @param $idv
         */
        public function cargarDatos($dni, $nom, $ape, $tel, $via) {
            $this->setPdocumento($dni);
            $this->setPnombre($nom);
            $this->setPapellido($ape);
            $this->setPtelefono($tel);
            $this->setViaje($via);
        }

        /**
         * Recupera datos de un pasajero segun su id
         * @param $dni
         * @return boolean en caso de encontrarlo
         */
        public function buscarDatos($dni) {
            $bD = new BaseDatos();
            $resultado = false;
            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM pasajero WHERE pdocumento = '$dni'";
                if ($bD->Ejecutar($consulta)) {
                    if ($row = $bD->Registro()) {
                        $viaje = new Viaje();
                        $viaje->buscarDatos($row['idviaje']);
                        $this->cargarDatos($dni, $row['pnombre'], $row['papellido'], $row['ptelefono'], $viaje);
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
         * Retorna una coleccion de pasajeros donde se cumpla $condicion
         * @param $condicion
         * @return array pasajeros que cumplieron la $condicion
         */
        public function listar($condicion = "") {
            $coleccion = [];
            $bD = new BaseDatos();
            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM pasajero ";
                if ($condicion != "") {
                    $consulta = $consulta.' WHERE '.$condicion;
                }
                $consulta .= " order by pdocumento ";
                if ($bD->Ejecutar($consulta)) {
                    $pasajero = new Pasajero();
                    $viaje = new Viaje();
                    while ($row = $bD->Registro()) {
                        $viaje->buscarDatos($row['idviaje']);
                        $pasajero->cargarDatos($row['pdocumento'], $row['pnombre'], $row['papellido'], $row['ptelefono'], $viaje);
                        array_push($coleccion, $pasajero);
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
         * Inserta los datos del pasajero actual a la bd
         * @return boolean
         */
        public function insertar() {
            $resultado = false;
            $bD = new BaseDatos();
            if ($bD->Iniciar()) {
                $consulta = "INSERT INTO pasajero(pdocumento, pnombre, papellido, ptelefono, idviaje) 
                VALUES ('".$this->getPdocumento()."','".$this->getPnombre()."','".$this->getPapellido()."',
                '".$this->getPtelefono()."','".($this->getViaje())->getIdviaje()."')";
                if ($bD->Ejecutar($consulta)) {
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
                $consulta = "UPDATE pasajero
                SET pnombre = '".$this->getPnombre()."', papellido = '".$this->getPapellido()."', 
                    ptelefono = '".$this->getPtelefono()."', idviaje = '".($this->getViaje())->getIdviaje()."'
                WHERE pdocumento = ".$this->getPdocumento();
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
         * Elimina los datos del pasajero actual de la bd
         * @return boolean 
         */
        public function eliminar() {
            $bD = new BaseDatos();
            $resultado = false;
            if ($bD->Iniciar()) {
                $consulta = "DELETE FROM pasajero WHERE pdocumento = ".$this->getPdocumento();
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
         * Retorna string con datos del pasajero
         * @return String
         */
        public function __toString() {
            return ("DNI: ".$this->getPdocumento().
                "\nNombre: ".$this->getPnombre(). 
                "\nApellido: ".$this->getPapellido().
                "\nTelefono: ".$this->getPtelefono().
                "\nViaje: ".($this->getViaje())->getIdviaje()."\n");
        }
    }
?>