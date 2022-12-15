<?php
  //include header
  include_once 'header.php';
  // Include config file
  require_once "config.php";
   
  // Define variables and initialize with empty values
  $name = $surname = $gender = $email = $password = $role = "";
  $personal_code = "Įveskite savo asmens kodą";
  $name_err = $surname_err = $personal_code_err = $gender_err = $email_err = $password_err = $role_err = "";

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){

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
    //Validate personal code
    if(empty(trim($_POST["personal_code"])))
    {
      $personal_code_err = "Įveskite asmens kodą.";
    }

    elseif(!preg_match('/^[0-9]+$/', trim($_POST["personal_code"])))
    {
      $personal_code_err = "Asmens kodas turi būti sudarytas tik iš skaičių.";
    }

    elseif(strlen((string) trim($_POST["personal_code"])) != 11)
    {
      $personal_code_err = "Asmens kodas turi būti sudarytas iš 11 skaičių.";
    }

    else
    {
      // Prepare a select statement
      $sql = "SELECT * FROM users WHERE personal_code = ?";
      
      if($stmt = $mysqli->prepare($sql))
      {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_personal_code);
        
        // Set parameters
        $param_personal_code = trim($_POST["personal_code"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute())
        {
          // store result
          $stmt->store_result();
          
          if($stmt->num_rows == 1)
          {
            $personal_code_err = "Paskyra su tokiu asmens kodu jau egzistuoja.";
          } 

          else
          {
            $personal_code = trim($_POST["personal_code"]);
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
    //Validate role
    if(empty(trim($_POST["role"])))
    {
      $role_err = "Pasirinkite rolę.";    
    } 

    else
    {
      $role = trim($_POST["role"]);
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
          
          if($stmt->num_rows == 1)
          {
            $email_err = "Šis elektroninis paštas jau yra surištas su kita paskyra.";
          } 

          else
          {
            $email = trim($_POST["email"]);
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

    //------------------------------------------------------------------------------------
    // Validate password
    if(empty(trim($_POST["password"])))
    {
      $password_err = "Įveskite slaptažodį.";    
    } 

    elseif(strlen(trim($_POST["password"])) < 6)
    {
      $password_err = "Slaptažodis turi būti bent 6 simbolių ilgio.";
    } 

    else
    {
      $password = trim($_POST["password"]);
    }

    //------------------------------------------------------------------------------------
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
        $param_role = $role;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
          // Redirect to login page
          header("location: users.php");
        } else{
          echo "Įvyko klaida, pabandykite užsiregistruotis dar kartą!";
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
    <section class="vh-100" style="background-image:url(https://img.freepik.com/free-photo/vintage-wooden-table-with-beard-shaping-salon-tools_53876-127084.jpg?w=2000)">
      <div class="container h-100" style="background-color:#e0e0b6; width: 5000px">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card align-items-center" style="border-radius: 1rem; margin: auto;">
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">

                  <form method="POST">

                  <div class="d-flex align-items-center mb-3 pb-1">
                        
                        <span class="h1 fw-bold mb-0">Paskyros kūrimas</span>
                      </div>

                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sukurkite naują paskyrą</h5>

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

                        <?php } elseif(!empty($role_err) ) { ?>

                        <div class="alert alert-danger"><?php echo $role_err; ?></div>

                      <?php } elseif(!empty($password_err) ) { ?>

                        <div class="alert alert-danger"><?php echo $password_err; ?></div>

                      <?php } ?>
                      
                      <div class="form-outline mb-4">
                        <label class="form-label">Vardas</label>
                        <input type="text" name="name" placeholder = "Įveskite savo vardą" class="form-control form-control-lg " value="<?php echo $name; ?>" />
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Pavardė</label>
                        <input type="text" name="surname" placeholder = "Įveskite savo pavardę" class="form-control form-control-lg " value="<?php echo $surname; ?>"/>
                      </div>

                      <div class="form-outline mb-4">
                      <label for="gender">Lytis:</label>
                        <select name="gender" id="gender">
                          <option value="" <?php $gender = ""; ?>> </option>
                          <option value="Male" <?php $gender = "Male"; ?>>Vyras</option>
                          <option value="Female" <?php $gender = "Female"; ?>>Moteris</option>
                          <option value="Other" <?php $gender = "Other"; ?>>Kita</option>
                        </select>
                      </div>

                      <div class="form-outline mb-4">
                      <label for="role">Rolė:</label>
                        <select name="role" id="role">
                          <option value="" <?php $role = ""; ?>> </option>
                          <option value="Client" <?php $role = "Client"; ?>>Klientas</option>
                          <option value="Barber" <?php $role = "Barber"; ?>>Kirpėjas</option>
                          <option value="Admin" <?php $role = "Admin"; ?>>Administratorius</option>
                        </select>
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Asmens kodas</label>
                        <input type="number" name="personal_code" placeholder = "Įveskite savo asmens kodą" class="form-control form-control-lg " value="<?php echo $personal_code; ?>"/>
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">El. paštas</label>
                        <input type="email" name="email" placeholder = "Įveskite savo elektroninį paštą" autocomplete="new-email" class="form-control form-control-lg " value="<?php echo $email; ?>"/>
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label">Slaptažodis</label>
                        <input type="password" name="password" autocomplete="new-password" placeholder = "Įveskite būsimą paskyros slaptažodį" class="form-control form-control-lg" value="<?php echo $password; ?>" />
                      </div>

                      <div class="pt-1 mb-4">
                        <input type="submit" name="submit" class="btn btn-dark btn-lg btn-block" value="Patvirtinti">  
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