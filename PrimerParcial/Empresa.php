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
        public function __construct($denom, $direc, $colClientes, $colMotos, $colVentas) {
            $this->denominacion = $denom;
            $this->direccion = $direc;
            $this->coleccionClientes = $colClientes;
            $this->coleccionMotos = $colMotos;
            $this->coleccionVentasRealizadas = $colVentas;
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
        public function setDenominacion($denom) {
            $this->denominacion = $denom;
        }
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

        public function mostrarClientes(){
            $cad = "";
            $colClientes = $this->getColeccionClientes();
            foreach ($colClientes as $cliente) {
                $cad = $cad.$cliente->__toString()." \n";
            }
            return $cad;
        }

        public function mostrarMotos(){
            $cad = "";
            $colMotos = $this->getColeccionMotos();
            foreach ($colMotos as $moto) {
                $cad = $cad.$moto->__toString()." \n";
            }
            return $cad;
        }

        public function mostrarVentas(){
            $cad = "";
            $colVentas = $this->getColeccionVentasRealizadas();
            foreach ($colVentas as $venta) {
                $cad = $cad.'-'.$venta->__toString()." \n";
            }
            return $cad;
        }
        
        public function __toString() {
            $info_clientes = $this->mostrarClientes();
            $info_motos = $this->mostrarMotos();
            $info_ventas = $this->mostrarVentas();
            $dir = $this->getDireccion();
            $denom = $this->getDenominacion();
            return <<<END
                Denominacion: $denom
                Direccion:  $dir
                Clientes: 
            $info_clientes
                Motos para vender:
            $info_motos
                Ventas realizadas: 
            $info_ventas
            END;
        }

        /**
         * @param String $codigoMoto
         */
        public function retornarMoto($codigoMoto) {
            $moto = "Moto no encontrada";
            $encontrado = false;
            $i = 0;
            $cantidadMotos = count($this->getColeccionMotos());
            while ($i <$cantidadMotos && !$encontrado) {
                //Comparo cada codigo del array con $codigoMoto
                $encontrado = ($this->getColeccionMotos()[$i]->getCodigo() == $codigoMoto);
                //Si se encuentra el codigo, se guarda dicha moto
                if ($encontrado) {
                    $moto = $this->getColeccionMotos()[$i];
                }
                $i++;
            }
            return $moto;
        }

        public function registrarVenta($codigosMoto, $cliente) {
            //Si el cliente no esta dado de baja, realiza la verificacion de codigos de moto
            //Si el cliente esta dado de baja o ninguna moto se pudo vender, se retorna un numero negativo
            if (!$cliente->getDadoDeBaja()) {
                $montoFinal = 0;
                $motosVenta = [];
                $cantidadMotosVenta = 0;
                $cantCodigos = count($codigosMoto);
                $colMotos = $this->getColeccionMotos();
                $cantMotos = count($colMotos);
                //Por cada codigo de $codigosMoto
                for ($i = 0; $i < $cantCodigos; $i++) {
                    $j = 0;
                    $encontrado = false;
                    //Busca cada codigo en $colMotos de la empresa
                    while ($j < $cantMotos && !$encontrado) {
                        $encontrado = ($codigosMoto[$i] == $colMotos[$j]->getCodigo());
                        $j++;
                    }
                    //Si la moto se encontro y la misma esta activa
                    if ($encontrado && $colMotos[$j-1]->getActiva()) {
                        //Se aumenta monto de la venta usando el precio venta
                        $montoFinal = $montoFinal + $colMotos[$j-1]->darPrecioVenta();
                        //Se agrega moto a la venta
                        $motosVenta[$cantidadMotosVenta] = $colMotos[$j-1];
                        $cantidadMotosVenta++;
                    }
                }
                if (count($motosVenta) > 0) {
                    $colVentasRealizadas = $this->getColeccionVentasRealizadas();
                    //Cantidad de ventas realizadas me da el numero y posicion de venta actual
                    $numVenta = count($colVentasRealizadas);
                    //Creo venta
                    $venta = new Venta($numVenta, date('d-m-Y'), $cliente, $motosVenta, $montoFinal);
                    //Agrego venta creada a coleccion de ventas realizadas
                    $colVentasRealizadas[$numVenta] = $venta;
                    //Seteo nueva coleccion modificada
                    $this->setColeccionVentasRealizadas($colVentasRealizadas);
                } else {
                    //Como ninguna moto se encontro/pudo vender, retorna un numero negativo
                    $montoFinal = -1;
                }
            } else {
                //Como el cliente esta dado de baja, se retorna un numero negativo
                $montoFinal = -1;
            }
            return $montoFinal;
        }

        public function retornarVentasXCliente($tipo, $numDoc) {
            $ventasDeCliente = [];
            $j = count($ventasDeCliente);
            $cantidadVentas = count($this->getColeccionVentasRealizadas());
            for ($i = 0; $i < $cantidadVentas; $i++) {
                $encontrado = false;
                $cliente = $this->getColeccionVentasRealizadas()[$i]->getCliente();
                $encontrado = ($cliente->getTipoDni() == $tipo) && ($cliente->getDni() == $numDoc);
                if ($encontrado) {
                    $ventasDeCliente[$j] = $this->getColeccionVentasRealizadas()[$i];
                    $j++;
                }
            }
            return $ventasDeCliente;
        }
    }
?>