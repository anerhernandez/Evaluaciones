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
    foreach ($asignaturas as $asignatura) {
        echo '<input id="' . $asignatura['nombreAsignatura'] . '" type="checkbox"Esta es la asignatura ' . $asignatura['nombreAsignatura'] . '>';
        echo '<label for="' . $asignatura['nombreAsignatura'] . '"> ' . $asignatura['nombreAsignatura'] . '</label><br>';
    }
}
//Asignaturas
function createasig($conn, $asignatura)
{
    try {
        $stmt = $conn->prepare("INSERT INTO asignaturas (nombreAsignatura) VALUES (?)");
        return $stmt->execute([$asignatura]);
    } catch (PDOException $e) {
        switch ($e->getCode()) {
                // 23000 para repetido
            case 23000:
                $_SESSION["asignaturas"]["error"] = "La asignatura que ha escrito ya existe <br>";
                break;
                // 22001 para caracter demasiado largo
            case 22001:
                $_SESSION["asignaturas"]["error"] = "El texto escrito es demasiado largo <br>";
                break;
            default:
            $_SESSION["asignaturas"]["error"] = "Ha ocurrido un error <br> " . $e->getMessage();
                break;
        }
    }
}
//Temas

//Actividades

//Notas
function delete($conn, $email)
{
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE Email LIKE ?");
    return $stmt->execute([$email]);
}
