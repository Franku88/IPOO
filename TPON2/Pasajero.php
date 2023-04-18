<?php 
    Class Pasajero {

        private $nombre;
        private $apellido;
        private $dni;
        private $telefono;

        /**
         * Constructor de la clase Pasajero
         * @param String nom
         * @param String ape
         * @param String dn
         * @param String tel
         */
        public function __construct($nom, $ape, $dn, $tel) {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->dni = $dn;
            $this->telefono = $tel;
        }

        public function setNombre($nom) {
            $this->nombre = $nom;
        }

        public function setApellido($ape) {
            $this->apellido = $ape;
        }

        public function setTelefono($tel) {
            $this->telefono = $tel;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getApellido() {
            return $this->apellido;
        }

        public function getTelefono() {
            return $this->telefono;
        }
        
        public function getDni() {
            return $this->dni;
        }

        public function __toString() {
            $cad = "Nombre: ".$this->nombre.", Apellido: ".$this->apellido.", DNI: ".$this->dni.", Telefono: ".$this->telefono;
            return $cad;
        }

        public function equals($otraPersona) {
            $iguales = $this->dni == $otraPersona->getDni();
            return $iguales;
        }
    }
?>