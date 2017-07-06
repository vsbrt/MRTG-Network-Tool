
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

       
            $IP = $_POST['IP'];
            $PORT = $_POST['HTTP_PORT'];
         
         // connection to database
        $database = mysql_connect($dbhost,$userid,$pwd)
         or die ("Unable to connect to the Database");
         
         $connect = mysql_select_db($data,$database)
         or die ("Database could not be selected");
         
         
         $ath = mysql_query("SELECT * FROM `server`");
         
         while($row = mysql_fetch_array($ath)):
          {
            if($IP==$row['IP'] && $PORT==$row['HTTP_PORT'])
             {
               echo "<br><br>It cannot be addded since device with same details already exists";
               $i=1;
             }
         }
         endwhile;
         mysql_close($database);
         
         if($i!=1)
          {
            $database = mysql_connect($dbhost,$userid,$pwd)
         or die ("Unable to connect to the Database");
         
         $connect = mysql_select_db($data,$database)
         or die ("Database could not be selected");
         
         
         $bth = "INSERT INTO server (IP,HTTP_PORT) VALUES('$IP','$PORT')";
         
              if(!mysql_query($bth))
               {
                die ("ERROR: " . mysql_error() );
               }
              echo "<br><br> New HTTP device data has been added to the database"; 
         
              mysql_close($database);
          }
         
         
        ?>
        
        </table>
        </div>
        </body>
</html>        
