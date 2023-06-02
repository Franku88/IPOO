<?php
    class Cliente {
        private $nombre;
        private $apellido;
        private $dadoDeBaja;
        private $tipoDni;
        private $numeroDni;

        /**
         * Constructor de la clase Cliente
         * @param String $nom
         * @param String $ape
         * @param boolean $deBaja
         * @param String $tDni
         * @param String $nDni 
         */
        public function __construct($nom, $ape, $deBaja, $tDni, $nDni) {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->dadoDeBaja = $deBaja;
            $this->tipoDni = $tDni;
            $this->numeroDni = $nDni;
        } 

        //Visualizadores
        public function getNombre() {
            return $this->nombre;   
        }
        public function getApellido() {
            return $this->apellido;
        }
        public function getDadoDeBaja() {
            return $this->dadoDeBaja;
        }
        public function getTipoDni() {
            return $this->tipoDni;
        }
        public function getDni() {
            return $this->numeroDni;
        }

        //Modificadores
        public function setNombre($nom) {
            $this->nombre = $nom;
        }
        public function setApellido($ape) {
            $this->apellido = $ape;
        }
        public function setDadoDeBaja($deBaja) {
            $this->dadoDeBaja = $deBaja;
        }
        public function setTipoDni($tDni) {
            $this->tipoDni = $tDni;
        }
        public function setDni($nDni) {
            $this->numeroDni = $nDni;
        }

        public function __toString() {
            /*Metodo que retorna una cadena con la información de la instancia de Cliente*/
            $cadena = "Nombre: ".$this->getNombre().", Apellido: ".$this->getApellido().", Dado de baja: ".(($this->getDadoDeBaja())?'Si':'No').
            ", Tipo de DNI: ".$this->getTipoDni().", Numero de DNI: ".$this->getDni();
            return $cadena;
        }
    }
?>