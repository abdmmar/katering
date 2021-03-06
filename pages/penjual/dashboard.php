<?php
require_once('./authorization.php');
require "../../inc.connection.php";
require('../../class/class.Penjual.php');
require('../../class/class.Transaksi.php');

$title = 'Hena Katering';

if (isset($_GET['p'])) {
  $title = $_GET['p'];
  if ($title == 'addMenu') {
    if (isset($_GET['menuID'])) {
      $title = 'Edit Menu | Hena Katering';
    } else {
      $title = 'Add Menu | Hena Katering';
    }
  }

  $title = ucfirst($title) . ' | Hena Katering';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?></title>
  <link rel="shortcut icon" href="../../logo.png" type="image/x-icon" />
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
          <li class="notification">
            <a href="dashboard.php?p=transaction" class="icon" id="notification" <?php
                                                                                  if (isset($_SESSION["IDpenjual"])) {
                                                                                    $Transaksi = new Transaksi();
                                                                                    $Transaksi->IDpenjual = $_SESSION["IDpenjual"];
                                                                                    $count = $Transaksi->getCountTransactionPending();

                                                                                    if ($Transaksi->result) {
                                                                                      if ($count > 0) {
                                                                                        echo 'data-notif="' . $count, '"';
                                                                                      } else {
                                                                                        echo 'data-notif="0"';
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                  ?>>
              <svg data-src="https://s.svgbox.net/hero-outline.svg?ic=bell&fill=767676" width="24" height="24"></svg>
            </a>
          </li>
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
              <div class="dropdown-profile">
                <h4><?php echo $_SESSION["nama"] ?></h4>
                <div class="dropdown-profile-info">
                  <span><?php echo $_SESSION["email"] ?></span>
                </div>
              </div>
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
  <footer>
    <div class="footer-info">
      <h3>Hena Katering</h3>
      <div class="footer-desc">
        <?php
        $Penjual = new Penjual();
        $Penjual->getInfoPenjual();

        if ($Penjual->result) {
          echo '<p>' . $Penjual->deskripsi . '</p>';
          echo '<div>';
          echo '<h4>Alamat</h4>';
          echo "<p>$Penjual->alamat</p>";
          echo '<h4>Kontak</h4>';
          echo "<p>WA/Telp: $Penjual->telepon</p>";
          echo '</div>';
        } else {
          echo '<p>Hena Katering adalah tempat yang menyediakan berbagai menu pilihan mulai dari nasi box hingga jajanan tradisional</p>';
          echo '<div>
          <h4>Alamat</h4>
          <p>Margonda, Depok</p>
          <h4>Kontak</h4>
          <p>Telp/WA: 0815423678</p>
        </div>';
        }
        ?>
      </div>
      <p class="copyright">© 2021, Hena Katering.</p>
    </div>
  </footer>
  <script type="text/javascript" src="https://unpkg.com/external-svg-loader@0.0.6/svg-loader.min.js" async></script>
  <script>
    const dropdown = document.querySelector('.dropdown');
    const dropdownContent = document.querySelector('.dropdown-content');
    const notification = document.querySelector('#notification');
    const inputFile = document.querySelector('#photoName');

    // if (notification != undefined) {
    //   notification.addEventListener('click', () => {
    //     delete notification.dataset.notif
    //     console.log("clicked");
    //   })
    // }

    if (inputFile != undefined) {
      inputFile.oninput = function() {
        let message = ''
        if (inputFile.length === 0) {
          message = 'Upload your photo'
        }
        inputFile.setCustomValidity(message);
      }
    }

    dropdown.addEventListener('click', () => {
      dropdownContent.classList.add('show');
    })
  </script>
</body>

</html>