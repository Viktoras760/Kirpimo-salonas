<?php 
include_once 'header.php';
include_once "auth_session.php";
require_once "config.php";



if ($_POST && $_SERVER['HTTP_REFERER'] == "http://localhost/kirpimo-salonas/reservation.php")
{
    $serviceID = $_POST['id'];
    $_SESSION['serviceID'] = $serviceID;
    $_SESSION['year'] = NULL;
}
else 
{
    $month = $_SESSION['month'];
    $day = $_SESSION['day'];
    $serviceID = $_SESSION['serviceID'];
}
$year = $cur_year = date('Y');
$result = mysqli_query($mysqli,"SELECT * FROM services WHERE id_Services = $serviceID");
$row = mysqli_fetch_array($result);
$_SESSION['barbID'] = $barberID = $row['fk_Barber_code'];
$_SESSION['duration'] = $row['Duration'];
$_SESSION['service'] = $row['Name'];
$_SESSION['price'] = $row['Price'];
$result = mysqli_query($mysqli,"SELECT * FROM users WHERE Personal_code = $barberID");
$row = mysqli_fetch_array($result);
$barber = $row['Name'];

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER['HTTP_REFERER'] == "http://localhost/kirpimo-salonas/time_reservation.php"){

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
                                <h3 style="text-align: center;">Laiko rezervacija paslaugai</h3>
                                <?php if(!empty($_SESSION['error']) ) { ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                                <?php } $_SESSION['error'] = NULL ?>

                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <svg height="24" width="24" viewBox="0 0 24 24" class="EmployeeSelect-module_avatar_f8203f" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid meet" fill="currentColor"><path d="M17.6 13.714A9.987 9.987 0 0122 22h-2a8 8 0 00-4.124-7 8.026 8.026 0 001.724-1.286zM12 2a6 6 0 01.225 11.996L12 14a8 8 0 00-8 8H2c0-4.21 2.603-7.814 6.287-9.288A6 6 0 0112 2zm0 2C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" fill-rule="evenodd"></path></svg>
                                    <label class="form-label">J??s?? kirp??jas: </label>
                                    
                                    <input readonly type="text" name="barber" class="form-control form-control-lg "  value="<?php echo $barber; ?>">
                            
                                    <div class="form-outline mb-2" >
                                    </div>
                                    <form method="post" action="time_reservation.php">
                                        
                                        <div class="form-outline mb-3">
                                                <label for="year">Pasirinkite rezervacijos metus</label>
                                                    <select name="year" id="year">
                                                    <option value=""<?php echo $year = $_SESSION['year']; ?>><?php echo $year; ?>.</option>
                                                    <option  value="<?php echo $year;?>"><?php $year = $cur_year; ?><?php echo $cur_year; ?>.</option>
                                                    <option  value="<?php echo $year;?>"><?php $year = $cur_year + 1; ?><?php echo $cur_year + 1; ?>.</option>
                                                    <option  value="<?php echo $year;?>"><?php $year = $cur_year + 2; ?><?php echo $cur_year + 2; ?>.</option>
                                                    </select>
                                            </div>

                                            <div class="form-outline mb-3">
                                                <label for="month">Pasirinkite rezervacijos m??nes??</label>
                                                    <select name="month" id="month">
                                                    <option value="" ><?php $month = $_SESSION['month']; ?><?php echo $month ?>.</option>
                                                    <option value="01" ><?php $month = "01"; ?>Sausis</option>
                                                    <option value="02" ><?php $month = "02"; ?>Vasaris</option>
                                                    <option value="03" ><?php $month = "03"; ?>Kovas</option>
                                                    <option value="04" ><?php $month = "04"; ?>Balandis</option>
                                                    <option value="05" ><?php $month = "05"; ?>Gegu????</option>
                                                    <option value="06" ><?php $month = "06"; ?>Bir??elis</option>
                                                    <option value="07" ><?php $month = "07"; ?>Liepa</option>
                                                    <option value="08" ><?php $month = "08"; ?>Rugpj??tis</option>
                                                    <option value="09" ><?php $month = "09"; ?>Rugs??jis</option>
                                                    <option value="10" ><?php $month = "10"; ?>Spalis</option>
                                                    <option value="11" ><?php $month = "11"; ?>Lapkritis</option>
                                                    <option value="12" ><?php $month = "12"; ?>Gruodis</option>
                                                    </select>
                                            </div>

                                            <div class="col-md-6 col-lg-8 d-none d-md-block">
                                                <div class="form-outline mb-2">
                                                    <label for="day">Pasirinkite rezervacijos dien??</label>
                                                        <select name="day" id="day">
                                                            <option value="" ><?php $day = $_SESSION['day']; ?><?php echo $_SESSION['day'] ?>.</option>
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
                                            <input type="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Pateikti laisvus laikus"></form>
                                            <?php if ($_SESSION['month'] && $_SESSION['day']) {  ?>
                                                
                                            <form method="post" action="reserv.php">
                                                <div class="form-outline mb-3">
                                                    <label for="time">Pasirinkite rezervacijos laik??</label>
                                                        
                                                            <?php $m = $_SESSION['month'];
                                                            $d = $_SESSION['day'];
                                                            $hours = array();
                                                            $reservations = mysqli_query($mysqli,"SELECT HOUR(Start_time), HOUR(End_time) FROM reservation WHERE MONTH(Start_time) = '$m' AND DAY(Start_time) = '$d' AND fk_Barber_code = $barberID"); 
                                                            while($row3 = mysqli_fetch_array($reservations)){
                                                                array_push($hours, $row3['0'], $row3['1']);
                                                            }
                                                            ?>
                                                        <select name="time" id="time">
                                                        <option value="" ><?php $time = $_SESSION['time']; ?><?php echo $time ?>.</option>
                                                        <?php if (!in_array(9, $hours)) { ?>
                                                        <option value="9:00:00" ><?php $time = "9:00:00"; ?>9:00:00</option>
                                                        <?php } ?>
                                                        <?php if (!in_array(10, $hours)) { ?>
                                                        <option value="10:00:00" ><?php $time = "10:00:00"; ?>10:00:00</option>
                                                        <?php } ?>
                                                        <?php if (!in_array(11, $hours)) { ?>
                                                        <option value="11:00:00" ><?php $time = "11:00:00"; ?>11:00:00</option>
                                                        <?php } ?>
                                                        <?php if (!in_array(12, $hours)) { ?>
                                                        <option value="12:00:00" ><?php $time = "12:00:00"; ?>12:00:00</option>
                                                        <?php } ?>
                                                        <?php if (!in_array(13, $hours)) { ?>
                                                        <option value="13:00:00" ><?php $time = "13:00:00"; ?>13:00:00</option>
                                                        <?php } ?>
                                                        <?php if (!in_array(14, $hours)) { ?>
                                                        <option value="14:00:00" ><?php $time = "14:00:00"; ?>14:00:00</option>
                                                        <?php } ?>
                                                        <?php if (!in_array(15, $hours)) { ?>
                                                        <option value="15:00:00" ><?php $time = "15:00:00"; ?>15:00:00</option>
                                                        <?php } ?> <?php if (!in_array(9, $hours)) { ?>
                                                        <option value="16:00:00" ><?php $time = "16:00:00"; ?>16:00:00</option>
                                                        <?php } ?>
                                                        <?php if (!in_array(17, $hours)) { ?>
                                                        <option value="17:00:00" ><?php $time = "17:00:00"; ?>17:00:00</option>
                                                        <?php } ?>
                                                        </select>
                                                </div>

                                            <input type="hidden" name="duration" value='<?php echo $_SESSION['duration'];?>'><input type="hidden" name="year" value='<?php echo $_SESSION['year'];?>'><input type="hidden" name="service" value='<?php echo $_SESSION['serviceID'];?>'><input type="hidden" name="month" value='<?php echo $_SESSION['month'];?>'><input type="hidden" name="day" value='<?php echo $_SESSION['day'];?>'><input type="hidden" name="barbID" value='<?php echo $_SESSION['barbID'];?>'><input type="submit" name="submit" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border-radius: 8px;border-style: none;box-sizing: border-box;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: Helvetica, Arial, sans-serif;font-size: 14px;font-weight: 500;height: 40px;line-height: 20px;list-style: none;margin: 0;outline: none;padding: 10px 16px;position: relative;text-align: center;text-decoration: none;transition: color 100ms;vertical-align: baseline;user-select: none;-webkit-user-select: none;touch-action: manipulation;" value="Rezervuoti laik??"></form>
                                        <?php } ?>
                                </div>
                                <div class="col-md-6 col-lg-1 d-none d-md-block">
                                </div>
                                <div class="col-md-6 d-none d-md-block">
                                    <h3 style="color: #B4886B;font-weight: bold;display: block;text-align: center;">J??s?? rezervuojama paslauga:</h3>
                                    <ul class="responsive-table">
                                        <li class="table-row" style="border-radius: 3px;padding: 25px 30px;display: flex;justify-content: space-between;margin-bottom: 25px; background-color: #ffffff;box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);">
                                            <div class="col col-6" data-label="Job Id">Paslaugos pavadinimas</div>
                                            <div class="col col-6" data-label="Customer Name" style="text-align: right;"><?php echo $_SESSION['service']; ?></div>
                                        </li>
                                        <li class="table-row" style="border-radius: 3px;padding: 25px 30px;display: flex;justify-content: space-between;margin-bottom: 25px; background-color: #ffffff;box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);">
                                            <div class="col col-6" data-label="Job Id">Paslaugos teikimo trukm??</div>
                                            <div class="col col-6" data-label="Customer Name" style="text-align: right;"><?php echo $_SESSION['duration']; ?> minu??i??</div>
                                        </li>
                                        <li class="table-row" style="border-radius: 3px;padding: 25px 30px;display: flex;justify-content: space-between;margin-bottom: 25px; background-color: #ffffff;box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);">
                                            <div class="col col-6" data-label="Job Id">U??sakymo suma</div>
                                            <div class="col col-6" data-label="Customer Name" style="text-align: right;"><?php echo $_SESSION['price']; ?>???</div>
                                        </li>
                                    </ul>
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