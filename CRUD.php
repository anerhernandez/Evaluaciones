<?php
require("conexion.php");


function read($conn,$tabla)
{
    $stmt = $conn->prepare("SELECT * FROM $tabla");
    $stmt->execute([]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

function createalumn($conn, $datos) {
    $stmt = $conn->prepare("INSERT INTO alumnos (nombreAlumno, DNI) VALUES (?,?)");
    return $stmt->execute($datos);
}

function delete($conn, $email) {
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE Email LIKE ?");
    return $stmt->execute([$email]);
}

?>