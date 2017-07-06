<?php

$in = $_GET['INTERFACES'];
$device = $_GET['list'];

$interfaces = explode(',',$in);
#FOR AGGREGRTE 
$all = $_GET['all'];#Display the all interfaces that are selected when probing a device
$allints = explode(',',$all);


$path = dirname(__FILE__);
$now = time();
#$file = "$path/$device.rrd";
$ID=array();
for($i=0;$i<count($allints);$i++)
{
if($i==0)
{
$c="allinput"."$allints[$i]";#DEF.interface number
}
else
{
$c="allinput"."$allints[$i]".",+";
}
array_push($ID,$c);
}
$CDEF=join(',',$ID);
$OD=array();
for($i=0;$i<count($allints);$i++)
{
if($i==0)
{
$c="alloutput"."$allints[$i]";
}
else
{
$c="alloutput"."$allints[$i]".",+";
}
array_push($OD,$c);
}
$CD=join(',',$OD);

$rrd = array("--slope-mode","--vertical-label=bits per second",
                     "--start","-1h",
                     "--end",$now);

foreach($interfaces as $m){
                     $color = str_pad( dechex( mt_rand(0,0xFFFFFF) ),6,'0',STR_PAD_LEFT);
                     array_push($rrd,"DEF:input$m=$device.rrd:Input$m:AVERAGE","LINE:input$m#$color:INPUT$m");
                     $color = str_pad( dechex( mt_rand(0,0xFFFFFF) ),6,'0',STR_PAD_LEFT);
                     array_push($rrd,"DEF:output$m=$device.rrd:Output$m:AVERAGE","LINE:output$m#$color:OUTPUT$m");
}
foreach($allints as $ai){
     array_push($rrd,"DEF:allinput$ai=$device.rrd:Input$ai:AVERAGE","DEF:alloutput$ai=$device.rrd:Output$ai:AVERAGE");
}
		     $color = str_pad( dechex( mt_rand(0,0xFFFFFF) ),6,'0',STR_PAD_LEFT);
		     array_push($rrd,"CDEF:Input=$CDEF","LINE:Input#$color:Aggregate Input");
		     $color = str_pad( dechex( mt_rand(0,0xFFFFFF) ),6,'0',STR_PAD_LEFT);
		     array_push($rrd,"CDEF:Output=$CD","LINE:Output#$color:Aggregate Output");
			
$dth = rrd_graph("$path/$device.png",$rrd);

$graph = fopen("$device.png",'rb');

header("Content-Type: image/png\n");
header("Content-Transfer-Encoding: binary");

fpassthru($graph);
unlink("$path/$device.png");
?>

