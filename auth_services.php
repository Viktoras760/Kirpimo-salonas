<?php 
include_once 'header.php';
include_once "auth_session.php";
require_once "config.php";
$barber;
$userID = $_SESSION['personal_code'];
$result = mysqli_query($mysqli,"SELECT * FROM services");
$user = mysqli_query($mysqli,"SELECT * FROM users WHERE Personal_code = '$userID'");
$row3 = mysqli_fetch_array($user);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <title>V&R kirpimo salonas</title>
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
                                <?php if(!empty($_SESSION['error']) ) { ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                                <?php } $_SESSION['error'] = NULL ?>
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <?php if($_SESSION["role"] == 'Barber' || $_SESSION["role"] == 'Admin'){ ?> 
                                    <a href="add_service.php" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;">Pridėti naują paslaugą</a><?php } ?>
                                </div>
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <?php if($_SESSION["role"] != NULL){ ?> 
                                    <a href="reservation.php" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 12px;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: -apple-system,system-ui,Roboto,Helvetica,Arial,sans-serif;font-size: 16px;font-weight: 500;line-height: 2.5;outline: transparent;padding: 0 1rem;text-align: center;text-decoration: none;transition: box-shadow .2s ease-in-out;user-select: none;-webkit-user-select: none;touch-action: manipulation;white-space: nowrap;" >Registruotis</a><?php } ?>
                                </div>

                                <table style="border-collapse: collapse; background:white;border-radius:6px;overflow:hidden; width:100%;margin:0 auto;position:relative;">
                                    <thead>
                                        <tr style="height:60px;background:#FFED86;font-size:16px;">
                                            <th>Paslauga</th>
                                            <th>Paslaugos kainas (Eur)</th>
                                            <th>Trukmė (min)</th>
                                            <th>Kirpėjas</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($result)){ ?>
                                        <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                                            <td title="Paslauga"> <?php echo $row['Name'] ?> </td>
                                            <td title="Paslaugos kainas (Eur)"> <?php echo $row['Price'] ?> </td>
                                            <td title="Trukmė (min)"> <?php echo $row['Duration'] ?> </td>
                                            <?php $sql = "SELECT * FROM users WHERE Personal_code = ?";
        
                                            if($stmt = $mysqli->prepare($sql))
                                            {
                                                // Bind variables to the prepared statement as parameters
                                                $stmt->bind_param("s", $row['fk_Barber_code']);

                                                // Attempt to execute the prepared statement
                                                if($stmt->execute())
                                                {
                                                    $res = $stmt->get_result();
                                                    $row2 = $res->fetch_assoc();
                                                    $barber = $row2['Name'];
                                                } 
                                            
                                                // Close statement
                                                $stmt->close();
                                            } ?>
                                            <td title="Kirpėjas"> <?php echo $barber ?> </td>
                                            <td><form method="POST" action="edit_auth_service.php"><input type="hidden" name="id" value='<?php echo $row['id_Services'];?>'><input type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Paslaugos aprašymas"></form></td>
                                            <?php if($row3['Role'] == "Barber" || $row3['Role'] == "Admin") { ?>
                                            <td><form method="POST" action="delete_service.php"><input type="hidden" name="id" value='<?php echo $row['id_Services'];?>'><button onclick="return confirm('Ar Jūs įsitikinę, kad norite ištrinti šią paslaugą?')" type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;">Ištrinti</button></form></td>
                                                <?php } ?>
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