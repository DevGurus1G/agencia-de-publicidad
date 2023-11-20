<?php 
//Si esta loegueado redirecciona al home y con el exit para la ejecucion
if(isset($_SESSION['usuario'])){
  header("Location: /");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <header>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon"
            width="128"
            height="128"
            viewBox="0 0 24 24"
        >
            <path
            fill="#059669"
            d="M4 22V6h4q0-1.65 1.175-2.825T12 2q1.65 0 2.825 1.175T16 6h4v16H4Zm2-2h12V8h-2v3h-2V8h-4v3H8V8H6v12Zm4-14h4q0-.825-.588-1.413T12 4q-.825 0-1.413.588T10 6ZM6 20V8v12Z"
            />
        </svg>
        <h1>Gasteiz Denda</h1>
    </header>
</body>
</html>