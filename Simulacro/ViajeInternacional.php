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
            $docAd) {
            parent::__construct($destino, $horaPartida, $horaLlegada, $numero, $importe, $fecha, $cantAsientosTotales, $cantAsientosDisponibles, $personaResponsable);
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
            $cad = $cad . "\nDocumentacion adicional: ".(($this->getDocAdicional())?"Si":"No").
            "\nPorcentaje de impuestos: %".$this->getPorcentajeImpuestos()."\n";
            return $cad;
        }
}
?>