<pre>
Postgres db:
<code>
# pkg install postgres95-server postgres95-client postgres95-contrib
...
Enable PostgreSQL to start at system boot in /etc/rc.conf.
# echo 'postgresql_enable="YES"' >> /etc/rc.conf

Initialize the PostgreSQL database cluster for the first time.
# /usr/local/etc/rc.d/postgresql initdb
/usr/local/etc/rc.d/postgresql initdb
The files belonging to this database system will be owned by user "pgsql".
This user must also own the server process.

The database cluster will be initialized with locale C.
The default text search configuration will be set to "english".

fixing permissions on existing directory /usr/local/pgsql/data ... ok
creating subdirectories ... ok
selecting default max_connections ... 40
selecting default shared_buffers ... 28MB
creating configuration files ... ok
creating template1 database in /usr/local/pgsql/data/base/1 ... ok
initializing pg_authid ... ok
initializing dependencies ... ok
creating system views ... ok
loading system objects' descriptions ... ok
creating conversions ... ok
creating dictionaries ... ok
setting privileges on built-in objects ... ok
creating information schema ... ok
vacuuming database template1 ... ok
copying template1 to template0 ... ok
copying template1 to postgres ... ok

WARNING: enabling "trust" authentication for local connections
You can change this by editing pg_hba.conf or using the -A option the
next time you run initdb.

Success. You can now start the database server using:

    /usr/local/bin/postgres -D /usr/local/pgsql/data
or
    /usr/local/bin/pg_ctl -D /usr/local/pgsql/data -l logfile start

Configure PostgreSQL to listen for database connections on all system IP addresses by adding the following line to /usr/local/pgsql/data/postgresql.conf.

listen_addresses = '*'
 

Configure PostgreSQL to use password hash authentication for all hosts and users connecting from the local network by adding the following line to the /usr/local/pgsql/data/pg_hba.conf file. NOTE: Replace 10.0.1.0/24 with your own network.

host  all  all  10.0.1.0/24  md5
 
# su pgsql

$ createdb bedrock 
$ psql bedrock
bedrock=#

Connect to db
bedrock=#\c database
List db
\bedrock=#l 
bedrock=#\c show the database you are connected to
bedrock=#\d list tables in the database
bedrock=#\q quit from database
$
</code>
-
Web based ssh client on the server
 you can put into your server and access your server via https protocol
diretly through browser
 How to install shellinabox
<code>
 # cd /usr/ports/www/shellinabox
 # make install clean
</code>
 Now that it is installed, the shellinabox boots in through the /etc/rc.conf
bsd booting system:
<code>
# echo shellinaboxd_enable="YES"
# echo shellinaboxd_port="8022"
</code>
 the last step is to launch it or restart it
<code>
# /usr/local/etc/rc.d/shellinaboxd start #or stop or restart
</code>
 in order to access the running shellinaboxd deamon on port 8022 you have to 
point your browser to http://yourdomain:8022
-
APACHE
 install apache
<code>
$ pkg install apache24
</code>
 enable apache in rc.conf
<code>
$ su
password:
# echo "apache24_enable="YES" >> /etc/rc.conf
# # alternatively you can use syncr command
# sysrc apache24_enable=yes
</code>
 restart apache
<code>
# service apache24 restart
# # alternatively:
# /usr/local/etc/rc.d/apache24 restart
</code>

PHP
 install php
<code>
# pkg install mod_php56 php56-mysql php56_mysqli
...
</code>
 copy the sample configuration PHP file into place with this command:
<code>
# cp /usr/local/etc/php.ini-production /usr/local/etc/php.ini
</code>
 regenerate system's cached information about your installed executable files
<code>
# rehash
</code>

Web page
 put your web page index.php in the directory /usr/local/www/apache24/data
Settings
 put your settings in the file /usr/local/etc/apache24/httpd.conf
<code>
# vi usr/local/etc/apache24/httpd.conf
...
Listen 80
Listen 192.168.1.2:1256
...
User www
Group www
...
ServerAdming admin@gmail.com
...
DocumentRoot "/usr/local/www/apache24/data"
...
<IfModule dir_module>
    DirectoryIndex index.php index.html
</IfModule>
...
<Files ".ht*">
    Require all denied
</Files>

<FilesMatch "\.php$">
   SetHandler application/x-httpd-php
