<?php

    session_start();
    if (!isset($_SESSION['Admin_name'])) {
        header("location: Admin_Signin.php");
    }
    else{
        include_once('../../config/dbconnect.php');
    }

        $holiday_name = "";
        $holiday_date_from = "";
        $holiday_date_to = "";
        $holiday_description = "";

    if (isset($_POST['Add'])) {
        $holiday_name = $_POST['holiday_name'];
        $holiday_date_from = $_POST['holiday_date_from'];
        $holiday_date_to = $_POST['holiday_date_to'];
        $holiday_description = $_POST['holiday_description'];

        $sql = "INSERT INTO holiday(holiday_name, holiday_date_from, holiday_date_to, holiday_description)
                 VALUES ('$holiday_name','$holiday_date_from','$holiday_date_to','$holiday_description')";    

        if (mysqli_query($conn, $sql)) 
        {
            $successmsz = 'Holiday is successfully Entered.';
            header('refresh:1; url=Add_new_Holiday.php');
        }
        else
        {
            $errormsz = mysqli_error($conn);
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
        <link type="text/css" href="../../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/theme.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/custom.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='../../Assets/http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="../Dashboard.php">Employee Attendance Management</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Employee
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="Add_new_Employee_attendance.php">Add Employee Attendance</a></li>
                                    <li><a href="../lists/Employee_attendance_list.php">Attendance List</a></li>
                                </ul>
                            </li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Leave
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="Add_leave_type.php">Add new Leave Type</a></li>
                                    <li><a href="Add_employee_leave.php">Take Employee Leave</a></li>
                                    <li><a href="../lists/Employee_leave_list.php">Employee Leave List</a></li>
                                </ul>
                            </li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Holiday
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../lists/Holiday_list.php">Holiday List</a></li>
                                    <li><a href="Add_new_Holiday.php">Add Holiday</a></li>
                                </ul>
                            </li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $_SESSION['Admin_name']; ?>
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../../config/logout.php">Logout</a></li>
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
                        <div class="module">
                            <div class="module-head">
                                <center><h3>Add Holiday Details</h3></center>
                            </div>
                            <div class="module-body">

                                    <?php
                                            if(isset($successmsz))
                                            {
                                              ?>
                                              <div class="alert alert-success"><?php echo $successmsz; ?>
                                              </div>
                                              <?php
                                            }
                                       ?>

                                    <br />

                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal row-fluid" >

                                        <div class="control-group">
                                            <label class="control-label" for="holiday_name">Holiday Name</label>
                                            <div class="controls">
                                                <input type="text" id="holiday_name" name="holiday_name" class="span8"><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="holiday_date_from">Holiday Date From</label>
                                            <div class="controls">
                                                <input type="date" id="holiday_date_from"
                                                name="holiday_date_from" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="holiday_date_to">Holiday Date To</label>
                                            <div class="controls">
                                                <input type="date" id="holiday_date_to"
                                                name="holiday_date_to" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="holiday_description">Holiday Description</label>
                                            <div class="controls">
                                                <textarea cols="30" rows="5" name="holiday_description" class="span8"></textarea><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button name="Add" type="submit" class="btn btn-primary btn-xl">Add</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                </div>
                </div><!--/.span9-->
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <script src="../../Assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../../Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/common.js" type="text/javascript"></script>

    </body>
