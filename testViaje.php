<?php
include_once 'Pasajero.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';

//Arreglo Inicial de pasajeros
$pasajero_1 = new Pasajero("Brisa", "Celayes", 45390428, 2995859227);
$pasajero_2 = new Pasajero("Lola", "Celayes", 46415245, 2995845211);
$pasajero_3 = new Pasajero("Sabrina", "Flores", 42451487, 2996547858);
$arregloPasajeros = array(
        $pasajero_1,
        $pasajero_2,
        $pasajero_3
);
//Comienza el MENÚ
echo "AEROLINEAS Viaje Feliz\n";
$responsable_viaje = new ResponsableV(5246, "56-451-485", "Luna", "Torres");
$viajeFeliz = new Viaje("845-6511", "Bariloche", 10, $responsable_viaje);
$viajeFeliz->setPasajeros($arregloPasajeros);
do {
    echo "--> Ingrese (1-5) para seleccionar la acción que desea realizar: \n";
    echo "1. Mostrar información del viaje\n";
    echo "2. Agregar pasajero\n";
    echo "3. Modificar responsable\n";
    echo "4. Modificar datos de un pasajero\n";
    echo "5. Salir\n";
    echo "Selección: ";
    $opcion = trim(fgets(STDIN));
    if ($opcion >= 1 && $opcion <= 5) {
        switch ($opcion) {
            case 1: 
                echo $viajeFeliz;
                break;
            case 2:
                if (!($viajeFeliz->contadorCantidadPasajeros())) {
                    echo "Ingrese el DNI de la persona a agregar: ";
                    $nro_docP = trim(fgets(STDIN));
                    if (!($viajeFeliz->verificarPasajero($nro_docP))) {
                        echo "Nombre: ";
                        $nombreP = trim(fgets(STDIN));
                        echo "Apellido: ";
                        $apellidoP = trim(fgets(STDIN));
                        echo "Teléfono: ";
                        $telefonoP = trim(fgets(STDIN));
                        $nuevo_pasajero = new Pasajero($nombreP, $apellidoP, $nro_docP, $telefonoP);
                        $viajeFeliz->agregarPasajero($nuevo_pasajero);
                            echo "\nEl nuevo pasajero ha sido agregado correctamente.\n\n";
                    } else {
                    echo "ERROR: Al parecer esta persona ya es parte de este viaje.\n\n";
                    }
                } else {
                    echo "ERROR: Lo sentimos, al parecer no hay lugares disponibles.\n\n";
                }
                break;  
            case 3: 
                echo "---CAMBIANDO RESPONSABLE---";
                echo "\nNombre: ";
                $nombreResponsable = trim(fgets(STDIN));
                echo "Apellido: ";
                $apellidoResponsable = trim(fgets(STDIN));
                echo "Número de Empleado: ";
                $empleado_num = trim(fgets(STDIN));
                echo "Número de Licencia: ";
                $licencia_num = trim(fgets(STDIN));
                $responsable_cambio= new ResponsableV($empleado_num, $licencia_num, $nombreResponsable, $apellidoResponsable);
                $viajeFeliz->setResponsable($responsable_cambio);
                echo "Responsable cambiado con éxito. \n";
                break;
        }
    }
    else {
        $opcion = 0;
    }
} while ($opcion != 5);
echo "¡Nos vemos pronto!";