</FilesMatch>
<FilesMatch "\.phps$">
   SetHandler application/x-httpd-php-source
</FilesMatch>
...
ErrorLog "/var/log/httpd-error.log"
</code>

-
OPERA
 install
<code>
$ pkg install opera
</code>

-
LATEX
 Texlive is now usable for FreeBSD. There is a texlive-base and texlive-texmf port.
If you do not want to install from port you can use packages.
<code>
$ pkg install texlive-base
...
$ pkg install texlive-texmf
...
$ pkg install print/tex-formats #installs pdf latex
...
$ pkg install texworks
...
</code> 
-
Set an enviroment variable temporarily
 PATH=/sbin:$PATH
 export PATH
Set an enviroment variable for all for sh shell
 edit ~/.profile file with the line
<code>
$ vi ~/.profile
...
PATH=/sbin:$PATH
...
</code>
-
The X Display Manager
 Xorg provides an X display manager, xdm, which can be used for login session
management. XDM provides a graphical interface for choosing which display
server to connect to and for entering authorization information such as a login
and password combination.
 Some desktops provide their own graphical login manager. Refer to gnome
display or KdE display. 

Configuring XDM
 To instal XDM package or port
<code>
$ pkg install x11/xdm
</code>
 It can be configured to ru when machine boots up by editing this entry 
in /etc/ttys:
<code>
ttyv8   "/usr/local/bin/xdm -nodaemon"  xterm   off secure
</code>
 The XDM configuration directory is located in /usr/local/lib/X11/xdm.
This directory contains several files used to change the behaviour and a
appereance of XDM as a few scripts and programs to set up the desktop wehn 
XDM is running. 
 Configuring remote access
By default, only users on the same system can login using XDM. To enable users
on other systems to connect to display server, edit the access control
rules and enable the connection listener. 
To configure XDM to listen for any remote connection, comment out the 
DisplayManager.requestPort line in /usr/local/lib/X11/xdm/xdm-config by 
putting a ! in front of it.

Login to XDM from remote client
 this enables to open window application from server on the client side
 X11 forwarding needs to be enabled on both the client side and the server
side. 
 On the client side -X option to ssh enables X11 forwarding
 On the server side X11Forwarding yes must be specified in /etc/ssh/sshd_config.
 The xauth program must be installed on the servers side. If there are any 
X11 programs there, it is very likely that xauth will be there. 
 Example
<code>
$ ssh -X User@server.org
password:
$ gedit #opens window application
</code>

Xfce
 Xfce is a desktop environment based on the GTK+ toolkit used by GNOME.
However it is more lightweight and provides a simple, efficient and easy to use desktop.
 Install xfce
<code>
 pkg install xfce
</code>
 Unlike GNOME and KDE, Xfce does not provide its own login manager. In order
to start Xfce fro the command line by typing startx, first add its entry to 
~/.xinitrc.
<code>
$ echo "exec /usr/local/bin/startxfce4" > ~/.xinitrc
</code>

-
FreeBSD networking 
STATIC WIRED
 Identify your network interfaces
<code>
$ dmesg |grep bge0
</code>
 Set your static route online on your router site, e.g. 192.168.1.1
 Modify /etc/rc.conf
<code>
$ vi /etc/rc.conf
ifconfig_bge0="inet 192.168.1.6 netmask 255.255.255.0"
defaultrouter="192.168.1.1"
</code>
 Modify your name server access
<code>
$ vi /etc/resolv.conf
nameserver 192.168.1.1
domain mydomain.org
</code>
 Restart networking
<code>
$ /etc/rc.d/netif restart && /etc/rc.d/routing restart
$ # or
$ service netif restart && service routing restart
</code>

STATIC WIRELESS
 Identify your network cards
<code>
$ ifconfig -a
</code>
Set your static route online on your router site, e.g. 192.168.1.1
 Modify /etc/rc.conf
<code>
$ vi /etc/rc.conf
wlans_ath0="wlan0"
ifconfig_wlan0="WPA inet a.b.c.d netmask 0xffffff00"
defaultrouter="a.b.c.e"
</code>
 Modify your name server access
<code>
$ vi /etc/resolv.conf
nameserver 192.168.1.1
domain mydomain.org
</code>
 If your wireless device is Atheros, you have to add the following to 
 the /boot/loader.conf file
