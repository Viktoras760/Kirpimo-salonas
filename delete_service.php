<?php
require_once "config.php";


if(isset($_POST['id'])){
    $serviceId = (int) $_POST['id'];
    if(!empty($_POST['id'])){
        $delete = mysqli_query($mysqli,"DELETE FROM services WHERE id_Services='$serviceId'");
    }
    if($delete){
        echo "Record deleted successfully";
    }else{
        echo "Sorry, record could not be deleted";
    }
}
//Redirect("auth_services.php");
header("Location: auth_services.php");


?>