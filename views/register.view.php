<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <form action="authenticate.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos">
        <label for="rol">Rol:</label>
        <select name="rol" id="rol">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" id="imagen">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>