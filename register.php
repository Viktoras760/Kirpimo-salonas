<?php
  //include header
  include_once 'header.php';
  // Include config file
  require_once "config.php";
   
  // Define variables and initialize with empty values
  $name = $surname = $gender = $email = $password ="";
  $personal_code = "Įveskite savo asmens kodą";
  $role = 'Client';
  $name_err = $surname_err = $personal_code_err = $gender_err = $email_err = $password_err = "";

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  //if (isset($_REQUEST['name'])) {

    //$sql = "INSERT INTO users (name, surname, personal_code, gender, email, role, password) VALUES ('$name', '$surname', 48946546555, 'Female', '$email', 'Barber', '$password')";
    //$result = mysqli_query($mysqli, $sql);
      // Validate name
      if(empty(trim($_POST["name"]))){
          $name_err = "Please enter a name.";
      } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["name"]))){
          $name_err = "Name can only contain letters.";
      } else{
          // Prepare a select statement
          $sql = "SELECT personal_code FROM users WHERE name = ?";
          
          if($stmt = $mysqli->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bind_param("s", $param_name);
              
              // Set parameters
              $param_name = trim($_POST["name"]);
              
              // Attempt to execute the prepared statement
              if($stmt->execute()){
                  // store result
                  $stmt->store_result();
                  
                  if($stmt->num_rows == 1){
                      $name_err = "This name is already taken.";
                  } else{
                      $name = trim($_POST["name"]);
                  }
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }
  
              // Close statement
              $stmt->close();
          }
      }



      $name = $param_name = trim($_POST["name"]);
      $surname = $param_surname = trim($_POST["surname"]);
      $gender = $param_gender = trim($_POST["gender"]);
      $email = $param_email = trim($_POST["email"]);
      $password = $param_password = trim($_POST["password"]);
      $personal_code = $param_personal_code = trim($_POST["personal_code"]);
      $param_role = 'Client';
      echo ("$name, $surname, $gender, $personal_code, $email, $password, $role");



      // Validate password
      if(empty(trim($_POST["password"]))){
          $password_err = "Please enter a password.";    
      } elseif(strlen(trim($_POST["password"])) < 6){
          $password_err = "Password must have atleast 6 characters.";
      } else{
          $password = trim($_POST["password"]);
      }
      
      // Check input errors before inserting in database
      if(empty($name_err) && empty($surname_err) && empty($gender_err) && empty($personal_code_err) && empty($email_err) && empty($password_err)){
          
          // Prepare an insert statement
          $sql = "INSERT INTO users (name, surname, personal_code, gender, email, role, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
           
          if($stmt = $mysqli->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bind_param("sssssss", $param_name, $param_surname, $param_personal_code, $param_gender, $param_email, $param_role, $param_password);
              
              // Set parameters
              $param_name = $name;
              $param_surname = $surname;
              $param_personal_code = $personal_code;
              $param_gender = $gender;
              $param_email = $email;
              $param_role = 'Client';
              $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
              
              //$stmt->bind_param( $param_name, $param_surname, $param_personal_code, $param_gender, $param_email, $param_role, $param_password);
              // Attempt to execute the prepared statement
              if($stmt->execute()){
                  // Redirect to login page
                  header("location: login.php");
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
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
<html>
  <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <style>
          body{ font: 14px sans-serif; }
          .wrapper{ width: 360px; padding: 20px; }
      </style>
  </head>
  <body>
    <form class="vh-100" style="background-color: #9A616D;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-0">
                <div class="col-md-2 col-lg-5 d-none d-md-block">
                  <img src="images/n.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">

                    <form>

                      <div class="d-flex align-items-center mb-3 pb-1">
                        
                        <span class="h1 fw-bold mb-0">Paskyros kūrimas</span>
                      </div>

                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Susikūrkite naują paskyrą</h5>

                      <div class="form-outline mb-4">
                        <label class="form-label">Vardas</label>
                        <input type="text" name="name" placeholder = "Įveskite savo vardą" class="form-control <?php echo (!empty($name_err)) ? 'netinkamas' : ''; ?>" value="<?php echo $name; ?>" />
                        <span class="invalid-feedback"><?php echo $name_err; ?></span>
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Pavardė</label>
                        <input type="text" name="surname" placeholder = "Įveskite savo pavardę" class="form-control form-control-lg <?php echo (!empty($surname_err)) ? 'netinkama' : ''; ?>" value="<?php echo $surname; ?>" required/>
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                      </div>

                      <div class="form-outline mb-4">
                      <label for="gender">Lytis:</label>
                        <select name="gender" id="gender">
                            <option value="Male" <?php $gender = "Male"; ?>>Vyras</option>
                            <option value="Female" <?php $gender = "Female"; ?>>Moteris</option>
                            <option value="Other" <?php $gender = "Other"; ?>>Kita</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $gender_err; ?></span>
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Asmens kodas</label>
                        <input type="number" name="personal_code" placeholder = "Įveskite savo asmens kodą" class="form-control form-control-lg <?php echo (!empty($personal_code_err)) ? 'netinkama' : ''; ?>" value="<?php echo $personal_code; ?>"/>
                        <span class="invalid-feedback"><?php echo $personal_code_err; ?></span>
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">El. paštas</label>
                        <input type="email" name="email" placeholder = "Įveskite savo elektroninį paštą" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'Netinkamas' : ''; ?>" value="<?php echo $email; ?>"/>
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Slaptažodis</label>
                        <input type="password" name="password" placeholder = "Įveskite būsimą paskyros slaptažodį" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'Netinkamas slaptažodis' : ''; ?>" value="<?php echo $password; ?>" />
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                      </div>

                      <div class="pt-1 mb-4">
                        <input type="submit" name="submit" class="btn btn-dark btn-lg btn-block" value="Patvirtinti">  
                      </div>
                      <p>Jau turite paskyrą? <a href="login.php">Prisijunkite čia</a>.</p>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>