<?php
try{

    function makeConnection($db){
        $link = new mysqli('localhost','inClass', 'secret', $db);

        if ($link->connect_errno > 0){
            echo "Unable to connect to database: ".$link->connect_error;
            exit();
        }

        if (!$link) {
            die("Connection failed" . $link->error);
        }
        return $link;
    }
}catch(Exception $e)
{
    echo $e->getMessage();
}
?>