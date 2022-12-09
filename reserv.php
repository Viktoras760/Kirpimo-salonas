<?php
session_start();
include_once "auth_session.php";
require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["time"]))
{
    if (trim($_POST["time"]))
    {
        $_SESSION['time'] = $time = trim($_POST["time"]);
    }
    if (trim($_POST["month"]))
    {
        $month = trim($_POST["month"]);
    }
    if (trim($_POST["day"]))
    {
        $day = trim($_POST["day"]);
    }
    if (trim($_POST["barbID"]))
    {
        $barbID = trim($_POST["barbID"]);
    }
    if (trim($_POST["duration"]))
    {
        $duration = trim($_POST["duration"]);
    }
    if (trim($_POST["service"]))
    {
        $service = trim($_POST["service"]);
    }
    // Prepare an insert statement
    $sql = "INSERT INTO reservation (Start_time, End_time, fk_Barber_code, fk_UserPersonal_code) VALUES (?, ?, ?, ?)";
        
    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("ssss", $datetime, $datetime2, $barbID, $user);
      
      // Set parameters
      $year = date("Y");
      $time2 = date('H:i:s', strtotime($time. ' +'.$duration.' minutes'));
      $datetime = "$year-$month-$day $time";
      $datetime2 = "$year-$month-$day $time2";
      $user = $_SESSION['personal_code'];
      // Attempt to execute the prepared statement
      if($stmt->execute()){
      
      } else{
        echo "Įvyko klaida, pabandykite užsiregistruotis dar kartą!";
      }
      // Close statement
      $stmt->close();
    }

    $sql = "INSERT INTO includes (fk_Servicesid_Services, fk_Reservationid_Reservation) VALUES (?, ?)";
        
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ss", $service, $reservation);
        
        // Set parameters
        $result = mysqli_query($mysqli,"SELECT * FROM reservation WHERE fk_UserPersonal_code = $user AND Start_time = '$datetime'");
        $row = mysqli_fetch_array($result);
        $reservation = $row['id_Reservation'];


        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $_SESSION['success'] = "Jūsų registracija buvo sėkminga!";
            header("location: reservation.php");
        } else{
            echo "Įvyko klaida, pabandykite užsiregistruotis dar kartą!";
        }
    }
  
}

?>