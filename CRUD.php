<?php
require("conexion.php");

//Read general
function read($conn,$tabla)
{
    $stmt = $conn->prepare("SELECT * FROM $tabla");
    $stmt->execute([]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}
//Alumnos
function buscaralu($conn,$DNI){
    $stmt = $conn->prepare("SELECT * FROM alumnos WHERE DNI LIKE ?");
    $stmt->execute([$DNI]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}
function createalumn($conn, $datos) {
    if (buscaralu($conn, $datos[1])) {
        echo "Ya existe un alumno con ese DNI";
        return;
    }else{
        $stmt = $conn->prepare("INSERT INTO alumnos (nombreAlumno, DNI) VALUES (?,?)");
        return $stmt->execute($datos);
    }
}
function DOMasignaturas($conn){
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
function delete($conn, $email) {
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE Email LIKE ?");
    return $stmt->execute([$email]);
}

?>