<?php  session_start();

function confirm_logged_in(){
    //if the username was not set in the session, redirect the user to the login page
    if(!isset($_SESSION['username'])){
        redirect_to('login.php?message=2');
    }
}

function confirm_logged_in_as_admin(){
    //if the username was not set in the session, redirect the user to the login page
    if(!isset($_SESSION['username'])){
        redirect_to('login.php?message=2');
    }else{
        if($_SESSION['type'] != 'admin'){
            redirect_to('login.php?message=3');
        }
    }
}

?>