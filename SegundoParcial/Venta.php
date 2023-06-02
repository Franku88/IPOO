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
        public function __construct($num, $fe, $cli, $colMotos, $precioF) {
            $this->numero = $num;
            $this->fecha = $fe;
            $this->cliente = $cli;
            $this->coleccionMotos = $colMotos;
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

        public function mostrarMotos(){
            $cad = "";
            foreach ($this->getColeccionMotos() as $moto) {
                $cad = $cad.$moto->__toString()." \n";
            }
            return $cad;
        }

        public function __toString() {
            $num = $this->getNumero();
            $fe = $this->getFecha();
            $cli = ($this->getCliente())->__toString();
            $colM = $this->mostrarMotos();
            $precioF = $this->getPrecioFinal();
            return <<<END
                - Numero: $num
                Fecha: $fe
                Cliente: $cli
                Motos:
            $colM    Precio final: $precioF
            END;
        }

        /**
         * Metodo que agrega una moto a la coleccion de motos
         * @param Moto $moto
         */
        public function incorporarMoto($moto) {
            if ($moto->getActiva()) {
                //Agrega $moto a la coleccion
                $coleccion = $this->getColeccionMotos();
                $posicion = count($coleccion);
                $coleccion[$posicion] = $moto;
                $this->setColeccionMotos($coleccion);
                
                //Calculo el nuevo precio final sumando el precio de $moto al precio final actual
                $nuevoPrecio = $this->getPrecioFinal() + $moto->darPrecioVenta();

                //Establezco el nuevo precio final
                $this->setPrecioFinal($nuevoPrecio);
            }
        }

        /**
         * Metodo que realiza sumatoria de monto de las motos nacionales
         * relacionadas a la venta actual
         * @return int
         */
        public function retornarTotalVentaNacional() {
            $motos = $this->getColeccionMotos();
            $totalNacional = 0;
            foreach($motos as $moto) {
                if (get_class($moto) == 'MotoNacional') {
                    $totalNacional = $totalNacional + $moto->darPrecioVenta();
                }
            }
            return $totalNacional;
        }

        /**
         * Metodo que retorna una coleccion de motos importadas 
         * relacionadas a la venta actual
         * @return MotoImportada[]
         */
        public function retornarMotosImportadas() {
            $motos = $this->getColeccionMotos();
            $importadas = [];
            foreach ($motos as $moto) {
                if (get_class($moto) == 'MotoImportada') {
                    $importadas[] = $moto; 
                }
            }
            return $importadas;
        }

        /**
         * Metodo que retorna verdadero si la venta tiene al menos
         * una moto importada, retorna falso si todas son nacionales
         * @return boolean
         */
        public function tieneMotoImportada() {
            $motos = $this->getColeccionMotos();
            $i = 0;
            $cantMotos = count($motos);
            $encontrado = false;
            while (!$encontrado && $i < $cantMotos) {
                $encontrado = get_class($motos[$i]) == 'MotoImportada';
                $i++;
            }
            return $encontrado;
        }
    }
?>