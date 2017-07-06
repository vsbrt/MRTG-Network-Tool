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
	
	
        if($_POST['select_count'])
        {
         $count = $_POST['select_count'];
	#foreach ($count as $f)    
	$seldev = array();     
	for($f=1;$f<$count;$f++)
         {
          $i = $_POST["device$f"];
          $dev = $_POST["dev$f"];
          $n = implode(',',$i);
          echo "<br>$dev<br>$n";
	array_push($seldev, $dev."_".$n);#For monitoring multiple devices
	$all = $_POST["allinterfaces$f"];   #ALL the interface numbers
          echo"<br><img src='graph3n.php?INTERFACES=$n&list=$dev&all=$all'/><br>";
	}

	$fp=implode(":",$seldev);

	echo "<br><br> Combined graph";

	echo"<br><img src='graph3n1.php?selected=$fp'/><br>";
         }
?>   
        </table>
        </div>
        </body>
</html>        
