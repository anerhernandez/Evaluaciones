<?php
require("crud.php");

?>
<h1>CREAR ALUMNO</h1>
<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
    <label for="alumno">Nombre alumno</label>
    <input type="text" name="nombre" id="nombre"><br><br>
    <label for="alumno">DNI</label>
    <input type="text" name="DNI" id="DNI"><br><br>
    <?php
    
    ?>
    <button type="submit" name="enviar" id="enviar">Enviar</button>
</form>
<?php
    
    if (isset($_POST["nombre"]) && isset($_POST["DNI"])) {
        if ($_POST["nombre"] == "" || ($_POST["DNI"] == "")) {
            echo "No se admiten carácteres en blanco <br>";
        }else{
            $datos = [$_POST["nombre"], $_POST["DNI"]];
            if (createalumn($conn, $datos)) {
                echo "Se ha creado al alumno con éxito <br>";
            };
        }
    }
    ?>
<a href="index.php">Volver a inicio</a>