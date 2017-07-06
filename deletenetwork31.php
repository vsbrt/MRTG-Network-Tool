
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
          
      $database = mysql_connect($dbhost,$userid,$pwd)
         or die ("Unable to connect to the Database");
         
         $connect = mysql_select_db($data,$database)
         or die ("Database could not be selected");
           
          $ID=$_GET['id'];
          $device = $_GET['device'];
          $bth=mysql_query("DELETE FROM netwrk WHERE id=$ID");
           
	  unlink ("$path/$device.rrd");
 	 
	 
 
          
          if(!$bth)
           {
            die ("ERROR: " . mysql_error());
           }
          else
           {
	    echo "<br><br>Device is deleted<br>";
           }
           
           mysql_close($database);
           
        ?>
            
        </br></td></center>    	    
        
        </table>
        </div>
        </body>
</html>        
