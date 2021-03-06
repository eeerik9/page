<pre>
Play mp3 files in terminal:
<code>
mpg123
</code>
Play ogg files in terminal:
<code>
ogg123
</code>
Convert mp3 to ogg file format:
<code>
mp32ogg
</code>

--
Icecast Blog:
<code>
https://blog.iandreev.com/?p=1522
</code>
Setup audio streaming with Icecast2 and Ices:
In this post Ill describe how to install and configure a streaming radio station with two separate streams. This means, you can have two or multiple radio stations running on the same port. For this, youll need a FreeBSD 10 server and some Ogg Vorbis music files. MP3 is not supported with ices2 client (licensing issues), but it's easy to overcome that.

Before going any further, this is what you need to know.

    icecast is the streaming server
    ices is the client that supplies the music files to icecast
    you are the listener, not a client

Install icecast

icecast can be easily installed from the packages or the ports. There is no need for any configurations, so well do the packages.
<code>	
pkg install icecast2
</code>
icecast comes up with a startup script, so we have to enable it on boot. Add the following line to /etc/rc.conf.
<code>	
icecast_enable="yes"
</code>
icecast also comes up with a sample config script, so lets modify it. The configuration parameters are described in the official document and this post will highlight only the necessary changes that you have to make.
<code>	
cd /usr/local/etc/
cp icecast.xml.sample icecast.xml
</code>
Change the location, the admin email, change the passwords for source-password, relay-password and admin-password under authentication. Its a good practice to change the default admin user as well. In addition, change the log directory under logdir and uncomment the user and the group that will run icecast daemon.

