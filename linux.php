<pre>
PATH variable
Example
 update path variable for your new executalbe which is located in your $HOME directory
<code>
# vim $HOME/.profile
# ~/.profile: executed by the command interpreter for login shells.
# This file is not read by bash(1), if ~/.bash_profile or ~/.bash_login
# exists.
# see /usr/share/doc/bash/examples/startup-files for examples.
# the files are located in the bash-doc package.

# the default umask is set in /etc/profile; for setting the umask
# for ssh logins, install and configure the libpam-umask package.
#umask 022

# if running bash
if [ -n "$BASH_VERSION" ]; then
    # include .bashrc if it exists
    if [ -f "$HOME/.bashrc" ]; then
        . "$HOME/.bashrc"
    fi
fi

# set PATH so it includes user's private bin if it exists
if [ -d "$HOME/bin" ] ; then
    PATH="$HOME/bin:$PATH"
fi
###############PATH edited##############
#edit PATH for golang
export GOROOT=$HOME/Golang/go
export PATH=$PATH:$GOROOT/bin
########################################
~    
:wq   
#echo $PATH
/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games                        
# #update PATH variable within the same window type bash (close and open window)
# source $HOME/.profile
echo $PATH
/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/home/erik/Golang/go/bin
</code>

--
TMUX terminal
 splits terminal into multiple areas
 install tmux terminal
<code>
# apt-get install tmux
</code>
 operates with PREFIX = Ctrl-b and the command
 manages sessions, windows, panels
 SESSIONS
 :new&#60;CR&#62; new session
 s list sessions
 $ name session

 WINDOW command
 c create window
 w list windows
 n next window
 p previous window
 f find window
 , name window
 & kill window

 PANEL command
 % vertical split
 " horizontal split
 o switch panes
 Ctrl-o swap panes
 q show panes numbers
 x kill pane
 PREFIX q show pane numbers, when the numbers show up type the key to goto that pane

 resize pane
  PREFIX : resize-pane -D (Resizes the current pane down)
  PREFIX : resize-pane -U (Resizes the current pane upward)
  PREFIX : resize-pane -L (Resizes the current pane left)
  PREFIX : resize-pane -R (Resizes the current pane right)
  PREFIX : resize-pane -D 20 (Resizes the current pane down by 20 cells)
  PREFIX : resize-pane -U 20 (Resizes the current pane upward by 20 cells)
  PREFIX : resize-pane -L 20 (Resizes the current pane left by 20 cells)
  PREFIX : resize-pane -R 20 (Resizes the current pane right by 20 cells)
  PREFIX : resize-pane -t 2 20 (Resizes the pane with the id of 2 down by 20 cells)
  PREFIX : resize-pane -t -L 20 (Resizes the pane with the id of 2 left by 20 cells)
  
--
MYSQL
Install mysql database
<code>
#apt-get install mysql-server mysql-client
...
</code>

Reseting mysql root passwofd (if forgotten)
<code>
# # stop mysql deamon
# /etc/init.d/mysql stop
# # Next yuo need to start mysql in safe mode - that is to say, we will start mysql but skip the user privileges table. 
# # Again, note that you will need to have sudo access for these commands so you do  not need to worry about any user being
# # to resent the mysql root password 
# mysql_safe --skip-grant-tables &
# #login to mysql
# # no password is required, we skipped the privileges table
# # login
# mysql -uroot
# #select the table
> use mysql;
# # reset password
# update user set password=PASSWORD("mynewpassword") where User='root';
# # flush privileges
> flush privileges;
# # log out and restart
> quit
# /etc/init.d/mysql stop
# /etc/init.d/mysql start
# # and finally login
# mysql -u root -p
> ...
...
</code>

Create and delete a user
<code>
mysql> CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';
...
</code>
Sadly, at this point newuser has no permissions to do anything with the databases. In fact, if newuser even tries
to login (with the password, password), they will not be able to reach mysql shell.
Add privileges
<code>
mysql> GRANT ALL PRIVILEGES ON * . * TO 'newuser'@'localhost';
mysql> FLUSH PRIVILEGES;
</code>
Just as you can delete databases with DROP, you can use DROP to delete a user altogether
<code>
mysql> DROP USER ‘demo’@‘localhost’;
</code>

Create database
<code>
mysql> CREATE DATABASE IF NOT EXISTS my_login;
</code>

Show database
<code>
mysql> SHOW DATABASES;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| my_login           |
| tutorial_database  |
+--------------------+
4 rows in set (0.00 sec)
</code>

Create a table
<code>
mysql> use my_login;
mysql> CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)
</code>

Create table msq
<code>
CREATE TABLE `msgs` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `msg` VARCHAR(256),
    `ts_create` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `ts_update` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
</code>

Insert into a table
<code>
mysql> INSERT INTO table_name (column1, column2, column3,...)
VALUES (value1, value2, value3,...)
</code>

Show columns in table
<code>
mysql> SHOW COLUMNS in <table_name>;
...
</code>

Modify the size of column in a table
<code>
mysql> ALTER TABLE <table_name> MODIFY <col_name> VARCHAR(65536);
</code>

Delete from a table
<code>
mysql> DELETE FROM table_name [WHERE Clause]
</code>

Global variables in mysql
<code>
mysql> SHOW GLOBAL VARIABLES LIKE 'local_infile';
+---------------+-------+
| Variable_name | Value |
+---------------+-------+
| local_infile  | OFF   |
+---------------+-------+
1 row in set (0.00 sec)
</code>


RENAME
 rename filenames
SYNTAX
 rename 's/PATTERN/NEWPATTERN/g' *.*
EXAMPLE
 Rename all files in directory *_XXXC_M_XX.csv to *_XXXC_C_XX.csv
<code>
$ rename _M_ _C_ *.csv
</code>

PKILL
 Linux logout all other users
 If you would like to logout other users, you must login as root user. Next you need to use the pkill command.
Example
<code>
$ su
Password:
# pkill -KILL -u user
</code>
 
-
Here is a useful example of the useradd command. Why use useradd? It gives a few more options for special cases. 
To add a user, give her a standard home directory in the /home folder and specify the shell she accesses by default do this:

$ sudo useradd username -m -s /bin/bash 
$ sudo passwd username 

-
Changing UID and GID
Example
<code>
usermod -u newuid login    
groupmod -g newgid group
find / -user olduid -exec chown -h newuid {} \;
find / -group oldgid -exec chgrp -h newgid {} \;
usermod -g newgid login
</code>

-
USERMOD
 change user name and his home directory
