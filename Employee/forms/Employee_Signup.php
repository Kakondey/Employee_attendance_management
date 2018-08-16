
<?php

    include_once('../../config/dbconnect.php');

    $Employee_name = "";
        $EmployeePhoneNo = "";
        $Employee_Email = "";
        $Employee_Address = "";
        $password = "";

    if (isset($_POST['Register'])) {
        $Employee_name = $_POST['Employee_name'];
        $EmployeePhoneNo = $_POST['EmployeePhoneNo'];
        $Employee_Email = $_POST['Employee_Email'];
        $Employee_Address = $_POST['Employee_Address'];
        $password = $_POST['password'];
    

        $sql = "INSERT INTO employee(Employee_name, Employee_contactNo, Employee_email,    Employee_address, Employee_password) VALUES ('$Employee_name','$EmployeePhoneNo','$Employee_Email','$Employee_Address','$password')";    

        if (mysqli_query($conn, $sql)) 
        {
            $successmsz = 'You are successfully registered. Press here to login.';
            header("refresh:1; url=../Employee_Signin.php");
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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signup Form</title>
        <link type="text/css" href="../../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/theme.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/css/custom.css" rel="stylesheet">
        <link type="text/css" href="../../Assets/bootstrap/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        <script src="../../Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>

                <a class="brand" href="#">
                    Employee Management System
                </a>

                <div class="nav-collapse collapse navbar-inverse-collapse">
                
                    <ul class="nav pull-right">

                        <li><a href="../../home.php">
                            Home
                        </a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->

            <div class="wrapper">
                <div class="row">
                <div class="span9" style="margin-top: 50px; margin-left: 200px;">
                    <div class="content">

                        <div class="module" >
                            <div class="module-head">
                                <h3 style="text-align: center;">Employee signup</h3>
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
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <a href="../../../../../../signin.php"><?php echo $notice; ?><a/></div>
                                              <?php
                                            }
                                       ?>
                                    <br />

                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal row-fluid" >

                                        <div class="control-group">
                                            <label class="control-label" for="Employee_name">Your Name</label>
                                            <div class="controls">
                                                <input type="text" id="Employee_name" name="Employee_name" placeholder="eg: Your name" class="span8"><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="phone_number">Phone number</label>
                                            <div class="controls">
                                                <input type="number" id="phone_number"
                                                name="EmployeePhoneNo" placeholder="Phone number" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                                <input type="text"
                                                name="Employee_Email" id="email" placeholder="kiko8797@gmail.com" class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="address">Address</label>
                                            <div class="controls">
                                                <textarea id="address" name="Employee_Address" class="span8" rows="5" required></textarea><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="password">Password</label>
                                            <div class="controls">
                                                <input type="password" id="password"
                                                name="password"  class="span8" required><br><br>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button name="Register" type="submit" class="btn btn-primary btn-xl" onclick="checkFields()">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!--/.content-->
                    </div><!--/.span9-->
                </div>
            </div>
</body>