This is how my icecast.xml looks like.
<xmp>
<icecast>
    <!-- location and admin are two arbitrary strings that are e.g. visible
         on the server info page of the icecast web interface
         (server_version.xsl). -->
    <location>NJ</location>
    <admin>icemaster@iandreev.com</admin>
 
    <limits>
        <clients>10</clients>
        <sources>2</sources>
        <threadpool>5</threadpool>
        <queue-size>524288</queue-size>
        <client-timeout>30</client-timeout>
        <header-timeout>15</header-timeout>
        <source-timeout>10</source-timeout>
        <!-- If enabled, this will provide a burst of data when a client 
             first connects, thereby significantly reducing the startup 
             time for listeners that do substantial buffering. However,
             it also significantly increases latency between the source
             client and listening client.  For low-latency setups, you
             might want to disable this. -->
        <burst-on-connect>1</burst-on-connect>
        <!-- same as burst-on-connect, but this allows for being more
             specific on how much to burst. Most people won't need to
             change from the default 64k. Applies to all mountpoints  -->
        <burst-size>65535</burst-size>
    </limits>
 
    <authentication>
        <!-- Sources log in with username 'source' -->
        <source-password>password1</source-password>
        <!-- Relays log in username 'relay' -->
        <relay-password>password2</relay-password>
 
        <!-- Admin logs in with the username given below -->
        <admin-user>username</admin-user>
        <admin-password>password3</admin-password>
    </authentication>
 
    <!-- set the mountpoint for a shoutcast source to use, the default if not
         specified is /stream but you can change it here if an alternative is
         wanted or an extension is required
    <shoutcast-mount>/live.nsv</shoutcast-mount>
    -->
 
    <!-- Uncomment this if you want directory listings -->
    <!--
    <directory>
        <yp-url-timeout>15</yp-url-timeout>
        <yp-url>http://dir.xiph.org/cgi-bin/yp-cgi</yp-url>
    </directory>
     -->
 
    <!-- This is the hostname other people will use to connect to your server.
    It affects mainly the urls generated by Icecast for playlists and yp
    listings. -->
    <hostname>localhost</hostname>
 
    <!-- You may have multiple <listener> elements -->
    <listen-socket>
        <port>8000</port>
        <!-- <bind-address>127.0.0.1</bind-address> -->
        <!-- <shoutcast-mount>/stream</shoutcast-mount> -->
    </listen-socket>
    <!--
    <listen-socket>
        <port>8001</port>
    </listen-socket>
    -->
 
    <!--<master-server>127.0.0.1</master-server>-->
    <!--<master-server-port>8001</master-server-port>-->
    <!--<master-update-interval>120</master-update-interval>-->
    <!--<master-password>hackme</master-password>-->
 
    <!-- setting this makes all relays on-demand unless overridden, this is
         useful for master relays which do not have <relay> definitions here.
         The default is 0 -->
    <!--<relays-on-demand>1</relays-on-demand>-->
 
    <!--
    <relay>
        <server>127.0.0.1</server>
        <port>8001</port>
        <mount>/example.ogg</mount>
        <local-mount>/different.ogg</local-mount>
        <on-demand>0</on-demand>
 
        <relay-shoutcast-metadata>0</relay-shoutcast-metadata>
    </relay>
    -->
 
    <!-- Only define a <mount> section if you want to use advanced options,
         like alternative usernames or passwords
    <mount>
        <mount-name>/example-complex.ogg</mount-name>
 
        <username>othersource</username>
        <password>hackmemore</password>
 
        <max-listeners>1</max-listeners>
        <dump-file>/tmp/dump-example1.ogg</dump-file>
        <burst-size>65536</burst-size>
        <fallback-mount>/example2.ogg</fallback-mount>
        <fallback-override>1</fallback-override>
        <fallback-when-full>1</fallback-when-full>
        <intro>/example_intro.ogg</intro>
        <hidden>1</hidden>
        <no-yp>1</no-yp>
        <authentication type="htpasswd">
                <option name="filename" value="myauth"/>
                <option name="allow_duplicate_users" value="0"/>
        </authentication>
        <on-connect>/home/icecast/bin/stream-start</on-connect>
        <on-disconnect>/home/icecast/bin/stream-stop</on-disconnect>
    </mount>
 
    <mount>
        <mount-name>/auth_example.ogg</mount-name>
        <authentication type="url">
            <option name="mount_add"       value="http://myauthserver.net/notify_mount.php"/>
            <option name="mount_remove"    value="http://myauthserver.net/notify_mount.php"/>
            <option name="listener_add"    value="http://myauthserver.net/notify_listener.php"/>
            <option name="listener_remove" value="http://myauthserver.net/notify_listener.php"/>
            <option name="headers"         value="x-pragma,x-token"/>
            <option name="header_prefix"   value="ClientHeader."/>
        </authentication>
    </mount>
 
    -->
 
    <fileserve>1</fileserve>
 
    <paths>
        <!-- basedir is only used if chroot is enabled -->
        <basedir>/usr/local/share/icecast</basedir>
 
        <!-- Note that if <chroot> is turned on below, these paths must both
             be relative to the new root, not the original root -->
        <logdir>/var/log/icecast</logdir>
        <webroot>/usr/local/share/icecast/web</webroot>
        <adminroot>/usr/local/share/icecast/admin</adminroot>
        <!-- <pidfile>/usr/local/share/icecast/icecast.pid</pidfile> -->
 
        <!-- Aliases: treat requests for 'source' path as being for 'dest' path
             May be made specific to a port or bound address using the "port"
             and "bind-address" attributes.
          -->
        <!--
        <alias source="/foo" destination="/bar"/>
          -->
        <!-- Aliases: can also be used for simple redirections as well,
             this example will redirect all requests for http://server:port/ to
             the status page
          -->
        <alias source="/" destination="/status.xsl"/>
    </paths>
 
    <logging>
        <accesslog>access.log</accesslog>
        <errorlog>error.log</errorlog>
        <!-- <playlistlog>playlist.log</playlistlog> -->
        <loglevel>3</loglevel> <!-- 4 Debug, 3 Info, 2 Warn, 1 Error -->
        <logsize>10000</logsize> <!-- Max size of a logfile -->
        <!-- If logarchive is enabled (1), then when logsize is reached
             the logfile will be moved to [error|access|playlist].log.DATESTAMP,
             otherwise it will be moved to [error|access|playlist].log.old.
             Default is non-archive mode (i.e. overwrite)
        -->
        <!-- <logarchive>1</logarchive> -->
    </logging>
 
    <security>
        <chroot>0</chroot>
        <changeowner>
            <user>nobody</user>
            <group>nogroup</group>
        </changeowner>
    </security>
