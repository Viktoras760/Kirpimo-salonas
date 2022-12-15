<?php
require_once "config.php";
session_start();

if(isset($_POST['id'])){
    $userId = (int) $_POST['id'];

    if(!empty($_POST['id'])){
        $delete = mysqli_query($mysqli,"DELETE FROM users WHERE Personal_code='$userId'");
    }
    if($delete){
        echo "Paskyra ištrinta sėkmingai";
    }else{
        echo "Atsiprašome, paskyra negali būti ištrinta";
    }
}
header("Location: users.php");


?>