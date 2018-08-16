<?php

    session_start();
    if (!isset($_SESSION['Admin_name'])) {
        header("location: Admin_Signin.php");
    }
    else{
        include_once('../../config/dbconnect.php');
    }
        $E_id = "";
        $Leave_from_date = "";
        $Leave_to_date = "";
        $Leave_type = "";
        $Leave_reason = "";

    if (isset($_POST['Update'])) {
        $E_id = $_POST['E_id'];
        $Leave_from_date = $_POST['Leave_from_date'];
        $Leave_to_date = $_POST['Leave_to_date'];
        $Leave_type = $_POST['Leave_type'];
        $Leave_reason = $_POST['Leave_reason'];
    
        $sqlu = "UPDATE employee_leave 
                SET Leave_from_date='$_POST[Leave_from_date]',Leave_to_date='$_POST[Leave_to_date]',
                Leave_type='$_POST[Leave_type]',Leave_reason='$_POST[Leave_reason]'  
                WHERE E_id='$_POST[E_id]'";

        if (mysqli_query($conn, $sqlu)) 
        {
            $successmsz = 'Employee Leave Successfully Updated.';
            header('Refresh:1; ../lists/Employee_leave_list.php');
        }
        else
        {
            $errormsz = mysqli_error($conn);
        }

    }

    if (isset($_GET['edit'])) {
        $sqlE = "SELECT * FROM employee_leave WHERE E_id='{$_GET['E_id']}'";
        $eQuery = mysqli_query($conn,$sqlE);
        $row = mysqli_fetch_object($eQuery);

        $E_id = $row->E_id;
        $Leave_from_date = $row->Leave_from_date;
        $Leave_to_date = $row->Leave_to_date;
        $Leave_type = $row->Leave_type;
        $Leave_reason = $row->Leave_reason;

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
                                <center><h3>Edit Employee Leave Details</h3></center>
                            </div>
                            <div class="module-body">

                                    <?php
                                            if(isset($successmsz))
                                            {
                                              ?>
                                              <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <a href="signin.php"><?php echo $successmsz; ?><a/> 
                                              </div>
                                              <?php
                                            }
                                            else if (isset($errormsz))
                                            {
                                            ?>
                                              <div class="alert alert-error">
                                                <?php echo $errormsz; ?></div>
                                              <?php
                                            }
                                       ?>

                                    <br />

                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal row-fluid" >

                                            <input type="hidden" id="E_id" value="<?php echo $E_id; ?>" name="E_id" class="span8"><br><br>
                                            
                                        

                                        <div class="control-group">
                                            <label class="control-label" for="Leave_from_date">Leave from date</label>
                                            <div class="controls">
                                                <input type="date" id="Leave_from_date" value="<?php echo $Leave_from_date; ?>" name="Leave_from_date" class="span8"><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Leave_to_date">Leave to date</label>
                                            <div class="controls">
                                                <input type="date" id="Leave_to_date"
                                                name="Leave_to_date" value="<?php echo $Leave_to_date; ?>" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Leave_type">Leave type</label>
                                            <div class="controls">
                                                <input type="text" id="Leave_type"
                                                name="Leave_type" value="<?php echo $Leave_type; ?>" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Leave_reason" >Leave reason</label>
                                            <div class="controls"><input type="text" id="Leave_reason"
                                                name="Leave_reason" value="<?php echo $Leave_reason; ?>" class="span8" required>
                                                <br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button name="Update" type="submit" class="btn btn-primary btn-xl">Update</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        
                        
                    </div><!--/.content-->
                </div><!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <script src="../../Assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../../Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="../../Assets/scripts/common.js" type="text/javascript"></script>

    </body>
