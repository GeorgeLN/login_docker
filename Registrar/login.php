<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['CorreoElectronico'], $_POST['Contrasena']) && !empty($_POST['CorreoElectronico']) && !empty($_POST['Contrasena'])){
        $correoElectronico = $_POST['CorreoElectronico'];
        $contrasena = $_POST['Contrasena'];
        
        try {
            // Conectar a la base de datos utilizando PDO
            $conexion = new PDO('mysql:host=db;dbname=Usuario', 'root', '1234');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Preparar la consulta SQL para seleccionar datos
            $stmt = $conexion->prepare("SELECT id_Usuario, Nombre FROM tbl_Usuario WHERE CorreoElectronico = ? AND Contrasena = ?");
            $stmt->execute([$correoElectronico, $contrasena]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Inicio de sesión exitoso
                header('Location: /welcome.html');
            } else {
                echo "Correo electrónico o contraseña incorrectos. Por favor, inténtalo de nuevo.";
            }
        } catch(PDOException $e) {
            echo "Error al iniciar sesión: " . $e->getMessage();
        }

        // Cerrar la conexión (no es necesario en PDO, pero se incluye por buenas prácticas)
        unset($conexion);
    }
}
?>