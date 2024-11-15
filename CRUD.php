<?php
require("conexion.php");

//Read general
function read($conn, $tabla)
{
    $stmt = $conn->prepare("SELECT * FROM $tabla");
    $stmt->execute([]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}
//Alumnos
// function buscaralu($conn,$DNI){
//     $stmt = $conn->prepare("SELECT * FROM alumnos WHERE DNI LIKE ?");
//     $stmt->execute([$DNI]);
//     $stmt->setFetchMode(PDO::FETCH_ASSOC);
//     return $stmt->fetchAll();
// }
function createalumn($conn, $datos)
{
    try {
        $stmt = $conn->prepare("INSERT INTO alumnos (nombreAlumno, DNI) VALUES (?,?)");
        return $stmt->execute($datos);
    } catch (PDOException $e) {
        switch ($e->getCode()) {
                // 23000 para repetido
            case 23000:
                echo "El DNI que ha escrito ya existe <br>";
                break;
                // 22001 para caracter demasiado largo
            case 22001:
                echo "Alguno de los campos es demasiado largo <br>";
                break;
            default:
                echo "Ha ocurrido un error <br>";
                break;
        }
    }
}
function DOMasignaturas($conn)
{
    $asignaturas = read($conn, "asignaturas");
    echo "Número total de asignaturas: " . count($asignaturas);
    foreach ($asignaturas as $asignatura) {
        echo '<p>Esta es la asignatura ' . $asignatura['nombreAsignatura'] . '</p>';
    };
}
//Asignaturas

//Temas

//Actividades

//Notas
function delete($conn, $email)
{
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE Email LIKE ?");
    return $stmt->execute([$email]);
}
