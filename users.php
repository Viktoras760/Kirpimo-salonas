<?php 
include_once 'header.php';
include_once "auth_session.php";
require_once "config.php";

if ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Barber')
{
    header("Location: /kirpimo-salonas/");
}
$users = mysqli_query($mysqli,"SELECT * FROM users");
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
                                <h3 style="text-align: center;">Registruoti vartotojai</h3>
                                <?php if(!empty($_SESSION['error']) ) { ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                                <?php } $_SESSION['error'] = NULL ?>
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <?php if($_SESSION["role"] == 'Barber' || $_SESSION["role"] == 'Admin'){ ?> 
                                    <a href="add_user.php"><input type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Pridėti naują vartotoją"></input></a><?php } ?>
                                </div>

                                <table style="border-spacing: 1; border-collapse: collapse; background:white;border-radius:6px;overflow:hidden; width:100%;margin:0 auto;position:relative;">
                                    <thead>
                                        <tr style="height:60px;background:#FFED86;font-size:16px;">
                                            <th>Vardas</th>
                                            <th>Pavardė</th>
                                            <th>El. paštas</th>
                                            <th>Rolė</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($users)){ ?>
                                    <tr style="height:48px; border-bottom:1px solid #E3F1D5 ;">
                  	                    <td title="Vardas"> <?php echo $row['Name'] ?> </td>
                                        <td title="Pavardė"> <?php echo $row['Surname'] ?> </td>
                                        <td title="Elektroninis paštas"> <?php echo $row['Email'] ?> </td>
                                        <td title="Rolė"> <?php echo $row['Role'] ?> </td>
                                        <?php if ($_SESSION['role'] == 'Admin') { ?>
                                        <td><form method="POST" action="edit_user.php"><input type="hidden" name="id" value='<?php echo $row['Personal_code'];?>'><input type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Redaguoti vartotojo duomenis"></form></td>
                                        <td><form method="POST" action="delete_user.php"><input type="hidden" name="id" value='<?php echo $row['Personal_code'];?>'><button onclick="return confirm('Ar Jūs įsitikinę, kad norite ištrinti paskyrą?')" type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;">Ištrinti</button></form></td>
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