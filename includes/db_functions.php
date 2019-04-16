<?php

function connect(){
    $link = new mysqli('localhost','inClass', 'secret', 'joker')
    or die('There was a problem connecting to the database');

    return $link;
}

//redirect page
function redirect_to($location){
    //header function redirects to the page which would be a parameter
    header('Location: ' . $location);
    exit();
}

function login($link, $username, $password){
   
    $sql = "select id, username, password, type from users where username = '$username'";
    $result = $link->query($sql);

    while($row=$result->fetch_row()){       

        if(password_verify($password, $row[2])){
            $_SESSION['username'] = $row[1];
            $_SESSION['id'] = $row[0];
            $_SESSION['type'] = $row[3];
            return true;
        }
        return false;
    }

}

?>