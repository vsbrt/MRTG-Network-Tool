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
        <form action="./addnetwork31.php" method="POST">
        <table border = 1 width = 500 align = center cell padding = 10>
        <tr><th Colspan = 2> Enter the device details </th></tr>
        <tr><td> IP </td><td><input type= "tinytext"name = "IP" aria-describedby="number-format" required aria-required="true"></td></tr>
        <tr><td> PORT </td><td><input type= "number" name = "PORT" aria-describedby="number-format" required aria-required="true"></td></tr>
        <tr><td> COMMUNITY </td><td><input type= "text"name = "COMMUNITY" aria-describedby="number-format" required aria-required="true"></td></tr>
        <tr></tr>
        <tr><td colspan = 2 align = "center"><input type = "submit" name = "formsubmit" value = "ADD"></td></tr></tr> 
        
        </table>    
        </table>
        </div>
        </body>
</html>        
