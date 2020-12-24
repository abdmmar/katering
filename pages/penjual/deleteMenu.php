<?php

require('../../class/class.Menu.php');

if (isset($_GET['MenuID'])) {
    $Menu = new Menu();
    $Menu->menuID = $_GET['MenuID'];
    $Menu->deleteMenu();

    echo "<script> alert('$Menu->message'); </script>";
    echo "<script> window.location = 'dashboardPenjual.php' </script>";
} else {
    echo '<script> window.history.back() </script>';
}
