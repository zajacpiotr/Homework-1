<?php
include_once ("DBConfig.php");

class Core extends DBConfig
{
    public function __construct()
    {
        parent::__construct();
    }
    public function readAll()
    {
        $query = "SELECT * FROM malfunction";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    public function insert($device, $description) 
    { 
        $query = "INSERT INTO malfunction (device, description) VALUES(:device, :description)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':device', $device, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();
    
        if ($stmt == false) {
            echo "Error: cannot insert";
            return false;
        } else {
            return true;
        }
    }
}
