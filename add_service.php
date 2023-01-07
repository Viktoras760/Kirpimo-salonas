<?php
  //include header
  include_once 'header.php';
  // Include config file
  require_once "config.php";
   
  // Define variables and initialize with empty values
  $name = $price = $duration = $barber = $description = $password = $tag="";
  $name_err = $price_err = $duration_err = $barber_err = $description_err = $password_err = $tag_err = "";
  if($_SESSION["role"] == 'Barber'){
    $barber = $_SESSION['personal_code'];
  }
  $barb = mysqli_query($mysqli,"SELECT * FROM users WHERE Role = 'Barber'");
  $tags = mysqli_query($mysqli,"SELECT * FROM services");

  // Processing form data when form is submitted
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
    //Validate tag

    if(empty(trim($_POST["tag"])))
    {
      $tag_err = "Pasirinkite kirpėją.";    
    } 
    else
    {
      $tag = trim($_POST["tag"]);
    }

    //------------------------------------------------------------------------------------
    // Check input errors before inserting in database
    if(empty($name_err) && empty($price_err) && empty($barber_err) && empty($duration_err) && empty($description_err) && empty($password_err)){
        
      // Prepare an insert statement
      $sql = "INSERT INTO services (Name, Price, Duration, Description, Tags, fk_Barber_code) VALUES ( ?, ?, ?, ?, ?, ?)";
        
      if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssss", $param_name, $param_price, $param_duration, $param_description, $param_tag, $param_barber,);
        
        // Set parameters
        $param_name = $name;
        $param_price = $price;
        $param_duration = $duration;
        $param_description = $description;
        $param_tag = $tag;
        $param_barber = $barber;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
          // Redirect to login page
          header("location: auth_services.php");
        } else{
          echo "Įvyko klaida, pabandykite pridėti paslaugą dar kartą!";
        }

        // Close statement
        $stmt->close();
      }
    }
    
    // Close connection
    $mysqli->close();
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

                    <form method="post">

                      <div class="d-flex align-items-center mb-3 pb-1">
                        
                        <span class="h1 fw-bold mb-0">Paslaugos kūrimas</span>
                      </div>

                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Pridėkite naują paslaugą</h5>

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

                        <?php } elseif(!empty($tag_err) ) { ?>

                        <div class="alert alert-danger"><?php echo $tag_err; ?></div>

                      <?php } ?>
                      
                      <div class="form-outline mb-4">
                        <label class="form-label">Paslaugos pavadinimas</label>
                        <input type="text" name="name" placeholder = "Įveskite paslaugos pavadinimą" class="form-control form-control-lg " value="<?php echo $name; ?>" >
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Kaina</label>
                        <input type="number" name="price" placeholder = "Įveskite paslaugos kainą" class="form-control form-control-lg " value="<?php echo $price; ?>">
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Trukmė</label>
                        <input type="number" name="duration" placeholder = "Įveskite paslaugos trukmę (minutėmis)" class="form-control form-control-lg " value="<?php echo $duration; ?>">
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
                          <option value="">_ <?php echo $bar['Personal_code'];?> <?php echo $bar['Name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <?php } ?>

                      <div class="form-outline mb-4">
                      <label for="tag">Paslaugos tipas:</label>
                        <select name="tag" id="tag">
                          <option value="">_ <?php $tag = ""; ?> </option>
                          <option value="Vyriškas kirpimas">Vyriškas kirpimas <?php $tag = "Vyriškas kirpimas"; ?> </option> 
                          <option value="Moteriškas kirpimas">Moteriškas kirpimas <?php $tag = "Moteriškas kirpimas"; ?></option>
                          <option value="Plaukų dažymas (vyrams)">Vyriškas plaukų dažymas <?php $tag = "Plaukų dažymas (vyrams)"; ?></option>
                          <option value="Plaukų dažymas (moterims)">Moteriškas plaukų dažymas <?php $tag = "Plaukų dažymas (moterims)"; ?></option>
                        </select>
                      </div>

                      <div class="pt-1 mb-4">
                        <input type="submit" name="submit" class="btn btn-dark btn-lg btn-block" value="Pridėti">  
                      </div>
                    </form>
                    <form action="auth_services.php" method="POST"><input type="submit" class="btn btn-dark btn-lg btn-block" value="Grįžti"></form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
    </section>
  </body>
</html>