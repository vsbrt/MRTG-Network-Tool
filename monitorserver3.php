<!DOCTYPE html>

<html>
        <head>
            <meta http-equiv="refresh" content="240" />
            <title> ASSIGNMENTS </title>                                
         
        </head>
        
        <body>
        <div class ="main">
        <table style = "width:1300px;" cell spacing = "0" cell padding = "0">
        <tr><td colspan ="5" style = "background-color:#1578F1;">        
        <h1><center> Performance Monitoring</center></h1>
        </td></tr>      
         
        <tr>
        <td colspan = "1"style="background-color:#B4E0F7;width:250px;vertical-align:top;">
           	<b><font size='5'>Lab-2</font></b><br>
                    <a href="monitor3.php"><h3>Monitor</h3></a> 
               	    <a href="add3.php"><h3>Add a Device</h3></a>
            	    <a href="delete3.php"><h3>Delete Device</h3></a>
            	    <a href="index.php"><h3> Home</h3></a>
            	    </td>
            	    	
        <td style="background-color:#eeeeee;height:600px;width:2000px;vertical-align:top;">
        <center><br>   
        
        <?php
        $array=array(parse_ini_file("../db.conf"));
$dbhost = $array[0]['IP'];
$port = $array[0]['Port'];
$data = $array[0]['DBname'];
$userid = $array[0]['Username'];
$pwd = $array[0]['Password'];
$path= dirname(__FILE__);
         
         // connection to database
        $database = mysql_connect($dbhost,$userid,$pwd)
         or die ("Unable to connect to the Database");
         
         $connect = mysql_select_db($data,$database)
         or die ("Database could not be selected");
         
         $ath = mysql_query("SELECT * FROM server");
         
         echo "<br><br> Select the device to be monitored<br><br>";
	echo "<form action=./graphserver3.php method='post'>";         
	echo "<table border ='1'>
               <tr><td></td><td> S.NO </td>
                   <td> IP </td>
                   <td> HTTP PORT </td></tr>";         
         $j=1;
         while($row = mysql_fetch_array($ath)):
         {
             $IP = $row[1]; $HTTP_PORT = $row[2];
             $ipport = "$IP-$HTTP_PORT";
             echo "<tr><td><input type = 'checkbox' name ='IPs[]' value = $ipport></td><td>" . "$j" . "</td><td><a href='graphserver3.php?IP=$IP&HTTPPORT=$HTTP_PORT'>" . "$IP" . "</td><td>". "$HTTP_PORT". "</td></tr>";
             $j++;                        
         }
         endwhile;
         echo "</table>";
	echo "<input type='submit' name='submit'>";
         echo "</form>";
         
         mysql_close($database);
         ?>   
        </table>
        </div>
        </body>
</html>        
