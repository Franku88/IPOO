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
            //Realiza el calculo del importe de un viaje nacional con su descuento aplicado al monto base y lo asigna
            $montoB = $this->getMontoBase() * (1 - ($this->getPorcentajeDescuento()/100));
            $asientosT = $this->getCantAsientosTotales();
            $imp =  $montoB + ($montoB * (($asientosT - $this->getCantAsientosDisponibles())/$asientosT));
            $this->setImporte($imp);
            return $imp;
        }
    }
?>