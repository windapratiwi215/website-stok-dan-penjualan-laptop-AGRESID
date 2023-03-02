<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login-registrasi.php");
    exit;

}
require 'database-conn.php';

if(!empty($_POST["q"])){

$select_category="SELECT serial_number FROM stok WHERE sku='".$_POST['q']."'";

$res=mysqli_query($conn,$select_category);
$rowCount = mysqli_num_rows($res);

if($rowCount > 0){
        foreach($res as $row):
		    echo '<option value="'.$row['serial_number'].'">'.$row['serial_number'].'</option>';
        endforeach;
    }
    else{
        echo '<option value="">not available</option>';
    }
}
