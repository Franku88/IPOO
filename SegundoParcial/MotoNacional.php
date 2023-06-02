<?php 
    include 'Moto.php';
    class MotoNacional extends Moto {
        private $porcentajeDescuento;

        public function __construct($cod, $cost, $anioM, $descrip, $porcIncAnual, $act) {
            parent::__construct($cod, $cost, $anioM, $descrip, $porcIncAnual, $act);
            $this->porcentajeDescuento = 15;
        }

        public function getPorcentajeDescuento() {
            return $this->porcentajeDescuento;
        }

        public function setPorcentajeDescuento($porcDescuento) {
            $this->porcentajeDescuento = $porcDescuento;  
        }

        public function __toString() {
            $cad = parent::__toString();
            $cad = $cad.", Porcentaje de descuento: %".$this->getPorcentajeDescuento();
            return $cad;
        }

        public function darPrecioVenta() {
            $montoFinal = parent::darPrecioVenta();
            if ($montoFinal >= 0) {
                $montoFinal = $montoFinal * (1 - ($this->getPorcentajeDescuento()/100));
            }
            return $montoFinal;
        }
    }
?>