</icecast>
</xmp>
Create the log directory and change the ownership.
<code>	
mkdir /var/log/icecast
chown -R nobody:nogroup /var/log/icecast
</code>
Start the icecast and check the log file.
<code>
service icecast2 start
tail /var/log/icecast/error.log
</code>
If everything is OK youll see something like this.
<code>	
[2014-09-13  23:34:13] INFO main/main Icecast 2.4.0 server started
[2014-09-13  23:34:13] INFO connection/get_ssl_certificate No SSL capability on any configured ports
[2014-09-13  23:34:13] INFO yp/yp_update_thread YP update thread started
</code>
Go to http://yourserver.com:8000 and you should see this.

Install ices

Well install ices from the packages and create a separate user and group called radio that will run the ices client. Ices client doesnt come up with a startup script, so well create one for each stream. In case you reboot, the streaming server and the clients will start automatically. Well also create a log directory.
<code>
pkg install ices
pw groupadd radio && pw useradd radio -g radio -m
mkdir /var/log/ices
chown -R radio:radio /var/log/ices
</code>

Switch to the radio user and create the folders for the configuration files and the two radio stations that you want to run. If you want more streams, just follow the pattern described bellow. In my case, Ill have two radio stations, trance and liquid.
<code>
su - radio
mkdir conf liquid trance
cd ~radio/conf
cp /usr/local/share/ices/ices-playlist.xml liquid-playlist.xml
</code>

Lets configure the first radio station and youll see how easy is to configure the the second one.

    Edit the configuration file for the first stream (liquid-playlist.xml) and change the following values: background, logpath, logfile and pidfile.
    Under stream section, change the name, genre and description.
    Under the input section, change the param name=file parameter. This value should point to a file that contains each Ogg file in a separate line.
    Under the instance section, change the password and the mount. The password supplied here must match the same source-password that was used to configure icecast (see line 31 in my example of icecast config). The mount parameter is how you are going to access the stream (e.g. http://yourserver.com:8000/station_name.ogg). Always end it up with .ogg.
    I also change the nominal-bitrate to 128000, which means, ices will encode the streams as 128kbps streams.

Make sure you have enough bandwidth to support this. Use the following link to determine your needs.

Finally, here is my liquid-playlist.xml file.
<xmp>

<ices>
    <!-- run in background -->
    <background>1</background>
    <!-- where logs, etc go. -->
    <logpath>/var/log/ices</logpath>
    <logfile>liquid.log</logfile>
    <!-- 1=error,2=warn,3=info,4=debug -->
    <loglevel>4</loglevel>
    <!-- set this to 1 to log to the console instead of to the file above -->
    <consolelog>0</consolelog>
 
    <!-- optional filename to write process id to -->
    <pidfile>/home/radio/liquid.pid</pidfile>
 
    <stream>
        <!-- metadata used for stream listing (not currently used) -->
        <metadata>
            <name>Liquid radio</name>
            <genre>Liquid D'n'B genre</genre>
            <description>Commercial Free Liquid D'n'B radio stream</description>
        </metadata>
 
        <!-- input module
 
            The module used here is the playlist module - it has 
            'submodules' for different types of playlist. There are
            two currently implemented, 'basic', which is a simple
            file-based playlist, and 'script' which invokes a command
            to returns a filename to start playing. -->
 
        <input>
            <module>playlist</module>
            <param name="type">basic</param>
            <param name="file">/home/radio/conf/liquid-playlist.txt</param>
            <!-- random play -->
            <param name="random">0</param>
            <!-- if the playlist get updated that start at the beginning -->
            <param name="restart-after-reread">0</param>
            <!-- if set to 1 , plays once through, then exits. -->
            <param name="once">0</param>
        </input>
 
        <!-- Stream instance
            You may have one or more instances here. This allows you to 
            send the same input data to one or more servers (or to different
            mountpoints on the same server). Each of them can have different
            parameters. This is primarily useful for a) relaying to multiple
            independent servers, and b) encoding/reencoding to multiple
            bitrates.
            If one instance fails (for example, the associated server goes
            down, etc), the others will continue to function correctly.
            This example defines two instances as two mountpoints on the
            same server.  -->
        <instance>
            <!-- Server details:
                You define hostname and port for the server here, along with
                the source password and mountpoint.  -->
            <hostname>localhost</hostname>
            <port>8000</port>
            <password>password1</password>
            <mount>/liquid.ogg</mount>
 
            <!-- Reconnect parameters:
                When something goes wrong (e.g. the server crashes, or the
                network drops) and ices disconnects from the server, these
                control how often it tries to reconnect, and how many times
                it tries to reconnect. Delay is in seconds.
                If you set reconnectattempts to -1, it will continue
                indefinately. Suggest setting reconnectdelay to a large value
                if you do this.
            -->
            <reconnectdelay>2</reconnectdelay>
            <reconnectattempts>5</reconnectattempts> 
 
            <!-- maxqueuelength:
                This describes how long the internal data queues may be. This
                basically lets you control how much data gets buffered before
                ices decides it can't send to the server fast enough, and 
                either shuts down or flushes the queue (dropping the data)
                and continues. 
                For advanced users only.
            -->
            <maxqueuelength>80</maxqueuelength>
 
            <!-- Live encoding/reencoding:
                Currrently, the parameters given here for encoding MUST
                match the input data for channels and sample rate. That 
                restriction will be relaxed in the future.
                Remove this section if you don't want your files getting reencoded.
            -->
            <encode>  
                <nominal-bitrate>128000</nominal-bitrate> <!-- bps. e.g. 64000 for 64 kbps -->
                <samplerate>44100</samplerate>
                <channels>2</channels>
            </encode>
        </instance>
 
    </stream>
