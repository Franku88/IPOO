<?php
class Viaje
{

    /*Se registra la siguiente información: destino, hora de partida, hora de llegada, número,
    importe, fecha, cantidad de asientos totales, cantidad de asientos disponibles, y una
    referencia a la persona responsable del viaje.    
    */
    
    private $destino;
    private $horaPartida;
    private $horaLlegada;
    private $numero;
    private $importe;
    private $fecha;
    private $cantAsientosTotales;
    private $cantAsientosDisponibles;
    private $objResponsable;

    public function __construct(
        $destino,
        $horaPartida,
        $horaLlegada,
        $numero,
        $importe,
        $fecha,
        $cantAsientosTotales,
        $cantAsientosOcupados,
        $personaResponsable
    ) {
        $this->destino = $destino;
        $this->horaPartida = $horaPartida;
        $this->horaLlegada = $horaLlegada;
        $this->numero = $numero;
        $this->importe = $importe;
        $this->fecha = $fecha;
        $this->cantAsientosTotales = $cantAsientosTotales;
        $this->cantAsientosDisponibles = $cantAsientosOcupados;
        $this->objResponsable = $personaResponsable;
    }

    //metodos de acceso
    

    public function getDestino(){
        return $this->destino;
    }

    public function getHoraPartida(){
        return $this->horaPartida;
    }

    public function getHoraLlegada(){
        return $this->horaLlegada;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function getImporte(){
        return $this->importe;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getCantAsientosTotales(){
        return $this->cantAsientosTotales;
    }

    public function getCantAsientosDisponibles(){
        return $this->cantAsientosDisponibles;
    }

    public function getResponsable(){
        return $this->objResponsable;
    }

    public function setDestino($destino){
        $this->destino = $destino;
    }

    public function setHoraPartida($horaPartida){
        $this->horaPartida = $horaPartida;
    }

    public function setHoraLlegada($horaLlegada){
        $this->horaLlegada = $horaLlegada;
    }

    public function setNumero($numero){
        $this->numero = $numero;
    }

    public function setImporte($importe){
        $this->importe = $importe;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setCantAsientosTotales($cantAsientosTotales){
        $this->cantAsientosTotales = $cantAsientosTotales;
    }

    public function setCantAsientosOcupados($cantAsientosDisponibles){
        $this->cantAsientosDisponibles = $cantAsientosDisponibles;
    }

    public function setResponsable($pResponsable){
        $this->objResponsable = $pResponsable;
    }

    //Otros metodos
    public function __toString()
    {
        return "Destino: " . $this->getDestino() . 
        "\nHora de partida: " . $this->getHoraPartida() . 
        "\nHora de llegada: " . $this->getHoraLlegada() . 
        "\nNumero: " . $this->getNumero() . 
        "\nImporte: " . $this->getImporte() . 
        "\nFecha: " . $this->getFecha() . 
        "\nCantidad de asientos totales: " . $this->getCantAsientosTotales() . 
        "\nCantidad de asientos ocupados: " . $this->getCantAsientosDisponibles() . 
        "\nPersona responsable: " . $this->getResponsable() . "\n";
    }

   /*    asignarAsientosDisponibles($catAsientos)        
     * Metodo que recibe por parametro la cantidad de asientos que desean asignarse.
     * Retorna true en caso de que se pueda realizar la asignacion o false en 
     * caso contrario
     * @param int $cantAsientos
     * @return boolean
     */
    public function asignarLugaresDisponibles($cantAsientos){
        $exito = false;
        $cantDisp = $this->getCantAsientosDisponibles();
        if ($cantDisp-$cantAsientos>0){
            $exito =true;
            $cantDisponibles =$cantDisp-$cantAsientos;
            $this->setCantasientosdisponibles($cantDisponibles);
        }           
        return $exito;

    }
}
?>