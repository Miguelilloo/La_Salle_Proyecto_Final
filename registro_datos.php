<?php
    // Definir los tipos MIME permitidos
    $allowedMimeTypes = [
        'image/png',
        'image/jpeg' // Cubre JPG y JPEG
    ];

    // 1. VALIDACIÓN DE CAMPOS POST REQUERIDOS (Error = 1)
    $requiredPostFields = ['meet', 'mañana_inicio', 'mañana_fin', 'tarde_inicio', 'tarde_fin', 'entidad'];

    // Comprobar que todos los campos POST requeridos tengan valor
    foreach ($requiredPostFields as $field) {
        if (empty($_POST[$field])) {
            //Redirigir con error=1 si falta un campo POST
            header("Location: registro.php?error=1");
            exit();
        }
    }


    // 2. VALIDACIÓN DEL TIPO DE ARCHIVO (Error = 2)
    $fileInfo = $_FILES['logo'];

    // Obtener el tipo MIME real del archivo
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $fileInfo['tmp_name']);
    // Eliminamos finfo_close() porque está en desuso y no es necesaria
    // finfo_close($finfo); 

    // Comprobar si el tipo MIME NO es PNG, JPG, o JPEG
    if (!in_array($mimeType, $allowedMimeTypes)) {
        // Redirigir con error=1 si el tipo de archivo es incorrecto
        header("Location: registro.php?error=2");
        exit();
    }

    
    // 3. VALIDACIÓN DE SUBIDA DE ARCHIVO (Error = 3)

    // Comprobar si el archivo fue enviado y no hubo un error de subida (ej. tamaño límite)
    if (!isset($_FILES['logo']) || $_FILES['logo']['error'] !== UPLOAD_ERR_OK) {
        // Redirigir con error=3 si el archivo no se seleccionó o la subida falló
        header("Location: registro.php?error=3"); 
        exit();
    }

    // ------------------------------------------------------------
    // 4. PROCESAMIENTO Y GUARDADO (Si todo es válido)
    // ------------------------------------------------------------

    $uploadDir = 'uploads/'; 

    // Generar un nombre de archivo único para seguridad (ejemplo)
    $extension = pathinfo($fileInfo['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $extension;
    $uploadFilePath = $uploadDir . $uniqueName;

    // Crear el directorio si no existe
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }


    if (move_uploaded_file($fileInfo['tmp_name'], $uploadFilePath)) {
        // **** Lógica de Base de Datos AQUÍ ****
    
        // Éxito: Redirigir a una página de confirmación
        header("Location: registro_exitoso.php");
        exit();
    } else {
        // Error al mover el archivo (ej. Permisos de la carpeta 'uploads').
        header("Location: registro.php?error=3"); 
        exit();
    }
?>