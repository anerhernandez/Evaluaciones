<?php
require("crud.php");

?>

<h1 style="text-align: center;">ESQUEMA DE LA BASE DE DATOS DE ASIGNATURAS TEMAS Y ACTIVIDADES</h1>
    <?php
        $asignaturas = read($conn, "asignaturas");
        $temas = read($conn, "temas");
        $actividades = read($conn, "actividades");
        foreach ($asignaturas as $asignatura) {
            echo "<h2 style='text-shadow:1px 1px 2px blue'>" . $asignatura["nombreAsignatura"] . "</h2>";
            foreach ($temas as $tema) {
                if ($tema["nombreAsignatura"] == $asignatura["nombreAsignatura"] ) {
                    echo "<p style='margin-left:20px; text-shadow:2px 2px 5px green'>" . $tema["nombreTema"] . "</p>";
                }
                foreach ($actividades as $actividad) {
                    if ($actividad["nombreTema"] == $tema["nombreTema"] && $tema["nombreAsignatura"] == $asignatura["nombreAsignatura"] ) {
                        echo "<p style='margin-left:50px; text-shadow:2px 2px 5px red''>" . $actividad["nombreActividad"] . "</p>";
                    }
                }
            }
        }
    ?>
    <hr>
<h1 style="text-align: center;">Alumnos y Notas</h1>
<?php
    $stmt = $conn->prepare("SELECT alumnos.nombreAlumno, alumnos.DNI, asignaturas.nombreAsignatura, temas.nombreTema, actividades.nombreActividad, notas.notas
    FROM alumnos 
    INNER JOIN matriculados ON alumnos.DNI = matriculados.DNI
    INNER JOIN asignaturas ON matriculados.nombreAsignatura = asignaturas.nombreAsignatura
    INNER JOIN temas ON asignaturas.nombreAsignatura = temas.nombreAsignatura
    INNER JOIN actividades ON temas.nombreTema = actividades.nombreTema
    INNER JOIN notas ON actividades.nombreActividad = notas.nombreActividad WHERE alumnos.DNI = notas.DNI");
    $stmt->execute([]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultado = ($stmt->fetchAll());
    foreach ($resultado as $result) {
        echo "<p>";
        echo ("Nombre de alumno: <b style='font-size:larger'>" . $result["nombreAlumno"] . "</b> | ");
        echo ("DNI: " . $result["DNI"] . " | ");
        echo ("Asignatura: " . $result["nombreAsignatura"] . " | ");
        echo ("Tema: " . $result["nombreTema"] . "   | ");
        echo ("Actividad: " . $result["nombreActividad"] . " | ");
        if ($result["notas"] >= 5) {
            echo ("Nota: <b style='color:green;font-size:larger'>" . $result["notas"] . "</b> | ");
        }else{
            echo ("Nota: <b style='color:red;font-size:larger'>" . $result["notas"] . "</b> | ");
        }
        echo "</p>";
    }

?>

<a href="index.php">Volver a inicio</a>