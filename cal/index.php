<!DOCTYPE html>
<html>
<title>Admin Panel</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css.css">
<link type="text/css" rel="stylesheet" href="style.css"/>    
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
    <script src="jquery.min.js"></script>
<style>
h1,h2,h3,h4,h5,h6 {font-family: "Oswald"}
body {font-family: "Open Sans"}
</style>
      <script>
  $(function() {
    $( "#skills" ).autocomplete({
      source: 'search.php'
    });
  });
  </script> 
    <?php include_once('functions.php'); ?>
<body class="w3-light-grey">
<div class="w3-content" style="max-width:1600px">

  
  <!-- Image header -->
  <p><a href="../Admin/lists/Employee_attendance_list.php" ><input class="btn btn-primary btn-small" value="Back" type="submit" name="Back"></a></p>

  <!-- Grid -->
  <div class="w3-row w3-padding w3-border">

    <!-- Blog entries -->
    <div class="w3-col l12 s12">
    
      <!-- Blog entry -->
      <div class="w3-container w3-white w3-margin w3-padding-large">
          <br>
          <div id="calendar_div">
	<?php echo getCalender(); ?>
</div>

          
            
      </div>
      
    </div>

  </div>

</div>

</body>
</html>
















 
