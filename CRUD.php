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
}function DOMasignaturasMarcadas($conn)
{
    $asignaturas = read($conn, "asignaturas");
    foreach ($asignaturas as $asignatura) {
        echo '<input id="' . $asignatura['nombreAsignatura'] . '" type="checkbox" name="checkbox[]" value="' . $asignatura['nombreAsignatura']. '">';
        echo '<label for="' . $asignatura['nombreAsignatura'] . '"> ' . $asignatura['nombreAsignatura'] . '</label><br>';
    }
}
function matricular ($conn, $DNI, $asignaturasMarcadas){
    if (isset($asignaturasMarcadas)) {
        try {
            $stmt = $conn->prepare("INSERT INTO matriculados (nombreAsignatura, DNI) VALUES (?,?)");
            foreach($asignaturasMarcadas as $asignatura){
                $stmt->execute([$asignatura, $DNI]);
            }
            echo "Se matriculó al alumno en todas las asignaturas.<br>";
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
}
//Asignaturas
function DOMasignaturas($conn)
{
    $asignaturas = read($conn, "asignaturas");
    foreach ($asignaturas as $asignatura) {
        echo '<input id="' . $asignatura['nombreAsignatura'] . '" type="checkbox" name="checkbox[]" value="' . $asignatura['nombreAsignatura']. '">';
        echo '<label for="' . $asignatura['nombreAsignatura'] . '"> ' . $asignatura['nombreAsignatura'] . '</label><br>';
    }
}
//DOM para select en temas.php
function DOMSelectasignaturas($conn)
{
    $temas = read($conn, "asignaturas");
    foreach ($temas as $tema) {
        echo '<option value="' . $tema['nombreAsignatura'] . '">' . $tema['nombreAsignatura'] . '</option>';
    }
}
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
//Estructura INSERT INTO `temas` (`nombreAsignatura`, `nombreTema`) VALUES ('Lengua', 'tema 2');

function createma($conn, $datos)
{
    try {
        $stmt = $conn->prepare("INSERT INTO temas (nombreAsignatura, nombreTema) VALUES (?, ?)");
        return $stmt->execute($datos);
    } catch (PDOException $e) {
        switch ($e->getCode()) {
                // 23000 para repetido
            case 23000:
                $_SESSION["temas"]["error"] = "El tema que ha escrito ya existe <br>";
                break;
                // 22001 para caracter demasiado largo
            case 22001:
                $_SESSION["temas"]["error"] = "El texto escrito es demasiado largo <br>";
                break;
            default:
            $_SESSION["temas"]["error"] = "Ha ocurrido un error <br> " . $e->getMessage();
                break;
        }
    }
}
//Actividades
function createactivi($conn, $datos)
{
    try {
        $stmt = $conn->prepare("INSERT INTO actividades (nombreActividad, nombreTema) VALUES (?, ?)");
        return $stmt->execute($datos);
    } catch (PDOException $e) {
        switch ($e->getCode()) {
                // 23000 para repetido
            case 23000:
                $_SESSION["actividades"]["error"] = "La actividad que ha escrito ya existe <br>";
                break;
                // 22001 para caracter demasiado largo
            case 22001:
                $_SESSION["actividades"]["error"] = "El texto escrito es demasiado largo <br>";
                break;
            default:
            $_SESSION["actividades"]["error"] = "Ha ocurrido un error <br> " . $e->getMessage();
                break;
        }
    }
}

function DOMSelectactividades($conn)
{
    $temas = read($conn, "temas");
    $asignaturas = read($conn, "asignaturas");
    foreach ($asignaturas as $asignatura) {
        echo '<optgroup label="'. $asignatura['nombreAsignatura'] . '">';
        foreach ($temas as $tema) {
            if ($tema['nombreAsignatura'] == $asignatura['nombreAsignatura']) {
                echo '<option value="' . $tema['nombreTema'] . '">' . $tema['nombreTema'] . '</option>';
            }
        }
        echo '</optgroup>';
    }
    
}
//Notas

//Deletes
function delete($conn, $email)
{
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE Email LIKE ?");
    return $stmt->execute([$email]);
}
