<?php
include_once 'Pasajero.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';
echo "AEROLINEAS Viaje Feliz\n";
$responsable_viaje = new ResponsableV(5246, "56-451-485", "Luna", "Torres");
$viajeFeliz = new Viaje("845-6511", "Bariloche", 58, $responsable_viaje);
do {
    echo "--> Ingrese (1-5) para seleccionar la acción que desea realizar: \n";
    echo "1. Mostrar información del viaje\n";
    echo "2. Agregar pasajero\n";
    echo "3. Modificar responsable\n";
    echo "4. Modificar datos de un pasajero\n";
    echo "5. Salir\n";
    echo "Selección: ";
    $opcion = trim(fgets(STDIN));
    if ($opcion < 1 && $opcion > 5) {
        switch ($opcion) {
            case 1: 
                echo $viajeFeliz;
                break;
        }
    }
    else {
        $opcion = 0;
    }
} while ($opcion != 5);