<?php 
include_once 'header.php';
include_once "auth_session.php";
require_once "config.php";
$barber;
$type;
$_SESSION['month'] = $_SESSION['day'] = $_SESSION['time'] = NULL;
$result = mysqli_query($mysqli,"SELECT * FROM services");
$result2 = mysqli_query($mysqli,"SELECT * FROM services");
$user = $_SESSION['personal_code'];
$cur_time = date('Y-m-d h:i:s');
if ($_POST)
{
    $type = $_POST['id'];
}
else
{
    $type = "Visos rezervacijos";
}
$reservations = mysqli_query($mysqli,"SELECT * FROM reservation WHERE fk_UserPersonal_code = '$user'");
$date = date('Y-m-d h:i:s');
//echo '<script>confirm("Welcome to Geeks for Geeks")</script>';
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
                                <h3 style="text-align: center;">Jūsų rezervacijos</h3>
                                <div class="col-md-6 col-lg-3 d-none d-md-block">
                                        
                                    <?php if ($type == "Visos rezervacijos")
                                    { ?>
                                    <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                                    <td><form method="POST" action="my_reservations.php"><input type="hidden" name="id" value='<?php echo "Visos rezervacijos";?>'><input type="submit" style="background: linear-gradient(to bottom right, #f30303, #e50707);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Visos rezervacijos"></form></td>
                                    </tr> 
                                    <?php } else { ?>

                                    <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                                    <td><form method="POST" action="my_reservations.php"><input type="hidden" name="id" value='<?php echo "Visos rezervacijos";?>'><input type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Visos rezervacijos"></form></td>
                                    </tr>
                                    <?php } ?>

                                    <?php if ($type == "Ateinančios rezervacijos")
                                    { ?>
                                    <td><form method="POST" action="my_reservations.php"><input type="hidden" name="id" value='<?php echo "Ateinančios rezervacijos";?>'><input type="submit" style="background: linear-gradient(to bottom right, #f30303, #e50707);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Ateinančios rezervacijos"></form></td>
                                    </tr> 
                                    <?php } else { ?>

                                    <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                                    <td><form method="POST" action="my_reservations.php"><input type="hidden" name="id" value='<?php echo "Ateinančios rezervacijos";?>'><input type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Ateinančios rezervacijos"></form></td>
                                    </tr>
                                    <?php } ?>

                                    <?php if ($type == "Praėjusios rezervacijos")
                                    { ?>
                                    <td><form method="POST" action="my_reservations.php"><input type="hidden" name="id" value='<?php echo "Praėjusios rezervacijos";?>'><input type="submit" style="background: linear-gradient(to bottom right, #f30303, #e50707);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Praėjusios rezervacijos"></form></td>
                                    </tr> 
                                    <?php } else { ?>

                                    <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                                    <td><form method="POST" action="my_reservations.php"><input type="hidden" name="id" value='<?php echo "Praėjusios rezervacijos";?>'><input type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Praėjusios rezervacijos"></form></td>
                                    </tr>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6 col-lg-9 d-none d-md-block">

                                    <table style="border-spacing: 1; border-collapse: collapse; background:white;border-radius:6px;overflow:hidden; width:100%;margin:0 auto;position:relative;">
                                        <thead>
                                            <tr style="height:60px;background:#FFED86;font-size:16px;">
                                                <th>Paslauga</th>
                                                <th>Paslaugos kainas (Eur)</th>
                                                <th>Paslaugos teikimo pradžios laikas</th>
                                                <th>Trukmė (min)</th>
                                                <th>Kirpėjas</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if ($type == "Visos rezervacijos")
                                                {
                                                    while($row = mysqli_fetch_array($reservations)){ 
                                                        $resID = $row['id_Reservation'];
                                                        $includes = mysqli_query($mysqli,"SELECT * FROM includes WHERE fk_Reservationid_Reservation = '$resID'");
                                                        $inc = mysqli_fetch_array($includes);
                                                        $incID = $inc['fk_Servicesid_Services'];
                                                        $service = mysqli_query($mysqli,"SELECT * FROM services WHERE id_Services = '$incID'");
                                                        $row2 = mysqli_fetch_array($service);
                                            ?>


                                            <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                                                <td title="Paslauga"> <?php echo $row2['Name'] ?> </td>
                                                <td title="Paslaugos kainas (Eur)"> <?php echo $row2['Price'] ?> </td>
                                                <td title="Paslaugos teikimo pradžios laikas"> <?php echo $row['Start_time'] ?> </td>
                                                <td title="Trukmė (min)"> <?php echo $row2['Duration'] ?> </td>
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
                                                <?php if ($row['Start_time'] > $cur_time) { ?>
                                                    <td><form method="POST" action="delete_my_reservation.php"><input type="hidden" name="id" value='<?php echo $row['id_Reservation'];?>'><button onclick="return confirm('Ar Jūs įsitikinę, kad norite ištrinti rezervaciją?')" type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;">Ištrinti</button></form></td>
                                                <?php } ?>
                                            </tr> 
                                            <?php } } else if ($type == "Ateinančios rezervacijos") {
                                                $reservations = mysqli_query($mysqli,"SELECT * FROM reservation WHERE fk_UserPersonal_code = '$user' AND End_time >= '$date'");
                                                while($row = mysqli_fetch_array($reservations)){ 
                                                    $resID = $row['id_Reservation'];
                                                    $includes = mysqli_query($mysqli,"SELECT * FROM includes WHERE fk_Reservationid_Reservation = '$resID'");
                                                    $inc = mysqli_fetch_array($includes);
                                                    $incID = $inc['fk_Servicesid_Services'];
                                                    $service = mysqli_query($mysqli,"SELECT * FROM services WHERE id_Services = '$incID'");
                                                    $row2 = mysqli_fetch_array($service);
                                              ?> 
                                            <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                                                <td title="Paslauga"> <?php echo $row2['Name'] ?> </td>
                                                <td title="Paslaugos kainas (Eur)"> <?php echo $row2['Price'] ?> </td>
                                                <td title="Paslaugos teikimo pradžios laikas"> <?php echo $row['Start_time'] ?> </td>
                                                <td title="Trukmė (min)"> <?php echo $row2['Duration'] ?> </td>
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
                                                <?php if ($row['Start_time'] > $cur_time) { ?>
                                                    <td><form method="POST" action="delete_my_reservation.php"><input type="hidden" name="id" value='<?php echo $row['id_Reservation'];?>'><button onclick="return confirm('Ar Jūs įsitikinę, kad norite ištrinti rezervaciją?')" type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;">Ištrinti</button></form></td>
                                                <?php } ?>
                                            </tr> 
                                            <?php  } } 
                                            else if ($type == "Praėjusios rezervacijos") {
                                                $reservations = mysqli_query($mysqli,"SELECT * FROM reservation WHERE fk_UserPersonal_code = '$user' AND End_time <= '$date'");
                                                while($row = mysqli_fetch_array($reservations)){ 
                                                    $resID = $row['id_Reservation'];
                                                    $includes = mysqli_query($mysqli,"SELECT * FROM includes WHERE fk_Reservationid_Reservation = '$resID'");
                                                    $inc = mysqli_fetch_array($includes);
                                                    $incID = $inc['fk_Servicesid_Services'];
                                                    $service = mysqli_query($mysqli,"SELECT * FROM services WHERE id_Services = '$incID'");
                                                    $row2 = mysqli_fetch_array($service);
                                              ?> 
                                            <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                                                <td title="Paslauga"> <?php echo $row2['Name'] ?> </td>
                                                <td title="Paslaugos kainas (Eur)"> <?php echo $row2['Price'] ?> </td>
                                                <td title="Paslaugos teikimo pradžios laikas"> <?php echo $row['Start_time'] ?> </td>
                                                <td title="Trukmė (min)"> <?php echo $row2['Duration'] ?> </td>
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
                                            </tr> 
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </section>
    </body>
    <?php include_once "footer.php"; ?>
</html>