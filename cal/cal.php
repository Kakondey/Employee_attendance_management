<?php
 include_once("dbConfig.php");
$month = date("F");
$vmonth = date("n");
$current_month = date("n"); //value will change if the user changes the month they are viewing
$current_year = date('Y');
$theday = date(w, mktime(0, 0, 0, $current_month, 1, $current_year));
$daysinmonth = date("t", mktime(0, 0, 0, $current_month, 1, $current_year));

echo "<table bgcolor=\"#C68282\" style=\"border: #990000 1px solid; font-size:8pt; font-family: Tahoma; color: #000000\" cellpadding=\"1\" cellspacing=\"0\" width=\"129\">";
echo "<tr>
<td colspan=7 align=center style=\"font-weight: bold;\">".date('F Y', mktime(0, 0, 0, $current_month, 1, $current_year))."</td>
</tr>";
echo "<tr style=\"background-color: 990000; color: white;\">";
echo "<td align=center>S</td>";
echo "<td align=center>M</td>";
echo "<td align=center>T</td>";
echo "<td align=center>W</td>";
echo "<td align=center>T</td>";
echo "<td align=center>F</td>";
echo "<td align=center>S</td>";
echo "</tr>";
echo "<tr>";
for ($i=0;$i<$theday;$i++)
{
   echo "<td>&nbsp;</td>";
}
$query = "SELECT title FROM events WHERE status = 1"; 
$result = mysql_query($query); 
$row = mysql_fetch_array($result);
for ($list_day=1;$list_day<=$daysinmonth;$list_day++)
{
    $event_day = date('j',$row['eventDate']);
  echo "<td align=\"center\">";
  if($list_day == $event_day) { 
    echo "<a href=\"#\" class=\"cal\">";
        echo $list_day . "<span class\"cal\"><div style=\"border-bottom: 1px solid #999999; padding: 2px; \">" . $month ."&nbsp;". $list_day .",&nbsp;". $current_year ." </div><div style=\"padding: 2px;\">" . $row['event'] ."</div></span></a></td>";
    } else { 
        echo $list_day;
    }
  if ($theday == 6)
  {
    echo "</tr>";
    echo "<tr>";
    $theday = -1;
  }
  $theday++;
}

?>