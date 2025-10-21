<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error 404</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #0d1117;
      color: #fff;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      overflow: hidden;
    }

    .container {
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    h1 {
      font-size: 5rem;
      margin: 0;
      color: #ff4c4c;
      text-shadow: 0 0 10px #ff4c4c, 0 0 20px #ff0000;
    }

    p {
      font-size: 1.3rem;
      margin: 20px 0;
      color: #ccc;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 30px;
      background: #238636;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-size: 1rem;
      transition: 0.3s;
    }

    a:hover {
      background: #2ea043;
    }

    .lights {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
    }

    .light {
      position: absolute;
      width: 200px;
      height: 200px;
      background: rgba(255, 0, 0, 0.2);
      border-radius: 50%;
      animation: float 8s infinite ease-in-out;
    }

    .light:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
    .light:nth-child(2) { top: 60%; left: 70%; animation-delay: 3s; }
    .light:nth-child(3) { top: 40%; left: 40%; animation-delay: 6s; }

    @keyframes float {
      0% { transform: translateY(0) scale(1); opacity: 0.5; }
      50% { transform: translateY(-30px) scale(1.2); opacity: 1; }
      100% { transform: translateY(0) scale(1); opacity: 0.5; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>404</h1>
    <p>Oops... La página que buscas no existe</p>
    <a href="../index.php">Volver al inicio</a>
  </div>

  <div class="lights">
    <div class="light"></div>
    <div class="light"></div>
    <div class="light"></div>
  </div>
</body>
</html>
