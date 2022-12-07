<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate name
    if(empty(trim($_POST["name"])))
    {
      $name_err = "Įveskite pavadinimą.";
    } 

    elseif(!preg_match('/^[a-zA-ZĄąČčĘęĖėĮįŠšŲųŪūŽž\s]*$/', trim($_POST["name"])))
    {
        
      $name_err = "Pavadinimas turi būti sudarytas tik iš raidžių ir tarpų.";
    }

    else
    {
      $name = trim($_POST["name"]);
    }

    //------------------------------------------------------------------------------------
    //Validate price
    if(empty(trim($_POST["price"])))
    {
      $price_err = "Įveskite kainą.";
    } 

    elseif(!preg_match('/^[0-9]+$/', trim($_POST["price"])))
    {
      $price_err = "Kaina turi būti sudaryta tik iš skaičių.";
    }

    else
    {
      $price = trim($_POST["price"]);
    }

    //------------------------------------------------------------------------------------
    //Validate paslaugos trukmę
    if(empty(trim($_POST["duration"])))
    {
      $duration_err = "Įveskite paslaugos trukmę.";
    }

    elseif((trim($_POST["duration"])) < 10)
    {
      $duration_err = "Trukmė privalo būti didesnė už 10 minučių.";
    }

    else {
        $duration = trim($_POST["duration"]);
    }

    //------------------------------------------------------------------------------------
    //Validate aprašymą

    $description = trim($_POST["description"]);

    //------------------------------------------------------------------------------------
    //Validate barber
    if($_SESSION["role"] == 'Admin'){
        if(empty(trim($_POST["barber"])))
        {
        $barber_err = "Pasirinkite kirpėją.";    
        } 

        else
        {
        $barber = trim($_POST["barber"]);
        }
    }
    //------------------------------------------------------------------------------------
// Check input errors before inserting in database

    // Prepare an insert statement
    echo $serviceId = $_SESSION['temp'];
    echo $param_name = $_SESSION['serName'];
    echo $param_price = $_SESSION['serPrice'];
    echo $param_duration = $_SESSION['serDuration'];
    echo $param_description = $_SESSION['serDescription'];
    echo $param_barber = $_SESSION['serBarber'];

    $update = mysqli_query($mysqli,"UPDATE services SET Name = '$param_name', Price = '$param_price', Duration = '$param_duration', Description = '$param_description', fk_Barber_code = '$param_barber' WHERE id_Services = $serviceId");
    
    if (!$update)
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else 
    {
        /*$_SESSION['temp'] = NULL;
        header("Location: auth_services.php");*/
    }
    
  }

  ?>