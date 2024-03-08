<?php
class Connection {
    public $dbhost;
    public $dbuser;
    public $dbpass;
    public $dbname;
    public $connection;

    public function __construct() {
        $this->OpenConn();
    }

    public function OpenConn() {
        $this->dbhost = "localhost";
        $this->dbuser = "root";
        $this->dbpass = "";
        $this->dbname = "student_config";

        if(!isset($this->connection)) {
            $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
            if(!$this->connection) {
                echo "Error Connection!";
            }
        }

        return $this->connection;
    }
}
?>