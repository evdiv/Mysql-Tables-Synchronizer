<?php

class Restore {

    private $db;
    private $dataFile;

    public $errors = array();

    function __construct() {
        $this->dataFile = OUTPUT_FILE;
        $this->db = new Database(TARGET_DB_HOST, TARGET_DB_USER, TARGET_DB_PASSWORD, TARGET_DB_NAME);
    }


    private function isEndOfLine($line = ''){
        if(empty($line)){
            return;
        }

        $line = trim($line);

        if(substr($line, - 6, 6) == ';--END'){
            return true;
        }
    }


    public function create() {

        if (!file_exists($this->dataFile)) {
            die("SQL file " . $this->dataFile . " doesn't exist");
        }
        
        $lines = file($this->dataFile);
        $sql = '';

        foreach ($lines as $line) {

            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if ($this->isEndOfLine($line)) {

                $sql = str_replace('--END', '', $sql);

                $this->db->query($sql);

                $sql = '';
            }
        } // end foreach

        $this->db->close();

        //Display errors
        if(count($this->db->errors) > 0){
            print_r($this->db->errors);
            return;
        }

        return true;
    }
}