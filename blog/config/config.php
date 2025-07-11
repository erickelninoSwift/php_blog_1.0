<?php 
    //host
    try {
    //
     $host = 'localhost';
    //bd name

    $db_name = 'blog';

    // username
    $user_name = 'root';

    //password
    $password = 'root';
     

    // PDO connection
    $connection = new PDO("mysql:host=$host;dbname=$db_name", $user_name, $password);

    // $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }catch(Exception $e){
        echo "Error: ".$e->getMessage()."";
    }