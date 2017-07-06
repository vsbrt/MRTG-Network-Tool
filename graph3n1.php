<?php

$devices = $_GET['selected'];#The number of multiple devices selected

$path = dirname(__FILE__);
$now = time();

$rrd = array("--slope-mode","--vertical-label=bits per second",
			 "--dynamic-labels",
	  		 "--color=BACK#CCCCCC",      
		    	 "--color=CANVAS#CCFFFF",    
		    	 "--color=SHADEB#9999CC",
                     "--start","-1h",
                     "--end",$now);


$sels =  explode(":",$devices);# Number of devices are exploded using :
#print_r($sels);
$x=1;
foreach($sels as $sel){
	$rrds =  explode("_",$sel);
	$rrdname = $rrds[0];
	$intfs = explode(",",$rrds[1]);
	foreach($intfs as $intf){
		$in = "dev".$x."input".$intf;#Multiple devices with the selected interfaces
		$out = "dev".$x."output".$intf;
		$color = str_pad( dechex( mt_rand(0,0xFFFFFF) ),6,'0',STR_PAD_LEFT);
                array_push($rrd,"DEF:$in=$rrdname.rrd:Input$intf:AVERAGE","LINE:$in#$color:INPUT$intf");
		$color = str_pad( dechex( mt_rand(0,0xFFFFFF) ),6,'0',STR_PAD_LEFT);
                array_push($rrd,"DEF:$out=$rrdname.rrd:Output$intf:AVERAGE","LINE:$out#$color:OUTPUT$intf");
	}
$x++;
}
	
$dth = rrd_graph("$path/combo.png",$rrd);

$graph = fopen("combo.png",'rb');

header("Content-Type: image/png\n");
header("Content-Transfer-Encoding: binary");

fpassthru($graph);
unlink("$path/combo.png");

?>

