<?php
// Configuración de la Base de Datos
$servername = "localhost"; // O la IP/nombre de tu servidor de BBDD
$username = "root"; // Usuario de MySQL
$password = ""; // Contraseña de MySQL
$dbname = "ProjectIrun";

// 1. Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Obtener datos del formulario
    $email = $_POST['email'] ?? '';
    $input_password = $_POST['password'] ?? '';

    // 3. Conexión a la Base de Datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }
    
    // 4. Preparar la consulta SQL
    // Ahora solo seleccionamos la contraseña en texto plano (contra)
    $stmt = $conn->prepare("SELECT contra FROM Empresas WHERE email = ?");
    $stmt->bind_param("s", $email); // "s" indica que el parámetro es un string
    $stmt->execute();
    $result = $stmt->get_result();

    // 5. Verificar credenciales
    if ($result->num_rows === 1) {
        // Se encontró un registro con ese email
        $row = $result->fetch_assoc();
        $db_password = $row['contra']; // <-- Este es el valor de texto plano '1234' de la DB
        
        // 5.1. ¡CAMBIO CLAVE! COMPARACIÓN DIRECTA DE CADENAS (INSEGURO)
        if ($input_password === $db_password) {
            // **¡Credenciales Correctas!**
            
            // 6. Iniciar Sesión 
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;

            // 7. Redirigir a la página de inicio
            header("Location: index.html");
            exit; // Detiene la ejecución del script después de la redirección
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        // Email no encontrado
        echo "Correo electrónico no registrado.";
    }

    // 8. Cerrar conexión
    $stmt->close();
    $conn->close();
} else {
    // Si alguien intenta acceder directamente al script sin enviar el formulario
    header("Location: login.html");
    exit;
}
?>