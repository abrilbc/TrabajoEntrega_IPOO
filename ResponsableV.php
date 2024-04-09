<?php
//En esta clase se almacenarán los atributos de un responsable del viaje, los métodos de acceso y __toString.
class ResponsableV{
    private $numero_empleado;
    private $numero_licencia;
    private $nombre;
    private $apellido;
    public function __construct($numEmpleado, $numLicencia, $name, $surname) {
        $this->numero_empleado = $numEmpleado;
        $this->numero_licencia = $numLicencia;
        $this->nombre = $name;
        $this->apellido = $surname;
    }
    public function getNumero_Empleado() {
        return $this->numero_empleado;
    }
    public function getNumero_Licencia() {
        return $this->numero_licencia;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function setNumero_Empleado($new_empleadoNum) {
        $this->numero_empleado = $new_empleadoNum;
    }
    public function setNumero_Licencia($nueva_licencia) {
        $this->numero_licencia = $nueva_licencia;
    }
    public function setNombre($nuevo_empleado) {
        $this->nombre = $nuevo_empleado;
    }
    public function setApellido($nuevo_apellido) {
        $this->apellido = $nuevo_apellido;
    }
    public function __toString() {
        return "\n - Nombre y Apellido: " . $this->getNombre() . " " .$this->getApellido() . 
                "\n - Número de Empleado: " . $this->getNumero_Empleado() . 
                "\n - Número de Licencia: " . $this->getNumero_Licencia() . "\n";
    }
    public function __destruct() {
    }

}