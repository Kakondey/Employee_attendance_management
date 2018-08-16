<?php
/*
 * Function requested by Ajax
 */
$e_id_post = "0"; 
if(isset($_POST['func']) && !empty($_POST['func'])){
	$e_id_post = $_POST['E_id'];
	switch($_POST['func']){
		case 'getCalender':
			getCalender($_POST['year'],$_POST['month'],$e_id_post);
			break;
		case 'getEvents':
			getEvents($_POST['date']);
			break;
		default:
			break;
	}
}

/*
 * Get calendar full HTML
 */
function getCalender($year = '',$month = '',$id_post='')
{
	$dateYear = ($year != '')?$year:date("Y");
	$dateMonth = ($month != '')?$month:date("m");
	$date = $dateYear.'-'.$dateMonth.'-01';
	$currentMonthFirstDay = date("N",strtotime($date));
	//echo 'BINA '.$currentMonthFirstDay;
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
?>
	<div id="calender_section">
		<h2>
			<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>', <?php if(isset($_GET['E_id'])) echo $_GET['E_id']; else if(isset($_POST['E_id'])) echo $_POST['E_id']; ?>);">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown" ><?php echo getAllMonths($dateMonth); ?></select>
			<select name="year_dropdown" class="year_dropdown dropdown" ><?php echo getYearList($dateYear); ?></select>
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>', <?php if(isset($_GET['E_id'])) echo $_GET['E_id']; else if(isset($_POST['E_id'])) echo $_POST['E_id']; ?>);">&gt;&gt;</a>
        </h2>
		<div id="event_list" class="none"></div>
		<div id="calender_section_top">
			<ul>
				<li>Sun</li>
				<li>Mon</li>
				<li>Tue</li>
				<li>Wed</li>
				<li>Thu</li>
				<li>Fri</li>
				<li>Sat</li>
			</ul>
		</div>
		<div id="calender_section_bot">
			<ul>
			<?php 
				$dayCount = 1; 
				for($cb=1;$cb<=$boxDisplay;$cb++){
					if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
						//Current date
						$currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;
						
						$eventNum = 0;
						//Include db configuration file
						error_reporting(0);
						include '../config/dbconnect.php';
						
					    $result = null;
						if($id_post=='')
							$result = $conn->query("SELECT * FROM attendance WHERE E_id = '{$_GET['E_id']}' && _date = '".$currentDate."'");
						else
							$result = $conn->query("SELECT * FROM attendance WHERE E_id = ".$id_post." && _date = '".$currentDate."'");						
					    $row = mysqli_fetch_object($result);
						// $result = $conn->query("SELECT _date FROM attendance WHERE _date = '".$currentDate."' AND E_id = '{$_GET['E_id']}'");
						 $eventNum = $result->num_rows;
						// echo "DATA: ".mysqli_num_rows($result);
						//Define date cell color
						if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
							echo '<li date="'.$currentDate.'" class="grey date_cell">';
						}elseif(mysqli_num_rows($result)>0){
							echo '<li date="'.$currentDate.'"  class="light_sky date_cell">';	
						}else{
							echo '<li date="'.$currentDate.'" class="date_cell">';
						}
						//Date cell
						echo '<span>';
						echo $dayCount;
						echo '</span>';
						
						//Hover event popup
						echo '<div style="margin-left:35px; margin-top:115px;" id="date_popup_'.$currentDate.'" class="date_popup_wrap none">';
						echo '<div class="date_window">';
						echo ($eventNum > 0)?'<a style="text-size:1px;" href="javascript:;" onclick="getEvents(\''.$currentDate.'\');">PRESENT</a>':'';
						echo '</div></div>';
						
						echo '</li>';
						$dayCount++;
			?>
			<?php }else{ ?>
				<li><span>&nbsp;</span></li>
			<?php } } ?>
			</ul>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script> 
	<script type="text/javascript">		
		function getParameterByName(name) {
			name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
			var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			results = regex.exec(location.search);
			return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
		}		
		function getCalendar(target_div,year,month,e_id){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data: {func:'getCalender',year:year,month:month,E_id:e_id},
				success:function(html){		
					$('#'+target_div).html(html);
				}
			});
		}
		
		function getEvents(date){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:{func:'getEvents',date:date,E_id:getParameterByName('E_id')},
				success:function(html){
					$('#event_list').html(html);
					$('#event_list').slideDown('slow');
				}
			});
		}
		
		function addEvent(date){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:'func=addEvent&date='+date,
				success:function(html){
					$('#event_list').html(html);
					$('#event_list').slideDown('slow');
				}
			});
		}
		
		$(document).ready(function(){
			$('.date_cell').mouseenter(function(){
				date = $(this).attr('date');
				$(".date_popup_wrap").fadeOut();
				$("#date_popup_"+date).fadeIn();	
			});
			$('.date_cell').mouseleave(function(){
				$(".date_popup_wrap").fadeOut();		
			});
			$('.month_dropdown').on('change',function(){	
				alert(getParameterByName('E_id'));	
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val(),getParameterByName('E_id'));
			});
			$('.year_dropdown').on('change',function(){
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val(),getParameterByName('E_id'));
			});
			$(document).click(function(){
				$('#event_list').slideUp('slow');
			});
		});
	</script>
<?php
}

/*
 * Get months options list.
 */
function getAllMonths($selected = ''){
	$options = '';
	for($i=1;$i<=12;$i++)
	{
		$value = ($i < 10)?'0'.$i:$i;
		$selectedOpt = ($value == $selected)?'selected':'';
		$options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
	}
	return $options;
}

/*
 * Get years options list.
 */
function getYearList($selected = ''){
	$options = '';
	for($i=2015;$i<=2025;$i++)
	{
		$selectedOpt = ($i == $selected)?'selected':'';
		$options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
	}
	return $options;
}

/*
 * Get events by date
 */
function getEvents($date = ''){
	//Include db configuration file
	include '../config/dbconnect.php';
	$eventListHTML = '';
	$date = $date?$date:date("Y-m-d");
	//Get events based on the current date
	$result = $conn->query("SELECT * FROM attendance WHERE E_id = ".$_POST['E_id']." && _date = '".$_POST['date']."'");
	if(mysqli_num_rows($result)>0){
		$eventListHTML = '<h2>Employee ID : '.$_POST['E_id'].' ,Present on '.date("l, d M Y",strtotime($date)).' </h2>';
		$eventListHTML .= '<ul>';
		// while($row = $result->fetch_assoc()){ 
  //           $eventListHTML .= '<li>'.$row['title'].'</li>';
  //       }
		$eventListHTML .= '</ul>';
	}
	echo $eventListHTML;
}
?>