<?php
include_once ("DbConfig.php");

class Validation extends DBConfig
{
    public function __construct()
    {
        parent::__construct();
    }
    public function checkEmpty($data, $fields) 
    {
        $msg= null;
        foreach ($fields as $value) {
            if (empty($data[$value])) {
                $msg .= "$value empty <br />";
            }
        }
        return $msg;
    }
     public function isValid($field)
    {
        if(strlen($field)>30) {
            return true;
            } else {
        return false;
        }
    }
     public function makeString($field)
    {
        $string = join(',', $field);
            return $string;
        
    }
}
