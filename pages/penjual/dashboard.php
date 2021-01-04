<?php
if (!isset($_SESSION)) {
  session_start();
}
require "../../inc.connection.php";
require('../../class/class.Penjual.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hena Katering</title>
  <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
  <header>
    <nav class="navbar">
      <div>
        <div class="logo">
          <a href="dashboard.php">
            <h2>Hena Catering</h2>
          </a>
        </div>
      </div>
      <div>
        <ul class="feature">
        <li>
          <a href="dashboard.php?p=report" class="icon">
            <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=document-report&fill=767676" width="24" height="24"></svg>
          </a>
        </li>
          <li>
            <a class="icon" href="dashboard.php?p=addMenu">
              <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=plus&fill=767676" width="24" height="24"></svg>
            </a>
          </li>
        </ul>
        <div class="profile" tabindex="0" role="button">
          <div class="profile-picture">
            <?php
            $Penjual = new Penjual();
            $Penjual->IDpenjual = $_SESSION["IDpenjual"];
            $Penjual->getPenjual();

            echo '<img src="../../uploads/' . $Penjual->foto . '" alt="' . $Penjual->nama . ' profile picture">'
            ?>
          </div>
          <div class="dropdown" style="float: right">
            <div class="dropdown-content">
              <h4><?php echo $_SESSION["nama"] ?></h4>
              <a href="dashboard.php?p=profile&IDpenjual=<?php echo $_SESSION["IDpenjual"] ?>" tabindex="1">Profile</a>
              <a href="dashboard.php?p=logout" tabindex="2">Logout</a>
            </div>
            <div>
            </div>
    </nav>
  </header>
  <main>
    <?php
    $pages_dir = '../../pages/penjual';
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
        echo '<a href="dashboard.php">&larr; Go Home</a>';
        echo '</div>';
      }
    } else {
      include('./home.php');
    }
    ?>
  </main>
  <footer></footer>
  <script type="text/javascript" src="https://unpkg.com/external-svg-loader@0.0.6/svg-loader.min.js" async></script>
  <script>
    const dropdown = document.querySelector('.dropdown');
    const dropdownContent = document.querySelector('.dropdown-content');
    const inputFile = document.querySelector('#photoName');

    inputFile.oninput = function() {
      let message = ''
      if (inputFile.length === 0) {
        message = 'Upload your photo'
      }
      inputFile.setCustomValidity(message);
    }

    dropdown.addEventListener('click', () => {
      dropdownContent.classList.add('show');
    })
  </script>
</body>

</html>