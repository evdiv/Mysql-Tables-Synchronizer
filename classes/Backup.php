
<?php

class Backup 
{
    private $db;
    private $dataFile;

    function __construct() {
        $this->dataFile = OUTPUT_FILE;
        $this->db = new Database(SOURCE_DB_HOST, SOURCE_DB_USER, SOURCE_DB_PASSWORD, SOURCE_DB_NAME);
    }


    public function create($tables = '') {
        
        $tables = explode(',', $tables);
        $sql = '';

        foreach ($tables as $table) {

            // If the server has closed the connection, try to reconnect.
            $this->db->ping();

            // Drop existing table
            $sql .= "DROP TABLE IF EXISTS " . $table . ";--END\n\n";

            // Create a new table
            $rows = $this->db->query('SHOW CREATE TABLE ' . $table);
            $sql .= $rows[0][1] . ";--END\n\n";

            //Insert records
            $rows = $this->db->query('SELECT * FROM ' . $table);

            foreach ($rows as $row) {

                $sql .= 'INSERT INTO ' . $table . ' VALUES(';

                $fields = array();
                foreach($row as $field){
                    $fields[] = isset($field) ? '"' . addslashes($field) . '"' : '""';
                }

                $sql.= implode(', ', $fields);
                $sql.= ");--END\n";
            }

            $sql .="\n\n\n";
        }

        $this->db->close();

        //Display errors
        if(count($this->db->errors) > 0){
            print_r($this->db->errors);
        }


        return $sql;
    }


    public function store($sql = '') {
        if (empty($sql)){
            return;
        }
            
        try {
            $handle = fopen($this->dataFile, 'w+');
            fwrite($handle, $sql);
            fclose($handle);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return true;
    }
} 