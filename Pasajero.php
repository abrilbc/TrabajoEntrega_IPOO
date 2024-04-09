<?php
class Persona{
    private $nombre;
    private $apellido;
    private $documento;
    private $telefono;
    public function __construct($nombre_pasajero, $apellido_pasajero, $documento_pasajero, $telefono_pasajero) {
        $this->nombre = $nombre_pasajero;
        $this->apellido = $apellido_pasajero;
        $this->documento = $documento_pasajero;
        $this->telefono = $telefono_pasajero;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nuevo_nombre) {
        $this->nombre = $nuevo_nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function setApellido($nuevo_apellido) {
        $this->apellido = $nuevo_apellido;
    }
    public function getDocumento() {
        return $this->documento;
    }
    public function getTelefono() {
        return $this->telefono;
    }
    public function setTelefono($nuevo_telefono) {
        $this->telefono = $nuevo_telefono;
    }
    public function __toString() {
        return "Nombre y Apellido: " . $this->getNombre() . " " . $this->getApellido() . 
                "\nNúmero de Documento: " . $this->getDocumento() . 
                "\nTeléfono: " . $this->getTelefono(); 
    }
}