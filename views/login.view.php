<?php include 'views/components/header_auth.php'; ?>
    <main>
      <div class="login">
        <form action="/login" method="post">
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
        <a href="/register" class="cambiar">¿Eres nuevo? Registrate</a>
      </div>
    </main>
    <script src="assets/js/login.js"></script>
  </body>
</html>
