<?php
include_once 'Pasajero.php';
include_once 'ResponsableV';
class Viaje{
    private $codigo;
    private $destino;
    private $cantidad_maxima;
    //Arreglo de pasajeros
    private array $pasajeros;
    private $responsable;

    public function __construct($codigo_viaje, $destino_viaje, $cantidad_viaje, $responsableV){
        $this->codigo = $codigo_viaje;
        $this->destino = $destino_viaje;
        $this->cantidad_maxima = $cantidad_viaje;
        $this->pasajeros = array(); //Comienza como un array vacío
        $this->responsable = $responsableV;
    }
    public function getCodigo() {
        return $this->codigo;
    }
    public function setCodigo($nuevo_codigo) {
        $this->codigo = $nuevo_codigo;
    }
    public function getDestino() {
        return $this->destino;
    }
    public function setDestino($nuevo_codigo) {
        $this->codigo = $nuevo_codigo;
    }
    public function getCantidad_Maxima(){
        return $this->cantidad_maxima;
    }
    public function setCantidad_Maxima($nueva_cantidad) {
        $this->cantidad_maxima = $nueva_cantidad;
    }
    public function getPasajeros() {
        return $this->pasajeros;
    }
    public function setPasajeros($nuevo_arrayPasajeros) {
        $this->pasajeros = $nuevo_arrayPasajeros;
    }
    public function getResponsable() {
        return $this->responsable;
    }
    public function setResponsable($nuevo_responsable) {
        $this->responsable = $nuevo_responsable;
    }
    /** Funcion que permite verificar si un pasajero está presente en la lista a partir de su Numero de Documento
     * @param object $pasajero
     * @return boolean
     */
    public function verificarPasajero($pasajero) {
        $encontrado = false;
        foreach ($this->getPasajeros() as $pasajeroA) {
            if ($pasajeroA->getDocumento() == $pasajero->getDocumento()) {
                $encontrado = true;
                break;
            }
        }
        return $encontrado;
    }
    /** Agrega un pasajero luego de que se cumplan las verificaciones
     * @param object $pasajero
     * @return boolean
     */
    public function agregarPasajero($pasajero) {
        $agregado = false;
        $array_pasajeros = $this->getPasajeros();
        if (count($array_pasajeros) < $this->getCantidad_Maxima() && !$this->verificarPasajero($pasajero)) {
            $array_pasajeros[] = $pasajero;
            $this->setPasajeros($array_pasajeros);
            $agregado = true;
        }
        return $agregado;
    }
    
}