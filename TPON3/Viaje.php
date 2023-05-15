<?php
    class Viaje {

        private $codigo;
        private $destino;
        private $cantidadMaxPasajeros;
        private $pasajeros;
        private $responsable;
        private $costo;
        private $totalAbonado;

        /**
         * Constructor de la clase Viaje
         * @param String $cod
         * @param String $des
         * @param int $cantMax
         * @param Pasajero[] $pas
         * @param ResponsableV $resp
         * @param double $cost
         * @param double $total
         */
        public function __construct($cod, $des, $cantMax, $pas, $resp, $cost, $total) {
            $this->codigo = $cod;
            $this->destino = $des;
            $this->cantidadMaxPasajeros = $cantMax;
            $this->pasajeros = $pas;
            $this->responsable = $resp;
            $this->costo = $cost;
            $this->totalAbonado = $total;
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

        public function getResponsable() {
            return $this->responsable;
        }

        public function getCosto() {
            return $this->costo;
        }

        public function getTotalAbonado() {
            return $this->totalAbonado;
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

        public function setResponsable($resp) {
            $this->responsable = $resp;
        }

        public function setCosto($cost) {
            $this->costo = $cost;
        }

        public function setTotalAbonado($total) {
            $this->totalAbonado = $total;
        }

        /**
         * Asigna array de pasajeros.
         * Retorna un booleano que indica si se pudo realizar la asignacion.
         * @param Pasajero[] $pas (array de pasajeros cargados)
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
         * @param Pasajero $pasajero
         * @return boolean
         */
        public function setPasajero($pos, $pasajero) {
            /*Si la $pos de pasajero no se encuentra dentro de $this->pasajeros, 
            no sera posible cargar el pasajero en dicha posicion*/
            if ($pos >= 0 || $pos < $this->cantidadMaxPasajeros) {
                $this->pasajeros[$pos] = $pasajero;
                $exito = true;
            } else {
                $exito = false;
            }
            return $exito;

        }

        public function toString() {
            $cadena = "Codigo: ".$this->codigo.", Destino: ".$this->destino.
            ", Cantidad maxima de pasajeros: ".$this->cantidadMaxPasajeros.
            "\nResponsable: ".($this->responsable);
            return $cadena;
        }

        /**
         * Verifica si un pasajero se encuentra en el viaje
         * @param Pasajero $pasajero
         * @return boolean $seEncuentra
         */
        public function estaEnViaje($pasajero){
            $seEncuentra = false;
            $i = 0;
            $limite = count($this->pasajeros);
        
            while (!$seEncuentra && $i < $limite){
              if ($this->pasajeros[$i]->equals($pasajero)){
                $seEncuentra = true;
              } else{
                $i++;
              }
            }
            return $seEncuentra;
          }

        /**
         * Metodo que vende un pasaje al pasajero ingresado. Retorna el costo a abonar por el pasajero 
         * Si el viaje esta lleno, entonces retorna numero negativo y no lo agrega al
         * @param Pasajero $pasajero
         * @return double $costo
         */
        public function venderPasaje($pasajero) {
        $costo = -1;
        if ($this->hayPasajesDisponible()) { //Si el viaje no esta lleno
            //Agrega pasajero a coleccion de pasajeros
            $this->setPasajero(count($this->getPasajeros())+1, $pasajero);
            //Calcula el costo segun el porcentaje de incremento y costo de viaje
            $costo = $this->getCosto() * ((100 + $pasajero->darPorcentajeIncremento())/100);
            //Suma costo calculado al total abonado y lo reemplaza
            $this->setTotalAbonado($this->getTotalAbonado() + $costo);
        }
        return $costo;
        }

        /**
         * Metodo que retorna verdadero si la cantidad de pasajeros actual es menor al limite
         * @return boolean
         */
        public function hayPasajesDisponible() {
            $cantP = count($this->getPasajeros());
            return $cantP < $this->getCantidadMaxPasajeros();
        }
    }
?>