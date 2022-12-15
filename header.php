<?php
// Initialize the session
session_start();
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>V&R kirpimo salonas</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="/kirpimo-salonas/">V & R kirpimo salonas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php // Check if the user is logged in
          if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ ?>
    <div class=" collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto ">
        <li class="nav-item">
          <a class="nav-link mx-2 active" aria-current="page" href="login.php">Registruotis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="services.php">Paslaugos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="contacts.php">Kontaktai</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
        <li class="nav-item mx-2">
          <a class="nav-link text-light h5" href="register.php" target="blank">Kurti paskyrą</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-light h5" href="login.php" target="blank">Prisijungti</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php } elseif($_SESSION["role"] == 'Client'){ ?>
  <div class=" collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto ">
        <li class="nav-item">
          <a class="nav-link mx-2 active" aria-current="page" href="reservation.php">Registruotis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="auth_services.php">Paslaugos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="contacts.php">Kontaktai</a>
        </li>
    <li class="nav-item">
      <a class="nav-link mx-2" href="my_reservations.php">Mano rezervacijos</a>
    </li>
  </ul>
      <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
        <li class="nav-item mx-2">
          <a class="nav-link text-light h5" href="profile.php" target="blank">Mano paskyra</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-light h5" href="logout.php" target="blank">Atsijungti</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php } elseif($_SESSION["role"] == 'Barber'){ ?>
  <div class=" collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto ">
        <li class="nav-item">
          <a class="nav-link mx-2 active" aria-current="page" href="reservation.php">Registruotis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="auth_services.php">Paslaugos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="contacts.php">Kontaktai</a>
        </li>
        <li class="nav-item">
      <a class="nav-link mx-2" href="my_reservations.php">Mano rezervacijos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mx-2" href="schedule.php">Kirpimų grafikas</a>
    </li>
  </ul>
      <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
        <li class="nav-item mx-2">
          <a class="nav-link text-light h5" href="profile.php" target="blank">Mano paskyra</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-light h5" href="logout.php" target="blank">Atsijungti</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php } elseif ( $_SESSION["role"] == 'Admin'){  ?>
  <div class=" collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto ">
        <li class="nav-item">
          <a class="nav-link mx-2 active" aria-current="page" href="reservation.php">Registruotis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="auth_services.php">Paslaugos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="contacts.php">Kontaktai</a>
        </li>
        <li class="nav-item">
      <a class="nav-link mx-2" href="my_reservations.php">Mano rezervacijos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mx-2" href="schedule.php">Kirpimų grafikas</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mx-2" href="users.php">Naudotojų valdymas</a>
    </li>
  </ul>
      <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
        <li class="nav-item mx-2">
          <a class="nav-link text-light h5" href="profile.php" target="blank">Mano paskyra</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-light h5" href="logout.php" target="blank">Atsijungti</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php } ?>

