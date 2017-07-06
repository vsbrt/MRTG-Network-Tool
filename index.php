<!DOCTYPE html>

<html>
        <head>
            <meta http-equiv="refresh" content="240" />
            <title> Assignment-2 </title>                                
         
        </head>
        
        <body>
        <div class ="main">
        <table style = "width:1300px;" cell spacing = "0" cell padding = "0">
        <tr><td colspan ="5" style = "background-color:#1578F1;">        
        <h1><center> Assignment-2</center></h1>
        </td></tr>      
         
        <tr>
        <td colspan = "1"style="background-color:#B4E0F7;width:250px;vertical-align:top;">
           	<b><font size='5'>Lab-2</font></b><br>
            	    <a href="monitor3.php"><h3>Monitor</h3></a> 
               	    <a href="add3.php"><h3>Add a Device</h3></a>
            	    <a href="delete3.php"><h3>Delete Device</h3></a>
            	    <a href="index.php"><h3> Home </h3></a>
            	    </td>
            	    	
        
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
//Creating Table 
$ath=mysql_query("CREATE TABLE IF NOT EXISTS `netwrk` (`id` int (11) NOT NULL AUTO_INCREMENT,`IP` tinytext NOT NULL,`PORT` int (11) NOT NULL,`COMMUNITY` tinytext NOT NULL, `INTERFACES` tinytext NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1"); 


$bth=mysql_query("CREATE TABLE IF NOT EXISTS `server`(`id` int(11) NOT NULL AUTO_INCREMENT,`IP` tinytext NOT NULL,`HTTP_PORT` int(11) NOT NULL, PRIMARY KEY (`id`) )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");            
       
?>
 </table>
        </div>
        </body>
</html>        
