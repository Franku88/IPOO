<?php
    class Empresa {

        private $idempresa;
        private $enombre;
        private $edireccion;
        private $mensajeDeOperacion;
        
        /**
         * Constructor de la clase Empresa
         * @param $ide
         * @param $enom
         * @param $edir
         */
        public function __construct($ide = null, $enom = null, $edir = null) {
            $this->idempresa = $ide;
            $this->enombre = $enom;
            $this->edireccion = $edir;
        }

        //Getters
        public function getIdempresa() {
            return $this->idempresa;
        }

        public function getEnombre() {
            return $this->enombre;
        }

        public function getEdireccion() {
            return $this->edireccion;
        }

        public function getMensajeDeOperacion() {
            return $this->mensajeDeOperacion;
        }

        //Setters
        public function setIdempresa($ide) {
            $this->idempresa = $ide;
        }

        public function setEnombre($enom) {
            $this->enombre = $enom;
        }

        public function setEdireccion($edir) {
            $this->edireccion = $edir;
        }

        public function setMensajeDeOperacion($mensaje) {
            $this->mensajeDeOperacion = $mensaje;
        }

        //Otras funciones
        /**
         * Asigna todas las variables de una empresa
         * @param $ide
         * @param $enom
         * @param $edir
         */
        public function cargarDatos($ide, $enom, $edir) {
            $this->setIdempresa($ide);
            $this->setEnombre($enom);
            $this->setEdireccion($edir);
        }

        /**
         * Recupera datos de una empresa segun su id
         * @param $ide
         * @return boolean en caso de encontrarlo
         */
        public function buscarDatos($ide) {
            $resultado = false;
            $bD = new BaseDatos();
            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM empresa WHERE idempresa = '$ide'";
                if ($bD->Ejecutar($consulta)) {
                    if ($row = $bD->Registro()) {
                        $this->cargarDatos($ide, $row['enombre'], $row['edireccion']);
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
         * Retorna una coleccion de empresas donde se cumpla $condicion
         * @param $condicion
         * @return array empresas que cumplieron la $condicion
         */
        public function listar($condicion = "") {
            $coleccion = null;
            $bD = new BaseDatos();
            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM empresa ";
                if ($condicion != "") {
                    $consulta = $consulta.' WHERE '.$condicion;
                }
                $consulta .= " order by idempresa ";
                if ($bD->Ejecutar($consulta)) {
                    $coleccion = array();
                    while ($row = $bD->Registro()) {
                        $empresa = new Empresa();
                        $empresa->cargarDatos($row['idempresa'], $row['enombre'], $row['edireccion']);
                        array_push($coleccion, $empresa);
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
         * Inserta los datos de la empresa actual a la bd
         * @return boolean
         */
        public function insertar() {
            $resultado = false;
            $bD = new BaseDatos();
            if ($bD->Iniciar()) {
                $consulta = "INSERT INTO empresa(enombre, edireccion) 
                VALUES ('".$this->getEnombre()."','".$this->getEdireccion()."')";
                if ($idempresa = $bD->devuelveIDInsercion($consulta)) {
                    $this->setIdempresa($idempresa);
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
                $consulta = "UPDATE empresa 
                    SET enombre = '".$this->getEnombre()."', edireccion = '".$this->getEdireccion()."' 
                    WHERE idempresa = ".$this->getIdempresa();
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
         * Elimina los datos de la empresa actual de la bd
         * @return boolean 
         */
        public function eliminar() {
            $bD = new BaseDatos();
            $resultado = false;
            if ($bD->Iniciar()) {
                $consulta = "DELETE FROM empresa WHERE idempresa = ".$this->getIdempresa();
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
         * Retorna una lista con los viajes de la empresa actual
         */
        public function obtenerViajes() {
            $viaje = new Viaje;
            $viajes = $viaje->listar("idempresa = ".$this->getIdempresa());
            return $viajes;
        }

        /**
         * Retorna string con datos de la empresa
         * @return String
         */
        public function __toString() {
            return ("Empresa: ".$this->getIdempresa().
                "\nNombre: ".$this->getEnombre().
                "\nDireccion: ".$this->getEdireccion()."\n");
        }
    }
?>