<?php

    session_start();
    if (!isset($_SESSION['Admin_name'])) {
        header("refresh:1; url= Admin_Signin.php");
    }
    else{
        error_reporting(0);
        include_once('../config/dbconnect.php');
    }

    if (isset($_POST['Calculate'])) {
        $E_id = $_POST['E_id'];
        $Year = $_POST['Year'];
        $Month = $_POST['Month'];
          //to get the weekend days.
          $workingDays = array();
          $weekEnds = array();
          $calendarType = CAL_GREGORIAN;

          $day_count = cal_days_in_month($calendarType, $Month, $Year);

          //for removing the weekends.
          for($i = 1;$i <= $day_count; $i++)
          {
            $dateFormat = $Year.'/'.$Month.'/'.$i;//format the date.
            $get_name = date('l', strtotime($dateFormat));
            $day_name = substr($get_name, 0, 3);

            //if not saturday and sunday add to array.
            if ($day_name != 'Sun') {
              $workingDays[] = "<br>".$i;
              $workingDaysXplod = implode(' ',$workingDays);
            }
            else
            {
              $weekEnds[] = "<br>".$i;
              $weekendXplod = implode(' ',$weekEnds);
            }

          }

        //Total number of Days Present.  
        $sqlAttendance = "SELECT * FROM attendance WHERE month(_date)='$Month' AND year(_date)='$Year' AND E_id='$E_id'";
        $queryAttendance=mysqli_query($conn,$sqlAttendance);
        $PresentDays=mysqli_num_rows($queryAttendance);

        //leave days count.
        $leaveDates = array();
        $sqlLeave = "SELECT * FROM employee_leave WHERE E_id='$E_id'";
        $queryLeave = mysqli_query($conn,$sqlLeave);
        if (mysqli_num_rows($queryLeave)>0) {
            while ($row=mysqli_fetch_object($queryLeave)){
                $Leave_from_date = $row->Leave_from_date;
                $Leave_to_date = $row->Leave_to_date;
                $Leave_type = $row->Leave_type;
                $Leave_reason = $row->Leave_reason;

                        //to count number of days between any two dates.
                $leaveDateDiff = strtotime($Leave_to_date) - strtotime($Leave_from_date);
                $leaveDays = floor($leaveDateDiff/(60*60*24)+1);

                $date_from = "$Leave_from_date";   
                $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
                  
                // Specify the end date. This date can be any English textual format  
                $date_to = "$Leave_to_date";  
                $date_to = strtotime($date_to); // Convert date to a UNIX timestamp

                    // Loop from the start date to end date and output all dates inbetween  
                for ($i=$date_from; $i<=$date_to; $i+=86400) {  
                    $leaveDates[] = date("Y-m-d", $i); 

                    
                }
 
            }}


        //Fetching the number of holidays.
        $holidayDates = array();
        $sqlHoliday = "SELECT * FROM holiday WHERE month(holiday_date_from)='$Month' AND year(holiday_date_from)='$Year' 
                      AND month(holiday_date_to)='$Month' AND year(holiday_date_to)='$Year'";
        $queryHoliday = mysqli_query($conn,$sqlHoliday);
        if (mysqli_num_rows($queryHoliday)>0) {
            while ($row=mysqli_fetch_object($queryHoliday)){
                $holiday_name = $row->holiday_name;
                $holiday_date_from = $row->holiday_date_from;
                $holiday_date_to = $row->holiday_date_to;
                $holiday_description = $row->holiday_description;
                $holidaysDateDiff = strtotime($holiday_date_to) - strtotime($holiday_date_from);
                $holidays = floor($holidaysDateDiff/(60*60*24)+1);

                $date_from = "$holiday_date_from";   
            $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
              
            // Specify the end date. This date can be any English textual format  
            $date_to = "$holiday_date_to";  
            $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
              
            // Loop from the start date to end date and output all dates inbetween  
            for ($i=$date_from; $i<=$date_to; $i+=86400) {  
                $holidayDates[] = date("Y-m-d", $i); 
                // $holidayDays = implode(' ',$holidayDates);
            }
             
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <link type="text/css" href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../Assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../Assets/bootstrap/css/theme.css" rel="stylesheet">
        <link type="text/css" href="../Assets/bootstrap/css/custom.css" rel="stylesheet">
        <link type="text/css" href="../Assets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='../Assets/http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top ">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="Dashboard.php">Employee Attendance Management</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Employee
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="forms/Add_new_Employee_attendance.php">Add Employee Attendance</a></li>
                                    <li><a href="lists/Employee_attendance_list.php">Attendance List</a></li>
                                </ul>
                            </li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Leave
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="forms/Add_leave_type.php">Add new Leave Type</a></li>
                                    <li><a href="forms/Add_employee_leave.php">Take Employee Leave</a></li>
                                    <li><a href="lists/Employee_leave_list.php">Employee Leave List</a></li>
                                </ul>
                            </li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Holiday
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="lists/Holiday_list.php">Holiday List</a></li>
                                    <li><a href="forms/Add_new_Holiday.php">Add Holiday</a></li>
                                </ul>
                            </li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $_SESSION['Admin_name']; ?>
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../config/logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span9">
                        <div class="content">
                        <div class="btn-controls">
                            <div class="btn-box-row row-fluid">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                                    <div class="form-group" style="display: block;">
                                        <label for="csvfile" class="control-label col-xs-2"><b>Click "Choose File" to upload the List of students</b></label>
                                    <div class="col-xs-3">
                                        <input type="file" class="form-control" name="csv" id="csv">
                                        <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                                    </div>
                                        <?php

                                            if (isset($_POST['upload'])) 
                                              {
                                                $file = $_FILES['csv'];
                                                  $file_name = basename($_FILES['csv']['name']);  
                                                  /*echo "File Name: ".$file_name;*/
                                                  if (move_uploaded_file($_FILES["csv"]["tmp_name"], $file_name)) {
                                                        /*echo "The file ".$file_name. " has been uploaded.";*/
                                                    } else {
                                                        echo "Sorry, there was an error uploading your file.";
                                                    }
                                                  $target_dir = "/";

                                                    /*$file = $file_name;*/
                                                    

                                                  // $sqlDelete = "TRUNCATE TABLE `attendance`";
                                                  // mysqli_query($conn,$sqlDelete);
                                                  $file = fopen($file_name, "r");
                                                  while (($emapData = fgetcsv($file, 11000, ",")) !== FALSE)
                                                    {

                                                        
                                                        /*if(mysqli_query($conn,$sqlDelete))*/
                                                            $sql = "INSERT into attendance(E_id, E_name, _date) values('$emapData[0]','$emapData[1]','$emapData[2]')";
                                                            mysqli_query($conn,$sql);
                                                        
                                                    }
                                                    fclose($file);
                                                    echo "CSV File has been successfully Imported.";
                                                }

                                        ?>
                                    </div>
                                </form>    
                            </div> 
                            </div>   
                        </div>
                        <br><hr><br>
                        <div class="content"> 
                        <div class="module">
                            <div class="module-head">
                                <center><h3>Calculate Details</h3></center>
                            </div>
                            <div class="module-body">
                                    <br/>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal row-fluid" >

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Employee ID</label>
                                            <div class="controls">
                                                <select name="E_id" class="span8">
                                                    <option selected="selected">--Select Employee ID--</option>
                                                    <?php
                                                        $queryL = "SELECT * FROM attendance";
                                                        $resultL = mysqli_query($conn,$queryL);
                                                        while($row=mysqli_fetch_assoc($resultL))
                                                        {
                                                            ?>
                                                            <option value="<?php echo $row['E_id']; ?>"><?php echo $row['E_id']; ?></option>
                                                            <?php
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Year">Enter Year</label>
                                                <div class="controls">
                                                    <input type="text" id="Year" name="Year" class="span8" required>
                                                </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Month">Enter Month</label>
                                                <div class="controls">
                                                    <select name="Month" class="span8">
                                                        <option selected="selected">--Select Month--</option>
                                                        <option>01</option>
                                                        <option>02</option>
                                                        <option>03</option>
                                                        <option>04</option>
                                                        <option>05</option>
                                                        <option>06</option>
                                                        <option>07</option>
                                                        <option>08</option>
                                                        <option>09</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                </select>
                                                </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button name="Calculate" type="submit" class="btn btn-primary btn-xl">Calculate</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                        <!--/.content-->
                    <div class="content"> 
                        <div class="module">
                            <div class="module-head">
                                <center><h3>Add Holiday Details</h3></center>
                            </div>
                            <div class="module-body">
                                    <br />
                                        <div class="control-group">
                                            <label class="control-label" for="Total_month_days">Total Days in The Month : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $day_count; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Total_weekend_days">Total Number of Weekend Days(SUNDAY) : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo count($weekEnds); ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Total_days_holiday">Total Number of Holidays : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo count($holidayDates); ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Total_days_Present">Total Number of Days Present : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo $PresentDays; ?></p>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Total_days_leave">Total Number of Days on Leave : </label>
                                            <div class="controls">
                                                <p style="margin-top: 5px;"><?php echo count($leaveDates); ?></p>
                                            </div>
                                        </div>

                            </div>
                        </div>
                    </div>
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <script src="../Assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../Assets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../Assets/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="../Assets/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="../Assets/scripts/common.js" type="text/javascript"></script>

    </body>