<code>
if_ath_load="YES"
</code>
 With a device driver configured you need to also bring in the 802.11 networking
 support required by the driver. For ath driver is at least the wlan module; this
 module is automatically loaded with the wireless device driver. With that 
 you will need modules that implement cryptographic support for the security
 protocols you intend to use. To add these modules at boot time, add the following
 lines to /boot/loader.conf
<code>
wlan_wep_load="YES"
wlan_ccmp_load="YES"
wlan_tkip_load="YES"
</code>
 Restart networking
<code>
$ /etc/rc.d/netif restart && /etc/rc.d/routing restart
$ # or
$ service netif restart && service routing restart
</code>
 See available networks
<code>
$ ifconfig wlan0 up scan
SSID/MESH BSSID CHAN RATE S:N INT CAPS
Zyxel b2:b3:7e:26:90:b2 1 54M -63:-96 100 EP WPS HTCAP WPA WME
OSK-C3E b2:c3:de:7b:k5:b2 1 54M -88:-96 100 EP RSN HTCAP WME
</code>

 Set configuration via /etc/wpa_supplicant.conf
<code>
$ vi /etc/wpa_supplicant.conf
ctrl_interface=/var/run/wpa_supplicant
ctrl_interface_group=wheel
eapol_version=1
ap_scan=1
fast_reauth=1

network {
 ssid=ssid of network
 scan_ssid=1
 psk=password
}
</code>

DYNAMIC WIRED
  in /etc/rc.conf change line ifconfig_bge0 to 
<code>
ifconfig_bge0=DHCP
</code>
DYNAMIC WIRELESS
  in /etc/rc.conf change line ifconfig_wlan0 to 
<code>
ifconfig_wlan0=WPA DHCP
</code>

FREEBSD SSH2 SERVER
 FreeBSD has OpenSSH-server installed by default
<code>
$ echo "sshd_enable=YES" > /etc/rc.conf
$ /etc/rc.d/sshd start|stop|restart
$ # Make sure "Protocol 2" is enabled in /etc/ssh/sshd_config and reload sshd with
$ sh /etc/rc.d/sshd reload
</code>
Make OpenSSH listen on the other port than default
<code>
$ vi /etc/ssh/sshd_config
Port 40
ListenAddress 127.0.0.1
ListenAddress 172.16.45.0
$ # Restart sshd deamon
$ service sshd restart
$ # Now the command below can be used to connect a client from 172.16.44.0 network to the OpenSSH server:
$ ssh 172.16.44.1 -p 40
</code>
Make OpenSSH listen on more than one port
 show which ports it is currently listening to
<code>
$ sockstat -4l |grep sshd
root   sshd   1030   4   tcp4   *:22         *:*
$ vi /etc/ssh/sshd_config #and add the following lines
Port 22
Port 2222 #new port number
</code>

FTP SERVER
 Once the ftp server has been configured, set the appropriate variable in /etc/rc.conf to start the service
 during booting
<code>
ftpd_enable=YES
</code>
 To start or restart the service
<code>
$ service ftpd start|stop|restart
</code>
 To test the connection to the FTP server use localhost
<code>
$ ftp localhost
</code>
 Edit /etc/services to change the standard port numbers FTP uses
 Say change port 20 & 21 to 35520 & 35521

VIRTUAL CONSOLE
 ALT+F1 =accesses a system console
 ALT+F2-F8 =accesses virtual consoles
 in /etc/ttys is configured the number of virtual consoles, to disable one put comment in front of it
 Changing console resolution
  The first command is called “ vidcontrol “ and you would issue it as
<code>
$ vidcontrol -i mode 
</code>
  And it will list the different modes avaliable, for your video card. You would then use.
<code>
$ vidcontrol MODE_xxx 
</code>
  Where “xxx” is the three digit number of the video size of your choice, you may have to test a few, in order to find the right size.
  Once you have the correct resolution you can do.
<code>
$ allscreens=”MODE_xxx”
</code>
  and put this in “ /etc/rc.conf “ to be persistent on reboot.
 
INSTALL BASH to FreeBSD 9
<code>
$ pkg_add -r bash
</code>

INSTALL BASH from FreeBSD 10
<code>
$ pkg install bash
$ # to delete
$ pkg delete bash
</code>

  
</pre>
