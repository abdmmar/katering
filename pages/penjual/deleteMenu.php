<?php

require('../../class/class.Menu.php');

if (isset($_GET['MenuID'])) {
    $Menu = new Menu();
    $Menu->menuID = $_GET['MenuID'];

    $Menu->getMenu();
    $target_dir = "../../uploads/";
    $target_file = $target_dir . basename($Menu->gambar);

    if (file_exists($target_file)) {
        unlink($target_file);
    }

    $Menu->deleteMenu();

    echo "<script> alert('$Menu->message'); </script>";
    echo "<script> window.location = 'dashboardPenjual.php' </script>";
} else {
    echo '<script> window.history.back() </script>';
}
