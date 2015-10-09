<?php

class UserDAL
{
    private static $path = "../Data/database.bin";
    private static $databaseFile;
    
    public function __construct()
    {
        if(file_exists(self::$path))
        {
            self::$databaseFile = fopen(self::$path, "a+");
            fclose(self::$databaseFile);
        }
    }
    
    public function addUser($userName, $password)
    {
        $Users = self::getUnserializedUsers();
        if($Users == false)
        {
            $Users = array();
        }
        array_push($Users, new User($userName, $password));
        
        $SerializedUsers = serialize($Users);
        file_put_contents(self::$path, $SerializedUsers);
    }
    
    public function getUnserializedUsers(){
        return unserialize(file_get_contents(self::$path));
    }
}