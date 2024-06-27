<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imperial Inventory</title>
    <link rel="stylesheet" href="../Administrador/css/loguin.css"> 
    <link href='https://fonts.googleapis.com/css?family=Chewy' rel='stylesheet'>
    <style>
        body {
    font-family: 'Chewy';font-size: 22px;
}
    </style>
</head>
<body>

<div class="container-fluid">
  <div class="intro-section">
    <div class="intro-content-wrapper">
      <h1 class="frase">El orden es el reflejo de tu personalidad</h1>
    </div>
    <div class="intro-section-footer">
      <nav class="footer-nav">
        <a href="https://www.facebook.com/?locale=es_LA" class="in1"></a>
        <a href="https://twitter.com/?lang=es" class="in2"></a>
        <a href="https://www.google.com/intl/es-419/gmail/about/" class="in3"></a>
      </nav>
    </div>
  </div>
  <div class="form-section">
    <div class="login-wrapper">
      <h2 class="login-title">Inicio de Sesión</h2>
      <?php
      if(isset($_GET['error'])) {
        echo "<p class='error-message'>El usuario o la contraseña son incorrectos, inténtalo nuevamente.</p>";
      }
      ?>
      <form id="loginForm" action="validar.php" method="post">
        <div class="form-group">
          <label for="usuario" class="sr-only">Usuario</label>
          <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
        </div>
        <div class="form-group mb-3">
          <label for="password" class="sr-only">Contraseña</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
        </div>
        <div class="d-flex justify-content-between align-items-center mb-5">
          <button name="login" id="login" class="login-btn" type="submit">Login</button></a>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>

