<?php
require_once "config.php";
session_start();

$user = $_SESSION['personal_code'];
if(isset($_POST['id'])){
    $serviceId = (int) $_POST['id'];
    if ($_SESSION["role"] == 'Barber') {
        if (!empty($_POST['id']))
        {
            $service = mysqli_query($mysqli,"SELECT * FROM services WHERE id_Services='$serviceId'");
            $row = mysqli_fetch_array($service);
            if ($row['fk_Barber_code'] != $user)
            {
                $_SESSION['error'] = "Ši paslauga priklauso kitam kirpėjui";
                header("Location: auth_services.php");
            }
            else{
                $delete = mysqli_query($mysqli,"DELETE FROM services WHERE id_Services='$serviceId'");
            }
        }
    }
    else if(!empty($_POST['id'])){
        $delete = mysqli_query($mysqli,"DELETE FROM services WHERE id_Services='$serviceId'");
    }
    if($delete){
        echo "Paslauga ištrinta sėkmingai";
    }else{
        echo "Atsiprašome, paslauga negali būti ištrinta";
    }
}
header("Location: auth_services.php");


?>