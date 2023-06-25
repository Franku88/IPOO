<?php
    class Viaje {

        private $idviaje;
        private $empresa;
        private $responsable;
        private $vdestino;
        private $vcantidadmaxpasajeros;
        private $vimporte;
        private $mensajeDeOperacion;

        /**
         * Constructor de la clase Viaje
         * @param $idv
         * @param $emp
         * @param $des
         * @param $cantMax
         * @param $resp
         * @param $vimp
         */
        public function __construct($idv = null, $emp = null, $resp = null, $des = null, $cantMax = null, $vimp = null) {
            $this->idviaje = $idv;
            $this->empresa = $emp;
            $this->responsable = $resp;
            $this->vdestino = $des;
            $this->vcantidadmaxpasajeros = $cantMax;
            $this->vimporte = $vimp;
        }

        //Getters
        public function getIdviaje() {
            return $this->idviaje;
        }

        public function getEmpresa() {
            return $this->empresa;
        }

        public function getResponsable() {
            return $this->responsable;
        }

        public function getVdestino() {
            return $this->vdestino;
        }

        public function getVcantmaxpasajeros() {
            return $this->vcantidadmaxpasajeros;
        }

        public function getVimporte() {
            return $this->vimporte;
        }
        
        public function getMensajeDeOperacion() {
            return $this->mensajeDeOperacion;
        }

        //Setters
        public function setIdviaje($idv) {
            $this->idviaje = $idv;
        }

        public function setEmpresa($emp) {
            $this->empresa = $emp;
        }

        public function setResponsable($resp) {
            $this->responsable = $resp;
        }

        public function setVdestino($des) {
            $this->vdestino = $des;
        }

        public function setVcantmaxpasajeros($cantMax) {
            $this->vcantidadmaxpasajeros = $cantMax;
        }

        public function setVimporte($vimp) {
            $this->vimporte = $vimp;
        }

        public function setMensajeDeOperacion($mensaje) {
            $this->mensajeDeOperacion = $mensaje;
        }

        //Otras funciones
        /**
         * Asigna todas las variables de un viaje
         * @param $idv
         * @param $ide
         * @param $rnum
         * @param $des
         * @param $cantMax
         * @param $vimp
         */
        public function cargarDatos($idv, $emp, $resp, $des, $cantMax, $vimp) {
            $this->setIdviaje($idv);
            $this->setVdestino($des);
            $this->setVcantmaxpasajeros($cantMax);
            $this->setVimporte($vimp);
            $this->setResponsable($resp);
            $this->setEmpresa($emp);
        }

        /**
         * Recupera datos de un viaje segun su id
         * @param $idv
         * @return boolean en caso de encontrarlo
         */
        public function buscarDatos($idv) {
            $bD = new BaseDatos();
            $resultado = false;
            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM viaje WHERE idviaje = '$idv'";
                if ($bD->Ejecutar($consulta)) {
                    if ($row = $bD->Registro()) {
                        $empresa = new Empresa();
                        $empresa->buscarDatos($row['idempresa']);
                        $responsable = new ResponsableV();
                        $responsable->buscarDatos($row['rnumeroempleado']);
                        $this->cargarDatos($idv, $empresa, $responsable, $row['vdestino'], $row['vcantmaxpasajeros'], $row['vimporte']);
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
         * Retorna una coleccion de viajes donde se cumpla $condicion
         * @param $condicion
         * @return array viajes que cumplieron la $condicion
         */
        public function listar($condicion = "") {
            $coleccion = [];
            $bD = new BaseDatos();
            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM viaje ";
                if ($condicion != "") {
                    $consulta = $consulta.' WHERE '.$condicion;
                }
                $consulta .= " order by idviaje ";
                if ($bD->Ejecutar($consulta)) {
                    while ($row = $bD->Registro()) {
                        $viaje = new Viaje();
                        $empresa = new Empresa();
                        $responsable = new ResponsableV();
                        $empresa->buscarDatos($row['idempresa']);
                        $responsable->buscarDatos($row['rnumeroempleado']);
                        $viaje->cargarDatos($row['idviaje'], $empresa, $responsable, $row['vdestino'], $row['vcantmaxpasajeros'], $row['vimporte']);
                        array_push($coleccion, $viaje);
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
         * Inserta los datos del viaje actual a la bd
         * @return boolean
         */
        public function insertar() {
            $resultado = false;
            $bD = new BaseDatos();
            if ($bD->Iniciar()) {
                $consulta = "INSERT INTO viaje(idempresa, rnumeroempleado, vdestino, vcantmaxpasajeros, vimporte) 
                    VALUES ('".($this->getEmpresa())->getIdempresa()."','".($this->getResponsable())->getRnumeroempleado()."',
                    '".$this->getVdestino()."','".$this->getVcantmaxpasajeros()."','".$this->getVimporte()."')";
                if ($idviaje = $bD->devuelveIDInsercion($consulta)) {
                    $this->setIdviaje($idviaje);
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
                $consulta = "UPDATE viaje 
                    SET idempresa = '".($this->getEmpresa())->getIdempresa()."', rnumeroempleado = '".($this->getResponsable())->getRnumeroempleado()."',
                    vdestino = '".$this->getVdestino()."', vcantmaxpasajeros = '".$this->getVcantmaxpasajeros()."', vimporte = '".$this->getVimporte()."'
                    WHERE idviaje = ".$this->getIdviaje();
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
         * Elimina los datos del viaje actual de la bd
         * @return boolean 
         */
        public function eliminar() {
            $bD = new BaseDatos();
            $resultado = false;
            if ($bD->Iniciar()) {
                $consulta = "DELETE FROM viaje WHERE idviaje = ".$this->getIdviaje();
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
         * Retorna una lista con los pasajeros del viaje actual
         */
        public function obtenerPasajeros() {
            $pasajero = new Pasajero;
            $pasajeros = $pasajero->listar("idviaje = ".$this->getIdviaje());
            return $pasajeros;
        }

        /**
         * Retorna string con datos del viaje
         * @return String
         */
        public function __toString() {
            return ("Viaje: ".$this->getIdviaje().
                "\nEmpresa: ".$this->getEmpresa().
                "\nResponsable: ".$this->getResponsable().
                "\nDestino: ".$this->getVdestino().
                "\nCantidad maxima de pasajeros: ".$this->getVcantmaxpasajeros().
                "\nImporte: $".$this->getVimporte()."\n");
        }

    }
?>