<?php
    Class Empresa {
        private $denominacion;
        private $direccion;
        private $coleccionClientes;
        private $coleccionMotos;
        private $coleccionVentasRealizadas;

        /**  
         * Constructor de la clase Venta
         * @param String $denominacion
         * @param String $direccion
         */
        public function __construct($denom, $direc) {
            $this->denominacion = $denom;
            $this->direccion = $direc;
            $this->coleccionClientes = [];
            $this->coleccionMotos = [];
            $this->coleccionVentasRealizadas = [];
        }

        //Visualizadores
        public function getDenominacion(){
            return $this->denominacion;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function getColeccionClientes(){
            return $this->coleccionClientes;
        }
        public function getColeccionMotos(){
            return $this->coleccionMotos;
        }
        public function getColeccionVentasRealizadas(){
            return $this->coleccionVentasRealizadas;
        }

        //Modificadores
        public function setDireccion($dir){
            $this->direccion = $dir;
        }
        /**
         * @param Cliente[] $clientes
         */
        public function setColeccionClientes($clientes){
            $this->coleccionClientes = $clientes;
        }
        /**
         * @param Moto[] $motos
         */
        public function setColeccionMotos($motos){
            $this->coleccionMotos = $motos;
        }
        /**
         * @param Venta[] $ventas
         */
        public function setColeccionVentasRealizadas($ventas){
            $this->coleccionVentasRealizadas = $ventas;
        }

        public function _toString() {
            $cadena = "Denominacion: ".$this->denominacion."\n Direccion: ".$this->direccion."\n Clientes: (".$this->coleccionClientes.
            ")\n Coleccion de Motos: (".$this->coleccionMotos.")\n Ventas: (".$this->coleccionVentasRealizadas.")";
            return $cadena;
        }

        /**
         * @param String $codigoMoto
         */
        public function retornarMoto($codigoMoto) {
            $moto = "Moto no encontrada";
            $encontrado = false;
            $i = 0;
            $cantidadMotos = count($this->coleccionMotos);
            while ($i <$cantidadMotos && !$encontrado) {
                //Comparo cada codigo del array con $codigoMoto
                $encontrado = ($this->coleccionMotos[$i]->getCodigo() == $codigoMoto);
                //Si se encuentra el codigo, se guarda dicha moto
                if ($encontrado) {
                    $moto = $this->coleccionMotos[$i];
                }
                $i++;
            }
            return $moto;
        }

        public function registrarVenta($codigosMoto, $cliente) {
            $motosVenta = [];
            $cantidadMotosVenta = 0;
            $cantCodigos = count($codigosMoto);
            $cantMotos = count($this->coleccionMotos);
            for ($i=0; $i<$cantCodigos;$i++) {
                $j = 0;
                $encontrado = false;
                while ($j < $cantMotos && !$encontrado) {
                    $encontrado = ($codigosMoto[$i] == $this->coleccionMotos[$j]);
                    $j++;
                }
                if ($encontrado) {
                    $motosVenta[$cantidadMotosVenta]= $this->coleccionMotos[($j-1)];
                    $cantidadMotosVenta++;
                }
            }
            return $motosVenta;
        }

        public function retornarVentasXCliente($tipo, $numDoc) {
            $ventasDeCliente = [];
            $j = count($ventasDeCliente);
            $cantidadVentas = count($this->coleccionVentasRealizadas);
            for ($i=0; $i < $cantidadVentas; $i++) {
                $encontrado = false;
                $cliente = $this->coleccionVentasRealizadas[$i]->getCliente();
                $encontrado = ($cliente->getTipoDni() == $tipo) && ($cliente->getDni() == $numDoc);
                if ($encontrado) {
                    $ventasDeCliente[$j] = $this->coleccionVentasRealizadas[$i];
                    $j++;
                }
            }
            return $ventasDeCliente;
        }
    }
?>