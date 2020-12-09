<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Hena Catering</title>
  <link rel="stylesheet" href="../../style.css">
  <link rel="shortcut icon" href="../../logo.png" type="image/x-icon" />
</head>
<body>
  
  <div class="container">
    <div class="sign-in-container">
      <img class="logo" src="../../logo.png" alt="Ketring Logo" />
      <h2 class="sign-in-heading">Login</h2>

      <form action="#" method="post">
        <section class="email-section">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            placeholder="Username@domain.com"
            autocomplete="email"
            required
            autofocus
          />
        </section>

        <section class="password-section">
          <label for="current-password">Password</label>
          <input
            id="current-password"
            name="current-password"
            type="password"
            autocomplete="current-password"
            aria-describedby="password-constraints"
            placeholder="Password"
            required
          />
          <button
            id="toggle-password"
            type="button"
            aria-label="Show password as plain text. Warning: this will display your password on the screen."
          >
            Show password
          </button>
          <div id="password-constraints">
            Eight or more characters with a mix of letters, numbers and
            symbols.
          </div>
        </section>

        <button type="submit" id="signin">Login</button>
      </form>
      <div class="sign-up">
        <p>Don't have an account yet? <a href="register.php">Sign Up</a></p>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>