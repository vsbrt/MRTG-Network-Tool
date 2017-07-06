<?php


$dev = explode(",",$_GET['name']);
$def = $_GET['graph'];

$path = dirname(__FILE__);
$now = time();

$rrd = array("--slope-mode",
                     "--start","-1h","--vertical-label", "$def",
                     "--end",$now);
$n=1;
foreach($dev as $devx){
$color = str_pad( dechex( mt_rand(0,0xFFFFFF) ),6,'0',STR_PAD_LEFT);
                     array_push($rrd,"DEF:".$def.$n."=$devx.rrd:$def:AVERAGE",
                     "LINE:".$def.$n."#$color:Dev$n"."$def");
$n++;
}
$bth = rrd_graph("$path/graph$def.png",$rrd);                    
$graph1 = fopen("graph$def.png",'rb');
header("Content-Type: image/png\n");
header("Content-Transfer-Encoding: binary");

fpassthru($graph1);
unlink("$path/graph$def.png");            
?>                
