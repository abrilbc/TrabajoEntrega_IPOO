<?php
include_once 'Pasajero.php';
include_once 'ResponsableV.php';
class Viaje{
    private $codigo;
    private $destino;
    private $cantMaxima;
    private $arrayPasajeros;
    private $objResponsableV;
    
//Metodo constructor 
    public function __construct($vCodigo, $vDestino, $vCantMaxima, $objetoResponsableV) {
        $this->codigo = $vCodigo;
        $this->destino = $vDestino;
        $this->cantMaxima = $vCantMaxima;
        $this->arrayPasajeros = array(); //array vacío
        $this->objResponsableV = $objetoResponsableV;
    }
//Métodos de Acceso
    public function getCodigo() {
        return $this->codigo;
    }
    public function setCodigo($nuevoCodigo) {
        $this->codigo = $nuevoCodigo;
    }
    public function getDestino() {
        return $this->destino;
    }
    public function setDestino($nuevoDestino) {
        $this->destino = $nuevoDestino;
    }
    public function getCantMaxima() {
        return $this->cantMaxima;
    }
    public function setCantMaxima($nuevaCantMaxima) {
        $this->cantMaxima = $nuevaCantMaxima;
    }
    public function getArrayPasajeros() {
        return $this->arrayPasajeros;
    }
    public function setArrayPasajeros($nuevoArrayPasajeros) {
        $this->arrayPasajeros = $nuevoArrayPasajeros;
    }
    public function getObjResponsableV() {
        return $this->objResponsableV;
    }
    public function setObjResponsableV($nuevoObjResponsableV) {
        $this->objResponsableV = $nuevoObjResponsableV;
    }
//Métodos y funciones del objeto

    /** Funcion que permite verificar si un pasajero está presente 
     * en la lista a partir de su Numero de Documento
     * @param int $docObjPasajero
     * @return bool $found
     */
    public function verificarPasajero($docObjPasajero) {
        $arregloPasajeros = $this->getArrayPasajeros();
        $indice = 0;
        $found = false;
        while ($indice <= $this->getCantMaxima() && !$found) {
            $dniPasajeroEnArray = $arregloPasajeros[$indice]->getDni();
            if ($dniPasajeroEnArray == $docObjPasajero) {
                $found = true;
            } else {
                $indice++;
            }
        }
        return $found;
    }
    /** Función para buscar un pasajero con el dni y devuelve el indice de la 
     * posicion de ese pasajero en el arreglo
     * @param int $dniObjPasajero
     * @return int $indice 
     */
    public function obtenerIndicePasajero($dniObjPasajero) {
        $arregloPasajeros = $this->getArrayPasajeros();
        $indice = 0;
        $verifica = false;
        while ($indice <= $this->getCantMaxima() && !$verifica) {
            $dniPasajeroEnArray = $arregloPasajeros[$indice]->getDni();
            if ($dniPasajeroEnArray == $dniObjPasajero) {
                $verifica = true;
            } else {
                $indice++;
            }
        }
        if (!$verifica) {
            $indice = -1;
        }
        return $indice;
    }

    /** Función que devuelve true si el viaje está lleno, false si no lo está
     * @return bool $full
     */
    public function verificaViajeLleno() {
        $full = true;
        if (count($this->getArrayPasajeros()) < $this->getCantMaxima()) {
            $full = false;
        }
        return $full;
    }
    /** Funcion que modifica los datos de un pasajero
     * @param object $objPasajero
     */
    
    /** Función que agrega un pasajero si no está en el arreglo en base a su dni, y si está, lo modifica
     * @param int $docObjPasajero
     * @param object $objPasajero
     * @return bool $success
     */
    public function ingresarModificarPasajero($ObjPasajero) {
        $pasajeros = $this->getArrayPasajeros();
        //Datos del pasajero
        $docPasajero = $ObjPasajero->getDni();
        $nombrePasajero = $ObjPasajero->getNombre();
        $apellidoPasajero = $ObjPasajero->getApellido();
        $telPasajero = $ObjPasajero->getTelefono();
        if ($this->verificarPasajero($docPasajero)) {
            $indiceP = $this->obtenerIndicePasajero($docPasajero);
            $pasajeroA = $pasajeros[$indiceP];
            
        }
        
    }
    public function __toString() {
        $info_viaje = "\n------------VIAJE FELIZ------------" . 
        "\nCódigo del Viaje: " . $this->getCodigo() . 
        "\nDestino: " . $this->getDestino() . 
        "\nCantidad max. de Pasajeros: " . $this->getCantMaxima() . 
        "\n-----------------------------------\n" .
        "\n------------RESPONSABLE------------" 
            . $this->getObjResponsableV() . 
        "\n-----------------------------------\n" .
        "\n-------------PASAJEROS-------------\n";
        foreach ($this->getArrayPasajeros() as $un_pasajero) {
            $info_viaje .= $un_pasajero->__toString() .
                            "\n-----------------------------------\n";
        }
        return $info_viaje;
    }
}