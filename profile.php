<?php
  //include header
  include_once 'header.php';
  // Include config file
  require_once "config.php";
   
  // Define variables and initialize with empty values
  $name_err = $surname_err = $personal_code_err = $gender_err = $email_err = $password_err = $role_err = "";

  $userId = $_SESSION['personal_code'];

  $user = mysqli_query($mysqli,"SELECT * FROM users WHERE Personal_code = '$userId'");
  $row = mysqli_fetch_array($user);
  $email = $row['Email'];
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

                  <form action="edit_profile.php">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    
                    <span class="h1 fw-bold mb-0">Jūsų paskyros informacija</span>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Vardas</label>
                    <input readonly type="text" name="name" class="form-control form-control-lg " value="<?php echo $row['Name'];?>" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Pavardė</label>
                    <input readonly type="text" name="surname"  class="form-control form-control-lg " value="<?php echo $row['Surname']; ?>"/>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Asmens kodas</label>
                    <input readonly type="number" name="personal_code"  class="form-control form-control-lg " value="<?php echo $row['Personal_code']; ?>"/>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">El. paštas</label>
                    <input readonly type="email" name="email" placeholder = "Įveskite savo elektroninį paštą" autocomplete="new-email" class="form-control form-control-lg " <?php $email = $row['Email']; ?> value="<?php echo $row['Email']; ?>"/>
                  </div>

                  <div class="form-outline mb-4">
                      <label for="role">Rolė:</label>
                      <input readonly type="text" name="role"  class="form-control form-control-lg " value="<?php echo $row['Role']; ?>"/>
                    </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Lytis</label>
                    <input readonly type="text" name="gender" class="form-control form-control-lg " value="<?php echo $row['Gender']; ?>"/>
                  </div>

                  <div class="pt-1 mb-4">
                    <input type="submit" class="btn btn-dark btn-lg btn-block" value="Redaguoti paskyrą"> 
                    
                  </div>
                  </form>
                  <form action="/kirpimo-salonas/" method="POST"><input type="submit" class="btn btn-dark btn-lg btn-block" value="Grįžti"></form>
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