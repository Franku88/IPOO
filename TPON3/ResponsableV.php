<?php 
    Class ResponsableV {

        private $nombre;
        private $apellido;
        private $numeroEmpleado;
        private $numeroLicencia;

        /**
         * Constructor de la clase ResponsableV
         * @param String nom
         * @param String ape
         * @param String numEmpleado
         * @param String numlicencia
         */
        public function __construct($nom, $ape, $numEmpleado, $numLicencia) {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->numeroEmpleado = $numEmpleado;
            $this->numeroLicencia = $numLicencia;
        }

        public function setNombre($nom) {
            $this->nombre = $nom;
        }

        public function setApellido($ape) {
            $this->apellido = $ape;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getApellido() {
            return $this->apellido;
        }

        public function getNumeroEmpleado() {
            return $this->numeroEmpleado;
        }
        
        public function getNumeroLicencia() {
            return $this->numeroLicencia;
        }

        public function __toString() {
            $cad = "Nombre: ".$this->nombre.", Apellido: ".$this->apellido.", Numero de empleado: ".$this->numeroEmpleado.", Numero de licencia: ".$this->numeroLicencia;
            return $cad;
        }
    }
?>