<?php 
    Class Pasajero {

        private $dni;
        private $nombre;
        private $apellido;
        private $telefono;
        private $numeroAsiento;
        private $numeroTicket;

        /**
         * Constructor de la clase Pasajero
         * @param String nom
         * @param String ape
         * @param String dn
         * @param String tel
         * @param String numA
         * @param String numT
         */
        public function __construct($nom, $ape, $dn, $tel, $numA, $numT) {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->dni = $dn;
            $this->telefono = $tel;
            $this->numeroAsiento = $numA;
            $this->numeroTicket = $numT;
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

        public function setNumeroAsiento($num) {
            $this->numeroAsiento = $num;
        }

        public function setNumeroTicket($num) {
            $this->numeroTicket = $num;
        }
        
        public function getDni() {
            return $this->dni;
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
        
        public function getNumeroAsiento() {
            return $this->numeroAsiento;
        }

        public function getNumeroTicket() {
            return $this->numeroTicket;
        }

        public function __toString() {
            $cad = "Nombre: ".$this->getNombre().", Apellido: ".$this->getApellido().", DNI: ".$this->getDni().", Telefono: ".$this->getTelefono().
            ", Numero de asiento: ".$this->getNumeroAsiento().", Numero de ticket: ".$this->getNumeroTicket();
            return $cad;
        }

        public function equals($otraPersona) {
            $iguales = $this->getDni() == $otraPersona->getDni();
            return $iguales;
        }

        public function darPorcentajeIncremento() {
            //Metodo que retorna el incremento en porcentaje
            $incremento = 10;
            return $incremento;
        }

    }
?>