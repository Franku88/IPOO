<?php
    class Viaje {

        private $codigo;
        private $destino;
        private $cantidadMaxPasajeros;
        private $pasajeros;

        /**
         * Constructor de la clase Viaje
         * @param int $cod
         * @param String $des
         * @param int $cantMax
         * @param mixed[] $pas
         */
        public function __construct($cod, $des, $cantMax, $pas) {
            $this->codigo = $cod;
            $this->destino = $des;
            $this->cantidadMaxPasajeros = $cantMax;
            $this->pasajeros = $pas;
        }

        //Observadores
        public function getCodigo() {
            return $this->codigo;
        }

        public function getDestino() {
            return $this->destino;
        }

        public function getCantidadMaxPasajeros() {
            return $this->cantidadMaxPasajeros;
        }

        public function getPasajeros() {
            return $this->pasajeros;
        }

        
        //No se realiza setCodigo pues es el atributo clave de la clase
        //En caso de necesitarlo, generar otro objeto con codigo diferente
        
        //Modificadores
        public function setDestino($des) {
            $this->destino = $des;
        }

        public function setCantidadMaxPasajeros($cantMax) {
            $this->cantidadMaxPasajeros = $cantMax;
        }

        /**
         * Asigna array de pasajeros.
         * Retorna un booleano que indica si se pudo realizar la asignacion.
         * @param mixed[] $pas (array de pasajeros cargados)
         * @var boolean $exito (array ingresado no se excede de pasajeros)
         * @return boolean
         */
        public function setPasajeros($pas) {
            //Si la longitud de $pas es mayor a cantidad maxima, no permite realizar la asignacion
            //Retorna falso si no se realizó la carga
            if (count($pas) <= $this->cantidadMaxPasajeros) {
                $this->pasajeros = $pas;
                $exito = true;
            } else {
                $exito = false;
            }
            return $exito;
        }

        //Modifica array $pasajeros
        /**
         * Modifica un pasajero de la $pos del arreglo $this->pasajeros.
         * Retorna un booleano que indica si se pudo realizar la modificacion.
         * @param int $pos (posicion dentro del arreglo)
         * @param String $nom
         * @param String $ap
         * @param String $dni
         * @return boolean
         */
        public function setPasajero($pos, $nom, $ap, $dni) {
            /*Si la $pos de pasajero no se encuentra dentro de $this->pasajeros, 
            no sera posible cargar el pasajero en dicha posicion*/
            if ($pos >= 0 || $pos < $this->cantidadMaxPasajeros) {
                $this->pasajeros[$pos] = ["Nombre"=>$nom, "Apellido"=>$ap, "Numero de DNI"=>$dni];
                $exito = true;
            } else {
                $exito = false;
            }
            return $exito;

        }

        public function toString() {
            $cadena = "Codigo: ".$this->codigo.", Destino: ".$this->destino.", Cantidad maxima de pasajeros: ".$this->cantidadMaxPasajeros;
            return $cadena;
        }
    }
?>