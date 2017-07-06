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
                    <a href="./monitor3.php"><h3>Monitor</h3></a> 
               	    <a href="./add3.php"><h3>Add a Device</h3></a>
            	    <a href="./delete3.php"><h3>Delete Device</h3></a>
            	    <a href="./index.php"><h3> Home</h3></a>
            	    </td>
            	    	
        <td style="background-color:#eeeeee;height:600px;width:2000px;vertical-align:top;">
        <center><br>
        <form action = "./addnetwork32.php" method = "POST">   
        <?php
        $IP = $_POST['IP'];
        $PORT = $_POST['PORT'];
        $COMMUNITY = $_POST['COMMUNITY'];
        $in = snmpwalk ("$IP:$PORT","$COMMUNITY",'1.3.6.1.2.1.2.2.1.1');#SNMPWALK for that particular IP and COmmunity
        
         echo "<table border ='1'>
               <tr><td> IP </td>
                   <td> PORT </td>
                   <td> COMMUNITY </td></tr>";
         
             
        echo "<tr><td>" . "$IP" . "</td><td>" . "$PORT" . "</td><td>" . "$COMMUNITY" . "</td></tr>";
         echo "</table>";
         echo "<br><br> Select the interfaces to be monitored";
         echo "<br><table border = '1'>";
#var_dump($in); 
        for($x=0;$x<count($in);$x++){
        $i = explode(' ',$in[$x]);
        echo "<tr><td><input type = 'checkbox' name ='interfaces[]' value = '$i[1],$COMMUNITY,$IP,$PORT'> $i[1]</td></tr>";
} #Probing for the Number of interfaces that are to be selected
         ?>
         </table>
         <input type = "submit" value = "ADD">
         </form>
        
        </table>
        </div>
        </body>
</html>        