</ices>
</xmp>

At this point, we need to put some Ogg files that we want to stream. In my case, Ive put them under /home/radio/liquid for the first stream. Now, go to:
<code>	
cd ~radio/conf
ls -d /home/radio/liquid/*.ogg > liquid-playlist.txt
cat liquid-playlist.txt
</code>

This will generate the playlist for you from all Ogg files. If you have your files separated in sub directories, then do:

<code>
cd ~radio/genre
find /home/radio/genre -name "*.ogg" -print > /home/radio/conf/genre-playlist.txt
</code>

At this point, start the station with ices liquid-playlist.xml. If everything is OK, you shouldnt see anything. Ices will start in the background. Do a simple check:
<code>	
ps -waux | grep ices
tail /var/log/ices/liquid.log
</code>

Check your radio with http://yourserver.com:8000/liquid.ogg. Now that you have the first radio ready, its very easy to configure the 2nd one. First, lets create the configuration file as a copy from the first station.
<code>	
cd ~radio/conf
cp liquid-playlist.xml trance-playlist.xml
</code>

I use vi to replace everything in trance-playlist.xml that says liquid as trance. Use 
<code>
:%s/liquid/trance/g.
</code>

Put some Ogg file for the 2nd station under ~radio/trance and create the playlist text file.

<code>	
cd ~radio/conf
ls -d /home/radio/trance/*.ogg > trance-playlist.txt
cat trance-playlist.txt
</code>

Start the station with ices trance-playlist.xml and test it with http://yourserver.com:8000/trance.ogg.

Configure ices startup

Once you make sure that everything works fine, lets create the ices startup files in case the server reboots.

Log as root and do:
<code>	
cd /usr/local/etc/rc.d
</code>
Create the first startup script called ices_liquid and add everything from here.
<code>
#!/bin/sh
#
# PROVIDE: ices_liquid
# REQUIRE: DAEMON icecast2
# BEFORE:  LOGIN
# KEYWORD: shutdown
 
. /etc/rc.subr
 
name="ices_liquid"
rcvar=ices_liquid_enable
 
command="/usr/local/bin/ices"
extra_commands="reload"
pidfile="/home/radio/liquid.pid"
sig_reload="USR1"
 
load_rc_config "$name"
: ${ices_liquid_enable="NO"}
: ${ices_liquid_config="/home/radio/conf/liquid-playlist.xml"}
: ${ices_liquid_flags="${ices_liquid_config}"}
: ${ices_liquid_user="radio"}
required_files="${ices_liquid_config}"
 
run_rc_command "$1"
</code>
Save it and do chmod 555 ices_liquid to make sure its executable on start. Add ices_liquid_enable="YES" in /etc/rc.conf. Follow the same pattern for the second startup script. Copy ices_liquid as ices_trance and replace every occurrence of liquid as trance. Then add ices_trance_enable="YES" in /etc/rc.conf. Now you can control the streams with the standard FreeBSD daemon command service. E.g.
<code>	
service ices_liquid start
service ices_liquid stop
service ices_liquid status
</code>
OK. At this point you have a streaming station(s) but they all run on port 8000. As we stated above, you can access a station by accessing this URL: http://genre.domain.com:8000/genre.ogg, speaking in general terms. Read further to see how can you bypass this restriction in order to access your radio behind a firewall.

Firewall

icecast runs on port 8000 and in many corporate environments only ports 80 and 443 are allowed inbound through various proxies. I tried to run icecast on port 80, but icecast refused to run. Mind that you cant run icecast using a non-root account on port 80. Actually, you can. apache runs on port 80 as www user, but its parent process runs as root and then forks the processes. But most importantly, if you somehow make icecast to run as root, you cant run apache on that port. The easiest way is to use mod_proxy. This module will do the heavy lifting for you. It will redirect port 8000 to port 80. This is how we are going to accomplish that using two virtual hosts in Apache.
First, create two DNS aliases, e.g. genre.domain.com and genrefw.domain.com. They should point to the same IP of your icecast server. In Apache, make sure you have mod_proxy and mod_proxy_html modules built in and loaded in httpd.conf. See my other post on how to run virtual hosts under Apache.

<code>	
LoadModule proxy_module libexec/apache24/mod_proxy.so
LoadModule proxy_http_module libexec/apache24/mod_proxy_http.so
LoadModule cgi_module libexec/apache24/mod_cgi.so
</code>
or if you have the prefork/worker config file, you might also see this.
<code>	
<IfModule mpm_prefork_module>
        LoadModule cgi_module libexec/apache24/mod_cgi.so
</IfModule>
</code>
The virtual hosts directives in httpd-vhosts.conf should look like this.
<code>
<VirtualHost *:80>
    ServerAdmin admin@domain.com
    DocumentRoot "/usr/local/www/genre.domain.com"
    ServerName genre.domain.com
    ErrorLog "/var/log/genre.domain.com-error_log"
    CustomLog "/var/log/genre.domain.com-access_log" common
    <Directory "/usr/local/www/genre.domain.com">
        Options All
        AllowOverride All
        Require all granted
   </Directory>
   ScriptAlias /cgi-bin/ "/usr/local/www/genre.domain.com/cgi-bin/"
   <Directory "/usr/local/www/genre.domain.com/cgi-bin">
        Options +ExecCGI
        Order allow,deny
        Allow from all
        AddHandler cgi-script .cgi
   </Directory>
</VirtualHost>
<VirtualHost *:80>
    ServerAdmin admin@domain.com
    DocumentRoot "/usr/local/www/genrefw.domain.com"
    ServerName genrefw.domain.com
    ErrorLog "/var/log/genrefw.domain.com-error_log"
    CustomLog "/var/log/genrefw.domain.com-access_log" common
    ProxyRequests Off
    ProxyPass / http://genre.domain.com:8000/genre.ogg
    ProxyPassReverse / http://genre.domain.com:8000/genre.ogg
    <Directory "/usr/local/www/genrefw.domain.com">
        Options All
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
</code>
Now, you have to create two virtual web sites, genre.domain.com and genrefw.domain.com. The genrefw.domain.com site will be an empty site. Read further and see how I built two web sites. You can make it much simpler or even more complex. I also enabled cgi-bin in order to run some scripts. The step below is optional. If you just want to bypass the firewall, create the two virtual hosts as described above and for regular users use http://genre.domain.com:8000/genre.ogg and for the users behind a firewall use http://genrefw.domain.com/genre.ogg.


--
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
  The first command is called � vidcontrol � and you would issue it as
<code>
$ vidcontrol -i mode 
</code>
  And it will list the different modes avaliable, for your video card. You would then use.
<code>
$ vidcontrol MODE_xxx 
</code>
  Where �xxx� is the three digit number of the video size of your choice, you may have to test a few, in order to find the right size.
  Once you have the correct resolution you can do.
<code>
$ allscreens=�MODE_xxx�
</code>
  and put this in � /etc/rc.conf � to be persistent on reboot.
 
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
