<?php include 'includes/session.php';
        include 'includes/db_functions.php';

    $_SESSION = array();

    if(isset($_COOKIE['session_name()'])){
        setcookie(session_name(), '', time()-4200, "/");
    }

    session_destroy();

    redirect_to("login.php?message=1");

?>