Example
<code>
# usermod -l login_name old_name 
# #change the name of their home directory by mv command
# #change the name of their home directory in /etc/passwd file
# # or use
# usermod -d /home/user1 -m user
# #move home folder of user user to a new directory /home/user1
</code>

Create a new group and put the existing user into it
Example
<code>
# groupadd newgroup 
# usermod -g newgroup existinguser
# #check the changes
# id existing user
uid=1000(existinguser) gid=1002(newgroup) groups=1002(newgroup),4(adm),24(cdrom),27(sudo)
</code>

-
GRANT SUDO PRIVILEDGES
Example
<code>
$ sudo -v # shows if you have sudo priviledges
Sorry, user [username] may not run sudo on [hostname].
$ #login as a root or administrator or switch to it
$ su
# uname -n #finds the name of the server
afalj45
# visudo #edit sudoers files and add the server you want to have sudo access to for specified users
</code>

-
TR
 substitutes characters
Examples
<code>
$ #replaces one space for one semi-column
$ ls -la | tr ' ' ':'
$ # replaces multiple grouped spaces for one semi-column
$ ls -la |tr -s ' ' ':'
</code>

-
AWK
Examples
<code>
$ #shows only fifth column of ls
$ ls -la | awk '{print $5}'
$ #counts the total size of ls files
$ ls -la | awk '{total+=$5}; END {print total}'
$ #prints the first two fields of the file chapter2 with input fields separated by comma and/or blanks and tabs, and then adds up the first column, and prints the sum and average:
$ cat 
BEGIN  {FS = ",|[ \t]+"}
       {print $1, $2}
       {s += $1}
END    {print "sum is",s,"average is", s/NR }
$ awk -f sum3.awk chapter2
$ #To display the lines of a file that are longer than 72 characters, enter:
$ awk  'length  >72'  chapter1
$ #To display all lines between the words start and stop, including "start" and "stop", enter:
$ awk  '/start/,/stop/'  chapter1
</code>
-
Downloading and creating and installation image on usb
 download os image from torrent or ftp NetBSD-6.0-i386-install.img.gz
 prepare usb, usually mounted on /dev/sdb
 unzip and create
Example
<code>
# gunzip NetBSD-6.0-i386-install.img.gz
# dd if=NetBSD-6.1.5-i386-install.img of=/dev/sdb
1048576+0 records in
1048576+0 records out
536870912 bytes (537 MB) copied, 184,742 s, 2,9 MB/s
</code>
<br>
-
APACHE SERVER
 Install apache
<code>
 apt-get install apache2
</code>
 Restart apache server
<code>
$ sudo /etc/init.d/apache2 stop
$ sudo /etc/init.d/apache2 start
$ # or sudo /etc/init.d/apache2 restart
</code>
 by default directory /var/www contains website that is run by the apache
Modify default profile and access your site
 Dissite default profile
<code>
# cd /etc/apache2
# ls
apache2.conf conf.d envvars magic mods-available mods-enabled ports.conf sites-available sites-enabled
# cd sites-available
# ls
default default-ssl
# a2dissite default
# vi default 
</code>
 edit default to the following format
<img src="images/default.png" position="absolute" alt="default" align="left">
<br clear="left">
<code>
# cd ..
# #leave ports.conf and apache.conf unchanged
# #update new site to apache
# a2ensite default
# service apache2 reload #reloads apache configuration files
# service apache2 restart 
</code>
apache2.conf: This is the main configuration file for the server. 
 Almost all configuration can be done from within this file, although it is recommended 
 to use separate, designated files for simplicity. This file will configure defaults and  
 be the central point of access for the server to read configuration details.
ports.conf: This file is used to specify the ports that virtual hosts should listen on.
 Be sure to check that this file is correct if you are configuring SSL.
conf.d/: This directory is used for controlling specific aspects of the Apache configuration. 
 For example, it is often used to define SSL configuration and default security choices.
sites-available/: This directory contains all of the virtual host files that define different web sites.
 These will establish which content gets served for which requests. 
 These are available configurations, not active configurations.
sites-enabled/: This directory establishes which virtual host definitions are actually being used.
 Usually, this directory consists of symbolic links to files defined in the "sites-available" directory.
mods-[enabled,available]/: These directories are similar in function to the sites directories, 
 but they define modules that can be optionally loaded instead.
 As you can see, Apache configuration does not take place in a single monolithic file,
 but instead happens through a modular design where new files can be added and modified as needed.
<br>
PORT FORWARDING
Oracle VirtualBox Manager -> System -> Settings ->Network
Adapter 1
Attached to NAT
Advanced
Adapter Type ...
Adapter Mode ...
MAC Address ...
checked Cable Connected
Port Forwarding
Name   Protocol   Host IP   Host Port   Guest IP   Guest Port
http   TCP       127.0.0.1  24          10.0.2.15  80
ssh    TCP       192.168.3  55          10.0.2.15  22
VM port forwarding
 access local host to vm guest machine via http protocol
 guest machine has nat network, ip address 10.0.2.15
<code>
$ cat /etc/network/interface
auto lo
iface lo inet loopback

auto eth0
iface eth0 inet dhcp
</code>
 guest machine nat address is 10.0.2.15
 Access site in your browser via http://localhost or 127.0.0.1.
Access your webserver via public ip address
 Portforwarding router
  Network -> NAT
   # Active Service Name Start Port End Port PortTranslation Server IP Address 
     checked port_55     55         55                       192.168.3       
Port forwarding in linux
The most used way 
<code>
# cat /proc/sys/net/ipv4/ip_forward
# #if the output is 1, it is enabled if 0, then it is disabled
# echo 1 > /proc/sys/net/ipv4/ip_forward
</code>
Use sysctl
 let's you change Kernel values on the fly, so you can use it, 
 to change the IP forward behaviour of your Linux.
 First, let's check if it is enabled or disabled, as root run
<code>
# sysctl -a |grep net.ipv4.ip_forward
</code>
Now you can set its value to 1, to enable ip forwarding.
<code>
# sysctl -w net.ipv4.ip_forward=1
</code>
This is all temporary, if you want to be permanent, you can edit the
file /etc/sysctl.conf and modify or add this line 
<code>
net.ipv4.ip_forward = 1
</code>
Now let Linux load the changes you have made.
<code>
# sysctl -p
</code>
This works for Ubuntu, Debian, Fedora, Slackware or any other Linux 
distribution
Website to check open ports:
 http://www.t1shopper.com/tools/port-scan/
Get your public ip address:
<code>
$ curl ifconfig.me
 85.92.6.79
