<?php
require("crud.php");
$mensaje = '';
if (isset($_POST["asignatura"])) {
    if ($_POST["asignatura"] == "") {
        $mensaje =  "No se admiten carácteres en blanco <br>";
    } else {
        if (createasig($conn, $_POST["asignatura"])) {
            $mensaje =  "Se ha creado la asignatura con éxito <br>";
        };
    }
}
?>

<h1>CREAR Asignatura</h1>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <label for="asignatura">Nombre asignatura</label>
    <input type="text" name="asignatura" id="asignatura">
    <button type="submit" name="enviar" id="enviar">Enviar</button>
    <?php
        echo $mensaje;
        if (isset($_SESSION["asignaturas"]["error"])) {
            echo $_SESSION["asignaturas"]["error"];
        }
        unset($_SESSION["asignaturas"]["error"]);
    ?>
</form>
<?php
$asignaturas = read($conn, "asignaturas");
echo "Asignaturas existentes: <br>";
foreach ($asignaturas as $asignatura) {
    echo '<p> ● ' . $asignatura['nombreAsignatura'] . '</p>';
}
?>

<a href="index.php">Volver a inicio</a>