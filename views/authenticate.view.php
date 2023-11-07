<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *, *::before, *::after{
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        html, body {
            height: 100vh;
            background-color: #000;
        }
        body {
            display: grid;
            place-content: center;
        }
        .register {
            position: relative;
            display: flex;
            padding: 1em;
            flex-direction: column;
            width: 400px;
            max-width: 400px;
            height: 700px;
            max-height: 700px;
            justify-content: center;
            align-items: center;
        }
        .register form {
            display: flex;
            color: #fff;
        }

        .register form input {
            font-size: 1em;
            background-color: #0a0a0a;
            line-height: normal;
            padding: 1em;
            border-radius: .5em;
            border: none;
            outline: none;
            box-shadow: 0 0 0 1px hsla(0,0%,100%,.24);
        }

        .register form input:focus {
            box-shadow: 0 0 0 1px hsla(0,0%,100%,.51), 0 0 0 4px hsla(0,0%,100%,.24)
        }
        .register form input:hover {
            box-shadow: 0 0 0 1px hsla(0,0%,100%,.40)
        }

        .register form button {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1em;
            background-color: #fff;
            line-height: normal;
            padding: 1em;
            border-radius:.5em;
            border: none;
            outline: none;
        }
        .register form button:hover {
            background-color: #bfbfbf;
        }

        .register form > div :not(.formulario-paso) {
            display: flex;
            flex-direction: column;
        }
            /* Estilos para los indicadores de pasos */
        .indicadores-paso {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .indicador {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            width: 2em;
            height: 2em;
            border: 1px solid hsla(0,0%,100%,.24);
            border-radius: 50%;
            margin: 0 1em;
        }

        .indicador-activo {
            background-color: hsla(0,0%,100%,.24);
        }

        .formulario-paso {
            display: none;
        }
        
        .formulario-paso-activo {
            display: flex;
            flex-direction: column;
            gap: 1em;
        }
        #paso3 > div {
            max-width: 400px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        #paso3 > div > input {
            box-shadow: none;
            background: none;
        }
        /* Para subir la imagen */

        #paso3 > div > img {
            height: 4em;
            width: 4em;
            margin-right: 1em;
        }
        #paso3 > div > div> input {
            display: none;
        }
        #paso3 > div > div> label {
            color: #000;
            font-size: 1em;
            background-color: #fff;
            line-height: normal;
            padding: 1em;
            border-radius:.5em;
        }
        #paso3 > div > div> label:hover {
            background-color: #bfbfbf;
        }
        #avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
        }

        /* para los radios */
        .radio {
            border: 1px solid hsla(0,0%,100%,.24);
            border-radius: .5em;
            padding: 1em;
        }

        .ir-login {
            margin-top: 1em;
            color: #fff;
            font-weight: bold;
            font-size: .75em;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Registro -->
    <div class="register">
        <div class="indicadores-paso">
            <div class="indicador indicador-activo">1</div>
            <div class="indicador">2</div>
            <div class="indicador">3</div>
        </div>
        <form action="authenticate.php" method="post" enctype="multipart/form-data" id="registro-form">
            <input type="hidden" name="tipo" value="registro">
            <div id="paso1" class="formulario-paso formulario-paso-activo">
                <!-- Contenido del paso 1 -->
                <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
                <!-- Botones de navegación -->
                <button type="button" onclick="mostrarPaso(2)">Siguiente</button>
            </div>
            <div id="paso2" class="formulario-paso">
                <!-- Contenido del paso 2 -->
                <input type="email" name="email" id="email" placeholder="Email" >
                <input type="text" name="username" id="username" placeholder="Usuario" >
                <input type="password" name="password" id="password" placeholder="Contraseña" >
                <!-- Botones de navegación -->
                <!-- Botones de navegación -->
                <button type="button" onclick="mostrarPaso(1)">Volver</button>
                <button type="button" onclick="mostrarPaso(3)">Continuar</button>
            </div>
            <div id="paso3" class="formulario-paso">
                <!-- Contenido del paso 3 -->
                <div>
                    <img src="assets/img/default_avatar.webp" id="avatar">
                    <div>
                        <input type="file" name="imagen" id="imagen" />
                        <label for="imagen">Subir</label>
                    </div>
                </div>
                <div class="radio">
                    <label for="admin">Admin</label>
                    <input type="radio" name="tipo" id="admin">
                </div>
                <div class="radio">
                    <label for="user">user</label>
                    <input type="radio" name="tipo" id="user">
                </div>
                <!-- Botones de navegación -->
                <button type="button" onclick="mostrarPaso(2)">Volver</button>
                <button type="submit">Enviar</button>
            </div>
        </form>
        <a href="#" class="ir-login">¿Ya tienes una cuenta? Inicia sesion</a>
    </div>
    <!-- Login -->
    <form action="authenticate" method="post" id="login-form" style="display:none">
        <input type="hidden" name="tipo" value="login">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        <button type="submit">Login</button>
    </form>
    <script>
    document.querySelector("#imagen").addEventListener("change", () => {
        const file = document.querySelector("#imagen").files[0];
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            document.querySelector("#avatar").src = reader.result;
        });
        reader.readAsDataURL(file);
    }) 
    function mostrarPaso(paso) {
        // Desactiva la clase "formulario-paso-activo" en todas las secciones
        document.querySelectorAll('.formulario-paso').forEach(function(seccion) {
            seccion.classList.remove('formulario-paso-activo');
        });

        // Activa la clase "formulario-paso-activo" en la sección seleccionada
        document.getElementById('paso' + paso).classList.add('formulario-paso-activo');
        
        // Actualiza los indicadores de paso
        document.querySelectorAll('.indicador').forEach(function(indicador, index) {
            if (index + 1 === paso) {
                indicador.classList.add('indicador-activo');
            } else {
                indicador.classList.remove('indicador-activo');
            }
        });
    }
    </script>