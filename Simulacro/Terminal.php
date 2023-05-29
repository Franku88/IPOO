<?php
class Terminal
{
    //Se registra la siguiente información: denominación, dirección y la colección empresas registradas en la terminal.
    private $denominacion;
    private $direccion;
    private $colEmpresas;

    public function __construct($denominacion, $direccion, $colEmpresas)
    {
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->colEmpresas = $colEmpresas;
    }

    //Metodos de acceso

    public function getDenominacion()
    {
        return $this->denominacion;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getColEmpresas()
    {
        return $this->colEmpresas;
    }

    public function setDenominacion($denominacion)
    {
        $this->denominacion = $denominacion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setColEmpresas($colEmpresas)
    {
        $this->colEmpresas = $colEmpresas;
    }

    //Otros metodos

    public function __toString()
    {
        return "Denominacion: " . $this->getDenominacion() .
            "\nDireccion: " . $this->getDireccion() .
            "\nEmpresas: " . $this->mostrarEmpresas() . "\n";
    }

    private function mostrarEmpresas()
    {
        $coleccion = $this->getColEmpresas();
        $texto = "No se han cargado empresas.\n";
        $cantidad = count($coleccion);
        for ($i = 0; $i < $cantidad; $i++) {
                $texto = $texto . $coleccion[$i];
            }
        return $texto;
    }

    /**
     * Implementar el método ventaAutomatica($cantAsientos, $fecha, $destino, $empresa) 
     * que recibe por parámetro la cantidad de asientos que se requieren, 
     * una fecha, un destino y la empresa con la que se desea viajar. 
     * Automáticamente se registra la venta del viaje. (Para la implementación de 
     * este método debe utilizarse uno de los métodos implementados en la clase Viaje).
     * @param int $cantAsientos
     * @param String $fecha
     * @param String $destino
     * @param Empresa $empresa
     * @return Viaje
     */
    public function ventaAutomatica($cantAsientos, $fecha, $destino, $empresa)
    {
        $viajeVendido = $empresa->venderViajeADestino($cantAsientos, $destino, $fecha);
        return $viajeVendido;
    }


    /**
     * Implementar el método empresaMayorRecaudacion retorna un objeto de la clase 
     * empresa que se corresponde con la de mayor recaudación.
     * @return Empresa
     */
    public function empresaMayorRecaudacion()
    {
        $empresas = $this->getColEmpresas();
        $cantidadEmpresas = count($empresas);
        $empresaMayorRecaudacion = $empresas[0];
        $mayorRecaudacion = 0;
        for ($i = 0; $i < $cantidadEmpresas; $i++) {
            if ($mayorRecaudacion < $empresas[$i]->montoRecaudado()) {
                $empresaMayorRecaudacion = $empresas[$i];
                $mayorRecaudacion = $empresas[$i]->montoRecaudado();
            }
        }
        return $empresaMayorRecaudacion;
    }

    /**
     * Implementar el método responsableViaje($numeroViaje) que recibe por parámetro 
     * un número de viaje y retorna el responsable del viaje
     * @param int $numeroViaje
     * @return objeto de la clase Responsable
     */
    public function responsableViaje($numeroViaje)
    {
        $responsable = null;
        $empresas = $this->getColEmpresas();
        $i = 0;
        while ($i < count($empresas) && $responsable==null) {
            $objEmpresa = $empresas[$i];
            $responsable = $objEmpresa->darInfoViaje($numeroViaje);  
            $i++;         
        }
        return $responsable;
    }
}
?>