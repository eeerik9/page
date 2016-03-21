<pre>
-
TASKMANAGER
 starts task manager
Microsoft Windows [Version 6.1.7601]
Copyright (c) 2009 Microsoft Corporation.  All rights reserved.

C:\Users\user>taskmgr

C:\Users\user>

-
IPCONFIG
 shows network configurations
Example
<code>
C:\> ipconfig /all
Windows IP Configuration

   Host Name . . . . . . . . . . . . : myhome
   Primary Dns Suffix  . . . . . . . : myhome.com
   Node Type . . . . . . . . . . . . : Hybrid
   IP Routing Enabled. . . . . . . . : No
   WINS Proxy Enabled. . . . . . . . : No
   DNS Suffix Search List. . . . . . : myhome.com

Ethernet adapter Local Area Connection* 11:

   Media State . . . . . . . . . . . : Media disconnected
   Connection-specific DNS Suffix  . :
   Description . . . . . . . . . . . : Check Point Virtual Network Adapter For S
SL Network Extender
   Physical Address. . . . . . . . . : 54-72-91-5D-C6-12
   DHCP Enabled. . . . . . . . . . . : Yes
   Autoconfiguration Enabled . . . . : Yes

Ethernet adapter Local Area Connection* 14:

   Media State . . . . . . . . . . . : Media disconnected
   Connection-specific DNS Suffix  . :
   Description . . . . . . . . . . . : Check Point Virtual Network Adapter For S
ecureClient
   Physical Address. . . . . . . . . : 55-50-6D-B8-EA-32
   DHCP Enabled. . . . . . . . . . . : Yes
   Autoconfiguration Enabled . . . . : Yes

Ethernet adapter Bluetooth Network Connection 3:

   Media State . . . . . . . . . . . : Media disconnected
   Connection-specific DNS Suffix  . :
   Description . . . . . . . . . . . : Bluetooth Device (Personal Area Network)
#3
   Physical Address. . . . . . . . . : E0-06-E6-B9-84-19
   DHCP Enabled. . . . . . . . . . . : Yes
   Autoconfiguration Enabled . . . . : Yes

Ethernet adapter Local Area Connection 2:

   Connection-specific DNS Suffix  . : myhome.com
   Description . . . . . . . . . . . : Intel(R) 82579LM Gigabit Network Connection
on #2
   Physical Address. . . . . . . . . : 3C-97-0E-22-AF-AC
   DHCP Enabled. . . . . . . . . . . : Yes
   Autoconfiguration Enabled . . . . : Yes
   IPv4 Address. . . . . . . . . . . : 10.233.126.81(Preferred)
   Subnet Mask . . . . . . . . . . . : 255.255.254.0
   Lease Obtained. . . . . . . . . . : 30. apríla 2015 08:01:26
   Lease Expires . . . . . . . . . . : 30. apríla 2015 20:01:26
   Default Gateway . . . . . . . . . : 10.233.127.254
   DHCP Server . . . . . . . . . . . : 10.233.97.187
   DNS Servers . . . . . . . . . . . : 10.233.97.187
                                       10.233.97.149
                                       10.233.97.193
                                       10.233.98.2
   NetBIOS over Tcpip. . . . . . . . : Enabled
</code>

PING
 test connection to host 
 By default, the echo feature is on in MS-DOS-based (and later, Windows) systems when executing a batch file. 
 That means that every command issued in a batch file (and all of its output) would be echoed to the screen. 
 By issuing, the ‘echo off’ command, this feature is turned off but as a result of issuing that command, 
 the command itself will still show up on the screen. By including the ‘@’ symbol in ‘@echo off’, 
 it will prevent the ‘echo off’ command from being seen on the screen.
Example
 Script to monitor your connection to a website (example.com) every 15 seconds:
<code>
@Echo off
Echo Logging ping responses, press CTRL-C to stop
:start
 Ping -n 1 example.com | find "TTL=" >>c:\pingtest.txt
 Echo .
 Ping -n 16 127.0.0.1>nul
goto start
</code>

NET USE
 map new disks on the filesystem
Example
 net use &#60;Disk&#62;: \\&#60;host or ip address&#62; /&#60;domain&#62;\&#60;user&#62;
<code>
net use P: \\10.233.97.18\Public    /USER:domain.com\erlux 
</code>

-
CD
 changes directory same as unix
 although change to other disk:
<code>
C:\>H:
H:\>
</code>

-
DIR
 lists files in the current directory
 looks for files
Example
 searching for file with filename
<code>
C:\>cd\
C:\>dir saplogon.ini /s
 Volume in drive C is System
 Volume Serial Number is D472-7F7E

 Directory of C:\Windows

20.04.2015  14:17            43 669 SAPLOGON.INI
               1 File(s)         43 669 bytes

     Total Files Listed:
               1 File(s)         43 669 bytes
               0 Dir(s)   5 624 958 976 bytes free
C:\>dir *.txt /s
 Volume in drive H is FS04_E
 Volume Serial Number is EC6F-33C3

 Directory of H:\

08.04.2015  14:36               469 keepass-todo.txt
               1 File(s)            469 bytes

 Directory of H:\tcom

23.04.2015  14:49                60 active-billing.txt
               1 File(s)             60 bytes

 Directory of H:\tcom\EssentialPIM_4.24

30.01.2011  12:02             5 547 License.txt
03.01.2011  16:11             3 749 Readme.txt
               2 File(s)          9 296 bytes

     Total Files Listed:
               4 File(s)          9 825 bytes
               0 Dir(s)     339 640 320 bytes free

</code>
- 
This is a blog mainly about windows command prompt and the principles that do not change over time.

</pre>