<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hena Katering</title>
  <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <header>
    <nav class="navbar">
      <div>
        <div class="logo">
          <h1>Hena Catering</h1>
        </div>
        <form class="search-input">
          <input type="search" id="search" placeholder="Search">
          <button class="btn-icon" type="submit">
            <!-- Please refer: https://github.com/shubhamjain/svg-loader -->

            <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=search&fill=ffffff" width="18" height="18"></svg>
          </button>
        </form>
      </div>
      <div>
        <ul class="feature">
          <li>
            <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=shopping-cart&fill=767676" width="24" height="24">
            </svg>
          </li>
        </ul>
        <div class="profile">
          <ul>
            <li><a href="pages/register.php">Register</a></li>
            <li><a href="pages/login.php">Login</a></li>
          </ul>
          <!-- <div class="profile-picture">
          </div> -->
        </div>
      </div>
    </nav>
  </header>
  <main>
    <?php
    $pages_dir = 'pages';
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
  <script type="text/javascript" src="https://unpkg.com/external-svg-loader@0.0.6/svg-loader.min.js" async></script>
</body>

</html>