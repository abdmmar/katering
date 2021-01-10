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
          <a href="index.php">
            <h2>Hena Catering</h2>
          </a>
        </div>
        <form class="search-input" method="GET">
          <input type="search" id="search" name="search" placeholder="Search">
          <button class="btn-icon" name="searchbtn" type="submit" value="search">
            <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=search&fill=ffffff" width="18" height="18"></svg>
          </button>
        </form>
      </div>
      <div>
        <ul class="feature">
          <li class="icon">
            <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=shopping-cart&fill=767676" width="24" height="24">
            </svg>
          </li>
        </ul>
        <div class="profile">
          <a class="icon" href="pages/login.php" aria-label="Login to Hena Catering">
            <button class="login">
              Login
            </button>
          </a>
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