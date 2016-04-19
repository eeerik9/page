<?php
class db {

    private $dbservername_;
    private $dbusername_;
	private $dbpassword_;
    private $dbname_;

    private $conn_;

    function db_set($dbservername, $dbusername, $dbpassword){
            $this->dbservername_ = $dbservername;
            $this->dbusername_ = $dbusername;
            $this->dbpassword_ = $dbpassword;
    }

    function db_connect () {

        // Create connection
    	$this->conn_ = mysql_connect($this->dbservername_, $this->dbusername_, $this->dbpassword_);
        // Check connection
        if (!$this->conn_) {
                var_dump($this->conn_->connect_error);
    		return NULL;
        }
       // echo __FUNCTION__; 
       return $this->conn_;
    }

    function db_change($dbname){
        // echo __FUNCTION__;
        mysql_select_db($dbname, $this->conn_);
        $this->dbname_ = $dbname;
    }

    function db_get_connection(){
            // echo __FUNCTION__;
            return $this->conn_;
    }

    function db_close_connection() {
            mysql_close($this->conn_);
    }

}

function escape_fields($field)
{
	return mysql_real_escape_string(stripslashes($field));
}

?> 
