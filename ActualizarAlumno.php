<?php
require("crud.php");
//QUEDA ARREGLAR
?>
<h1>CREAR ALUMNO</h1>
<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
    <!-- <label for="nombre">Nombre alumno</label>
    <input type="text" name="nombre" id="nombre"><br><br>
    <label for="DNI">DNI</label>
    <input type="text" name="DNI" id="DNI"><br><br> -->
    <?php 
        DOMasignaturasMarcadas($conn);
    ?>
    <br>
    <button type="submit" name="enviar" id="enviar">Enviar</button>
</form>
<?php
    if (isset($_POST["nombre"]) && isset($_POST["DNI"])) {
        if ($_POST["nombre"] == "" || ($_POST["DNI"] == "")) {
            echo "No se admiten carácteres en blanco <br>";
        }else{
            $datos = [$_POST["nombre"], $_POST["DNI"]];
            $asignaturasMarcadas = []; 
            foreach ($_POST["checkbox"] as $checkbox) {
                $asignaturasMarcadas[] = $checkbox;
            }
            if (createalumn($conn, $datos)) {
                echo "Se ha creado al alumno con éxito <br>";
                if (isset($_POST["checkbox"])) {
                    matricular($conn, $_POST["DNI"], $asignaturasMarcadas);
                }
            };
        }
    }
?>
<a href="index.php">Volver a inicio</a>