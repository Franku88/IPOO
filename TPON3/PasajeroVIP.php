<?php
    include 'Pasajero.php';
    Class PasajeroVIP extends Pasajero {
        private $numeroViajeroFrecuente;
        private $millas;

        /**
         * Constructor de la clase PasajeroVIP
         * @param String nom
         * @param String ape
         * @param String dn
         * @param String tel
         * @param String numA
         * @param String numT
         * @param String numV
         * @param double $mil
         */
        public function __construct($nom, $ape, $dn, $tel, $numA, $numT, $numV, $mil) {
            parent::__construct($nom, $ape, $dn, $tel, $numA, $numT);
            $this->numeroViajeroFrecuente = $numV;
            $this->millas = $mil;
        }

        public function setNumeroViajeroFrecuente($numV) {
            $this->numeroViajeroFrecuente = $numV;
        }

        public function setMillas($mil) {
            $this->millas = $mil;
        }

        public function getNumeroViajeroFrecuente() {
            return $this->numeroViajeroFrecuente;
        }

        public function getMillas() {
            $this->millas;
        }

        public function __toString() {
            $cad = parent::__toString();
            $cad .= ", Viajero frecuente: ".$this->getNumeroViajeroFrecuente().", Millas: ".$this->getMillas();
            return $cad;
        }

        public function darPorcentajeIncremento() {
            //Metodo que retorna el incremento en porcentaje
            if ($this->getMillas()>300) {
                $incremento = 30;
            } else {
                $incremento = 35;
            } 
            return $incremento;
        }
        
    }
?>