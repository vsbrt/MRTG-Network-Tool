# MRTG-Network-Tool
network monitor tool which captures performance metrics from an SNMP enabled networking device and stores them into RRD to generate graphical representation on a web interface
---
Bitrate is the metric monitored in this performance monitoring tool. Elements such as Crontab for scheduling, RRD tool for holding data, MySQL database and SNMP for retrieval.
---
The required packages and the installation to run this tool are:
1. Perl
* Install From terminal: sudo apt-get install perl
2. DBI 
* Install From terminal: sudo apt-get install libdbi-perl
3. DBD::mysql
* Install From terminal: sudo apt-get install libmysqlclient-dev
* Download and extract DBD::mysql-4.028.tar.gz file from cpan
* From terminal give the path of the directory where it is extracted and follow the commands given below as root.
	1. perl Makefile.pl
	2. make
	3. make install
4. Net::SNMP
	→From terminal:
		→sudo apt-get install snmp
		→sudo apt-get install snmpd
		→sudo apt-get install libperl-dev
		→sudo apt-get install libnet-snmp-perl
	→Download and extract net-snmp-5.tar.gz file from www.net-snmp.org
	→From terminal give the path of the directory where it is extracted and follow the commands given below as root
		→configure
		→make
		→make install
5->RRDTool "sudo apt-get install rrdtool librrds-perl"
6→ RRD::Simple()
	From terminal: sudo apt-get install librrd-simple-perl
7→ php5.0 x or later versions
	From terminal: sudo apt-get install php5


8→ php5-mysql
	From terminal:
		→sudo apt-get install php5-mysql
		→sudo service apache2 restart
9→ php5-snmp
	From Terminal:
		→sudo apt-get install php5-snmp 
		→sudo service apache2 restart
10→ php5-rrd
		→sudo apt-get install php5-rrd
	 → add extension "extension=rrdtool.so" in php.ini file present in /etc/php5 folder
11→ apache server
	 →sudo apt-get install apache2
12→ libapache2-mod-php5
	 →sudo apt-get install libapache2-mod-php5
13→ mysql-server  
	 →sudo apt-get install mysql-server

14→ Perl Module Config::IniFiles "sudo apt-get install libconfig-inifiles-perl"
15→ sudo apt-get install curl
16-> sudo apt-get update
17-> sudo apt-get upgrade

Restart the apache2 web server: "sudo service apache2 restart"

How the tool works:
*******************
1. Change the database the creditials in db.conf in et2536-save15/ Folder.
2. Change the permissions of this assignment directory ./et2536-save15/assignment2/ by the entering the following command:
	"sudo chmod -R 777 /et2536-save15/assignment2/" to provide all necessary permissions.
3. User should first go to the webpage for creating the tables at the MySQL.
  	URL: http://localhost/et2536-save15/assignment2/index.php
3. Run bash script backend.pl using the command:
	"sudo perl backend.pl" 
4. Don't the exit the running terminal or send to background process.
5. User should go to the webpage for monitoring the performance of the devices.
  	URL: http://localhost/et2536-save15/assignment2/index.php
6. When adding a Network device the user has to select the interfaces he wants to monitor the graphs.
7. Enter the device details the user wants to monitor in both Network and Server by clicking Add Network device and Add Server Device. 
8. After the details are added click "MONITOR" on the left side, the user can select which Tool to monitor i.e., network or Server and should select the device and the interface for which the user wants to monitor the graphs. 
 




		


		

