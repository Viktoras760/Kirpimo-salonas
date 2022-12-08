<?php 
include_once 'header.php';
require_once "config.php";


$result = mysqli_query($mysqli,"SELECT * FROM services");
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
                                
                    
                                <table style="border-spacing: 1; border-collapse: collapse; background:white;border-radius:6px;overflow:hidden; width:100%;margin:0 auto;position:relative;">
                                    <thead>
                                        <tr style="height:60px;background:#FFED86;font-size:16px;">
                                            <th>Paslauga</th>
                                            <th>Paslaugos kainas (Eur)</th>
                                            <th>Trukmė (min)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($result)){ ?>
                                    <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                  	                    <td title="Paslauga"> <?php echo $row['Name'] ?> </td>
                                        <td title="Paslaugos kainas (Eur)"> <?php echo $row['Price'] ?> </td>
                                        <td title="Trukmė (min)"> <?php echo $row['Duration'] ?> </td>
                                        <td><form method="POST" action="edit_service.php"><input type="hidden" name="id" value='<?php echo $row['id_Services'];?>'><input type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Paslaugos aprašymas"></form></td>
                                    </tr> 
                                    <?php } ?> 
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