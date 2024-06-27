<?php
include_once 'Pasajero.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';

/** Función que muestra el menú principal y devuelve la opción elegida
 * 
 */
function menuInicial() {
    echo "--> Ingrese (1-5) para seleccionar la acción que desea realizar: \n";
    echo "1. Mostrar información del viaje\n";
    echo "2. Agregar pasajero\n";
    echo "3. Modificar responsable\n";
    echo "4. Modificar datos de un pasajero\n";
    echo "5. Salir\n";
    echo "Selección: ";
    $menuOpcion = trim(fgets(STDIN));
        return $menuOpcion;
}
function menuModificarPasajero($elViaje) {
    echo "Ingrese el número de documento del pasajero: ";
    $num_documento = trim(fgets(STDIN));
    if ($elViaje->verificarPasajero($num_documento)) {
        echo "¿Qué dato desea modificar?\n";
        echo "1. Nombre\n";
        echo "2. Apellido\n";
        echo "3. Teléfono\n";
        echo "Selección: ";
        $eleccion = trim(fgets(STDIN));
        //Switch para cambiar un solo dato en vez de todos al mismo tiempo
        switch ($eleccion) {
            case 1:
                echo "\nNuevo nombre: ";
                $nuevo_Nombre = trim(fgets(STDIN));
            $elViaje->modificarPasajero($num_documento, 'nombre', $nuevo_Nombre);
                break;
            case 2:
                echo "Nuevo apellido: ";
                $nuevo_Apellido = trim(fgets(STDIN));
            $elViaje->modificarPasajero($num_documento, 'apellido', $nuevo_Apellido);
                break;
            case 3:
                echo "Nuevo teléfono: ";   
                $nuevo_Telefono = trim(fgets(STDIN));                    
            $elViaje->modificarPasajero($num_documento, 'telefono', $nuevo_Telefono);                    
                break;                                     
            default:                    
                echo "Opción inválida.\n";                    
        }
            echo "\n--> Dato cambiado con éxito.\n\n";
    } else {
        echo "El pasajero con el número de documento" . $num_documento . "no se encontró en el viaje.\n";
    }         
}

function menuModificarResponsable($elViaje) {
    echo "Ingrese el número de empleado del responsable: ";
    $num_empleado = trim(fgets(STDIN));
    if (!($elViaje->verificarResponsable($num_empleado))) {
        echo "¿Qué dato desea modificar?\n";
        echo "1. Nombre\n";
        echo "2. Apellido\n";
        echo "3. Número de Licencia\n";
        echo "Selección: ";
        $eleccion = trim(fgets(STDIN));
        //Switch para cambiar un solo dato en vez de todos al mismo tiempo
        switch ($eleccion) {
            case 1:
                echo "\nNuevo nombre: ";
                $nuevo_Nombre = trim(fgets(STDIN));
            $elViaje->modificarResponsable('nombre', $nuevo_Nombre);
                break;
            case 2:
                echo "Nuevo apellido: ";
                $nuevo_Apellido = trim(fgets(STDIN));
            $elViaje->modificarResponsable('apellido', $nuevo_Apellido);
                break;
            case 3:
                echo "Nuevo número de Licencia: ";   
                $nuevo_nroLicencia = trim(fgets(STDIN));                    
            $elViaje->modificarResponsable('nroLicencia', $nuevo_nroLicencia);                    
                break;                                     
            default:                    
                echo "Opción inválida.\n";                    
        }
            echo "\n--> Dato cambiado con éxito.\n\n";
    } else {
        echo "ERROR: Al parecer esta persona no es responsable de este viaje.\n\n";
    }
}

//Arreglo Inicial de pasajeros
$pasajero_1 = new Pasajero("Brisa", "Celayes", 45390428, 2995859227);
$pasajero_2 = new Pasajero("Lola", "Celayes", 46415245, 2995845211);
$pasajero_3 = new Pasajero("Sabrina", "Flores", 42451487, 2996547858);
$arregloPasajeros = array(
        $pasajero_1,
        $pasajero_2,
        $pasajero_3
);

//PROGRAMA PRINCIPAL

$responsable_viaje = new ResponsableV(5246, "56-451-485", "Luna", "Torres");
$viajeFeliz = new Viaje("845-6511", "Bariloche", 10, $responsable_viaje);
$viajeFeliz->setArrayPasajeros($arregloPasajeros);
do {
    echo "-- AEROLINEAS Viaje Feliz --\n";
    $opcion = menuInicial();
    if ($opcion >= 1 && $opcion <= 5) {
        switch ($opcion) {
            case 1: 
                echo $viajeFeliz;
                break;
            case 2:
                if (!($viajeFeliz->verificaViajeLleno())) {
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
                        $viajeFeliz->ingresarPasajero($nuevo_pasajero);
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
                if (!($viajeFeliz->verificarResponsable($empleado_num))) {
                    $responsable_cambio= new ResponsableV($empleado_num, $licencia_num, $nombreResponsable, $apellidoResponsable);
                    $viajeFeliz->setObjResponsableV($responsable_cambio);
                    echo "Responsable cambiado con éxito. \n";
                } else {
                    echo "El responsable ingreasado ya está en el viaje. \n Si cree que hay algún error trate de cambiar los datos del responsable.";
                }
                
                break;
            case 4:
                menuModificarPasajero($viajeFeliz);
            }
    } else {
        $opcion = 0;
    }
} while ($opcion != 5);
echo "¡Nos vemos pronto!";