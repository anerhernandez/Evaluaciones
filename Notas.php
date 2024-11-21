
<?php
require("crud.php");
$mensaje = '';
if (isset($_POST["alumnos"]) && isset($_POST["actividad"]) && isset($_POST["nota"])) {
    if ($_POST["alumnos"]== "" || ($_POST["actividad"] == "") || $_POST["nota"] == "") {
        $mensaje = "No se admiten carácteres en blanco <br>";
    }else{
        $datos = [$_POST["alumnos"], $_POST["actividad"], $_POST["nota"]];
        if (createnota($conn, $datos)) {
            $mensaje = "Se ha actualizado la nota <br>";
        };
    }
    
}

?>
<h1>CREAR ACTIVIDAD</h1>
<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
    <label for="alumnos">Nombre de alumno</label>
    <select name="alumnos" id="alumnos">
        <?php
            asignarNotas($conn);
        ?>
    </select><br><br>
    <label for="actividad">Nombre actividad</label>
    <select name="actividad" id="actividad">
        <?php
            DOMactividades($conn);
        ?>
    </select><br><br>
    <label for="nota">Puntuación (1/10)</label>
    <input name="nota" type="number" min="0" max="10" /><br><br>

    <button type="submit" name="enviar" id="enviar">Enviar</button>
    <?php
        echo $mensaje;
        if (isset($_SESSION["notas"]["error"])) {
            echo $_SESSION["notas"]["error"];
        }
        unset($_SESSION["notas"]["error"]);
    ?>
</form>
<a href="index.php">Volver a inicio</a>