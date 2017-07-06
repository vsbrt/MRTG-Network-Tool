#!usr/bin/perl

use DBI;
use RRD::Simple();
use Net::SNMP;
use Config::IniFiles;
use Data::Dumper;
use FindBin '$Bin';
my $cfg = Config::IniFiles->new(-file =>"$Bin/../db.conf");
my $driver= "mysql";
my $ip_data= $cfg->val( 'ip_data', 'IP');
my $database= $cfg->val( 'Database', 'DBname');
my $port = $cfg->val( 'ip_data', 'Port');
my $dsn= "DBI:$driver:database=$database;host=$ip_data;port=$port";
my $directory=$cfg->val('ip_data', 'ServerDirectory');
my $device=$cfg->val('Database', 'Tablename');
my $userid= $cfg->val('Database', 'Username');
my $password= $cfg->val('Database', 'Password');

# invoke the ConnectToMySQL sub-routine to make the database connection
my $dbh = DBI->connect($dsn, $userid, $password ) or die $DBI::errstr;
#while(1){
my $sth = $dbh->prepare("SELECT * FROM `server` ");
$sth->execute() or die $DBI::errstr;
while( my @row = $sth->fetchrow_array())
{ 
 my $id = $row[0];
 my $IP = $row[1];
 my $HTTP_PORT = $row[2];
 print "$IP:$HTTP_PORT\n";
   $HTTP = HTTP($IP,$HTTP_PORT);
   @fth = split(',',$HTTP);
print "Values: $HTTP\n";
   # RRD creation
    if (!-e "$Bin/$IP-$HTTP_PORT.rrd")
     {
      my $rrd = RRD::Simple -> new (file => "$Bin/$IP-$HTTP_PORT.rrd");
 
      $rrd -> create("$Bin/$IP-$HTTP_PORT.rrd",
                CPU => "GAUGE",
                REQ_SEC => "GAUGE",
                BYTES_SEC => "GAUGE",
                BYTES_REQ => "GAUGE");
    }

    #Updating rrd
    my $rrd = RRD::Simple -> new(file => "$Bin/$IP-$HTTP_PORT.rrd");
    $rrd -> update("$Bin/$IP-$HTTP_PORT.rrd",
                 CPU => $fth[0],
                 REQ_SEC => $fth[1],
                 BYTES_SEC => $fth[2],
                 BYTES_REQ => $fth[3]);
              
    }
   
   

#print Dumper(@fth);       

snmp_dispatcher(); 

#sleep(60);
#}     
#--- start sub-routine ------------------------------------------------
sub HTTP()
{
 my ($IP,$HTTP_PORT) =@_;
system("curl http://$IP:$HTTP_PORT/server-status?auto > $Bin/retrieve.txt");
open(FILE,"<$Bin/retrieve.txt");
while (my $row = <FILE>)
{
$cpu = $1 if($row=~m/CPULoad:\s(\d*.+)/g);
$up = $1 if($row=~m/Uptime:\s(\d*.\d+)/g);
$CPU_USAGE=$cpu*$up/100;
$REQUESTS_SEC = $1 if($row=~m/ReqPerSec:\s(\d*.\d+)/g);
$BYTES_SEC = $1 if($row=~m/BytesPerSec:\s(\d*.\d+)/g);
$BYTES_REQUEST = $1 if($row=~m/BytesPerReq:\s(\d*.\d+)/g);
   
 }
$HTTP = "$CPU_USAGE,$REQUESTS_SEC,$BYTES_SEC,$BYTES_REQUEST";
 return $HTTP; 
 }
