<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Nombre'], $_POST['Apellido'], $_POST['CorreoElectronico'], $_POST['Contrasena']) && !empty($_POST['Nombre']) && !empty($_POST['Apellido']) && !empty($_POST['CorreoElectronico']) && !empty($_POST['Contrasena'])){
        $nombre = $_POST['Nombre'];
        $apellido = $_POST['Apellido'];
        $correoElectronico = $_POST['CorreoElectronico'];
        $contrasena = $_POST['Contrasena'];
        
        try {
            // Conectar a la base de datos utilizando PDO
            $conexion = new PDO('mysql:host=db;dbname=Usuario', 'root', '1234');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Preparar la consulta SQL para insertar datos
            $stmt = $conexion->prepare("INSERT INTO tbl_Usuario (Nombre, Apellido, CorreoElectronico, Contrasena) VALUES (?, ?, ?, ?)");
            
            // Ejecutar la consulta con los parámetros proporcionados
            $stmt->execute([$nombre, $apellido, $correoElectronico, $contrasena]);

            echo "Registro exitoso";
        } catch(PDOException $e) {
            echo "Error al registrar: " . $e->getMessage();
        }
        
        unset($conexion);
    } else {
        echo "Todos los campos del formulario son obligatorios.";
    }
}