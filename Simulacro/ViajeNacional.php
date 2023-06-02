<?php 
    include 'Viaje.php';
    class ViajeNacional extends Viaje {
        private $porcentajeDescuento;

        public function __construct(
            $destino,
            $horaPartida,
            $horaLlegada,
            $numero,
            $importe,
            $fecha,
            $cantAsientosTotales,
            $cantAsientosDisponibles,
            $personaResponsable,
            $monto) {
            parent::__construct($destino, $horaPartida, $horaLlegada, $numero, $importe, $fecha, $cantAsientosTotales, $cantAsientosDisponibles, $personaResponsable, $monto);
            $this->porcentajeDescuento = 10;
        }
        
        public function getPorcentajeDescuento() {
            return $this->porcentajeDescuento;
        }

        public function setPorcentajeDescuento($porcDesc) {
            $this->porcentajeDescuento = $porcDesc;
        }

        public function __toString() {
            $cad = parent::__toString();
            $cad = $cad."Porcentaje de descuento: %".$this->getPorcentajeDescuento()."\n";
            return $cad;
        }

        public function calcularImporteViaje() {
            //Realiza el calculo del importe final de un viaje con su descuento y lo asigna
            parent::calcularImporteViaje();
            $imp = $this->getImporte();
            $imp = $imp * (1 - (($this->getPorcentajeDescuento())/100));
            $this->setImporte($imp);
        }
    }
?>