$ curl ipecho.net/plain
 85.92.6.79
</code>
And now you can access your server via ssh
<code>
$ ssh -p 55 user@85.92.6.79
</code>
<br>
-
ALIAS
 creates a shortcut command for a longer command
 shows all aliases on your system
Example
<code>
$ alias
alias egrep='egrep --color=auto'
alias fgrep='fgrep --color=auto'
alias grep='grep --color=auto'
alias l='ls -CF'
alias la='ls -A'
alias ll='ls -alF'
alias ls='ls --color=auto'
</code>
 alias command creates alias for a given session. If you would like to make a permanent alias, you have to edit .bashrc file (e.g. by adding alias cp cp -i)
 On most modern system, you have as root your .bashrc or .profile has an alias of cp to cp -i. This asks you after every copy of a file for your permission
 to copy it. It can be pretty bugging, especially when copying multiple files.
  you can abolish the alias with command unalias cp for the current session
  or you you can prefix the command with \ as e.g. \whatever
<code>
# \cp file /home/folder/
</code>
<br>
ALSAMIXER
 interactive sound management
Example
<code>
$ alsamixer
</code>
Output
<img src="images/alsamixer.png" position="absolute" alt="Alsamixer" align="left">
<br clear="left">
<br>
-
SD CARD mounting
Example
<code>
$ sudo fdisk -l #lists of drives that pop up. You have to figure out which you want to mount
Partition 1 does not start on physical sector boundary.
luxm@luxm-pc:~$ sudo fdisk -l
WARNING: GPT (GUID Partition Table) detected on '/dev/sda'! The util fdisk doesn't support GPT. Use GNU Parted.


Disk /dev/sda: 500.1 GB, 500107862016 bytes
255 heads, 63 sectors/track, 60801 cylinders, total 976773168 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 4096 bytes
I/O size (minimum/optimal): 4096 bytes / 4096 bytes
Disk identifier: 0x52891ca4

   Device Boot      Start         End      Blocks   Id  System
/dev/sda1               1   976773167   488386583+  ee  GPT
Partition 1 does not start on physical sector boundary.

Disk /dev/sdg: 3931 MB, 3931111424 bytes
121 heads, 62 sectors/track, 1023 cylinders, total 7677952 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk identifier: 0x6f20736b

This doesn't look like a partition table
Probably you selected the wrong device.

   Device Boot      Start         End      Blocks   Id  System
/dev/sdg1   ?   778135908  1919645538   570754815+  72  Unknown
/dev/sdg2   ?   168689522  2104717761   968014120   65  Novell Netware 386
/dev/sdg3   ?  1869881465  3805909656   968014096   79  Unknown
/dev/sdg4   ?  2885681152  2885736650       27749+   d  Unknown

Partition table entries are not in disk order
$ sudo mount /dev/&#60;id of your card&#62;
$ #...
$ sudo umount /dev/&#60;id of your card&#62;
</code>

-
FIND
 searches files in the specified directory
Syntax
 find &#60;dir&#62; -name &#60;file&#62;
Parameters
 dir =directory to be searched
 -name =name of pattern to search for
 -inum =inode of searched file
 -mtime n =older than n days
 -mmin +/-n =modified more/less n minutes ago
 -cmin +/-n =changed more/less n minutes ago
 -amin +/-n =accessed more/less n minutes ago
 -maxdepth n =maximal recursive depth n to be searched in the current directory
 -size +/-n =bigger/smaller files 
Example
<code>
$ find . -name file -type f -mtime +26 -maxdepth 1
$ #search in the current directory an ordinary file older 
$ #than 26 days but exclude all subdirectories during search
$ #find older files that a given date in the current directory
$ find . -not -newermt 2010-01-01
$ #find older than 1 minute and newer than 60 minutes
$ find . -mtime +1 -mtime -59 -exec ls -la {} \;
$ #find files older than 240 min newer than 300 min and print their sum
$ find . -mmin +240 -mmin -300 -exec ls -la {} \; | awk '{total += $5} END {print total}'
$ #find files that are bigger than 30M or 30000K
$ find . -size +30000k -exec ls -la {} \;
$ #find files that are smaller than 40M and bigger than 30M and print their count
$ find . -size +30000k -size -40000k -exec ls -la {} \; | wc -l
</code>
On some systems, AIX, Solaris, maxdepth is not implemented,
therefore: 
Prune option =is an action like -print not a test like -name
 it alters the "to-do" list, but always returns true
Syntax
 find &#60;path&#62; &#60;conditions to prune&#62; -prune -o \
                            &#60;your usual conditions&#62; &#60;actions to perform&#62;
  You pretty much always want the -o immediately after -prune, 
  because that first part of the test (up to including -prune) will return
  false for the stuff you actually want (the stuff you do not want to prune out)
Example
<code>
$ find . -name .snapshot -prune -o -name ".foo" -print
$ # this will find ".foo" files that are not under ".snapshot directories.
$ # In the example, -name .snapshot is the "test for stuff you want to prune",
$ # and -name "*.foo" -print is the stuff, you normally put after the path
</code>
Important notes
 if all you want to do is print the results you might be used to leaving out the -print action. 
 You generally do not want to do that when using -prune
 The default behaviour of find is to "and" the entire expression with the print action if there
 are no actions other than -prune (irronically) at the end. That means
 that writing this
<code>
$ find . -name .snapshot -prune -o -name "*.foo"  # DON'T DO THIS
</code> 
is equivalent to writing this
<code>
$ find . \( -name .snapshot -prune -o -name '*.foo' \) -print # DON'T DO THIS
</code> 
which means it also print out the name of directory you are prunning, which usually is not 
what you want. It is better to explicitelly specify print option.
<code>
$ find . -name .snapshot -prune -o -name '*.foo' -print       # DO THIS
</code>
 If your usual condition happens to match files that also match your prune condition,
 those files will not be included in the output. The way to fix this is to add -type d
 predicate to your prune condition.
Example
 Suppose, we wanted to prune out any directory that started with .git but also we
 wanted to see all files like .gitignore
 If you try this
<code>
$ find . -name ".git*" prune -o -type f -print
$ #this would not include .gitignore in the output. Here is the fixed version
$ find . -type d -name ".git*" -prune -o -type f -print
</code> 
Extra option for find
 -exec =executes commands on files searched by find
Example
<code>
$ find . -name "*.dbf.Z" -mtime +26 -exec mv {} /home/erik/ \;
$ #moves found files with the name ending .dbf.Z older than 26 days
$ #to folder /home/erik/
</code>
<br>
-
LOCK AND UNLOCK SSH LOGIN
 PAM_TALLY2 module is used to lock user accounts after certain number of failed ssh login attempts 
 made to the system. This module keeps the count of attempted accesses and too many failed attempts
