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

    public function verificarResponsable($numero_empleado) {
        $responsable = $this->getObjResponsableV();
        $nroEmpleado = $responsable->getNumero_Empleado();
        $existente = true;
        if ($nroEmpleado != $numero_empleado) {
            $existente = false;
        }
        return $existente;
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
    /** Funcion que modifica los datos de un pasajero basado en el dato que se quiere cambiar
     * @param int $dni
     * @param string $atributo
     * @param mixed $datoNuevo
     */
    public function modificarPasajero($dni, $atributo, $datoNuevo) {
        $arregloPasajeros = $this->getArrayPasajeros();
        $indiceCambio = $this->obtenerIndicePasajero($dni);
        $pasajero = $arregloPasajeros[$indiceCambio];
        if ($this->verificarPasajero($dni)) {
            switch ($atributo) {
                case 'nombre': 
                    $pasajero->setNombre($datoNuevo);
                    break;
                case 'apellido':
                    $pasajero->setApellido($datoNuevo);
                    break;
                case 'telefono':
                    $pasajero->setTelefono($datoNuevo);
                    break;
            }
        }
    }

    /** Funcion que modifica los datos de un pasajero basado en el dato que se quiere cambiar
     * @param int $dni
     * @param string $atributo
     * @param mixed $datoNuevo
     */
    public function modificarResponsable($atributo, $datoNuevo) {
        $objResponsable = $this->getObjResponsableV();
        $nroEmpleado_responsable = $objResponsable->getNumero_Empleado();
        if ($this->verificarResponsable($nroEmpleado_responsable)) {
            switch ($atributo) {
                case 'nombre': 
                    $objResponsable->setNombre($datoNuevo);
                    break;
                case 'apellido':
                    $objResponsable->setApellido($datoNuevo);
                    break;
                case 'nroLicencia':
                    $objResponsable->setNumero_Licencia($datoNuevo);
                    break;
            }
        }
    }

    /** Función que agrega un pasajero si no está en el arreglo en base a su dni
     * @param object $objPasajero
     * @return bool $success
     */
    public function ingresarPasajero($objPasajero) {
        $success = false;
        $arregloPasajeros = $this->getArrayPasajeros();
        if (!($this->verificaViajeLleno())) {
            $dniPasajero = $objPasajero->getDocumento();
            if (!($this->verificarPasajero($dniPasajero))) {
                $arregloPasajeros[] = $objPasajero;
                $this->setArrayPasajeros($arregloPasajeros);
                $success = true;
            }
        }
        return $success;
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