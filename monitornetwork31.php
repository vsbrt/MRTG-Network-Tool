
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
        <center><br><br> Select the interfaces to be monitored   
        <form action = "graphnetwork3.php" method = "POST">
        <?php
        #include "db.php";
$array=array(parse_ini_file("../db.conf"));
$dbhost = $array[0]['IP'];
$port = $array[0]['Port'];
$data = $array[0]['DBname'];
$userid = $array[0]['Username'];
$pwd = $array[0]['Password'];
$path= dirname(__FILE__);  
         // connection to database
         
         $c = $_POST['community'];
          $in = array();
          $z = 1;      
          foreach($c as $COMMUNITY){
           // connection to database
            $database = mysql_connect($dbhost,$userid,$pwd)
         or die ("Unable to connect to the Database");
         
         $connect = mysql_select_db($data,$database)
         or die ("Database could not be selected");
         
          $ath = mysql_query("SELECT *FROM netwrk WHERE COMMUNITY = '$COMMUNITY'");
          
          echo "<br><table border ='1'>
               <tr><td> IP </td>
                   <td> PORT </td>
                   <td> COMMUNITY </td></tr>";         
         
         while($row = mysql_fetch_array($ath)):
         {
             $ID = $row[0]; $IP = $row[1]; $PORT = $row[2]; $COMMUNITY = $row[3]; $INTERFACES= $row[4];
             
             echo "<tr><td>" . "$IP" . "</td><td>" . "$PORT" . "</td><td>" . "$COMMUNITY" . "</td></tr>";                          
         }
         endwhile;
         echo "</table>";
         $in = array();
         $i = explode(",",$INTERFACES);# Number of interfaces selected
         echo "<br>Interfaces of $COMMUNITY are: ";
         echo "<br><table border = '1'><tr>";
         array_push($in,$IP,$COMMUNITY,$PORT);
         $n=implode('-',$in);
         //echo "<td>";
         //print_r($in);
         //echo"</td>";
         for ($y = 0; $y<count($i);$y++)
         {
            $a = "$i[$y]";
            //print_r($in);
            ?>
       <td><input type = 'checkbox' name="device<?php echo $z;?>[]" value = "<?php echo $a ;?>"><?php echo $i[$y];?></td>
       <input type='hidden' name="dev<?php echo $z;?>" value="<?php echo $n;?>">
		<input type='hidden' name="allinterfaces<?php echo $z;?>" value="<?php echo $INTERFACES?>">
	<?php
         }    
     
         echo "</table>";     
         mysql_close($database);
         $z++;
         }
                 
         ?>
        <input type='hidden' name='select_count' value="<?php echo $z;?>">
        <input type = "submit" value = "Monitor">
        </table>
        </div>
        </body>
</html>        
