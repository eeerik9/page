<pre>
-
Logical and physical database structure
 Database stores all its tables and indices in files called datafiles (datafile1, datafile2, ..)
 DATAFILE is created before any table is written to it
 datafiles are grouped into a bigger logical structure called TABLESPACES.
 tablespaces are just categorization (tablespace for costumers, tablespace for apples, ..)
  e.g. table red_apples is written in datafile1 and datafile2 and all of it is stored in tablespace1
  e.g. my databases consists of n tablespaces, which consist of datafiles
 oracle distributes space in datafiles and chooses a free one to write in it
 the maximum datafile can be 32GB
 there also exists bigfiles, known for oracle as an alternative to datafiles, and these can have 1TERAB
 SEGMENT are written to datafiles, segment is a general term for table or index
 segments are constructed by extends, segments cannot extend by bytes, only by extends
 extends are based on oracle datablocks which set in os, it depends on filesystem if it understand 4k blocks or 8k block
  e.g. if you lose one file you lose more than one table or could lose one or more tables and it is not easy to
  e.g. if datafile is full, it can be extended to 32GB or you can add new datafile
 oracle can have 1024 datafiles for tablespace
 SCHEMA
  is a owner of database tables
  e.g. one database with two owners
  e.g. a user can log into database via two database users under different schemas (HRschema =employees table, SAPschema =employees table (different))
 Illustration
<img src="images/oracle_structure.png" position="absolute" alt="Oracle logical physical structure" align="left">
LOGICAL
 Database
 Schema
 Tablespae
 Segment - Table/Index
 Extent
 Data block
PHYSICAL
 Datafile
 Disk block
<br clear ="left">
-
Tree structure of oracle database in SAP
 oracle is installed ...
 folder /oracle/SID/..
 in directory &#60;Release&#62; (&#60;INS_NUM&#62;_64) =are located oracle files (in case of 32 bit architecture _32)
  bin =oracle executables
  dbs or database =oracle profiles  init&#60;DBSID&#62;.ora , spfile&#60;DBSID&#62;.ora (instance configuration parameters)
  Network/admin =listener or client configuration files (listener.ora, tnsnames.ora)
 sapdata1 =datafiles of the tablespaces
 .
 .
 sapdata&#60;n&#62; =datafiles
 origlogA =online redo log files (log_g11m1.dbf, log_g13m1.dbf)
 origlogB =online redo log files
 mirrlogA =online redo log files
 mirrlogB =online redo log files
  online redo log files reside in the directories above
 oraarch =Offline redo log files
 saparch =BRARCHIVE logs (arch&#60;DBSID&#62;.log)
 saptrace
  background =oracle dump files and oracle alert log (alert&#60;DBSID&#62;.log)
  usertrace =trace files of server processes (&#60;DBSID&#62;_ora_&#60;PID&#62;.trc)
 sapbackup =BRBACKUP/BRRESTORE/BRRECOVER
  logs
 sapcheck =BRCONNECT logs
 sapreorg =BRSPACE log, default compression directory
 
<br>
-
Oracle directories and environmental variables
 enviroment is all setings, paths, aliases, address structures for a user
 Example oracle enviroment
  ORACLE_SID=T14
  ORACLE_BASE=/oracle
  ORACLE_HOME=/oracle/T14/102_64
Example
<code>
$ env #displays enviroment variables
$ export &#60;env_variable&#62;=&#60;value&#62; #sets an environmental varaible to requested value
$ setenv &#60;env_variable&#62; &#60;value&#62; #sets an environmental varaible to requested value
$ echo $ORACLE_HOME #displays value of oracle environmental variable
</code>
<br>
-
Oracle relational database
 stores data and their relations
Architecture
 does not change with oracle versions
 SGA =storage global area
  is a part of ram allocated/used by oracle database
  includes several buffers =Database buffer cache, Shared pool, Redo log buffers
   Database buffer cache =cached database data
   Shared pool =sql commands
   Redolog buffer =captures all changes that happen in database
    online redolog disk (the faster the transfer, the quicker the transaction)
    when one online redolog is full, you redirect data to the second one. While data are flowing
    the first online redolog is put to offline redolog disk (in raid or other technologies
 ONLINE REDOLOGS
  is a diskA and its mirrorA. diskB and its mirrorB
   mirrors are exact copies, written to in paralel in case of failure
   when one disk is full, it is switched to the other to free it up
 PROCESSES
  Database Writer Process =writes updates to a database
  Log Writer Process =writes to online redologs
  Archiver Process =archives redologs
  Database Process Monitor =manages processes
  Oracle Shadow Process =every user when logs to a database, creates a shadow process
   shadow processes use multiplexing =always at least two making and switch quickly to handle users
  in linux you can see all the processes in os under ora user using ps -ef |grep ora
  in windows task manager =one process with threads as windows uses threads not processes
 FILES
  pfile =contains data concerning database (size of ram, database parameters)
  control file in 3 copies =all paths to database files. In case of loss of all these control files, it does
   every oracle database has a control file. A control file is a small binary file that records the physical structure
   of the database and includes
    the database name
    names and locations of associated datafiles and online redo log files
    the timestamp of the database creation
    the current log sequence number
    checkpoint information 
    all locations of control files are configured in Oracle profile init&#60;SID&#62;.ora
  not matter if you have data, the database will not be able to read them
 TERMINOLOGY
  instance =all sga buffers and processes
  base =all database in physical files
Users
 USER
  oracle during installation creates its own user ora&#60;sid&#62;
   su - ora&#60;sid&#62; =changes to user
   ps -ef |grep ora&#60;sid&#62; =shows all shadow processes that communicate with you and the database
   if you terminate/close one of connections (a shadow process) another process (dpmon =process monitor) creates
   creates another process as a replacement and cleans the wrong doings
Update
 CHECKPOINT =is set time when oracle tries to write down every table to its disks when users finished writting
  happens each 3 seconds or so, can be set by parameters
  is a signal to store database
 Illustration

<object width="550" height="400">

<param name="logging" value="logging_modifications.swf">

<embed src="images/logging_modifications.swf" width="400" height="350">

</embed>

</object>

Logs
 Terminology
  LOG is a general file containing alerts, messages
  TRACE is a file that belongs to a concreate program
   you trace a database writer (a concrete program)
   you can change the granularity and volume of data for traces 
 Alert Log =contains complete technical information about the database (database switched on/off, any errors etc.)
  it is a text file monitored by patrol
Illustrations
<img src="images/oracle2.png" position="absolute" alt="Oracle structure" align="left">
<br clear="left">
<img src="images/oracle.png" position="absolute" alt="Oracle structure" align="left">
<br clear="left">

<br>
-
Starting a blog about oracle database..
<br>
</pre>