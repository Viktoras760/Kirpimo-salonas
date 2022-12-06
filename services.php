<?php 

include_once 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <section class="vh-100" style="background-image:url(https://img.freepik.com/free-photo/vintage-wooden-table-with-beard-shaping-salon-tools_53876-127084.jpg?w=2000)">
            <div class="container h-100" style="background-color:#e0e0b6; width: 5000px">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0">
                                <h3 style="text-align: center;">Paslaugos ir jų kainos </h3>
                                
                                <table class="kainutabl">
                                    <thead>
                                        <tr>
                                            <th>Paslauga</th>
                                            <th>Paslaugos kainas (Eur)</th>
                                            <th>Viktorijos kainos</th>
                                            <th>Ričio kainos</th>
                                            <th>Trukmė (min)</th>
                                            <th><?php if($_SESSION["role"] == 'Barber' || $_SESSION["role"] == 'Admin'){ ?> <button type="button" href="edit_service.php" >Redaguoti paslaugą</button> <button type="button" >Pašalinti paslaugą</button> <?php } ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </section>
    </body>
    <?php include_once "footer.php"; ?>
</html>