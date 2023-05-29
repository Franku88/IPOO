<?php
class Empresa
{
    //: identificación, nombre y la colección de Viajes que realiza.

    private $identificacion;
    private $nombre;
    private $colViajes;

    public function __construct($identificacion, $nombre, $colViajes)
    {
        $this->identificacion = $identificacion;
        $this->nombre = $nombre;
        $this->colViajes = $colViajes;
    }

    //Metodos de acceso

    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getColViajes()
    {
        return $this->colViajes;
    }

    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setColViajes($colViajes)
    {
        $this->colViajes = $colViajes;
    }

    //Otros metodos
    public function __toString()
    {
        return "Identificacion: " . $this->getIdentificacion() .
            "\nNombre: " . $this->getNombre() .
            "\nViajes: " . $this->mostrarViajes() . "\n";
    }

    private function mostrarViajes()
    {
        $coleccionViajes = $this->getColViajes();
        $texto = "No se han cargado viajes.\n";
        $cantidad = count($coleccionViajes);
        for ($i = 0; $i < $cantidad; $i++) {
                $texto = $texto . $coleccionViajes[$i];
            }
        
        return $texto;
    }

    /**
     * Implementar el método darViajeADestino($elDestino) que recibe por parámetro 
     * un destino junto a una cantidad de asientos y retorna una colección con 
     * todos los viajes disponibles a ese destino. 
     * @param String $elDestino
     * @param int $cantAsientos
     * @return Array
     */
    public function darViajeADestino($elDestino, $cantAsientos)
    {
        $coleccionViajes = $this->getColViajes();
        $viajesAlDestino = array();
        for ($i=0; $i<count($coleccionViajes);$i++){
            $unViaje = $coleccionViajes[$i];
            //el viaje va a ese destino
            if ($unViaje->getDestino()==$elDestino 
                &&
                //el viaje tiene cant asientos disponibles
                $unViaje->getCantAsientosDisponibles()>=$cantAsientos
                    ){
                        $viajesAlDestino[] =$unViaje;

            }
        }
        
        return $viajesAlDestino;
    }

    /**
     * Implementar el método incorporarViaje que recibe como parámetro un viaje, 
     * verifica que no se encuentre registrado ningún otro viaje al mismo destino,
     * en la misma fecha y con el mismo horario de partida. 
     * El método retorna verdadero si la incorporación del viaje se realizó 
     * correctamente y falso en caso contrario.
     * @param Viaje $nuevoViaje
     * @return boolean
     */
    public function incorporarViaje($nuevoViaje)
    {
        $coleccionViajes = $this->getColViajes();
        $encontro = false;
        $exito = false;
        $i =0;
        while ($i<count($coleccionViajes) && !$encontro){
            $unViaje = $coleccionViajes[$i];
            if ($unViaje->getDestino() == $nuevoViaje->getDestino()
                    &&
                $unViaje->getFecha() == $nuevoViaje->getFecha()
                    &&
                $unViaje->getHoraPartida() == $nuevoViaje->getHoraPartida()){
                //si es el destino, la fecha y la hora de partida ya existe un 
                //viaje igual al que quiero ingresar
                    $encontro =true;
            }
            $i++;
        }        
        if (!$encontro){
            $coleccionViajes[]=$nuevoViaje;
            $this->setColViajes($coleccionViajes);
            $exito = true;
        }
       return $exito;
    }

    /*Implementar el método venderViajeADestino($cantAsientos, $destino) método que recibe 
     * por parámetro la cantidad de asientos y el destino y se registra la asignación 
     * del viaje en caso de ser posible(invocar al método asignarAsientosDisponibles ). 
     * El método retorna la instancia del viaje asignado 
     * o null en caso contrario.
     * @param int $cantAsientos
     * @param String $destino
     * @param String $fecha
     * @return objViaje
     */
    public function venderViajeADestino($cantAsientos, $destino, $fecha){
        $coleccionViajes = $this->getColViajes();
        $viajeAsignado = null;
        $encontro = false;
        $i =0;
        while ($i<count($coleccionViajes) && !$encontro){
            $unViaje = $coleccionViajes[$i];
            if ($unViaje->getDestino() == $destino && $unViaje->getFecha() == $fecha){
                 $haydispo = $unViaje->asignarLugaresDisponibles($cantAsientos);
                 if ($haydispo){
                    $encontro =true;
                    $viajeAsignado = $unViaje;
                 }
                 
            }    
             $i++;            
        } 
         
        return $viajeAsignado;
    }

    /**
     * Implementar el método montoRecaudado que retorna el monto recaudado 
     * por la Empresa.
     * (tener en cuenta los asientos vendidos y el importe del viaje)
     * @return int
     */
    public function montoRecaudado(){
        $totalRecaudado = 0;
        $coleccionViajes = $this->getColViajes();
        $cantidadViajes = count($coleccionViajes);
        for ($i = 0; $i<$cantidadViajes; $i++){
            $unViaje = $coleccionViajes[$i];
            $totalRecaudado = $totalRecaudado + ($unViaje->getImporte() * 
                        ($unViaje->getCantAsientosTotales()-$unViaje->getCantAsientosDisponibles()));
        }
        return $totalRecaudado;
    }

    public function darInfoViaje($numeroViaje)
    {
        $i = 0;
        $objresponsable = null;
        $colViajes = $this->getColViajes();
        while ($i < count($colViajes) && $objresponsable == null) {
                $objViaje = $colViajes[$i];
                if ($objViaje->getNumero() == $numeroViaje) {
                    $objresponsable = $objViaje->getResponsable();
                }
                $i++;
            }
        return $objresponsable;
          
        }
}
?>