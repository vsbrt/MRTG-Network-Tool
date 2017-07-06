#!/usr/bin/perl 

use DBI;
use DBD::mysql;
use Net::SNMP;
use RRD::Simple();
use Data::Dumper;
use Config::IniFiles;
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
my $sth = $dbh->prepare("SELECT * FROM `netwrk` ");
$sth->execute() or die $DBI::errstr;
               
 $InOctets = '1.3.6.1.2.1.2.2.1.10';
 $OutOctets = '1.3.6.1.2.1.2.2.1.16';
my %Values; 
my @net;

while ( my @row = $sth-> fetchrow_array() )
{
 
 

 my $IP = $row[1];
 my $PORT = $row[2];
 my $COMMUNITY = $row[3];
 my $INTERFACES = $row[4];
 my @interface = split(',',$INTERFACES);
 my $inter = $interface[$#interface];
 my $oid = @interface; 
 print "The interface i see are $inter\n";
 print "The oids mentioned are $oid\n";
 print "$IP:$PORT:$COMMUNITY:$INTERFACES\n"; 
                  
          #----------Creating a session-------
          my ($session,$error) = Net::SNMP -> session(
                                   -hostname => $IP,
                                   -port => $PORT,
                                   -community => $COMMUNITY,
                                   -timeout => 1,
                                   -retries => 0,
                                   -nonblocking => 0x1 );
     
          if(!defined($session))
            {
              print "Session not created for $IP \n";
              next;
            }   
         @net = ();
	  
          foreach(@interface){            
                   
           my $inoc = "$InOctets" . ".$_";
           my $outoc = "$OutOctets" . ".$_";
           push (@net,"$inoc","$outoc");

	}
#Splitting the device if the number of interfaces are greater than 40
	while(scalar(@net)>40){
	@vars = splice(@net,0,40);
	my $result = $session -> get_request(
                        -varbindlist => \@vars,
                        -callback => [\&sysup,$COMMUNITY,$IP,$PORT,$inter,$oid,@vars]     
                            );  
	}
#Sending the request for the devices
	my $result = $session -> get_request(
                        -varbindlist => \@net,
                        -callback => [\&sysup,$COMMUNITY,$IP,$PORT,$inter,$oid,@net]     
                            );  

	  if (!defined  $result) {
             printf "ERROR: Failed to queue get request for host '%s': %s.\n",
              $session->hostname(),  $session->error();
             }
             
             #-----creation of RRD---
             if(!-e "$Bin/$IP-$COMMUNITY-$PORT.rrd")
               {

		@ds = ();
		foreach(@interface)
		{
		 push(@ds,"Input$_" => "COUNTER");
		 push(@ds,"Output$_" => "COUNTER");
		}
		 # Create 
		 my $rrd = RRD::Simple->new( file => "$Bin/$IP-$COMMUNITY-$PORT.rrd");
		
		 # Create a new RRD file with data sources called
		 $rrd->create("$Bin/$IP-$COMMUNITY-$PORT.rrd","year",map{+$_}@ds);
		 print "RRD Created for $COMMUNITY\n";            
		                         
               }         
			
            }
snmp_dispatcher();

#sleep(60);
#} 

sub sysup
{
print "IN SUB\n";
my ($session,$COMMUNITY,$IP,$PORT,$inter,$oid,@net) = @_;
 @val;
$i=1;
foreach(@net){
print"IN Foreach: $_\n";
my @in = split(/\./,$_);
 $ath = pop(@in);
my $bth = join('.',@in);
                   
print "Subject: $InOctets; Match: $bth\npop: $ath\n";      
if ($bth eq $InOctets)
{
 print "IN IF\n";
my $IOctets = $session -> var_bind_list -> {$_};
$Values{"Input" . "$ath"} = $IOctets*8;
my $cth = "Input$ath";

print "I have $IOctets\n";

push (@val,$cth);}
             
elsif($bth eq $OutOctets){
my $OOctets = $session -> var_bind_list -> {$_};
$Values{"Output" . "$ath"} = $OOctets*8;
my $dth = "Output$ath";
print "We have $OOctets\n";
push (@val,$dth);
}
                    
if ($oid*2 == $i)
{
 print "DS in update: @val\n";
 my $rrd = RRD::Simple -> new (file => "$Bin/$IP-$COMMUNITY-$PORT.rrd");
 $rrd->update("$Bin/$IP-$COMMUNITY-$PORT.rrd", map{($_ => $Values{$_})}@val);
}
$i++;
}  
}   
