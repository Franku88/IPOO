<?php 
    include 'Viaje.php';
    class ViajeInternacional extends Viaje {
        private $docAdicional;
        private $porcentajeImpuestos;

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
            $monto,
            $docAd) {
            parent::__construct($destino, $horaPartida, $horaLlegada, $numero, $importe, $fecha, $cantAsientosTotales, $cantAsientosDisponibles, $personaResponsable, $monto);
            $this->docAdicional = $docAd;
            $this->porcentajeImpuestos = 45;
        }

        public function getDocAdicional() {
            return $this->docAdicional;
        }

        public function getPorcentajeImpuestos() {
            return $this->porcentajeImpuestos;
        }

        public function setDocAdicional($docAd) {
            $this->docAdicional = $docAd;
        }

        public function setPorcentajeImpuestos($porImp) {
            $this->porcentajeImpuestos = $porImp;
        }

        public function __toString() {
            $cad = parent::__toString();
            $cad = $cad."Documentacion adicional: ".(($this->getDocAdicional())?"Si":"No").
            "\nPorcentaje de impuestos: %".$this->getPorcentajeImpuestos()."\n";
            return $cad;
        }

        public function calcularImporteViaje() {
            //Realiza el calculo del importe de un viaje internacional con sus impuestos aplicados al importe total y lo asigna
            $imp = parent::calcularImporteViaje();
            $imp = $imp * (1 + ($this->getPorcentajeImpuestos()/100));
            $this->setImporte($imp);
            return $imp;
        }

    }
?>