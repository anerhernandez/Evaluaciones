<?php
require("crud.php");
$mensaje = '';
if (isset($_POST["tema"]) && isset($_POST["actividad"])) {
    if ($_POST["tema"]== "" || ($_POST["actividad"] == "")) {
        $mensaje = "No se admiten carácteres en blanco <br>";
    }else{
        $datos = [$_POST["actividad"], $_POST["tema"]];
        if (createactivi($conn, $datos)) {
            $mensaje = "Se ha creado la actividad con éxito <br>";
        };
    }
    
}

?>
<h1>CREAR ACTIVIDAD</h1>
<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
    <label for="tema">Escoge una tema para añadir una actividad</label>
    <select name="tema" id="tema">
        <?php
            DOMSelectactividades($conn);
        ?>
    </select><br><br>
    <label for="actividad">Nombre actividad</label>
    <input type="text" name="actividad" id="actividad"><br><br>
    <br>
    <button type="submit" name="enviar" id="enviar">Enviar</button>
    <?php
        echo $mensaje;
        if (isset($_SESSION["actividades"]["error"])) {
            echo $_SESSION["actividades"]["error"];
        }
        unset($_SESSION["actividades"]["error"]);
    ?>
</form>
<a href="index.php">Volver a inicio</a>