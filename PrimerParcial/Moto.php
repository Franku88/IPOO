<?php
    class Moto {
        private $codigo;
        private $costo;
        private $anio;
        private $descripcion;
        private $porcentajeIncrementoAnual;
        private $activa;

        /**  
         * Constructor de la clase Moto
         * @param String $cod
         * @param double $cost
         * @param int $anioM
         * @param String $descrip
         * @param double $porcIncAnual
         * @param boolean $act
         */
        public function __construct($cod, $cost, $anioM, $descrip, $porcIncAnual, $act) {
            $this->codigo = $cod;
            $this->costo = $cost;
            $this->anio = $anioM;
            $this->descripcion = $descrip;
            $this->porcentajeIncrementoAnual = $porcIncAnual;
            $this->activa = $act;
        } 

        //Visualizadores
        public function getCodigo() {
            return $this->codigo;   
        }
        public function getCosto() {
            return $this->costo;   
        }
        public function getAnio() {
            return $this->anio;   
        }
        public function getDescripcion() {
            return $this->descripcion;   
        }
        public function getPocentajeIncrementoAnual() {
            return $this->porcentajeIncrementoAnual;   
        }
        public function getActiva() {
            return $this->activa;   
        }

        //Modificadores
        public function setCosto($cost) {
            $this->costo = $cost;   
        }
        public function setAnio($anioM) {
            $this->anio = $anioM;   
        }
        public function setDescripcion($descrip) {
            $this->descripcion = $descrip;   
        }
        public function setPocentajeIncrementoAnual($porcIncAnual) {
            $this->porcentajeIncrementoAnual = $porcIncAnual;   
        }
        public function setActiva($act) {
            $this->activa = $act;   
        }

        public function _toString() {
            $cadena = "Codigo: ".$this->codigo.", Costo: ".$this->costo.", Anio: ".$this->anio.", Descripcion: ".$this->descripcion.
            ", Porcentaje de incremento anual: ".$this->porcentajeIncrementoAnual.", Esta activa: ".$this->activa;
            return $cadena;
        }

        public function darPrecioVenta() {
            //Retorna el valor por el cual puede ser vendida la moto
            $montoFinal = -1;
            if ($this->activa) {
                $compra = $this->costo;
                $anio = intval(date("Y")); //Asigno el anio actual como un int
                $montoFinal =  $compra + $compra * ($anio * $this->porcentajeIncrementoAnual);
            }
            return $montoFinal;
        }
    }
?>