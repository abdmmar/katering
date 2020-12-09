<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hena Katering</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>

    </header>
    <main>
        <?php
        $pages_dir = 'src/pages';
        $pages = scandir($pages_dir, 0);
        echo '<a href="src/pages/login.php">To Login Page</a></br>';
        echo '<a href="src/pages/register.php">To Register Page</a>';
        if (!empty($_GET['p'])) {
            $pages = scandir($pages_dir, 0);
            unset($pages[0], $pages[1]);

            $p = $_GET['p'];
            if (in_array($p . '.php', $pages)) {
                include($pages_dir . '/' . $p . '.php');
            } else {
                echo '<div class="container">';
                echo '<h1></br>4😕4</h1>';
                echo '<h2>Halaman yang kamu cari ga ada!</h2>';
                echo '</br>';
                echo '<a href="index.php">&larr; Go Home</a>';
                echo '</div>';
            }
        } else {
            include($pages_dir . '/homepage.php');
        }
        ?>
    </main>
    <footer></footer>
</body>

</html>