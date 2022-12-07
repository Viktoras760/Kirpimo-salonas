<?php 

include_once 'header.php';
require_once "config.php";

$result = mysqli_query($mysqli,"SELECT * FROM services");
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
    <section class="vh-100" style="background-color: #9A616D;">
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

                    <form method="post">

                      <div class="d-flex align-items-center mb-3 pb-1">
                        
                        <span class="h1 fw-bold mb-0">Paskyros kūrimas</span>
                      </div>

                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Susikūrkite naują paskyrą</h5>

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
                      <p>Jau turite paskyrą? <a href="login.php">Prisijunkite čia</a>.</p>
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