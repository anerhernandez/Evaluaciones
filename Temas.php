<?php
require("crud.php");
$mensaje = '';
if (isset($_POST["Asignatura"]) && isset($_POST["tema"])) {
    if ($_POST["Asignatura"] == "" || ($_POST["tema"] == "")) {
        $mensaje = "No se admiten carácteres en blanco <br>";
    }else{
        $datos = [$_POST["Asignatura"], $_POST["tema"]];
        if (createma($conn, $datos)) {
            $mensaje = "Se ha creado el tema con éxito <br>";
        };
    }
}
?>
<h1>CREAR TEMA</h1>
<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
    <label for="Asignatura">Escoge una Asignatura para añadir un tema</label>
    <select name="Asignatura" id="Asignatura">
        <?php
            DOMSelectasignaturas($conn);
        ?>
    </select><br><br>
    <label for="tema">Nombre tema</label>
    <input type="text" name="tema" id="tema"><br><br>
    <br>
    <button type="submit" name="enviar" id="enviar">Enviar</button>
    <?php
        echo $mensaje;
        if (isset($_SESSION["temas"]["error"])) {
            echo $_SESSION["temas"]["error"];
        }
        unset($_SESSION["temas"]["error"]);
    ?>
</form>
<a href="index.php">Volver a inicio</a>