How to lock and unlock user accounts
 use /etc/pam.d/password-auth configuration file to configure login attempts accesses.
 open this file and add the following AUTH configuration line to it at beginning of the auth section.
<code>
auth        required      pam_tally2.so  file=/var/log/tallylog deny=3 even_deny_root unlock_time=1200
</code>
 next add the following line to the account section
<code>
 account     required      pam_tally2.so
</code>
Parameters
 file=/var/log/tallylog =default log file is used to keep login counts
 deny=3 =deny access after 3 attempts and lock down user
 even_deny_root =policy is also apply to root user
 unlock_time=1200 =account will be locked till 20 minutes (remove this parameter if you want to lock
 down permanently till manually unlock
Verify or check the counter that user attempts with the following command
<code>
$ pam_tally2 --user=tecmint
Login           Failures  Latest    failure     From
tecmint              5    04/22/13  21:22:37    172.16.16.52
</code>
Reset or unlock the user account to enable access again
<code>
$ pam_tally2 --user=tecmint --reset
Login           Failures  Latest    failure     From
tecmint             5     04/22/13  17:10:42    172.16.16.52
</code>
Verify login attempt is reset or unlocked
<code>
$ pam_tally2 --user=tecmint
Login           Failures   Latest   failure     From
tecmint            0
</code>
<br>
-
COMMAND SUBSTITUTION
$( &#60;COMMANDS&#62; )
` &#60;COMMANDS&#62; `
 the command substitution expands to the output of commands. These commands are executed in a sub-shell, and their  std-out data is what
 the substitution syntax expands to
 all trailing newlines are removed
 in later steps, if not quoted, the results undergo word splitting and pathname expansion. You have to remember that, because the word
 splitting will also remove embedded newlines and other IFS characters and break the results up into several words. Also you probably get
 unexpected pathname matches. If you need literal results, quote the command substitution!
 the second form `COMMAND` is obsolete for Bash. $(COMMAND) is also POSIX!

 when you call an explicit subshell command (COMMAND) inside the command $(), then take care, this way is wrong
<code>
$ $((COMMAND))
</code>
Why? Because it collides with the syntax for arithmetic expansion. You need to separate the command substitution from the inner (COMMAND):
<code>
$ $( (COMMAND) )
</code>
In general you really should only use the form $(), it is escaping neutral, it is nestable, it is also POSIX.
Nesting example
<code>
$ echo `echo \`ls\``
$ echo $(echo $(ls))
</code>
Example parsing
<code>
$ echo "$(ls)"
file1
file2
$ echo $(ls)
file1 file2
$ echo $(echo "$(ls)")
file1.txt file2.txt file3.txt
$ echo "$(echo "$(ls)")"
file1.txt
file2.txt
file3.txt
$ echo $(echo $(ls))
file1.txt file2.txt file3.txt
$ echo $(echo '$(ls)')
$(ls)
</code>
In general, the $() should be preferred method
 clean intuitive syntax, more readable, nestable, inner parsing is separate
Examples
<code>
$ #date
$ DATE="$(date)"
$ #to copy file and get cp error output
$ COPY_OUTPUT="$(cp file.txt /some/where 2>&1)"
</code>

$() preserves the exit status; you just have to use it in a statement that has no status of its own, such as an assignment
<code>
$ output=$(ls) || exit $?
echo $output
</code>
$$ =the process number of the current shell. For shell scripts, this is the process ID under which they are executing
$! =process number of the last background command
<code>
$ echo $$
23110
$ ps -ef |grep 23110
erik     748 23110  0 15:09 pts/0    00:00:00 ps -ef
erik     749 23110  0 15:09 pts/0    00:00:00 grep 23110
erik   23110 23109  0 14:58 pts/0    00:00:00 -csh
$
$
$ tail -f logfile.log &
logs into ...
logs into ..
logs into ..
$ echo $!
3613
$ ps -ef |grep 3613
erik    3613 23110  0 15:14 pts/0    00:00:00 tail -f ceqhkeax.chk
erik    3723 23110  0 15:14 pts/0    00:00:00 grep 3613
</code>
<br> 
-
VARIABLES SUBSTITUTION
 ${var}	=substitutes the value of var
 ${var:-word} =if var is null or unset, word is substituted for var. The value of var does not change
 ${var:=word} =if var is null or unset, var is set to the value of word
 ${var:?message} =if var is null or unset, message is printed to standard error. This checks that variables are set correctly
 ${var:+word} =if var is set, word is substituted for var. The value of var does not change
Example
<code>
$ echo ${var:-"Variable is not set"}
$ echo "1 - Value of var is ${var}"
Variable is not set
1 - Value of var is
$
$ echo ${var:="Variable is not set"}
$ echo "2 - Value of var is ${var}"
Variable is not set
2 - Value of var is Variable is not set
$
$ unset var
$ echo ${var:+"This is default value"}
$ echo "3 - Value of var is $var"

3 - Value of var is
$
$ var="Prefix"
$ echo ${var:+"This is default value"}
$ echo "4 - Value of var is $var"
This is default value
4 - Value of var is Prefix
$
$ echo ${var:?"Print this message"}
$ echo "5 - Value of var is ${var}"
Prefix
5 - Value of var is Prefix
$
</code>
<br>
-
WILDCARDS
 whenever you are not sure about the name of the file, you want to search them, 
 copy them or delete them based on some knowledge you have on their file names, 
 wildcards become very handy.  there are three types:
 * represents any sequence of characters
<code>
$ cat file* #finds all files that begin with letter sequence
$ ls *pdf #lists all files having 'pdf' in them
$ ls *.pdf #lists all files having 'gif' extension
$ ls *file* #lists all files that have the letters 'file' anywhere in them
$ ls .*txt* #lists all files in the given directory that have 'txt' in them
</code>
 ? represents any character which can be any character
<code>
$ ls file? #displays a file such as 'file1' and have one more character in their name which can be any one valid character
$ ls ??.txt #lists files in the current directory which have two characters before their extension
$ ls *.??? lists all the files in the current directory that have a file extension of 3 characters in length. Thus files having 
$ #extensions such as .gif, .jpg, .txt are listed
</code>
 [] Brackets Wildcard
  represents a range of characters
<code>
$ ls file[0-4] #displays all files 'file' with a given range
$              #Possible ranges are [0-9], [a-g], [F-Z]
$              #Remember that linux file names are case sensitive
$ ls [a-d,A-D]*.txt #lists all the files having the letters a,b,c,d,a,B,C or D. 
$                   #The [  ,] indicates that this entire range indicates ONLY ONE letter, and that letter can be from either a to d or from A to D.
$ ls file[0-9][0-9] #specifies the range for 2 characters in the filenames
</code>
<br>
"" (DOUBLE QUOTES)
 whenever you use the double quotes, the shell supresses the file name expansion.
<code>
$ ls "*c" #searches for a file named 'c*' because double quotes suppress shell expansion
</code>
` (BACK QUOTE)
 command substitution
 The ` character indicates the command substitution is required whenever it is used. Hence whenever ` is used,
 whatever part of command is enclosed by these back quotes would be executed (as if it was the only command) 
 and then the result of the command would be substituted in the original shell command that you typed
Example
<code>
$ echo "The contents of the directory are" `ls -l` > dir.txt
$ # The above command executes 'ls -l' part first and then substitute the result after 
 the string "The contents of this directory are " and both of these together (directory listing + string) are
$ #written to the file named dir.txt
</code>
' (APOSTROPHE)
 disables all kinds of transformations or modifications. It considers whatever is enclosed in the ' marks as a single entity,
 i.e. a single parameter. Absolutely no sort of substitution or expansion takes
 place
<code>
$ echo '$HOME' #writes $HOME
$ echo `$HOME` #writes error stating that the command was not found, since in this case, 
$              #$HOME is substituted with the path to your home directory and the shell tries to execute the path as such. It
$              # searches for the programed named '/home/erik'.
$              # remember that the back quotes cause it to consider the part within the quotes to be considered as separate 
$              #command and the output of this command is substituted here
$ echo "$HOME" #gets the expected output
</code>
<br>
-
Sending compressed tar fire via mail command unix
Example
<code>
$ tar -cvf cure.tar.gz cure/
$ uuencode cure.tar.gz cure.tar.gz | mail -s "Sending tar file" eeerik9.net16.net@gmail.com
</code>
<br>
-
Downloading the entire web page for offline viewing with wget
WGET
 downloads the Web site
 --recursive =downloads the entire Web site
 --domains website.org =doesn't follow links outside website.org
 --no-parent =doesn't follow links outside the directory tutorials/html/
 --page-requisites =gets all the elements that compose the page (images, CSS and so on)
 --html-extension =save files with the .html extension
 --convert-links =convers links so that they work locally, off-line.
 --restrict-file-names=windows =modifies filenames so that they will work in Windows as well.
 --no-clobber =doesn't overwrite any existing files (used in case the download is interrupted and resumed).
 --wait=20 and --limit-reate=20K =pauses between retrievals, makes sure you are not added to the back list
 -U tells the site about the browser

Example
<code>
$ wget --wait=20 --limit-rate=20K -r -p -U Mozilla www.eeerik9.net16.net
</code>
<br>
-
Taking screenshots from the terminal
GNOME-SCREENSHOT
 -w =window
 -a =grab area
 -b =window without borders
 -d sec =delay
 !d and a are conflicting while you choose area interactively
 --interactive =does it interactive, not interactive does not work
Example
<code>
$ sudo apt-get install gnome-screenshot
...
$ gnome-screenshot -a --interactive
</code>
<br>
-
Editing files remotely with ftp via vim
Example
<code>
$ vim
$ #in command mode
:e ftp://eeerik9@eeerik9.bplaced.net/public_html/blog.php
passwort: *****
$ #Cool stuff, not only it works, you can edit any file you want
</code>
<br>
-
Editing files with vi editor
VI 
 starts vi
 vi file =edits file
 vi +LineNumber file opens file and goes to the line
 vi +/searchTerm file opens file on the particular search pattern 
 i =inserts mode enables writing
 ESC =exits insert mode and goes to command mode
 :q gets out of vi editor
 :q! gets out of vi editor (force quit, without saving, ignores changes)
 :wq gets out of vi and save the changes (w is used for save)
 :w filename saves unnamed file as filename
 :123&#60;CR&#62; gets to the line (CR = carriage return)
 Inser mode
  h left
  j down
  k up
  l right
  x deletes current char
  56x deletes 56 character on the right
  X backspaces
  56X backspaces 56 character on the left
  dw delete a word on the right
  5dw deletes 5 words on the right
  dd deletes line
  d0 deletes all characters to the start of line
  d$ deletes all characters to the end of line
  dG deletes from cursor to the end of document
  d1G deletes from cursor to the beginning of document
  
  u one step back
 Command mode
  :number goes to the line number
  :set number shows numbering of lines
  :sets nonumber cancel numbering of lines
  G goes to the end of document
  #G goes to the line with number #
  GG goes to the first line
  I goes to the start of line in insert mode
  $ goes to the end of line
  o opens new line under actual line and puts you in insert mode
  O opens insert mode above the current line
  YY copies the line
  p pastes the line in the new line after
  P pastes the line in the new line before
  /"string" searches for pattern string
  n next occurence of searched patter
  N previous occurence of searched patter
  W goes to the next word
  e goes to the next word end
  2e goes to the second word end
  B goes to the previous word
  Ctrl-b goes full pageup
  Ctrl-f goes full pagedown
  r brings you to the insert mode and reverse one character
  R replaces all characters until you push ESC
<br>
Using VI to edit to files in split screen
 First go ahead and edit a file with VI
<code>
$ vi file
</code>
 While in vi enter the following
<code>
$ :new
</code>
 This will open a new split screen session, in order to navigate between the two windows in VI do the 
following:
<code>
&#60;ctrl-w&#62;
j
</code>
 or
<code>
&#60;ctrl-w&#62;
k
</code>
 Using the first will move you to the lower window and using the latter will move you to the upper window.
To make one of the windows full screen and out of the dual screen mode use the following
<code>
:only
</code>
 Important Side Notes
  If you used :new and opened up a new window session it will not have a name so you cannot save it without entering the following
<code>
:wq mynewfile.txt
</code>
  Also if you want to open a file in split screen mode that is not new and exists you can enter the following
<code>
:new /path/to/myfile
</code>
Using vi macros
 To enter a macro, type:
  q&#60;letter&#62;&#60;commands&#62;q
 To execute the macro &#60;number&#62; times (once by default), type:
  &#60;number&#62;@&#60;letter&#62;
 So, the complete process looks like:
  qd	start recording to register d
  ...	your complex series of commands
  q	stop recording
  3@d	execute your macro
  @@	execute your macro again
 
Happy editing!
-

Jobs on background and foreground
Example
<code>
$ tail -f file & #goes on background jobs 
</code>
JOBS sees background jobs
FG &#60;number&#62;
 puts a background job identified by number to foreground
 Ctrl-z end of input
BG &#60;number&#62;
 puts job of number back to background
Example
<code>
$ tail -f filename &
$ jobs
[1] tail -f filename
$ fg 1
$ Ctrl-Z
$ bf 1
</code>
<br>
NOHUP &#60;program&#62; &
 The program run under nohup runs also after you close the terminal, but it is not your job any more, therefore
 you will not find it by jobs. However, you have to look for it by ps -ef |grep tail
<br>
-
In the shell, && and ; are similar in that they both can be used to terminate commands. 
The difference is && is also a conditional operator. With ; the following command is always executed, 
but with && the later command is only executed if the first succeeds.

false; echo "yes"   # prints "yes"
true; echo "yes"    # prints "yes"
false && echo "yes" # does not echo
true && echo "yes"  # prints "yes"
<br>
-
Basics of linux processes
In computing, a process is an instance of a computer program that is being executed. It contains the program, and its current
activity (stack, variables,..)
TOP/TOPAS
 The top program (windows: task manager) provides a dynamic real-time view of a running system. It can display system summary 
 information as well as a list of tasks currently being managed by the linux kernel
 processes are sorted by top processing on processor
 q quit
 h help
Output
<img src="images/top.png" position="absolute" alt="Manual pages" align="left">
<br clear="left">
 cpu is busy on 0.2% it is 100 - 99.8 idle
 system starts to swap when RAM runs out
 if swap is full the system shuts down
Example
<code>
$ top
</code>
<br>
NMON 
 monitors processes or cpu
 when ram runs out you go into nmon or top
 Columns
 PID USER      PR  NI    VIRT    RES    SHR S  %CPU %MEM     TIME+ COMMAND        
 PID =process id
 USER who runs the process
 PR priority
 %CPU how much cpu does process take
 %MEM how much mem does process eat
 COMMAND name of the process
 fully interactive
 c =cpu
 m =memory
 n =network
 d =disk
Output
<img src="images/nmon.png" position="absolute" alt="Manual pages" align="left">
<br clear="left">
PS
 shows all processes
 ps -ef =shows all processes (options on linux)
 ps -ef |grep firefox =filters only firefox process
 Columns
 UID PID PPID CMD
 UID user id
 PID process id
 PPID parent process id
 CMD the name of the process
 ps -ef |grep PPID =searches for the parent process
 If you kill parent process, all children and their children are killed !watch out
KILL &#60;pid&#62;
 kills process
Example 
<code>
$ kill -9 pid #kill kill process =it halts it
</code>

<br>
-
Add user or group
USERADD &#60;newuser&#62;
GROUPADD &#60;newgroup&#62;
<br>
Changing group and owner
CHGRP &#60;newgroupname&#62; &#60;folder or file&#62;
 chgrp -R &#60;newgroupname&#62; &#60;folder&#62; =does it recursively for the whole directory
CHOWN &#60;newowner&#62; &#60;folder or file&#62;
 chown can change the owner and the group of file at once
Example
<code>
chown -R root:system folder #changes the owner of folder recursively to root and the group to system if not already set the same
</code>
<br>
-
PERMISSIONS for files and directories
 CHMOD &#60;perm type&#62; &#60;file&#62;
 7 = 4+2+1
 4 Read
 2 Write
 1 Execute
 Example
<code>
$ chmod 777 file.txt
$ chmod +r file #adds read permission to file for all user, group and others
$ chmod +w file #adds write permission to filename for all user, group, others
$ chmod +x file #adds execute permissions to file for all user, group and others
$ chmod u=+x file #adds execute permission only for user
$ chmod -R 777 file #recursively changes permissions for the whole folder
</code>
<br>
Example
<code>
$ #from drwxrwxr-x
$ #to d d-w-rw--wx
$ chmod u-rx,g-x,o-r,o+w exercise
</code>
<br>
-
EJECT
 opens CD-ROM
<br>
-
PING &#60;ip or hostname&#62;
 finds out if the computer is up, if the network is up, if the cabal is connected
IFCONFIG
 lists information about my network card
 sets ip address and set netmask
 -a =lists all information about my network card
 windows: ipconfig /o
TELNET &#60;IP or hostname&#62;
  the most common thing to do with telnet is to test ports
Example
<code>
$ telnet user
$ # finds out information about user + their email address
</code>
<br>
SSH &#60;user&#62;@&#60;IP or hostname&#62; &#60;port&#62;
 logins to remote computer
Example
<code>
ssh admin@192.168.1.1
</code>
<br>
-
Basics of networking
IP ADDRESS
 is a numerical value assigned to each device (e.g. computer printer) participating in a computer network that uses the internet protocol
HOSTNAME
 is a label that is assigned to a device connected to a computer network and that is used to identify the device in various
 forms of electronic communication such as the WWW, email, .. Hostnames may be simple names consisting of a single word or phrase,
 or they may have appended the name of a Domain Name Server (DNS) domain, separated by the host specific label by a period
 is a DNS server code of your ip address
 /etc/hostnames =file including your hostnames
FIREWALL
 is usually a computer that sites on two different networks and passes allowed traffic between different companies
 Example
<code>
$ vi /etc/sysconfig/iptables
</code>
<br>
-
SCP
Syntax
scp &#60;source&#62; GZIP &#60;target&#62;
 -p =preserves modification time, access time and modes for original file
 -P =specifies a port
 -r =recursively copies directories.
 scp follows symbolic links encountered in the traversal
<br>
-
RSYNC
 fast, versatile, remote (and local) file-copying tool
 -z =compresses the file data as it is sent to the destination machine, which reduces the amount of data
 --verbose =increases the amount of information you are given during the transfer. By default, rsync works silently
 -v =gives information about files files being transferred and a brief summary at the end
 -a --archive =is a quick way to say you want a recursion and want to preserve almost everything
Syntax
rsync -avz --progress &#60;source&#62; GZIP &#60;target&#62;
Example
<code>
$ rsync -avz erik@host:~/Desktop/files /home/erik/Desktop
$ #erik is user
$ #host = 192.168.1.1 or ip6 = the machine
$ #~/Desktop/files = source which is to be transferred
$ #/home/erik/Desktop = target directory
$ # could be written as 192.168.1.1:~/Desktop/files /home/erik/Desktop
</code>
<br>
-
Links
!files not processes
Inode is a unique identification number of file
 ls -il #lists inodes
LN -s &#60;target&#62; GZIP &#60;link&#62;
 creates soft links
LN &#60;target#62; GZIP &#60;link&#62;
 creates soft links
There are two types of links, both of which are created by ln
1. symbolic link, which refer to a symbolic path indicating the abstract location of another file
 links in windows are symbolic links
 symbolic link in linux is lrwxrwxrwx is a special type (l=link) containing the path to the file it points to e.g lenovo ->/home/admin/pebenedi/lenovo_temp
 if you open symbolic link, you get the target of the symbolic link that means the target file which is pointed to by the link
 if you delete the target file.. when opening symbolic link with vi editor, it creates a new file
 symbolic link has a different inode as target
2. hard links, which refer to the specified location of the physical data
 -rwxrwxrwx.  2 tux  tux   370319 Jun 13  2012 myHLink
 the number 2 indicates that there are two files with the same inode on the disk and they are connected
 if you modify the one, the other gets modified
 if you delete the one, the second remains the same as before
Example
<code>
ls -li #list files according to inodes
find . -inum 370319 #find files according to inode  
-rwxrwxrwx.  1 tux  tux   370319 Jun 13  2012 myHLink
</code>
<br>
-
Archives and archiving
TAR -cvf &#60;archive.tar&#62; &#60;target directory of files&#62;
 packs the files in the target directory into archive.tar, but files remain on the filesystem
 why do we create a packet of files without comprimation? To create one packet of folder, because you cannot zip folder
 so you tar folder and then zip it
 -c =creates a new archive
 -v lists the name of each file as the tar is processed
 -f uses archive.tar to be read or written
 -x extracts the files specified from the archive
 --remove_files =works like gzip, in a way that it removes the files after packing
Examples
<code>
$ tar -tvf archive.tar #shows the archive content
$ tar -uvf archive.tar test_file #adds test_file to archive.tar
$ tar -cvf files.tar file1.txt file2.txt file3.txt
$ tar -xvf files.tar #extracts files
</code>
<br>
GZIP &#60;compression rate&#62; &#60;file&#62;
GUNZIP &#60;file&#62;
 compresses and decomresses files
 gzip reduces the size of the named files 
Example
<code>
 gzip -9 archive.tar #takes longer time but the packet folder will be smaller
 gzip -1 archive.tar #takes shorter time but the packet folder will be bigger
</code>
 if you zip something big, it is important to use nohup gzip ... &, in case of down session archive.tar is deleted
<code>
$ gzip -9 -S ".Z9" archive.tar #creates different archive that usual archive.tar.gz -> archive.tar.Z9
$ gunzip archive.tar.Z9 #decompresses the gzip file to archive.tar
</code>
<br>
-
CRONTAB/CRON
 time based job scheduler in unix-like computer operating systems. Crontab enables users to schedule jobs (commands or shell
 scripts) to run periodically at certain times or dates. It is commonly used to automate system maintenance or administration
 Each user has its own cron table
 crontab -l =lists the user's crontab file
 crontab -e =edits a copy of the user's crontab file or creates an empty fiel to edit if the crontab file does not exist for a valid username
 when editing is complete, the file is copied into the crontab directory as the user's crontab file.
 Example
<code>
#Create a new job in crontab, which will print to your wall word "Hello!" every 5 minutes on thursdays
$ crontab -l lists
$ crontab -e #opens vi editor and write down
*/5 * * * 4 echo 'Hello!'|wall
#to disable crontab insert # before the command line #*/5 * * * 4 echo 'Hello!'|wall
</code>  
* * * * * command to be executed
5 4 3 2 1
1* day of week (0-6) is sunday, or use names
2* month (1-12)
3* day of month (1-12)
4* hour (0-23)
5* min (0-59)
* parameter symbolises every minute every hour etc.
 5 * * * * * date
  date runs in **:*5 every day every month every day of the month
 0 1 * * 0 /usr/sap/backup.sh 01:00 on sunday every day in month, every month
 30 11 5 3 6 11:30 the nearest saturday  5.3
 */20 means every 5 minutes but you do not know which minute, therefore you will write it as 0,20,40 * * * * ls
<br>
-
RMDIR CP &#60;dir&#62;
 removes directory only if it is empty
 rm -r =recursively removes dir subdirectories
 rm -rf =force to delete 
<code>
$ rm -rf *
</code> 
MKDIR &#60;dir&#62;
<br>
-
MV &#60;source&#62; &#60;target&#62;
 moves files and directories from one directory to another or renames a file or a directory. 
 mv always works recursively
<code>
$ mv file1 file2 #renames file1 to file2
$ mv file.txt /home/erik #moves file.txt to desired location and removes the file from the previous location
</code>
<br>
-
CP &#60;source&#62; &#60;target&#62;
 copies the source file to the destination file
 if the target file exists, cp overwrites the contents, but the mode, owner and group associated with it are not changed
 cp -r =copies folder recursively with subfolders
 cp -p =copies with the timestamp and permissions remaining the same
 R r are the same
<code>
$ cp file.txt file.zip file /home/erik #copies more files
$ cp file.txt file.zip #rename files
</code> 
<br>
-
MOVEMENT IN SHELLS
There is a good page: <a target="_blank" href="http://mamchenkov.net/wordpress/2010/08/05/shell-keyboard-shortcuts/"> http://mamchenkov.net/wordpress/2010/08/05/shell-keyboard-shortcuts/</a>
MOVEMENT IN BASH SHELL
 Ctrl-p, or Up: previous command 
 Ctrl-n, or Down: next command 
 Ctrl-b, or Left: previous character 
 Ctrl-r, or Right: next character
 Ctrl-a, or Home: begin of command 
 Ctrl-e, or End: end of command 
 Alt-b: previous word 
MOVEMENT in TCSH CSH SHELL 
 ESC b: move to previous word
 ESC f: move to next word
 Ctrl-b: move cursor back one character
 Ctrl-f: move cursor back one character
 Ctrl-a: move cursor to the beginning of line
 Ctrl-e: move cursor to the end of the line
EDITING IN BASH
 BkSpc, or Ctrl-h: delete previous character 
 Ctrl-d, or Del: delete current character, character under cursor
 Alt-BkSpc: delete word left
 Alt-d: delete word right
 Ctrl-u: detete to start of command
 Ctrl-k delete to end fo command
EDITING IN CSH TCSH
 Del or Ctrl-H: deletes previous character
 Ctrl-d: deletes character under cursor
 ESC d: deletes word
 Ctrl-k: detetes from cursor to the end of line
 Ctrl-u: deletes entire line
MISCELLANEA IN BASH
 Ctrl-/: undo
HINTS IN BASH
 Ctrl-c: cancels command and goes to another line
 Tab: auto-completion 
HINTS IN CSH
 Ctrl-c cancels command and goes to another line
 Alt-?: auto-completion of comamnds
<code>
$ adkal;^c
</code>
<br>
 When you double click on something you select it, and then you paste it with the middle roller of the mouse at the current position
HISTORY shows history of commands
<code>
$ history 4 #shows 4 commands in history
$ !4 #runs the command numbered 4 from history view
</code>
<br>
-
GREP "pattern" &#60;file&#62; searches for the pattern specified by the Pattern parameter and writes each matching line to standard output
 filter
 grep -i usr=ignores in case of case-sensitive matches, e.g. error messages in error logs, finds usr, Usr, etc.
 grep -r text =search for desired expressions recursive in all subdirectories
 grep -v =verboses, shows only non-matching lines
<code>
$ grep 1300 /etc/services
$ grep shm_psize * #applies grep to all files in the directory
</code> 

-
WC count words
 wc -n =count chars
 wc -L =max line length
 wc -l =count lines
| Pipe redirects the standard output of one program to standard input of another program
<code>
$ cat /etc/services | grep 1300 !do not use, grep is better
</code>
<br>
-
Creating and viewing files
 TOUCH &#60;file&#62; creates an empty file, change timestamp
  touch file1 file2 file3 changes empty files ..
  touch existing_file updates access time=timestamp
 CAT &#60;file&#62; displays the whole file at once
 MORE &#60;file&#62; displays file contents one screen at the time
 LESS &#60;file&#62; same as more
  you leave more or less with /q/, file opened in a editing window
  /space/ go down
  /u/ go up
  /// search
  /n/ next match pattern
  /N/ previous match pattern
  /?/ search the pattern for the previous occurence
  G end of the file
 HEAD &#60;file&#62; displays the first ten rows of the file
  head -1 &#60;file&#62; displays the first row of the file
 TAIL &#60;file&#62; displays the last ten rows of the file
  tail -f &#60;file&#62; =tail does not terminate after the last specified unit of the input file has been copied, but continues to read and copy additional units from the input file as they become available
  tail -100 -f install.log always displays last 100 rpws when the file is getting in size realtime, always update the screen
 ECHO writes a given string
  echo "ahoj" wirtes ahoj on the standard output
  echo "ahoj" > file writes ahoj to the file, but rewrite the file
  echo "ahoj" >> file appends to the existing file
<br>
-
Setting enviroment
ENV/PRINTENV list all enviroment for the current user
 enviroment variable is a named object that contains data used by one or more applications
 example of variable from the enviroment
  HOME=/home/&#60;username&#62 =you change the value of the enviroment varaible until we logout, there is also a command for a permanent change
<BR>
-
UNAME information about physical machine
 uname -a shows all available information about machine
 uname -i shows version of linux 32bit/64bit
DATE lists current time and date
TOP/TOPAS displays resource usage like task management
 displays the processes that are the most busy or top working on the system
WHO who is currently logged on the system
WHOAMI shows the name of the current user
FINGER information about logged on users + their email address
LAST check if there was not anyone on the system recently
<BR>
-
DU disk usage summarize how much disk space  does the folder takes on disk
 du -sh .
  s displays only total size
  h human readable
  . is the current folder
  * is alias for ls  

DF <path> basic command to work with a filesystem
 df =information about space on file systems
 df -h works on linux
 df -q works in aix
 df -m shows usage in megabytes
 df -k shows usage in kilobytes
 df -h . displays information about my . in h (human readable form. 
         It is on my mountpoint where is all my disk.
         information about the disk where the current folder is located
<code>
$ df -h .
... (todo)
</code>
20150408,08:49pm
SU - <username> switches to a different user username
 su root =switches the current user to root
 after switch from user to root current working directory of user switches to the home folder of the root
 /root is a home directory of root user - it is a different directory from home folder of erik user /home/erik
 logout|exit|ctrl -d logout from the root user
SUDO <command> allows users to run programs with the security privileges of another user (normally root)
 sudoers privileges can be editted by
<code>
sudo visudo
</code>
 sudo -l =shows what is allowed by sudo
 root can do anything with files what they want, rights do not concern root
 su - root =you can normally access to root
 sudo su root =you can normally access root you only need to know your password (should be allowed in sudoers)
when you are signed as root - means /root home folder
when you are signed as erik - means /home/erik home folder
<br>
20150408,08:36pm
SCROT snapshot from command line
 scrot -q 85 quality of snapshot
 scrot -d 5 delayed time of snapshot
<code>
$ sudo apt-get install scrot
$ sudo apt-get install gimp
$ scrot -q 85 -d 2 manman.png && nohup gimp manman.png &
</code>
<br>
20150408,07:46pm
PWD print working directory
<code>
$ pwd
$ /home/erik
</code>
CD change directory
 cd | cd ~ | cd $HOME =switches to your home directory
 cd .. =moves you up one directory
 cd <directory> =switches you to the desired directory
 cd . =changes directory to the position where you are
Relative path you always have to look where you are, what you want to do and act appropriatelly
Absolute path always defines the full path to a program or a file and always starts with /

<br>
20150408,07:13pm
Root is a superuser
 or it is the home folder of this superuser /root
 or it is a / root directory
Address structure /
 /bin user binaries
 /etc configuration files
 /home user home folders /home/erik
 /usr programs e.g. /usr/bin/..
Commands
MAN manual
<code>
$ man man
</code>
Output
<img src="images/manman.png" position="absolute" alt="Manual pages" align="left"><br clear="left">
<br clear="left">
20150408,03:30pm
Inode is a unique identifier of number of files on the disk

Example
<code>
Inode,rights, number of links, user that owns the file, the group, size, access, name of the file
type user group others owner group
d    rwx  ---   ---    root   system
d Directory r owner=root can read, 
            w owner=root can write, change
            x !owner=root can cd to this directory, if is missing you cannot access the directory
</code>
LS list what is in the current folder
 ls -a=all including hidden files
 ls -l=long list of attributes of entries
 ls -i=inode numbers
 ls -t=list of files sorted by modification time
 ls -u=list of files sorted access time
 ls -rt=list of files sorted by time in a reversed order
 ls -S=list of files with their size
<code>
$ ls -ali 
261709 drwxr-xrw- 2 root erik 4096 Feb 20 15:42
</code>
<br>
20150408,01:10pm
Starting a blog about examples in linux and unix...
</pre>						