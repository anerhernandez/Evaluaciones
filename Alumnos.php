<?php
require("crud.php");

?>
<h1>CREAR ALUMNO</h1>
<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
    <label for="alumno">Nombre alumno</label>
    <input type="text" name="nombre" id="nombre"><br><br>
    <label for="alumno">DNI</label>
    <input type="text" name="DNI" id="DNI"><br><br>
    <button type="submit" name="enviar" id="enviar">Enviar</button>
</form>
<a href="index.php">Volver a inicio</a>
<?php
    if (isset($_POST["nombre"]) && isset($_POST["DNI"])) {
        $datos = [$_POST["nombre"], $_POST["DNI"]];
        var_dump(createalumn($conn, $datos));
    }
?>