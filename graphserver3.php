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
        $IP = $_GET['IP'];
        $PORT = $_GET['HTTPPORT'];
       $IPx = $_POST['IPs']; 
        $arr = implode(",",$IPx);#Number of servers
	$n=1;
	foreach($IPx as $i){
		echo "Dev$n = $i <br>";
		$n++;
	}
	echo "<br>";
        $dev = "$IP-$PORT";
        echo "Graph for CPU Usage:";
        echo"<br><img src='graph3s.php?name=$arr&graph=CPU'/><br>";
        echo "Graph for Requests/sec:";
        echo"<br><img src='graph3s.php?name=$arr&graph=REQ_SEC'/><br>";        
        echo"Graph for Bytes/sec:";
        echo"<br><img src='graph3s.php?name=$arr&graph=BYTES_SEC'/><br>";
        echo"Graph for Bytes/req:";
        echo"<br><img src='graph3s.php?name=$arr&graph=BYTES_REQ'/><br>"; 
         ?>   
        </table>
        </div>
        </body>
</html>        
