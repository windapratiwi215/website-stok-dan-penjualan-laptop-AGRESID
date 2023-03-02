<?php

if($_SESSION["jabatan"] == "master") {
    require 'sidebar-master.php';
} else if($_SESSION["jabatan"] == "admin") {
    require 'sidebar-admin.php';
} else {
    require 'sidebar-sales.php';
}

?>