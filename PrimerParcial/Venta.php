<?php
    Class Venta {
        private $numero;
        private $fecha;
        private $cliente;
        private $coleccionMotos;
        private $precioFinal;

        /**  
         * Constructor de la clase Venta
         * @param String $num
         * @param String $fe
         * @param Cliente $cli
         * @param double $precioF
         */
        public function __construct($num, $fe, $cli, $precioF) {
            $this->numero = $num;
            $this->fecha = $fe;
            $this->cliente = $cli;
            $this->coleccionMotos = [];
            $this->precioFinal = $precioF;
        } 
    
        //Visualizadores
        public function getNumero(){
            return $this->numero;
        }
        public function getFecha(){
            return $this->fecha;
        }
        public function getCliente(){
            return $this->cliente;
        }
        public function getColeccionMotos(){
            return $this->coleccionMotos;
        }
        public function getPrecioFinal(){
            return $this->precioFinal;
        }

        //Modificadores
        public function setFecha($fe){
            $this->fecha = $fe;
        }
        public function setCliente($cli){
            $this->cliente = $cli;
        }
        /**
         * @param Moto[] $motos
         */
        public function setColeccionMotos($motos){
            $this->coleccionMotos = $motos;
        }
        public function setPrecioFinal($precioF){
            $this->precioFinal = $precioF;
        }

        public function _toString() {
            $cadena = "Numero: ".$this->numero."\n Fecha: ".$this->fecha."\n Cliente: (".$this->cliente.")\n Motos: (".$this->coleccionMotos.
            ")\n Precio final: ".$this->precioFinal;
            return $cadena;
        }

        /**
         * Metodo que agrega una moto a la coleccion de motos
         * @param Moto $moto
         */
        public function incorporarMoto($moto) {
            if ($moto->getActiva()) {
                //Agrega $moto a la coleccion
                $posicion = count($this->coleccionMotos);
                $this->coleccionMotos[$posicion] = $moto;
                
                //Calculo el nuevo precio final sumando el precio de $moto al precio final actual
                $nuevoPrecio = $this->precioFinal + $moto->darPrecioVenta();

                //Establezco el nuevo precio final
                $this->precioFinal->setPrecioFinal($nuevoPrecio);
            }
        }
    }
?>