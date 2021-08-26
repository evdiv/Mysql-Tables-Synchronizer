<?php

class Database
{
    private $host;
    private $userName;
    private $passwd;
    private $dbName;
    private $conn;

    public $errors = array();


    function __construct( $host, $userName, $passwd, $dbName) {
        $this->host = $host;
        $this->userName = $userName;
        $this->passwd = $passwd;
        $this->dbName = $dbName;

        $this->connect();
    }


    public function connect() {
        $this->conn = mysqli_connect( $this->host, $this->userName, $this->passwd, $this->dbName);

        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        return $this->conn;
    }


    public function query($sql = ''){
        if(empty($sql) ){
            return array();
        }
        
        $result = mysqli_query($this->conn, $sql);

        if(!$result){
            $this->errors[] = mysqli_error($this->conn);
            return array();
        }

        if($result === true){ //INSERT
            return true;
        }

        $rows = array();
        while ($row = mysqli_fetch_row($result)) {
            $rows[] = $row;
        }

        return $rows;
    }


    public function ping(){
        mysqli_ping($this->conn);
    }


    public function close() {
        mysqli_close( $this->conn);
    }
} 