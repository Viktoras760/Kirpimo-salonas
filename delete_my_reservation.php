<?php
require_once "config.php";
session_start();

if(isset($_POST['id'])){
    $reservationId = (int) $_POST['id'];

    if(!empty($_POST['id'])){
        $delete1 = mysqli_query($mysqli,"DELETE FROM includes WHERE fk_Reservationid_Reservation='$reservationId'");
        $delete = mysqli_query($mysqli,"DELETE FROM reservation WHERE id_Reservation='$reservationId'");
    }
    if($delete){
        echo "Rezervacija ištrinta sėkmingai";
    }else{
        echo "Atsiprašome, rezervacija negali būti ištrinta";
    }
}
header("Location: my_reservations.php");


?>