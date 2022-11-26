<?php
  include_once 'header.php';
?>

    

<!--<form action="/action_page.php">
  <div class="container">
    <h1>Paskyros kūrimas</h1>
    <p>Užpildykite visus nurodytus laukus, kad sukūrti naują paskyrą</p>
    <hr>

    <div><label for="name"><b>Vardas</b></label></div>
    <input type="text" placeholder="Įveskite vardą" name="name" id="name" required>

    <div><label for="surname"><b>Pavardė</b></label></div>
    <div><input type="text" placeholder="Įveskite pavardę" name="surname" id="surname" required></div>

    <div><label for="email"><b>El. paštas</b></label></div>
    <div><input type="text" placeholder="Įveskite elektroninį paštą" name="email" id="email" required></div>

    <div><label for="psw"><b>Slaptažodis</b></label></div>
    <div><input type="password" placeholder="Įveskite slaptažodį" name="psw" id="psw" required></div>

    <div><label for="psw-repeat"><b>Patvirtinkite slaptažodį</b></label></div>
    <div><input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required></div>
    <hr>

    <div><button type="submit" class="registerbtn">Kurti paskyrą</button></div>
  </div>
  
  <div class="container signin">
    <p>Jau turite paskyra? <a href="login.php">Prisijunkite</a>.</p>
  </div>
</form>-->

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

                <form>

                  <div class="d-flex align-items-center mb-3 pb-1">
                    
                    <span class="h1 fw-bold mb-0">Paskyros kūrimas</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Susikūrkite naują paskyra</h5>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Vardas</label>
                    <input type="name" id="form2Example17" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Pavardė</label>
                    <input type="surname" id="form2Example17" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                  <label for="gender">Lytis:</label>
                    <select name="gender" id="gender">
                        <option value="Male">Vyras</option>
                        <option value="female">Moteris</option>
                        <option value="other">Kita</option>
                    </select>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">El. paštas</label>
                    <input type="email" id="form2Example17" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Slaptažodis</label>
                    <input type="password" id="form2Example27" class="form-control form-control-lg" />
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="button">Patvirtinti</button>
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