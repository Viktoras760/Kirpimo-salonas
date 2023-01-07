<?php
  //include header
  include_once 'header.php';
  // Include config file
  require_once "config.php";

  if ($_SERVER['HTTP_REFERER'])
  {
    if ($_SERVER['HTTP_REFERER'] != "http://localhost/kirpimo-salonas/edit_services.php"){
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

  $_SESSION['serBarber'] = $us = $row['fk_Barber_code'];

  $barb2 = mysqli_query($mysqli,"SELECT * FROM users WHERE Personal_code = '$us'");
  $row2 = mysqli_fetch_array($barb2);

  $_SESSION['serName'] = $name = $row['Name'];
  $_SESSION['serPrice'] = $price = $row['Price'];
  $_SESSION['serDuration'] = $duration = $row['Duration'];
  $_SESSION['serDescription'] = $description = $row['Description'];
  $barber1 = $row2['Name'];
  $tag1 = $row['Tags'];
  
  $barb = mysqli_query($mysqli,"SELECT * FROM users");
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
                        <textarea readonly class="form-control form-control-lg " name="description" id="description" cols="40" rows="3"><?php echo $description; ?></textarea>
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Kirpėjas</label>
                        <input readonly type="text" name="barber" class="form-control form-control-lg " value="<?php echo $barber1; ?>">
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Kirpimo tipas</label>
                        <input readonly type="text" name="tag" class="form-control form-control-lg " value="<?php echo $tag1; ?>">
                      </div>

                      <div class="pt-1 mb-4">
                        <a href ="services.php" class="btn btn-dark btn-lg btn-block"> Grįžti </a>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </body>
</html>