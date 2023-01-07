<?php
  //include header
  include_once 'header.php';
  // Include config file
  require_once "config.php";
   
  // Define variables and initialize with empty values
  $name_err = $price_err = $duration_err = $barber_err = $description_err = $password_err = "";

  if ($_SERVER['HTTP_REFERER'])
  {
    if ($_SERVER['HTTP_REFERER'] != "http://localhost/kirpimo-salonas/edit_auth_service.php"){
        $serviceId = (int)$_POST['id'];
        $_SESSION['temp'] = $serviceId;
        $_SERVER["REQUEST_METHOD"] == "GET";
    }
  }
  else if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
  {
    header("Location: services.php");
  } 
  else header("Location: auth_services.php");

  $serviceId = $_SESSION['temp'];

  $service = mysqli_query($mysqli,"SELECT * FROM services WHERE id_Services = '$serviceId'");
  $row = mysqli_fetch_array($service);

  if (!isset($_SESSION["serBarber"]))
  {
    $_SESSION['serBarber'] = $us = $row['fk_Barber_code'];
  }
  $us = $_SESSION['serBarber'];

  $barb2 = mysqli_query($mysqli,"SELECT * FROM users WHERE Personal_code = '$us'");
  $row2 = mysqli_fetch_array($barb2);

  $_SESSION['serName'] = $name = $row['Name'];
  $_SESSION['serPrice'] = $price = $row['Price'];
  $_SESSION['serDuration'] = $duration = $row['Duration'];
  $_SESSION['serDescription'] = $description = $row['Description'];
  $tag1 = $row['Tags'];
  $barber1 = $row2['Name'];
  
  $barb = mysqli_query($mysqli,"SELECT * FROM users");

  if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER['HTTP_REFERER'] != "http://localhost/kirpimo-salonas/auth_services.php"){

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
    //Validate description
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
            $barber1 = trim($_POST["barber"]);
        }
    }
    //------------------------------------------------------------------------------------
    // Check input errors before inserting in database

    // Prepare an insert statement
    $serviceId = $_SESSION['temp'];
    $param_name = $name;
    $param_price = $price;
    $param_duration = $duration;
    $param_description = $description;


    $update = mysqli_query($mysqli,"UPDATE services SET Name = '$param_name', Price = '$param_price', Duration = '$param_duration', Description = '$param_description' WHERE id_Services = $serviceId");
    
    if (!$update)
    {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else 
    {
      $_SESSION['temp'] = NULL;
      header("Location: auth_services.php");
    }
    
  }
?>
   
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>V&R kirpimo salonas</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
      </style>
  </head>
  <body>
    <section class="vh-100" style="background-image:url(https://img.freepik.com/free-photo/vintage-wooden-table-with-beard-shaping-salon-tools_53876-127084.jpg?w=2000)">
      <div class="container h-100" style="background-color:#e0e0b6; width: 5000px">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card align-items-center" style="border-radius: 1rem; margin: auto;">
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">

                  <?php if(($_SESSION["role"] == 'Barber' && $_SESSION["personal_code"] != $_SESSION['serBarber']) || $_SESSION["role"] == 'Client'){
                    ?>

                  <form method="POST">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    
                    <span class="h1 fw-bold mb-0">Paslaugos detalesnė informacija</span>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Paslaugos pavadinimas</label>
                    <input readonly type="text" name="name" class="form-control form-control-lg " value="<?php echo $name; ?>" >
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Kaina (eurais)</label>
                    <input readonly type="number" name="price"  class="form-control form-control-lg " value="<?php echo $price; ?>">
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Trukmė (minutėmis)</label>
                    <input readonly type="number" name="duration"  class="form-control form-control-lg " value="<?php echo $duration; ?>">
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Aprašymas</label>
                    <textarea readonly class="form-control form-control-lg " name="description"  cols="40" rows="3"><?php echo $description; ?></textarea>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Kirpėjas</label>
                    <input readonly type="text" name="barber"  class="form-control form-control-lg " value="<?php echo $barber1; ?>">
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Kirpimo tipas</label>
                    <input readonly type="text" name="tag" class="form-control form-control-lg " value="<?php echo $tag1; ?>">
                  </div>

                  <div class="pt-1 mb-4">
                    <input type="submit" name="submit"  class="btn btn-dark btn-lg btn-block" value="Grįžti">  
                  </div>
                  </form>

                  <?php } else { ?>
                    
                    <form method="POST">

                      <div class="d-flex align-items-center mb-3 pb-1">
                        
                        <span class="h1 fw-bold mb-0">Paslaugos atnaujinimas</span>
                      </div>

                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Atnaujinkite paslaugos informaciją</h5>

                      <?php if(!empty($name_err) ) { ?>
         
                        <div class="alert alert-danger"><?php echo $name_err; ?></div>
         
                      <?php } elseif (!empty($price_err)) { ?>

                        <div class="alert alert-danger"><?php echo $price_err; ?></div>

                      <?php } elseif(!empty($duration_err) ) { ?>

                        <div class="alert alert-danger"><?php echo $duration_err; ?></div>

                      <?php } elseif(!empty($description_err) ) { ?>

                        <div class="alert alert-danger"><?php echo $description_err; ?></div>

                        <?php } elseif(!empty($barber_err) ) { ?>

                        <div class="alert alert-danger"><?php echo $barber_err; ?></div>

                      <?php } ?>
                      
                      <div class="form-outline mb-4">
                        <label class="form-label">Paslaugos pavadinimas</label>
                        <input type="text" name="name" class="form-control form-control-lg " value="<?php echo $name; ?>" >
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Kaina</label>
                        <input type="number" name="price"  class="form-control form-control-lg " value="<?php echo $price; ?>">
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Trukmė</label>
                        <input type="number" name="duration"  class="form-control form-control-lg " value="<?php echo $duration; ?>">
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Aprašymas</label>
                        <textarea class="form-control form-control-lg " name="description" id="description" cols="40" rows="3"><?php echo $description; ?></textarea>
                      </div>

                      <?php if($_SESSION["role"] == 'Admin'){ ?>
                      <div class="form-outline mb-4">
                      <label for="barber">Kirpėjas:</label>
                        <select name="barber" id="barber">
                          <option value="" >_ <?php $barber = ""; ?></option>
                          <?php while($bar = mysqli_fetch_array($barb)){ ?>
                          <option value="<?php echo $bar['Personal_code'];?>"><?php echo $bar['Name']; ?>.</option>
                          <?php } ?>
                        </select>
                      </div>
                      <?php } 
                      
                      else {?>

                      <div class="form-outline mb-4">
                        <label class="form-label">Kirpėjas</label>
                        <input readonly type="text" name="barber" class="form-control form-control-lg " value="<?php echo $barber1; ?>">
                      </div>

                      <?php } ?>

                      <div class="form-outline mb-4">
                        <label>Paslaugos tipas:</label>
                        <input readonly type="text" name="tag" class="form-control form-control-lg " value="<?php echo $tag1; ?>">
                      </div>

                      <div class="pt-1 mb-4">
                        <input type="submit" name="submit"  class="btn btn-dark btn-lg btn-block" value="Atnaujinti paslaugą">  
                      </div>
                    </form>
                    <form action="auth_services.php" method="POST"><input type="submit" class="btn btn-dark btn-lg btn-block" value="Grįžti"></form>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </body>
</html>