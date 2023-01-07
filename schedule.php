<?php 
include_once 'header.php';
include_once "auth_session.php";
require_once "config.php";

$cur_year = date('Y');
$cur_date = date('Y-m-d');
$cur_time = date('Y-m-d h:i:s');
$datetime = new DateTime($cur_date);
$datetime->modify('+1 day');
$date2 = $datetime->format('Y-m-d');
$barber = $_SESSION['personal_code'];

if ($_SERVER['HTTP_REFERER'] != "http://localhost/kirpimo-salonas/schedule.php")
{
    $_SESSION['year'] = $_SESSION['month'] = $_SESSION['day'] = NULL;
    $date = $_SESSION['date'] = $cur_date;
}
else 
{
    $year = $_SESSION['year'];
    $month = $_SESSION['month'];
    $day = $_SESSION['day'];
    $date = $_SESSION['date'];
}

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER['HTTP_REFERER'] == "http://localhost/kirpimo-salonas/schedule.php"){

    if (trim($_POST["year"]))
    {
        $_SESSION['year'] = $year = trim($_POST["year"]);
    }

    if (trim($_POST["month"]))
    {
        $_SESSION['month'] = $month = trim($_POST["month"]);
    }

    if (trim($_POST["day"]))
    {
        $_SESSION['day'] = $day = trim($_POST["day"]);
    }

    $date = $_SESSION['date'] = "$year-$month-$day";
    $datetime = new DateTime($date);
    $datetime->modify('+1 day');
    $date2 = $datetime->format('Y-m-d');

}
if ($date == $cur_date)
{
    $reservations = mysqli_query($mysqli,"SELECT * FROM reservation WHERE fk_Barber_code = '$barber' AND End_time > '$cur_time' AND End_time < '$date2' ORDER BY Start_time");
}
else
{
    $reservations = mysqli_query($mysqli,"SELECT * FROM reservation WHERE fk_Barber_code = '$barber' AND End_time > '$date' AND End_time < '$date2' ORDER BY Start_time");
}
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
                                <h3 style="text-align: center;">Jūsų darbo (klientų rezervacijų) grafikas</h3>
                                <?php if(!empty($_SESSION['error']) ) { ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                                <?php } $_SESSION['error'] = NULL ?>

                                <div class="col-md-6 col-lg-4 d-none d-md-block">
                                    
                                    <h3 style="color: #B4886B;font-weight: bold;display: block;text-align: center;">Pasirinkite norimą datą:</h3>

                                    <div class="form-outline mb-2" ></div>
                                    <form method="post" action="schedule.php">
                                        
                                        <div class="form-outline mb-3">
                                            <label for="year">Pasirinkite norimus metus</label>
                                                <select name="year" id="year">
                                                <option value=""<?php echo $year = $_SESSION['year']; ?>><?php echo $year; ?>_</option>
                                                <option value="<?php echo $year;?>"><?php $year = $cur_year; ?><?php echo $cur_year; ?>.</option>
                                                <option value="<?php echo $year;?>"><?php $year = $cur_year + 1; ?><?php echo $cur_year + 1; ?>.</option>
                                                <option value="<?php echo $year;?>"><?php $year = $cur_year + 2; ?><?php echo $cur_year + 2; ?>.</option>
                                                </select>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label for="month">Pasirinkite norimą mėnesį</label>
                                                <select name="month" id="month">
                                                <option value="" <?php echo $month = $_SESSION['month']; ?>><?php echo $month ?>_</option>
                                                <option value="01"><?php $month = "01"; ?>Sausis</option>
                                                <option value="02" ><?php $month = "02"; ?>Vasaris</option>
                                                <option value="03" ><?php $month = "03"; ?>Kovas</option>
                                                <option value="04" ><?php $month = "04"; ?>Balandis</option>
                                                <option value="05" ><?php $month = "05"; ?>Gegužė</option>
                                                <option value="06" ><?php $month = "06"; ?>Birželis</option>
                                                <option value="07" ><?php $month = "07"; ?>Liepa</option>
                                                <option value="08" ><?php $month = "08"; ?>Rugpjūtis</option>
                                                <option value="09" ><?php $month = "09"; ?>Rugsėjis</option>
                                                <option value="10" ><?php $month = "10"; ?>Spalis</option>
                                                <option value="11" ><?php $month = "11"; ?>Lapkritis</option>
                                                <option value="12" ><?php $month = "12"; ?>Gruodis</option>
                                                </select>
                                        </div>

                                        <div class="col-md-6 col-lg-8 d-none d-md-block">
                                            <div class="form-outline mb-2">
                                                <label for="day">Pasirinkite norimą dieną</label>
                                                    <select name="day" id="day">
                                                        <option value="" ><?php $day = $_SESSION['day']; ?><?php echo $_SESSION['day'] ?>_</option>
                                                        <option value="1" ><?php $day = "1"; ?>1</option>
                                                        <option value="2" ><?php $day = "2"; ?>2</option>
                                                        <option value="3" ><?php $day = "3"; ?>3</option>
                                                        <option value="4" ><?php $day = "4"; ?>4</option>
                                                        <option value="5" ><?php $day = "5"; ?>5</option>
                                                        <option value="6" ><?php $day = "6"; ?>6</option>
                                                        <option value="7" ><?php $day = "7"; ?>7</option>
                                                        <option value="8" ><?php $day = "8"; ?>8</option>
                                                        <option value="9" ><?php $day = "9"; ?>9</option>
                                                        <option value="10" ><?php $day = "10"; ?>10</option>
                                                        <option value="11" ><?php $day = "11"; ?>11</option>
                                                        <option value="12" ><?php $day = "12"; ?>12</option>
                                                        <option value="13" ><?php $day = "13"; ?>13</option>
                                                        <option value="14" ><?php $day = "14"; ?>14</option>
                                                        <option value="15" ><?php $day = "15"; ?>15</option>
                                                        <option value="16" ><?php $day = "16"; ?>16</option>
                                                        <option value="17" ><?php $day = "17"; ?>17</option>
                                                        <option value="18" ><?php $day = "18"; ?>18</option>
                                                        <option value="19" ><?php $day = "19"; ?>19</option>
                                                        <option value="20" ><?php $day = "20"; ?>20</option>
                                                        <option value="21" ><?php $day = "21"; ?>21</option>
                                                        <option value="22" ><?php $day = "22"; ?>22</option>
                                                        <option value="23" ><?php $day = "23"; ?>23</option>
                                                        <option value="24" ><?php $day = "24"; ?>24</option>
                                                        <option value="25" ><?php $day = "25"; ?>25</option>
                                                        <option value="26" ><?php $day = "26"; ?>26</option>
                                                        <option value="27" ><?php $day = "27"; ?>27</option>
                                                        <option value="28" ><?php $day = "28"; ?>28</option>
                                                        <option value="29" ><?php $day = "29"; ?>29</option>
                                                        <option value="30" ><?php $day = "30"; ?>30</option>
                                                        <option value="31" ><?php $day = "31"; ?>31</option>
                                                    </select>
                                            </div>
                                        </div>
                                    <input type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Pateikti pasirinktos dienos grafiką"></form>
                                </div>
                                <div class="col-md-6 col-lg-8 d-none d-md-block">
                                    <h3 style="color: #B4886B;font-weight: bold;display: block;text-align: center;"><?php echo $date?> grafikas:</h3>
                                    <table style="border-spacing: 1px; border-collapse: collapse; background:white;border-radius:6px;overflow:hidden; width:100%;margin:0 auto;position:relative;">
                                        <thead>
                                            <tr style="height:60px;background:#FFED86;font-size:16px;">
                                                <th>Paslauga</th>
                                                <th>Paslaugos kainas (Eur)</th>
                                                <th>Paslaugos teikimo pradžios laikas</th>
                                                <th>Trukmė (min)</th>
                                                <th>Klientas</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
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
                                                    $stmt->bind_param("s", $row['fk_UserPersonal_code']);

                                                    // Attempt to execute the prepared statement
                                                    if($stmt->execute())
                                                    {
                                                        $res = $stmt->get_result();
                                                        $row2 = $res->fetch_assoc();
                                                        $user_name = $row2['Name'];
                                                        $user_surname = $row2['Surname'];
                                                    } 
                                                
                                                    // Close statement
                                                    $stmt->close();
                                                } ?>
                                                <td title="Klientas"> <?php echo $user_name, " ", $user_surname; ?> </td>
                                            </tr> 
                                            <?php } ?> 
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