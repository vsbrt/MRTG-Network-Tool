#!/usr/bin/perl -w
use FindBin '$Bin';

while(1)
{
$start_time = time();
system ("perl $Bin/backend_network.pl");

system ("perl $Bin/backend_server.pl");
$end_time = time();
$difference = $end_time - $start_time;
sleep(60 - $difference);

}
