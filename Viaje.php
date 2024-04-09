<?php
include_once 'Pasajero.php';
include_once 'ResponsableV.php';
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
    public function verificarPasajero($documento_a_comparar) {
        $encontrado = false;
        foreach ($this->getPasajeros() as $pasajeroA) {
            if ($pasajeroA->getDocumento() == $documento_a_comparar) {
                $encontrado = true;
                break;
            }
        }
        return $encontrado;
    }
    public function contadorCantidadPasajeros() {
        $full = true;
        if (count($this->getPasajeros()) < $this->getCantidad_Maxima()) {
            $full = false;
        }
        return $full;
    }
    /** Agrega un pasajero 
     * @param object $pasajero
     */
    public function agregarPasajero($pasajero) {
        $array_pasajeros = $this->getPasajeros();
            $array_pasajeros[] = $pasajero;
            $this->setPasajeros($array_pasajeros);
    }
    /** Modifica un dato de un pasajero si lo encuentra en el arreglo existente
     * @param int $id
     * @param 
     * @param int $num_identificadorDato
     */
    public function modificarPasajero($id, $nuevo_dato, $num_identificadorDato) {
        $lista_pasajeros = $this->getPasajeros();
        $success = false;
        foreach ($lista_pasajeros as $pasajero) {
            if ($this->verificarPasajero($pasajero)) {
                //Switch para determinar el dato que se va a cambiar, con el propósito de no tener que cambiar todo sino un solo dato
                switch ($num_identificadorDato) {
                    case 1: $pasajero->setNombre($nuevo_dato);
                            break;
                    case 2: $pasajero->setApellido($nuevo_dato);
                            break;
                    case 3: $pasajero->setTelefono($nuevo_dato);
                            break;
                }
                $success = true;
            }
        }
        return $success;
    }
    public function __toString() {
        $info_viaje = "\n------------VIAJE FELIZ------------" . 
        "\nCódigo del Viaje: " . $this->getCodigo() . 
        "\nDestino: " . $this->getDestino() . 
        "\nCantidad max. de Pasajeros: " . $this->getCantidad_Maxima() . 
        "\n------------RESPONSABLE------------" . $this->getResponsable() . "\n-----------------------------------\n" .
        "\n-------------PASAJEROS-------------\n";
        foreach ($this->getPasajeros() as $un_pasajero) {
            $info_viaje .= 
                            $un_pasajero->__toString() .
                            "\n-----------------------------------\n";
        }
        return $info_viaje;
    }
}