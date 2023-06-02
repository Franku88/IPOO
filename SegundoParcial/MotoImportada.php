<?php 
    class MotoImportada extends Moto {
        private $paisOrigen;
        private $importeImpuestos;

        public function __construct($cod, $cost, $anioM, $descrip, $porcIncAnual, $act, $pais, $imp) {
            parent::__construct($cod, $cost, $anioM, $descrip, $porcIncAnual, $act);
            $this->paisOrigen = $pais;
            $this->importeImpuestos = $imp;
        }

        public function getPaisOrigen() {
            return $this->paisOrigen;
        } 

        public function setPaisOrigen($pais) {
            $this->paisOrigen = $pais;
        }

        public function getImporteImpuestos() {
            return $this->importeImpuestos;
        }

        public function setImporteImpuestos($imp) {
            $this->importeImpuestos = $imp;
        }

        public function __toString() {
            $cad = parent::__toString();
            $cad = $cad.", Pais de origen: ".$this->getPaisOrigen().", Importe de impuestos: $".$this->getImporteImpuestos();
            return $cad;
        }

        public function darPrecioVenta() {
            $montoFinal = parent::darPrecioVenta();
            if ($montoFinal >= 0) {
                $montoFinal = $montoFinal + $this->getImporteImpuestos();
            }
            return $montoFinal;
        }
    }
?>