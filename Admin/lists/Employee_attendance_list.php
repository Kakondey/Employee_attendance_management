<?php

    session_start();
    if (!isset($_SESSION['Admin_name'])) {
        header("refresh:1; url= Admin_Signin.php");
    }
    else{
        error_reporting(0);
        include_once('../../config/dbconnect.php');
    }

    //deleting a row.
    // if (isset($_GET['delete'])) {
    //     $sql = "DELETE FROM attendance WHERE E_id='{$_GET['E_id']}' AND _date='{$_GET['_date']}'";
    //     $dQuery = mysqli_query($conn,$sql);
    //     if ($dQuery) {
    //         header('Refresh:1; question_list.php');
    //     }
    // }

    $Employee = $_POST['Employee'];
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
        <div class="navbar navbar-fixed-top ">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="../Dashboard.php">Dashboard</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">                           
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Employee
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../forms/Add_new_Employee_attendance.php">Add Employee Attendance</a></li>
                                    <li><a href="Employee_attendance_list.php">Attendance List</a></li>
                                </ul>
                            </li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Leave
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../forms/Add_leave_type.php">Add new Leave Type</a></li>
                                    <li><a href="../forms/Add_employee_leave.php">Take Employee Leave</a></li>
                                    <li><a href="Employee_leave_list.php">Employee Leave List</a></li>
                                </ul>
                            </li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Holiday
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="Holiday_list.php">Holiday List</a></li>
                                    <li><a href="../forms/Add_new_Holiday.php">Add Holiday</a></li>
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
                    <div class="span3">
                        <div class="sidebar">
                            <div class="controls">
                                            <form  method="post" action="Employee_attendance_list.php" id="exam_form" class="form-horizontal row-fluid">
                                                <p style="color: white; font-weight: bold;">Select Employee :</p>
                                                <select name="Employee" class="span8">
                                                    <option selected="selected">--Select Employee--</option>
                                                    <?php
                                                        $queryS = "SELECT DISTINCT E_name FROM attendance";
                                                        $resultS = mysqli_query($conn,$queryS);
                                                        while($rowS=mysqli_fetch_assoc($resultS))
                                                        {
                                                            ?>
                                                            <option value="<?php echo $rowS['E_name']; ?>"><?php echo $rowS['E_name']; ?></option>
                                                            <?php
                                                        } 
                                                    ?>
                                                </select>
                                                <br><br>

                                                        <button name="check" type="submit" class="btn btn-primary btn-xl">check</button><br><br>
                                            </form>                                        
                            </div>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9"  style=" width: 1000px;">
                    <div class="content">
                        <h3><p>Employee Name : <?php echo $Employee; ?></p></h3>                
                        <div class="module">
                            <div class="module-head">
                                <h3>Employee Attendance List</h3>
                            </div>
                            <div class="module-body table">
                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sql="SELECT * FROM `attendance` WHERE E_name = '$Employee'";
                                        $query=mysqli_query($conn,$sql);

                                        if (mysqli_num_rows($query)>0) {
                                            while ($row=mysqli_fetch_object($query)) {
                                                ?>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td><?php echo $row->_date; ?></td>
                                                <td><a href="../../cal/index.php?Check=1&_date=<?php echo $row->_date; ?>&E_id=<?php echo $row->E_id; ?>" ><input class="btn btn-primary btn-small" value="Check" type="submit" name="Check"></a></td>
                                            </tr>
                                        </tbody>
                                        <?php
                                            }
                                        }
                                    ?>
                                    
                                    <tfoot>
                                        <tr>
                                            <th>Date</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!--/.module-->

                        
                        
                    </div><!--/.content-->
                </div><!--/.span9-->
                    </div>
                    <!--/.span9-->
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
