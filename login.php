<?php
  include_once 'header.php';
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: /kirpimo-salonas/");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Įveskite elektroninį paštą.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Įveskite slaptažodį.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT personal_code, email, password, role FROM users WHERE email = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if email exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($personal_code, $email, $hashed_password, $role);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["personal_code"] = $personal_code;
                            $_SESSION["email"] = $email;
                            $_SESSION["role"] = $role;
                            $_SESSION["error"] = NULL;
                            $_SESSION["success"] = NULL;
                            $_SESSION["state"] = 0;                          
                            
                            // Redirect user to main page
                            header("location: /kirpimo-salonas/");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Paštas arba slaptažodis įvesti klaidingai.";
                        }
                    }
                } else{
                    // Email doesn't exist, display a generic error message
                    $login_err = "Paštas arba slaptažodis įvesti klaidingai.";
                }
            } else{
                echo "Įvyko klaida! Pabandykite prisijungti vėliau.";
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
    <section class="vh-100" style="background-color: #9A616D;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-0">
                <div class="col-md-2 col-lg-5 d-none d-md-block">
                  <img src="images/m.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%" >
                </div>
                <div class="col-md-4 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">

                    <form method="POST"> 

                      <div class="d-flex align-items-center mb-3 pb-1">
                        
                        <span class="h1 fw-bold mb-0">Prisijungti</span>
                      </div>
                    
                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Prisijunkite prie savo paskyros</h5>

                      <?php if(!empty($login_err)){ echo '<div class="alert alert-danger">' . $login_err . '</div>';} ?>

                      <div class="form-outline mb-4">
                        <label class="form-label" >El. paštas</label>
                        <input type="email" name="email" placeholder="Jūsų elektroninis paštas"  class="form-control form-control-lg" value="<?php echo $email; ?>">
                        
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label" >Slaptažodis</label>
                        <input type="password" name="password" placeholder="Jūsų slaptažodis" class="form-control form-control-lg" value="<?php echo $password; ?>">
                      </div>

                      <div class="pt-1 mb-4">
                        <input type="submit" class="btn btn-dark btn-lg btn-block" value="Prisijungti">
                      </div>

                      <a class="small text-muted" href="#!">Pamiršote slaptažodį?</a>
                      <p class="mb-5 pb-lg-2" style="color: #393f81;">Neturite paskyros? 
                        <a href="register.php" style="color: #393f81;">Registruokitės čia</a>
                      </p>
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

