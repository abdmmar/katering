<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Hena Catering</title>
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="container">
        <div class="sign-in-container">
            <a href="../index.php">
                <img class="logo" src="../logo.png" alt="Ketring Logo" />
            </a>
            <h2 class="sign-in-heading">Register</h2>

            <form action="#" method="post">
                <section class="name-section">
                <label for="name">Name</label>
                <input
                    type="text"
                    id="name"
                    placeholder="Budi"
                    autocomplete="name"
                    required
                    autofocus
                />
                </section>

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
                
                <section class="telpon-section">
                <label for="telpon">Nomer Telpon</label>
                <input
                    type="tel"
                    id="telpon"
                    placeholder="+62"
                    autocomplete="telpon"
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

                <button type="submit" id="signin">Register</button>
            </form>
            <div class="sign-up">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>