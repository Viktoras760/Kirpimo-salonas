<?php
  //include header
  include_once 'header.php';
  // Include config file
  require_once "config.php";
   
  // Define variables and initialize with empty values
  $name_err = $surname_err = $personal_code_err = $gender_err = $email_err = $password_err = $role_err = "";

  if ($_SERVER['HTTP_REFERER'])
  {
    if ($_SERVER['HTTP_REFERER'] != "http://localhost/kirpimo-salonas/edit_user.php"){
        $userId = (int)$_POST['id'];
        $_SESSION['temp'] = $userId;
        $_SERVER["REQUEST_METHOD"] == "GET";
    }
  }
  else if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
  {
    header("Location: login.php");
  } 
  else header("Location: /kirpimo-salonas/");


  $userId = $_SESSION['temp'];

  $user = mysqli_query($mysqli,"SELECT * FROM users WHERE Personal_code = '$userId'");
  $row = mysqli_fetch_array($user);
  $email = $row['Email'];

  if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER['HTTP_REFERER'] != "http://localhost/kirpimo-salonas/users.php"){

    // Validate name
    if(empty(trim($_POST["name"])))
    {
      $name_err = "Įveskite vardą.";
    } 

    elseif(!preg_match('/^[a-zA-ZĄąČčĘęĖėĮįŠšŲųŪūŽž]+$/', trim($_POST["name"])))
    {
      $name_err = "Vardas turi būti sudarytas tik iš raidžių.";
    }

    else
    {
      $name = trim($_POST["name"]);
    }

    //------------------------------------------------------------------------------------
    //Validate surname
    if(empty(trim($_POST["surname"])))
    {
      $surname_err = "Įveskite pavardę.";
    } 

    elseif(!preg_match('/^[a-zA-ZĄąČčĘęĖėĮįŠšŲųŪūŽž]+$/', trim($_POST["surname"])))
    {
      $surname_err = "Pavardė turi būti sudaryta tik iš raidžių.";
    }

    else
    {
      $surname = trim($_POST["surname"]);
    }

    //------------------------------------------------------------------------------------
    //Validate gender
    if(empty(trim($_POST["gender"])))
    {
      $gender_err = "Pasirinkite lytį.";    
    } 

    else
    {
      $gender = trim($_POST["gender"]);
    }

    //------------------------------------------------------------------------------------
    // Validate email
    if(empty(trim($_POST["email"])))
    {
      $email_err = "Įveskite elektroninį paštą.";    
    }

    else
    {
      // Prepare a select statement
      $sql = "SELECT * FROM users WHERE email = ?";
      
      if($stmt = $mysqli->prepare($sql))
      {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_email);
        
        // Set parameters
        $param_email = trim($_POST["email"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute())
        {
          // store result
          $stmt->store_result();
          
          if($stmt->num_rows == 1 && $param_email != $row['Email'])
          {
            $email_err = "Šis elektroninis paštas jau yra surištas su kita paskyra.";
          } 

          else
          {
            if (trim($_POST["email"]))
            {
              $email = trim($_POST["email"]);
            }
            //else $email = $row['Email'];
          }
        } 
        
        else
        {
          echo "Įvyko klaida! Pabandykite dar kartą.";
        }

        // Close statement
        $stmt->close();
      }
    }
    /*if ($email = "")
    {
      $email = $row['Email'];
    }*/
    //------------------------------------------------------------------------------------

    //Validate role
    if(empty(trim($_POST["role"])))
    {
      $role_err = "Pasirinkite lytį.";    
    } 

    else
    {
      if (trim($_POST["role"]))
      {
        $role = trim($_POST["role"]);
      }
    }

    //------------------------------------------------------------------------------------
    // Check input errors before inserting in database
    if(empty($name_err) && empty($surname_err) && empty($gender_err) && empty($personal_code_err) && empty($email_err) && empty($password_err)){
      // Prepare an insert statement
      $userId = $_SESSION['temp'];
      $param_name = $name;
      $param_surname = $surname;
      $param_email = $email;
      $param_role = $role;

      $update = mysqli_query($mysqli,"UPDATE users SET Name = '$param_name', Surname = '$param_surname', Email = '$param_email', Role = '$param_role' WHERE Personal_code = $userId");
      
      if (!$update)
      {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
      else 
      {
        $_SESSION['temp'] = NULL;
        header("Location: users.php");
      }
    }
  }
?>
   
<!DOCTYPE html>
<html>
  <head>
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
                    
                    <span class="h1 fw-bold mb-0">Redaguoti paskyros informaciją</span>
                  </div>
                  <?php if(!empty($name_err) ) { ?>
         
                  <div class="alert alert-danger"><?php echo $name_err; ?></div>

                <?php } elseif (!empty($surname_err)) { ?>

                  <div class="alert alert-danger"><?php echo $surname_err; ?></div>

                <?php } elseif(!empty($gender_err) ) { ?>

                  <div class="alert alert-danger"><?php echo $gender_err; ?></div>

                <?php } elseif(!empty($personal_code_err) ) { ?>

                  <div class="alert alert-danger"><?php echo $personal_code_err; ?></div>

                <?php } elseif(!empty($email_err) ) { ?>

                  <div class="alert alert-danger"><?php echo $email_err; ?></div>

                <?php } elseif(!empty($password_err) ) { ?>

                  <div class="alert alert-danger"><?php echo $password_err; ?></div>

                <?php } ?>

                  <div class="form-outline mb-4">
                    <label class="form-label">Vardas</label>
                    <input type="text" name="name" class="form-control form-control-lg " value="<?php echo $row['Name'];?>" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Pavardė</label>
                    <input type="text" name="surname"  class="form-control form-control-lg " value="<?php echo $row['Surname']; ?>"/>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Asmens kodas</label>
                    <input readonly type="number" name="duration"  class="form-control form-control-lg " value="<?php echo $row['Personal_code']; ?>"/>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">El. paštas</label>
                    <input type="email" name="email" placeholder = "Įveskite savo elektroninį paštą" autocomplete="new-email" class="form-control form-control-lg " <?php $email = $row['Email']; ?> value="<?php echo $row['Email']; ?>"/>
                  </div>

                  <div class="form-outline mb-4">
                      <label for="role">Rolė:</label>
                        <select name="role" id="role">
                          <option value="<?php echo $row['Role']; ?>" <?php $role = $row['Role']; ?>><?php echo $row['Role']; ?> </option>
                          <option value="Client" <?php $role = "Client"; ?>>Klientas</option>
                          <option value="Barber" <?php $role = "Barber"; ?>>Kirpėjas</option>
                          <option value="Admin" <?php $role = "Admin"; ?>>Administratorius</option>
                        </select>
                      </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Lytis</label>
                    <input readonly type="text" name="gender" class="form-control form-control-lg " value="<?php echo $row['Gender']; ?>"/>
                  </div>

                  <div class="pt-1 mb-4">
                    <input type="submit" name="submit"  class="btn btn-dark btn-lg btn-block" value="Patvirtinti">  
                  </div>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>