<?php
    include "Pasajero.php";
    Class PasajeroNE extends Pasajero {
        // sillas de ruedas, asistencia para el embarque o desembarque, o comidas especiales para personas con alergias o restricciones alimentarias
        private $sillaRuedas;
        private $asistencia;
        private $comidaEspecial;

         /**
         * Constructor de la clase PasajeroNE
         * @param String nom
         * @param String ape
         * @param String dn
         * @param String tel
         * @param String numA
         * @param String numT
         * @param boolean sRuedas
         * @param boolean asist
         * @param boolean comidaEsp
         */
        public function __construct($nom, $ape, $dn, $tel, $numA, $numT, $sRuedas, $asist, $comidaEsp) {
            parent::__construct($nom, $ape, $dn, $tel, $numA, $numT);
            $this->sillaRuedas = $sRuedas;
            $this->asistencia = $asist;
            $this->comidaEspecial = $comidaEsp;
        }

        public function setSillaRuedas($sRuedas) {
            $this->sillaRuedas = $sRuedas; 
        }

        public function setAsistencia($asist) {
            $this->asistencia = $asist; 
        }

        public function setComidaEspecial($comidaEsp) {
            $this->comidaEspecial = $comidaEsp; 
        }

        public function getSillaRuedas() {
            return $this->sillaRuedas;
        }

        public function getAsistencia() {
            return $this->asistencia;
        }

        public function getComidaEspecial() {
            return $this->comidaEspecial;
        }

        public function __toString() {
            $cad = parent::__toString();
            $cad .= "Silla de ruedas: ".$this->getSillaRuedas(). ", Asistencia des/embarque: " .$this->getAsistencia().", Comida especial: ".$this->getComidaEspecial();
            return $cad;
        }
        
        public function darPorcentajeIncremento() {
            //Metodo que retorna el incremento en porcentaje
            if ($this->cantidadNecesidades() > 1) {
                $incremento = 30;
            } else {
                $incremento = 15;
            }
            return $incremento;
        }

        private function cantidadNecesidades() {
            //Metodo privado que cuenta y retorna la cantidad de necesidades habilitadas para el pasajero
            $cant = 0;
            if ($this->getSillaRuedas()) {
                $cant++;
            }
            if ($this->getAsistencia()) {
                $cant++;
            }
            if ($this->getComidaEspecial()) {
                $cant++;
            }
            return $cant;
        }

    }

?>