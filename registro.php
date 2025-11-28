<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - LSBM</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-lg">
    <h1 class="text-2xl font-bold text-center mb-6">Registro de Empresa</h1>

    
    <form action="registro_datos.php" method="POST" class="space-y-5" enctype="multipart/form-data">
      <!-- Logo -->
      <label class="block text-sm font-semibold">Logo*</label>
      <input type="file" name="logo" required
        class="w-full border border-gray-300 rounded-lg p-2">
      <br>
      <?php
        if(isset($_GET['error'])){
          $error_code = $_GET['error'];
          echo '<div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">';
          switch ($error_code) {
            case 1:
              // Error 1: Campos faltantes
              // echo "<p class='font-semibold'>Error de Formulario:</p><p>Asegúrate de rellenar todos los campos obligatorios (*).</p>";
              // break;        
            case 2:
              // Error 2: Tipo de archivo incorrecto (Tu requisito principal)
              echo "<p class='font-semibold'>Error de Imagen:</p><p>El logo debe ser un archivo **PNG, JPG o JPEG**.</p>";
              break;
            case 3:
              // Error 3: Problema de subida / servidor
              echo "<p class='font-semibold'>Error de Servidor:</p><p>Hubo un problema con la subida del logo o no seleccionaste un archivo.</p>";
              break;
            default:
              echo "<p>Ocurrió un error desconocido.</p>";
          }
          echo '</div>';
        }
      ?>

      <!-- Descripción -->
      <label class="block text-sm font-semibold">Descripción de productos o servicios</label>
      <textarea name="descripcion" rows="3"
        class="w-full border border-gray-300 rounded-lg p-2"></textarea>
      <?php 
        if (isset($_GET['error'])){
          $error_code = $_GET['error'];
          

        }

      ?>

      <!-- URL Meet -->
      <label class="block text-sm font-semibold">URL Meet*</label>
      <input type="url" name="meet"
        class="w-full border border-gray-300 rounded-lg p-2">

      <!-- Horario -->
      <label class="block text-sm font-semibold">Horario de atención (Mañana)*</label>
      <div class="flex space-x-2">
        <input type="time" name="mañana_inicio" required class="w-1/2 border rounded-lg p-2">
        <input type="time" name="mañana_fin" required class="w-1/2 border rounded-lg p-2">
      </div>

      <label class="block text-sm font-semibold">Horario de atención (Tarde)*</label>
      <div class="flex space-x-2">
        <input type="time" name="tarde_inicio" required class="w-1/2 border rounded-lg p-2">
        <input type="time" name="tarde_fin" required class="w-1/2 border rounded-lg p-2">
      </div>

      <!-- Entidad -->
      <label class="block text-sm font-semibold">Entidad*</label>
      <input type="text" name="entidad" value="LA SALLE FP ONLINE" required
        class="w-full border border-gray-300 rounded-lg p-2">

      <!-- Botón -->
      <button type="submit"
        class="w-full bg-blue-600 py-3 rounded-lg font-semibold text-white hover:bg-blue-700 transition">
        REGISTRARSE
      </button>
    </form>
  </div>
</body>
</html>
