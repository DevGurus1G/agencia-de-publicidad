<?php include 'views/components/header_auth.php'; ?>
    <main>
      <div class="login">
        <form action="authenticate" method="post" id="login-form">
          <input type="hidden" name="tipo" value="login" />
          <input
            type="text"
            name="email"
            id="email"
            placeholder="example@domain.com"
          />
          <input
            type="password"
            name="password"
            id="password"
            placeholder="Contraseña"
          />
          <button type="submit" id="login-btn">Login</button>
        </form>
        <a href="/register" class="cambiar" id="btn-ir-registro"
          >¿Eres nuevo? Registrate</a
        >
      </div>
    </main>
  </body>
</html>
