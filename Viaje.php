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
    public function modificarResponsable($nuevo_resp) {
        $responsableActual = $this->getResponsable();
        $success = false;
        if ($nuevo_resp->getNumero_Empleado() == $responsableActual->getNumero_Empleado()) {
            $this->setResponsable($nuevo_resp);
            $success = true;
        }
        return $success;
    }
    public function __toString() {
        $info_viaje = "\n----VIAJE FELIZ----" . 
        "\nCódigo del Viaje: " . $this->getCodigo() . 
        "\nDestino: " . $this->getDestino() . 
        "\nCantidad max. de Pasajeros: " . $this->getCantidad_Maxima() . 
        "\n----RESPONSABLE----" . $this->getResponsable();
        "\n*---PASAJEROS---*";
        foreach ($this->getPasajeros() as $un_pasajero) {
            $info_viaje .= "\n--------------------\n".
                            "\nNombre y Apellido: " . $un_pasajero->getApellido() . ", " . $un_pasajero->getNombre() . 
                            "\nNúmero de Documento: " . $un_pasajero->getDocumento() . 
                            "\nTeléfono: " . $un_pasajero->getTelefono() . 
                            "\n--------------------\n";
        }
        return $info_viaje;
    }
}