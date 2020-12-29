<?php

require('../../class/class.Menu.php');

if (isset($_GET['menuID'])) {
    $Menu = new Menu();
    $Menu->menuID = $_GET['menuID'];

    $Menu->getMenu();
    $target_dir = "../../uploads/";
    $target_file = $target_dir . basename($Menu->gambar);

    if (file_exists($target_file)) {
        unlink($target_file);
    }

    $Menu->deleteMenu();

    echo "<script> alert('$Menu->message'); </script>";
    echo "<script> window.location = 'dashboard.php' </script>";
} else {
    echo '<script> window.history.back() </script>';
}
